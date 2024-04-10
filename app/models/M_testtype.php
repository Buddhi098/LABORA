<?php
        class M_testtype{
            protected $conn;
            public function __construct(){
                $this->conn = new Database;
                $this->conn = $this->conn->dbObject();
            }

            // public function enterUserData($name,$email,$password,$phone,$dob,$gender,$address){
            //     // get last row id
            //     $result =mysqli_query($this->conn , "SELECT * FROM patient_data ORDER BY patient_id DESC LIMIT 1") ;
            //     $user = mysqli_fetch_assoc($result);
            //     $lastid = 0;
            //     if(isset($user['patient_id'])){
            //         $lastid = $user['patient_id'];
            //     }
                

            //     $nextid = $lastid +1;
            //     $query = "INSERT INTO patient_data VALUES('$nextid','$name','$email','$password','$phone','$dob','$gender','$address')";
            //     mysqli_query($this->conn , $query);
            //     // echo
            //     // "<script> alert('Registration Successful');</script>";
            // }


            public function getDuration($test_type){
                $result =mysqli_query($this->conn , "SELECT * FROM test_type WHERE id='$test_type'") ;
                if(mysqli_num_rows($result)>0){
                    $row = mysqli_fetch_assoc($result);
                    return $row;
                    
                }  
            }

            public function getRow(){
                $result =mysqli_query($this->conn , "SELECT * FROM test_type");
                $result_set = mysqli_fetch_all( $result  , MYSQLI_ASSOC);
                return $result_set;       
            }

            public function getAvailableTime( $date , $start_time , $end_time){
                $result_set = mysqli_query($this->conn, "SELECT * FROM appointment WHERE Appointment_Date = '$date' AND Appointment_Time BETWEEN '$start_time' AND '$end_time' ORDER BY Appointment_Time DESC LIMIT 1;");
                if(mysqli_num_rows($result_set)){
                    $row = mysqli_fetch_assoc($result_set);
                    return $row;
                }
            }

            public function getTestTypeCount(){
                $result =mysqli_query($this->conn , "SELECT * FROM test_type");
                $count = mysqli_num_rows($result);
                return $count;
            }

            
    }
?>