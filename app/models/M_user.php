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
                $query = "INSERT INTO patient_data VALUES('','$name','$email','$password','$phone','$dob','$address')";
                mysqli_query($this->conn , $query);
                echo
                "<script> alert('Registration Successful');</script>";
            }

            public function isExistEmail($email){
                $query =mysqli_query($this->conn , "SELECT * FROM patient_data WHERE email='$email'") ;
                echo mysqli_num_rows($query);
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

            public function getId($email){
                $result =mysqli_query($this->conn , "SELECT * FROM patient_data WHERE email='$email'") ;
                if(mysqli_num_rows($result)>0){
                    $row = mysqli_fetch_assoc($result);
                    return $row['id'];
                }
            }
    }
?>