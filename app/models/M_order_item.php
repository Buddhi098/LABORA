<?php
        class M_order_item{
            protected $conn;
            public function __construct(){
                $this->conn = new Database;
                $this->conn = $this->conn->dbObject();
            }


            public function enterOrderItem($order_id , $item_id , $item_name , $quantity , $note){
                $result = mysqli_query($this->conn, "INSERT INTO order_item(order_id , item_id , item_name, quantity , note  ) VALUES ('$order_id', '$item_id', '$item_name', '$quantity' , '$note' )");
                if($result){
                    return true;
                }else{
                    return false;
                }
            }

            // public function getAllData(){
            //     $result = mysqli_query($this->conn , "SELECT * FROM order_item");
            //     $data =  mysqli_fetch_all($result , MYSQLI_ASSOC);

            //     return $data;
            // }

            public function getOrderItem($order_id){
                $result = mysqli_query($this->conn , "SELECT CONCAT('IT-' , id) AS item_id , item_name , quantity  , note FROM order_item WHERE order_id='$order_id'");
                $result_data = mysqli_fetch_all($result , MYSQLI_ASSOC);
                return $result_data;
            }
    }
?>