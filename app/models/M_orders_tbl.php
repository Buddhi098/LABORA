<?php
        class M_orders_tbl{
            protected $conn;
            public function __construct(){
                $this->conn = new Database;
                $this->conn = $this->conn->dbObject();
            }


            public function enterOrder($invmng_id , $expected_date , $status , $suplier_id ){
                $result = mysqli_query($this->conn, "INSERT INTO orders_tbl(invmng_id, order_date , expected_date, 	status  , suplier_id ) VALUES ('$invmng_id', CURRENT_DATE(), '$expected_date', '$status' , '$suplier_id' )");
                $order_id = mysqli_insert_id($this->conn);
                if($result){
                    return $order_id;
                }else{
                    return false;
                }
            }

            // public function getAllData(){
            //     $result = mysqli_query($this->conn , "SELECT * FROM orders_tbl");
            //     $data =  mysqli_fetch_all($result , MYSQLI_ASSOC);
            //     return $data;
            // }

            public function orderTableData(){
                $result = mysqli_query($this->conn, "SELECT 
                id , 
                CONCAT('OR-', id) AS orderid, 
                order_date, 
                expected_date, 
                status, 
                invoice_id,
                
                (SELECT full_name FROM employees WHERE id=suplier_id) AS Supplier_name 
                FROM orders_tbl 
                WHERE invmng_id='".$_SESSION["empid"]."'");
                
                $result = mysqli_fetch_all($result , MYSQLI_ASSOC);
                return $result;
            }
    }
?>