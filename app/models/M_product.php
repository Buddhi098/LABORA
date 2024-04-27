<?php
        class M_product{
            protected $conn;
            public function __construct(){
                $this->conn = new Database;
                $this->conn = $this->conn->dbObject();
            }

            // public function getAllData()
            // {
            //     $query = "SELECT
            //     i.id,
            //     i.Item_name,
            //     i.manufacturer,
            //     i.reorder_limit,
            //     SUM(CASE WHEN oi.expire_date IS NOT NULL THEN oi.quantity ELSE 0 END) AS total_quantity,
            //     i.unit_of_measure,
            //     i.description
            // FROM
            //     inventory_items i
            // LEFT JOIN
            //     order_item oi ON i.id = oi.item_id
            // GROUP BY
            //     i.id
            // ORDER BY
            //     i.id ASC";
            
            //     $result = mysqli_query($this->conn, $query);
            //     $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
            //     return $data;
            // }

             public function getAllData()
            {
                $query = "SELECT *
            FROM
                inventory_items
            ORDER BY
                id ASC";
            
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
            public function getItemBySupplier($supplier_id){
                $result = mysqli_query($this->conn , " SELECT 
                oi.item_id,
                ii.Item_name
            FROM 
                order_item oi
            LEFT JOIN 
                orders_tbl o ON o.id = oi.order_id
           AND o.status = 'complete'
            
            LEFT JOIN 
                inventory_items ii ON oi.item_id = ii.id
            WHERE suplier_id='$supplier_id'
            
            ORDER BY 
                ii.id ASC;");
                $result_data = mysqli_fetch_all($result , MYSQLI_ASSOC);
                return $result_data;
            }   
    

        }

       
       
    
?>