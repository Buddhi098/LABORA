<?php
        class M_appointment{
            protected $conn;
            public function __construct(){
                $this->conn = new Database;
                $this->conn = $this->conn->dbObject();
            }
            public function enterAppointmentData($refno,$test_type,$appointment_date,$appointment_time,$appointment_duration,$appointment_status,$appointment_notes,$email , $payment_method , $payment_status , $cost , $prescription){

                $result =mysqli_query($this->conn , "SELECT * FROM appointment ORDER BY id DESC LIMIT 1") ;
                $appointment = mysqli_fetch_assoc($result);
                $lastid = 0;
                if(isset($appointment['Id'])){
                    $lastid = $appointment['Id'];
                }
                

                $nextid = $lastid +1;
                $query = "INSERT INTO appointment VALUES('$nextid','$refno','$test_type','$appointment_date','$appointment_time','$appointment_duration','$appointment_status','$appointment_notes','$email' , '$payment_method' , '$payment_status' , '$cost' , '$prescription' , '' , '' , '' , '1')";
                $result = mysqli_query($this->conn , $query);

                if($result){
                    return true;
                }else{
                    return false;
                }
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
                $result =mysqli_query($this->conn , "SELECT * FROM appointment WHERE patient_email='$email' AND NOT (payment_method='online' AND payment_status='unpaid')") ;
                $result_data = mysqli_fetch_all($result , MYSQLI_ASSOC);
                if(!empty($result_data)){
                    return $result_data;
                }else{
                    return false;
                }       
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

            public function isAvailableDate($date , $time){
                $result =mysqli_query($this->conn , "SELECT * FROM appointment WHERE Appointment_Date='$date' AND Appointment_Time='$time'") ;
                $result_data = mysqli_fetch_all($result , MYSQLI_ASSOC);
                if(empty($result_data)){
                    return true;
                }else{
                    return false;
                }
            }

            public function doPayment($refno){

                $result = mysqli_query($this->conn , "UPDATE appointment
                SET Payment_Status = 'Paid'
                WHERE Ref_No = '$refno'");

                if($result){
                    return true;
                }else{
                    return false;
                }

            }

            public function getTotalRefund($email){
                $result = mysqli_query($this->conn , "SELECT SUM(cost) AS refund FROM appointment WHERE patient_email='$email' AND payment_status='paid' AND Appointment_Status='Canceled' AND payment_method='online'") ;
                $result_data = mysqli_fetch_all($result , MYSQLI_ASSOC);
                if(!empty($result_data[0]['refund'])){
                    return $result_data[0]['refund'];
                }else{
                    return 0;
                }
            }

            public function getTotalCost($email){
                $result = mysqli_query($this->conn , "SELECT SUM(cost) AS cost FROM appointment WHERE patient_email='$email' AND payment_status='paid'") ;
                $result_data = mysqli_fetch_all($result , MYSQLI_ASSOC);
                if(!empty($result_data[0]['cost'])){
                    return $result_data[0]['cost'];
                }else{
                    return 0;
                }
            }

            public function getUnpaidOnsiteAppointment($email){
                $result =mysqli_query($this->conn , "SELECT * FROM appointment WHERE patient_email='$email' AND payment_method='onsite' AND payment_status='unpaid' AND  Appointment_Status ='Pending'") ;
                $unpaid_appointment_count = mysqli_num_rows($result);
                return $unpaid_appointment_count;
            }

            public function getPendingAppointments(){
                $result =mysqli_query($this->conn , "SELECT * FROM appointment WHERE Appointment_Status='Pending'") ;
                $result_data = mysqli_fetch_all($result , MYSQLI_ASSOC);
                if(!empty($result_data)){
                    return $result_data;
                }else{
                    return false;
                }
            }

            public function setPassKey($appointment_id){
                $pass_key = $this->generateRandomString();
                $store_key = md5($pass_key);
                
                $result = mysqli_query($this->conn , "UPDATE appointment
                SET pass_code  = '$store_key '
                WHERE Id = '$appointment_id'");

                $result2 = mysqli_query($this->conn , "UPDATE appointment 
                SET  Appointment_Status='Complete' 
                WHERE Id = '$appointment_id'");

                return $pass_key;
            }

            public function generateRandomString($length = 10) {
                $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $randomString = '';
                $max = strlen($characters) - 1;
                for ($i = 0; $i < $length; $i++) {
                    $randomString .= $characters[random_int(0, $max)];
                }
                return $randomString;
            }

            public function getAppointmentByID($appointment_id){
                $appointment = mysqli_query($this->conn , "SELECT * FROM appointment WHERE id='$appointment_id'");
                $appointment = mysqli_fetch_assoc($appointment);
                return $appointment;
            }

            public function getAppointmentByPassKey($key){
                $hashed_key = md5($key);
                $appointment = mysqli_query($this->conn , "SELECT * FROM appointment WHERE  pass_code='$hashed_key' ");
                if(mysqli_num_rows($appointment)>0){
                    $appointment = mysqli_fetch_assoc($appointment);
                    return $appointment;
                }else{
                    return false;
                }
                
            }
            
    }
?>