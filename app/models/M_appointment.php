<?php
        class M_appointment{
            protected $conn;
            public function __construct(){
                $this->conn = new Database;
                $this->conn = $this->conn->dbObject();
            }
            public function enterAppointmentData($refno,$test_type,$appointment_date,$appointment_time,$appointment_duration,$appointment_status,$appointment_notes,$email){

                $result =mysqli_query($this->conn , "SELECT * FROM appointment ORDER BY id DESC LIMIT 1") ;
                $appointment = mysqli_fetch_assoc($result);
                $lastid = 0;
                if(isset($appointment['Id'])){
                    $lastid = $appointment['Id'];
                }
                

                $nextid = $lastid +1;
                $query = "INSERT INTO appointment VALUES('$nextid','$refno','$test_type','$appointment_date','$appointment_time','$appointment_duration','$appointment_status','$appointment_notes','$email')";
                mysqli_query($this->conn , $query);

                return true;
                // echo
                // "<script> alert('Registration Successful');</script>";
            }

            public function getNextId(){
                $result =mysqli_query($this->conn , "SELECT * FROM appointment ORDER BY id DESC LIMIT 1") ;
                $appointment = mysqli_fetch_assoc($result);
                $nextid = 1;
                if(isset($appointment['Id'])){
                    $nextid = $appointment['Id'] + 1;
                }
                return $nextid;
            }

            public function getRowByEmail($email){
                $result =mysqli_query($this->conn , "SELECT * FROM appointment WHERE patient_email='$email'") ;
                return $result;       
            }

            public function getRow(){
                $result =mysqli_query($this->conn , "SELECT * FROM appointment") ;
                return $result;       
            }

            public function getRowList($id){
                $result =mysqli_query($this->conn , "SELECT * FROM appointment WHERE Id='$id'");
                $row = mysqli_fetch_assoc($result);
                return $row;       
            }

            public function cancelAppointment($id){
                $result = mysqli_query($this->conn , "UPDATE appointment
                SET Appointment_Status = 'Canceled'
                WHERE Id = '$id'");
            }

            public function sendAppointment($id){
                $result = mysqli_query($this->conn , "UPDATE appointment
                SET Appointment_Status = 'Send to MLT'
                WHERE Id = '$id'");
            }
    }
?>