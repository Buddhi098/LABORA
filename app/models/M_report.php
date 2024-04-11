<?php
        class M_report{
            protected $conn;
            public function __construct(){
                $this->conn = new Database;
                $this->conn = $this->conn->dbObject();
            }


            public function getRowByEmail($email){
                $result =mysqli_query($this->conn , "SELECT * FROM medical_report WHERE email='$email'") ;

                $rows = mysqli_fetch_all($result , MYSQLI_ASSOC) ;
                if(!empty($row)){
                    return $rows;
                }else{
                    return false;
                }     
            }

            public function deleteFromId($id){
                $result = mysqli_query($this->conn ,"DELETE FROM medical_report WHERE id = '$id';") ;
            }

            public function getReportCount($email){
                $result = mysqli_query($this->conn , "SELECT * FROM medical_report WHERE email='$email';") ;
                $report_count = mysqli_num_rows($result) ;
                return $report_count ;
            }
    }
?>