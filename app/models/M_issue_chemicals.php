<?php
        class M_issue_chemicals{
            protected $conn;
            public function __construct(){
                $this->conn = new Database;
                $this->conn = $this->conn->dbObject();
            }

        public function getAllData(){
            $result = mysqli_query($this->conn, "SELECT id, 
            CONCAT('REQ-', id) AS request_id,
            request_date, 
            delivered_date, 
            status, 
            note 
            FROM lab_order");
            $result = mysqli_fetch_all($result , MYSQLI_ASSOC);
            return $result;
        }


           
    }
?>