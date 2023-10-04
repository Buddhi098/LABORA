<?php
        class M_user{
            protected $conn;
            public function __construct(){
                $this->conn = new Database;
                $this->conn = $this->conn->dbObject();
            }
            public function isEnteredEmail($email){
                $duplicate = mysqli_query($this->conn , "SELECT * FROM patient_data WHERE email='$email'" );
                if(mysqli_num_rows($duplicate)>0){
                    return true;
                }else{
                    return false;
                }
            }

            public function enterUserData($name,$email,$password,$phone,$dob,$address){
                // get last row id
                $result =mysqli_query($this->conn , "SELECT * FROM patient_data ORDER BY ID DESC LIMIT 1") ;
                $user = mysqli_fetch_assoc($result);
                $lastid = $user['id'];

                $nextid = $lastid +1;
                $query = "INSERT INTO patient_data VALUES('$nextid','$name','$email','$password','$phone','$dob','$address')";
                mysqli_query($this->conn , $query);
                echo
                "<script> alert('Registration Successful');</script>";
            }

            public function isExistEmail($email){
                $query =mysqli_query($this->conn , "SELECT * FROM patient_data WHERE email='$email'") ;
                if(mysqli_num_rows($query)>0){
                    return true;
                }else{
                    return false;
                }
            }

            public function getPassword($email){
                $result =mysqli_query($this->conn , "SELECT * FROM patient_data WHERE email='$email'") ;
                if(mysqli_num_rows($result)>0){
                    $row = mysqli_fetch_assoc($result);
                    return $row["password"];;
                }
                
            }

            public function getUser($email){
                $result =mysqli_query($this->conn , "SELECT * FROM patient_data WHERE email='$email'") ;
                if(mysqli_num_rows($result)>0){
                    $user = mysqli_fetch_assoc($result);
                    return $user;
                }
            }
    }
?>