<?php
        class M_request_items{
            protected $conn;
            public function __construct(){
                $this->conn = new Database;
                $this->conn = $this->conn->dbObject();
            }

            public function getRequestItem($request_id){
                $result = mysqli_query($this->conn , "SELECT item_id , item_name , quantity  , note FROM requested_items WHERE request_id='$request_id'");
                $result_data = mysqli_fetch_all($result , MYSQLI_ASSOC);
                return $result_data;
            }
    }
?>