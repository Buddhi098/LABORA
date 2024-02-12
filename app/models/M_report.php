<?php
        class M_report{
            protected $conn;
            public function __construct(){
                $this->conn = new Database;
                $this->conn = $this->conn->dbObject();
            }


            public function getRowByEmail($email){
                $result =mysqli_query($this->conn , "SELECT * FROM medical_report WHERE email='$email'") ;
                return $result;       
            }

            public function deleteFromId($id){
                $result = mysqli_query($this->conn ,"DELETE FROM medical_report WHERE id = '$id';") ;
            }
    }
?>