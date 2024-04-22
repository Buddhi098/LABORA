<?php
class M_lab_order_item
{
    protected $conn;
    public function __construct()
    {
        $this->conn = new Database;
        $this->conn = $this->conn->dbObject();
    }

    public function enterLabOrderItem($storeOrderId , $item_id ,$item_name , $item_quantity ,$item_note )
    {

        $result = mysqli_query($this->conn, "INSERT INTO lab_order_item(order_id  , `item_id` , item_name ,quantity,note) VALUES ('$storeOrderId' , '$item_id' , '$item_name' ,'$item_quantity','$item_note' )");
        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    public function getRequestItems($order_id){
        $result = mysqli_query($this->conn, "SELECT * FROM lab_order_item WHERE order_id = '$order_id'");
        $result = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $result;
    }


}

?>