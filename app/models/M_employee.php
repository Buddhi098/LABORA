<?php
        class M_employee{
            protected $conn;
            public function __construct(){
                $this->conn = new Database;
                $this->conn = $this->conn->dbObject();
            }

            public function isExistEmail($email){
                $query =mysqli_query($this->conn , "SELECT * FROM employees WHERE email='$email'") ;
                if(mysqli_num_rows($query)>0){
                    return true;
                }else{
                    return false;
                }
            }
            public function isEnteredEmail($email){
                $duplicate = mysqli_query($this->conn , "SELECT * FROM employees WHERE email='$email'" );
                if(mysqli_num_rows($duplicate)>0){
                    return true;
                }else{
                    return false;
                }
            }

            public function enterUserData($name,$email,$phone,$dob,$address ,$gender ,$role, $password ){
                // get last row id
                $result =mysqli_query($this->conn , "SELECT * FROM employees ORDER BY id DESC LIMIT 1") ;
                $user = mysqli_fetch_assoc($result);
                $lastid = 0;
                if(isset($user['id'])){
                    $lastid = $user['id'];
                }
                

                $nextid = $lastid +1;
                $query = "INSERT INTO employees VALUES('$nextid','$name','$email','$phone','$dob','$address' ,'$gender' ,'$role', '$password')";
                mysqli_query($this->conn , $query);
                // echo
                // "<script> alert('Registration Successful');</script>";
            }


            public function getRow(){
                $result =mysqli_query($this->conn , "SELECT * FROM employees") ;
                return $result;       
            }

            public function getUser($email){
                $result =mysqli_query($this->conn , "SELECT * FROM employees WHERE email='$email'") ;
                if(mysqli_num_rows($result)>0){
                    $user = mysqli_fetch_assoc($result);
                    return $user;
                }
            }

            public function getPassword($email){
                $result =mysqli_query($this->conn , "SELECT * FROM employees WHERE email='$email'") ;
                if(mysqli_num_rows($result)>0){
                    $row = mysqli_fetch_assoc($result);
                    return $row["password"];
                }
                
            }

            public function deleteFromMail($email){
                $result = mysqli_query($this->conn ,"DELETE FROM employees WHERE email = '$email';") ;
            }

            public function getAllSupplier(){
                $supplier = mysqli_query($this->conn, "SELECT id, full_name, email, phone, address 
                FROM employees
                WHERE role='supplier' ORDER BY id ASC");
                if($supplier && mysqli_num_rows($supplier) > 0){
                    $supplier_array = array();
                    while($row = mysqli_fetch_assoc($supplier)){
                        $supplier_array[] = $row;
                    }
                    return $supplier_array;
                } else {
                    return false;
                }
            }
    }
?>