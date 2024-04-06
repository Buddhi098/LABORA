<?php
        class M_items{
            protected $conn;
            public function __construct(){
                $this->conn = new Database;
                $this->conn = $this->conn->dbObject();
            }


            public function enterItems($item_name , $item_type , $manufacture , $reorder_level , $description){
                $result = mysqli_query($this->conn, "INSERT INTO inventory_items (Item_name, item_type, reorder_limit, description, manufacturer) VALUES ('$item_name', '$item_type', '$reorder_level', '$description', '$manufacture')");

                if($result){
                    return true;
                }else{
                    return false;
                }
            }

            public function getItemDetails(){
                $result = mysqli_query($this->conn , "SELECT id, item_name, expire_date, quantity FROM order_item WHERE item_id = 23 AND expire_date IS NOT NULL");
                $data =  mysqli_fetch_all($result , MYSQLI_ASSOC);

                return $data;
            }

            public function getNameById($id){
                $name = mysqli_query($this->conn , "SELECT Item_name FROM  inventory_items WHERE id='$id'");
                $name = mysqli_fetch_assoc($name);

                if($name){
                    return $name['Item_name'];
                }else{
                    return false;
                }
            }
    }
?>