<?php
        class M_user{
            protected $conn;
            public function __construct(){
                $this->conn = new Database;
                $this->conn = $this->conn->dbObject();
            }
            public function isEnteredEmail($email){
                $duplicate = mysqli_query($this->conn , "SELECT * FROM patient_data WHERE patient_email='$email'" );
                if(mysqli_num_rows($duplicate)>0){
                    return true;
                }else{
                    return false;
                }
            }

            public function enterUserData($name,$email,$password,$phone,$dob,$gender,$address){
                // get last row id
                $result =mysqli_query($this->conn , "SELECT * FROM patient_data ORDER BY patient_id DESC LIMIT 1") ;
                $user = mysqli_fetch_assoc($result);
                $lastid = 0;
                if(isset($user['patient_id'])){
                    $lastid = $user['patient_id'];
                }
                

                $nextid = $lastid +1;
                $query = "INSERT INTO patient_data VALUES('$nextid','$name','$email','$password','$phone','$dob','$gender','$address')";
                mysqli_query($this->conn , $query);
                // echo
                // "<script> alert('Registration Successful');</script>";
            }

            public function isExistEmail($email){
                $query =mysqli_query($this->conn , "SELECT * FROM patient_data WHERE patient_email='$email'") ;
                if(mysqli_num_rows($query)>0){
                    return true;
                }else{
                    return false;
                }
            }

            public function getPassword($email){
                $result =mysqli_query($this->conn , "SELECT * FROM patient_data WHERE patient_email='$email'") ;
                if(mysqli_num_rows($result)>0){
                    $row = mysqli_fetch_assoc($result);
                    return $row["password"];;
                }
                
            }

            public function getUser($email){
                $result =mysqli_query($this->conn , "SELECT * FROM patient_data WHERE patient_email='$email'") ;
                if(mysqli_num_rows($result)>0){
                    $user = mysqli_fetch_assoc($result);
                    return $user;
                }
            }

            public function getUserName($email){
                $result =mysqli_query($this->conn , "SELECT * FROM patient_data WHERE patient_email='$email'") ;
                if(mysqli_num_rows($result)>0){
                    $user = mysqli_fetch_assoc($result);
                    return $user['patient_name'];
                }
            }

            public function changeName($email , $name){
                $result = mysqli_query($this->conn , "UPDATE patient_data
                SET patient_name = '$name'
                WHERE patient_email = '$email'");
            }

            public function changePhone($email , $phone){
                $result = mysqli_query($this->conn , "UPDATE patient_data
                SET patient_phone = '$phone'
                WHERE patient_email = '$email'");
            }

            public function changeDob($email , $dob){
                $result = mysqli_query($this->conn , "UPDATE patient_data
                SET patient_dob = '$dob'
                WHERE patient_email = '$email'");
            }

            public function changeAddress($email , $address){
                $result = mysqli_query($this->conn , "UPDATE patient_data
                SET patient_address = '$address'
                WHERE patient_email = '$email'");
            }

            public function getRow(){
                $result =mysqli_query($this->conn , "SELECT * FROM patient_data") ;
                return $result;       
            }
    }
?>