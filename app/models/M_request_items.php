<?php
        class M_request_items{
            protected $conn;
            public function __construct(){
                $this->conn = new Database;
                $this->conn = $this->conn->dbObject();
            }

            public function getRequestItem($request_id){
                $result = mysqli_query($this->conn , "SELECT *
                FROM lab_order_item 
                WHERE order_id='$request_id'");
                $result_data = mysqli_fetch_all($result , MYSQLI_ASSOC);
                return $result_data;
            }
    }
?>