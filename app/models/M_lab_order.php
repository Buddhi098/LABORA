<?php
class M_lab_order
{
    protected $conn;
    public function __construct()
    {
        $this->conn = new Database;
        $this->conn = $this->conn->dbObject();
    }

    public function enterLabOrder($note)
    {
        $today = date("Y-m-d");

        $result = mysqli_query($this->conn, "INSERT INTO lab_order(request_date , `status` , note) VALUES ('$today' , 'Pending' , '$note' )");
        $order_id = mysqli_insert_id($this->conn);
        if ($result) {
            return $order_id;
        } else {
            return false;
        }
    }

    public function getRequestOrder(){
        $result = mysqli_query($this->conn, "SELECT * FROM lab_order");
        $result = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $result;
    }

    public function cancelOrder($order_id){
        $result = mysqli_query($this->conn, "UPDATE lab_order SET status = 'Canceled' WHERE id = '$order_id'");
        if ($result) {
            return $result;
        } else {
            return false;
        }
    }


}

?>