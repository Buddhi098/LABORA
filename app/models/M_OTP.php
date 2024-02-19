<?php
        class M_OTP{
            protected $conn;
            public function __construct(){
                $this->conn = new Database;
                $this->conn = $this->conn->dbObject();
            }

            public function enterOTP($email , $OTP_code){
                $query = "INSERT INTO otptable VALUES('','$email' , '$OTP_code')";
                mysqli_query($this->conn , $query);
                echo
                "<script> alert('Check your inbox');</script>";
            }

            public function isExistEmail($email){
                $query =mysqli_query($this->conn , "SELECT * FROM otptable WHERE email='$email'") ;
                if(mysqli_num_rows($query)>0){
                    return true;
                }else{
                    return false;
                }
            }

            public function getOTP($email){
                $result =mysqli_query($this->conn , "SELECT * FROM otptable WHERE email='$email' ORDER BY id DESC") ;
                if(mysqli_num_rows($result)>0){
                    $row = mysqli_fetch_assoc($result);
                    return $row["otp"];
                }
                
            }

            public function dropOTP($email){
                mysqli_query($this->conn, "DELETE FROM otptable WHERE email='$email'");
            }
            
    }
?>