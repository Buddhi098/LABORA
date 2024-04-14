<?php
        class M_product{
            protected $conn;
            public function __construct(){
                $this->conn = new Database;
                $this->conn = $this->conn->dbObject();
            }

            public function getAllData()
            {
                $query = "SELECT i.id, i.Item_name, i.manufacturer, i.reorder_limit, SUM(o.quantity) AS total_quantity, i.description
                          FROM inventory_items i
                          LEFT JOIN order_item o ON i.id = o.item_id
                          GROUP BY i.id
                          ORDER BY i.id ASC";
            
                $result = mysqli_query($this->conn, $query);
                $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
                return $data;
            }

            public function enterItems($item_name , $total_quantity , $manufacture , $reorder_level , $description){
                $result = mysqli_query($this->conn, "INSERT INTO inventory_items (Item_name, total_quantity, reorder_limit, description, manufacturer) VALUES ('$item_name', '$item_type', '$reorder_level', '$description', '$manufacture')");

                if($result){
                    return true;
                }else{
                    return false;
                }
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