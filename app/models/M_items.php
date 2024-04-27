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

            public function enterItems($item_name , $manufacture , $reorder_level , $description, $unit_of_measure){
                $result = mysqli_query($this->conn, "INSERT INTO inventory_items 
                (Item_name, reorder_limit, description, manufacturer, unit_of_measure) 
                VALUES ('$item_name', '$reorder_level', '$description', '$manufacture','$unit_of_measure')");

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
                $result = mysqli_query($this->conn , "SELECT * 
                FROM inventory_items");
                $data =  mysqli_fetch_all($result , MYSQLI_ASSOC);

                return $data;
            }

            public function getAllDataByID($itemId){
                $result = mysqli_query($this->conn , "SELECT * 
                FROM inventory_items WHERE id = '$itemId'");
                $data =  mysqli_fetch_all($result , MYSQLI_ASSOC);

                return $data;
            }

            // public function getItemDetails(){
            //     $result = mysqli_query($this->conn , "SELECT id, item_name, expire_date, quantity FROM order_item WHERE item_id = 23 AND expire_date IS NOT NULL");
            //     $data =  mysqli_fetch_all($result , MYSQLI_ASSOC);

            //     return $data;
            // }

            public function getNameById($id){
                $name = mysqli_query($this->conn , "SELECT Item_name 
                FROM  inventory_items 
                WHERE id='$id'");
                $name = mysqli_fetch_assoc($name);

                if($name){
                    return $name['Item_name'];
                }else{
                    return false;
                }
            }

            // public function updateItem($itemId, $itemName, $manufacture,  $reorderLimit, $unitOfMeasure, $description){
            //     $result = mysqli_query($this->conn, "UPDATE inventory_items 
            //     SET Item_name = '$item_name' , 
            //     reorder_limit = '$reorder_level',
            //     unit_of_measure = '$unitOfMeasure', 
            //     manufacturer = '$manufacture', 
            //     description = '$description' 
            //     WHERE id = '$itemId'");

            //     if($result){
            //         return true;
            //     }else{
            //         return false;
            //     }
            // }

            public function changeName($id , $name){
                $result = mysqli_query($this->conn , "UPDATE inventory_items
                SET Item_name = '$name'
                WHERE id = '$id'");
            }

            public function changeManufacturer($id , $manufacturer){
                $result = mysqli_query($this->conn , "UPDATE inventory_items
                SET manufacturer = '$manufacturer'
                WHERE id = '$id'");
            }

            public function changeReorderLimit($id , $reorder_limit){
                $result = mysqli_query($this->conn , "UPDATE inventory_items
                SET reorder_limit = '$reorder_limit'
                WHERE id = '$id'");
            }
            public function changeUnitOfMeasure($id , $unit_of_measure){
                $result = mysqli_query($this->conn , "UPDATE inventory_items
                SET unit_of_measure = '$unit_of_measure'
                WHERE id = '$id'");
            }
            public function changeDescription($id , $description){
                $result = mysqli_query($this->conn , "UPDATE inventory_items
                SET description = '$description'
                WHERE id = '$id'");
            }

            public function getReorderData(){
                $result = mysqli_query($this->conn , "SELECT 
                ii.*, 
                CASE 
                    WHEN oi.item_id IS NOT NULL THEN 'Yes'
                    ELSE 'No'
                END AS status
            FROM 
                inventory_items ii
            LEFT JOIN 
                order_item oi ON ii.id = oi.item_id
            WHERE 
                ii.quantity <= ii.reorder_limit
            ORDER BY 
                status ASC;
            
            
                ");
                $data =  mysqli_fetch_all($result , MYSQLI_ASSOC);

                return $data;
            }

            public function getReorderFormData(){
                $result = mysqli_query($this->conn , "SELECT 
                ii.*
            FROM 
                inventory_items ii
            LEFT JOIN 
                order_item oi ON ii.id = oi.item_id
            WHERE 
                ii.quantity <= ii.reorder_limit
                AND oi.item_id IS NULL;  
                ");
                $data =  mysqli_fetch_all($result , MYSQLI_ASSOC);

                return $data;
            }

            public function getExpiredItem(){
                $result = mysqli_query($this->conn , "SELECT id, item_id, item_name, quantity, expire_date 
                FROM order_item 
                WHERE expire_date <= CURDATE() + INTERVAL 21 DAY ORDER BY expire_date ASC;
                ");
                $result = mysqli_fetch_all($result , MYSQLI_ASSOC);
                return $result;
            }

            public function deleteExpiredItem($itemId)
            {
                $result = mysqli_query($this->conn , "DELETE FROM order_item WHERE id = '$itemId'");
                $data =  mysqli_fetch_all($result , MYSQLI_ASSOC);

                if ($data) {
                    return true;
                } else {
                    return false;
                }
            }

            public function getFilteredExpiredItems($startDate, $endDate) {
                $result = mysqli_query($this->conn , "SELECT id, item_id, item_name, quantity, expire_date 
                            FROM order_item 
                            WHERE expire_date BETWEEN '$startDate' AND '$endDate' ORDER BY expire_date ASC");
                $result = mysqli_fetch_all($result , MYSQLI_ASSOC);
                return $result;
            }
            


            

    }
?>