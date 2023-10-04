<?php
        class M_employee{
            protected $conn;
            public function __construct(){
                $this->conn = new Database;
                $this->conn = $this->conn->dbObject();
            }
            public function isExistEmail($email){
                $duplicate = mysqli_query($this->conn , "SELECT * FROM emp WHERE empemail='$email'" );
                if(mysqli_num_rows($duplicate)>0){
                    return true;
                }else{
                    return false;
                }
            }

            public function getPassword($email){
                $result =mysqli_query($this->conn , "SELECT * FROM emp WHERE empemail='$email'") ;
                if(mysqli_num_rows($result)>0){
                    $row = mysqli_fetch_assoc($result);
                    return $row["emppwd"];;
                }
                
            }

            public function getUser($email){
                $result =mysqli_query($this->conn , "SELECT * FROM emp WHERE empemail='$email'") ;
                if(mysqli_num_rows($result)>0){
                    $user = mysqli_fetch_assoc($result);
                    return $user;
                }
            }
    }
?>