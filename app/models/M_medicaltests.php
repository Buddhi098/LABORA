<?php
        class M_medicaltests{
            protected $conn;
            public function __construct(){
                $this->conn = new Database;
                $this->conn = $this->conn->dbObject();
            }

            public function isExistTest($test_name){
                $query =mysqli_query($this->conn , "SELECT * FROM medical_tests WHERE test_name='$test_name'") ;
                if(mysqli_num_rows($query)>0){
                    return true;
                }else{
                    return false;
                }
            }
            // public function isEnteredEmail($email){
            //     $duplicate = mysqli_query($this->conn , "SELECT * FROM employees WHERE email='$email'" );
            //     if(mysqli_num_rows($duplicate)>0){
            //         return true;
            //     }else{
            //         return false;
            //     }
            // }

            public function enterTestData($test_name,$short_name,$test_type,$availability,$description,$preparation ,$time){
                // get last row id
                $result =mysqli_query($this->conn , "SELECT * FROM medical_tests ORDER BY id DESC LIMIT 1") ;
                $test = mysqli_fetch_assoc($result);
                $lastid = 0;
                if(isset($test['id'])){
                    $lastid = $test['id'];
                }
                

                $nextid = $lastid +1;
                $query = "INSERT INTO medical_tests VALUES('$nextid','$test_name','$short_name','$test_type','$availability','$description','$preparation' ,'$time')";
                mysqli_query($this->conn , $query);
                // echo
                // "<script> alert('Registration Successful');</script>";
            }


            public function getRow(){
                $result =mysqli_query($this->conn , "SELECT * FROM medical_tests") ;
                return $result;
            }

            public function getTest($test_name){
                $result =mysqli_query($this->conn , "SELECT * FROM medical_tests WHERE test_name='$test_name'") ;
                if(mysqli_num_rows($result)>0){
                    $test = mysqli_fetch_assoc($result);
                    return $test;
                }
            }

            // public function getPassword($email){
            //     $result =mysqli_query($this->conn , "SELECT * FROM employees WHERE email='$email'") ;
            //     if(mysqli_num_rows($result)>0){
            //         $row = mysqli_fetch_assoc($result);
            //         return $row["password"];
            //     }
                
            // }

            public function deleteFromTest($id){
                $result = mysqli_query($this->conn ,"DELETE FROM medical_tests WHERE id = '$id';") ;
            }

            
            public function updateAvailability($testId, $newAvailability) {
                // Your SQL query to update availability in the database
                $sql = "UPDATE medical_tests SET availability = '$newAvailability' WHERE id = $testId";
                
                // Execute the query (you may need to adjust this based on your database connection method)
                $result = mysqli_query($this->conn, $sql);
                
                // Check if the query was successful
                if ($result) {
                    return true; // Return true if update was successful
                } else {
                    return false; // Return false if there was an error
                }
            }
            
    }
?>