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

        public function removeSupplyRequest($request_id){
            $result = mysqli_query($this->conn, "DELETE FROM 
            lab_order 
            WHERE id='$request_id';");
           
            return $result;
        }

        public function removeSupplyRequestItem($request_id){
            $result = mysqli_query($this->conn, "DELETE FROM 
             lab_order_item 
             WHERE order_id='$request_id';");
            return $result;
        }

        public function denySupplyRequest($request_id){
            $result = mysqli_query($this->conn, "UPDATE lab_order 
            SET status = 'Denied' 
            WHERE id = '$request_id';");
            return $result;
        }

        public function approveSupplyRequest($request_id){
            $result = mysqli_query($this->conn, "UPDATE lab_order 
            SET status = 'Approved' 
            WHERE id = '$request_id';");
            return $result;
        }
        public function approveSupplyItem($request_id){
            $result = mysqli_query($this->conn, "UPDATE inventory_items i
            JOIN (
                SELECT item_id, SUM(quantity) AS total_quantity
                FROM lab_order_item
                WHERE order_id = '$request_id'
                GROUP BY item_id
            ) loi ON i.id = loi.item_id
            SET i.quantity = i.quantity - loi.total_quantity;
            ");
            return $result;
        }

        public function approveDelivaryDate($request_id){
            $result = mysqli_query($this->conn, "UPDATE lab_order 
            SET delivered_date = CURDATE() 
            WHERE id = '$request_id';
            ;");
            return $result;
        }
           
    }
?>