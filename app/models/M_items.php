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
            public function getItemDetailsWithExpiry($itemId)
            {
                $query = "SELECT o.id, o.item_name, o.expire_date, o.quantity, i.manufacturer
                        FROM order_item o
                        JOIN inventory_items i ON o.item_id = i.id
                        WHERE o.item_id = ? AND o.expire_date IS NOT NULL
                        ORDER BY o.expire_date ASC";

                $stmt = mysqli_prepare($this->conn, $query);
                mysqli_stmt_bind_param($stmt, 'i', $itemId);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
                return $data;
            }
    }
?>