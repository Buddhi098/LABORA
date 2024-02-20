<?php
        class M_product{
            protected $conn;
            public function __construct(){
                $this->conn = new Database;
                $this->conn = $this->conn->dbObject();
            }
            // public function enterItemData($item_name,$quantity,$reorder_level){
            //     // get last row id
            //     $result =mysqli_query($this->conn , "SELECT * FROM inventorychemical ORDER BY item_id  DESC LIMIT 1") ;
            //     $item = mysqli_fetch_assoc($result);
            //     $lastid = 0;
            //     if(isset($item['item-id'])){
            //         $lastid = $item['item-id'];
            //     }

            //     $nextid = $lastid +1;
            //     $query = "INSERT INTO inventorychemical VALUES('$nextid','$item_name','$quantity','$reorder_level')";
            //     mysqli_query($this->conn , $query);
            //     // echo
            //     // "<script> alert('Item is Successfully added to the system');</script>";
            // }
            public function enterItemData($item_name, $reorder_level){
                $query = "INSERT INTO inventorychemical (item_name, reorder_level) VALUES ('$item_name',  '$reorder_level')";
                mysqli_query($this->conn, $query);
            }
            public function getRowById(){
                $result =mysqli_query($this->conn , "SELECT * FROM inventorychemical") ;
                return $result;       
            }

            public function getNextId(){
                $result = mysqli_query($this->conn, "SELECT MAX(item_id) as max_id FROM inventorychemical");
                $row = mysqli_fetch_assoc($result);
                return $row['max_id'] + 1;
            }

            public function deleteItemById($item_id){
                $query = "DELETE FROM inventorychemical WHERE Item_Id = '$item_id'";
                return mysqli_query($this->conn, $query);
            }

            public function getItemById($item_id){
                $query = "SELECT * FROM inventorychemical WHERE Item_Id = '$item_id'";
                $result = mysqli_query($this->conn, $query);
                return mysqli_fetch_assoc($result);
            }
            
            public function isItemNameExists($item_name) {
                $query = "SELECT * FROM inventorychemical WHERE Item_Name = '$item_name'";
                $result = mysqli_query($this->conn, $query);
                return mysqli_num_rows($result) > 0;
            }
            

        
    }
?>