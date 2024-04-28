<?php
class M_orders_tbl
{
    protected $conn;
    public function __construct()
    {
        $this->conn = new Database;
        $this->conn = $this->conn->dbObject();
    }


    public function enterOrder($invmng_id, $expected_date, $status, $suplier_id)
    {
        $result = mysqli_query($this->conn, "INSERT INTO orders_tbl(invmng_id, order_date , expected_date, 	status  , suplier_id ) VALUES ('$invmng_id', CURRENT_DATE(), '$expected_date', '$status' , '$suplier_id' )");
        $order_id = mysqli_insert_id($this->conn);
        if ($result) {
            return $order_id;
        } else {
            return false;
        }
    }

    // public function getAllData(){
    //     $result = mysqli_query($this->conn , "SELECT * FROM orders_tbl");
    //     $data =  mysqli_fetch_all($result , MYSQLI_ASSOC);
    //     return $data;
    // }

    public function orderTableData()
    {
        $result = mysqli_query($this->conn, "SELECT 
                id , 
                CONCAT('OR-', id) AS orderid, 
                order_date, 
                expected_date, 
                `status`, 
                invoice_id,
                suplier_id,
                (SELECT full_name FROM employees WHERE id=suplier_id) AS Supplier_name 
                FROM orders_tbl 
                WHERE invmng_id='" . $_SESSION["empid"] . "'");

        $result = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $result = array_reverse($result);
        return $result;
    }

    public function orderTableDataForSupplier()
    {
        $result = mysqli_query($this->conn, "SELECT 
                id , 
                CONCAT('OR-', id) AS orderid, 
                order_date, 
                expected_date, 
                status, 
                invoice_id,
                
                (SELECT full_name FROM employees WHERE id=suplier_id) AS Supplier_name 
                FROM orders_tbl 
                WHERE suplier_id='" . $_SESSION["empid"] . "'");

        $result = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $result = array_reverse($result);
        return $result;
    }

    public function getPendingOrders()
    {
        $result = mysqli_query($this->conn, "SELECT COUNT(*) AS pending_orders FROM orders_tbl WHERE status='Placed Order'");
        $result = mysqli_fetch_assoc($result);
        return $result['pending_orders'];
    }

    public function getCancelledOrders()
    {
        $result = mysqli_query($this->conn, "SELECT COUNT(*) AS cancelled_orders FROM orders_tbl WHERE status='Cancelled'");
        $result = mysqli_fetch_assoc($result);
        return $result['cancelled_orders'];
    }

    public function getSendInoviceCount()
    {
        $result = mysqli_query($this->conn, "SELECT COUNT(*) AS send_inovice FROM orders_tbl WHERE status='Send Invoice'");
        $result = mysqli_fetch_assoc($result);
        return $result['send_inovice'];
    }

    public function getMonthlyRevenue()
    {
        $result = mysqli_query($this->conn, "SELECT 
                YEAR(order_date) AS year,
                MONTH(order_date) AS month,
                COUNT(*) AS order_count
            FROM 
                orders_tbl
            WHERE 
            suplier_id  = " . $_SESSION['empid'] . "
                AND order_date >= DATE_SUB(CURDATE(), INTERVAL 6 MONTH)
            GROUP BY 
            suplier_id ,
                YEAR(order_date),
                MONTH(order_date)
            ORDER BY 
                year ASC,
                month ASC");

        $result = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $result;

    }

    public function getInventoryManagerID($order_id){
        $result = mysqli_query($this->conn , "SELECT invmng_id FROM orders_tbl WHERE id='$order_id'");
        $result = mysqli_fetch_assoc($result);
        return $result['invmng_id'];
    }

    public function updateInvoiceID($invoice_id , $order_id){
        $result = mysqli_query($this->conn , "UPDATE orders_tbl SET invoice_id='$invoice_id' WHERE id='$order_id'");
        if($result){
            return true;
        }else{
            return false;
        }
    }

    public function updateStatus($order_id , $status){
        $result = mysqli_query($this->conn , "UPDATE orders_tbl SET `status`='$status' WHERE id='$order_id'");
        if($result){
            return true;
        }else{
            return false;
        }
    }

    public function approveOrder($order_id){
        $result = mysqli_query($this->conn , "UPDATE orders_tbl SET `status`='Approved' WHERE id='$order_id'");
        if($result){
            return true;
        }else{
            return false;
        }
    }

    public function rejectOrder($order_id){
        $result = mysqli_query($this->conn , "UPDATE orders_tbl SET `status`='Rejected' WHERE id='$order_id'");
        if($result){
            return true;
        }else{
            return false;
        }
    }
}
?>