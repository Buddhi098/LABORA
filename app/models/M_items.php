<?php
        class M_items{
            protected $conn;
            public function __construct(){
                $this->conn = new Database;
                $this->conn = $this->conn->dbObject();
            }

            public function getItemDetail($id){
                $result = mysqli_query($this->conn , "SELECT
                oi.id,
                o.suplier_id,
                oi.expire_date,
                oi.quantity 
            FROM
                order_item oi
            JOIN
                orders_tbl o ON oi.order_id = o.id
            WHERE
                oi.item_id = '$id'
            AND
                oi.expire_date IS NOT NULL
            ORDER BY
                oi.expire_date ASC");

                $result_data = mysqli_fetch_all($result , MYSQLI_ASSOC);
                return $result_data;
            }

            public function enterItems($item_name , $manufacture , $reorder_level , $description){
                $result = mysqli_query($this->conn, "INSERT INTO inventory_items (Item_name, reorder_limit, description, manufacturer) VALUES ('$item_name', '$reorder_level', '$description', '$manufacture')");

                if($result){
                    return true;
                }else{
                    return false;
                }
            }

            // public function editItems($itemId, $itemName, $reorderLimit, $manufacturer, $description) {
            //     $sql = "UPDATE inventory_items SET Item_name = ?, reorder_limit = ?, manufacturer = ?, description = ? WHERE id = ?";
            //     $stmt = $this->conn->prepare($sql);
            //     $stmt->bind_param("ssisi", $itemName, $reorderLimit, $manufacturer, $description, $itemId);
            //     $result = $stmt->execute();
            //     return $result;
            // }

            public function getAllData(){
                $result = mysqli_query($this->conn , "SELECT * FROM inventory_items");
                $data =  mysqli_fetch_all($result , MYSQLI_ASSOC);

                return $data;
            }

            // public function getItemDetails(){
            //     $result = mysqli_query($this->conn , "SELECT id, item_name, expire_date, quantity FROM order_item WHERE item_id = 23 AND expire_date IS NOT NULL");
            //     $data =  mysqli_fetch_all($result , MYSQLI_ASSOC);

            //     return $data;
            // }

            public function getNameById($id){
                $name = mysqli_query($this->conn , "SELECT Item_name FROM  inventory_items WHERE id='$id'");
                $name = mysqli_fetch_assoc($name);

                if($name){
                    return $name['Item_name'];
                }else{
                    return false;
                }
            }

            public function editItems($item_name , $manufacture , $reorder_level , $description){
                $result = mysqli_query($this->conn, "UPDATE inventory_items SET Item_name = '$item_name' , reorder_limit = '$reorder_level', manufacturer = '$manufacture', description = '$description' WHERE id = ?");

                if($result){
                    return true;
                }else{
                    return false;
                }
            }

            public function getItemById($itemId) {
                $sql = "SELECT * FROM inventory_items WHERE id = ?";
                $stmt = $this->conn->prepare($sql);
                $stmt->bind_param("i", $itemId);
                $stmt->execute();
                $result = $stmt->get_result();
                return $result->fetch_assoc();
            }
        
            public function updateItem($itemId, $itemName, $manufacturer, $reorderLimit, $description) {
                $sql = "UPDATE inventory_items SET Item_name = ?, manufacturer = ?, reorder_limit = ?, description = ? WHERE id = ?";
                $stmt = $this->conn->prepare($sql);
                $stmt->bind_param("ssisi", $itemName, $manufacturer, $reorderLimit, $description, $itemId);
                $result = $stmt->execute();
                return $result;
            }

    }
?>