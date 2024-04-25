<?php

 class M_supplier_item_quantity_chart{

    protected $conn;

    public function __construct(){

        $this->conn=new Database();

        $this->conn=$this->conn->dbObject();
    }


    public function getItemQuantityData(){

        $result_data=array();

        //query to fetch the item_name and quantity from requested_items
        $query="SELECT 
                item_name,quantity
                
                FROM
                requested_items";
                
                $result = mysqli_query($this->conn, $query);

                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $result_data[] = array(
                            'item_name' => $row['item_name'],
                            'quantity' => $row['quantity']
                        );
                    }
                } else {
                    // Handle query execution error
                    return false;
                }
            
                return $result_data;
            }
 }

?>