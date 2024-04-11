<?php
        class M_issue_chemicals{
            protected $conn;
            public function __construct(){
                $this->conn = new Database;
                $this->conn = $this->conn->dbObject();
            }

        public function getAllData(){
            $result = mysqli_query($this->conn, "SELECT request_id, requested_by, request_date, requested_delivery_date, status, notes FROM supply_requests");
            $result = mysqli_fetch_all($result , MYSQLI_ASSOC);
            return $result;
        }


           
    }
?>