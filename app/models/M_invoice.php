<?php
class M_invoice
{
    protected $conn;
    public function __construct()
    {
        $this->conn = new Database;
        $this->conn = $this->conn->dbObject();
    }


    public function setInvoice($sup_id, $invmng_id, $status, $order_id)
    {
        $result = mysqli_query($this->conn, "INSERT INTO  order_invoice_tbl (supplier_id , inv_id  , invoice_date, 	`status`  , order_id  ) VALUES ('$sup_id', '$invmng_id', CURRENT_DATE(), '$status' , '$order_id' )");
        $invoice_id = mysqli_insert_id($this->conn);
        if ($result) {
            return $invoice_id;
        } else {
            return false;
        }
    }

    // public function getAllData(){
    //     $result = mysqli_query($this->conn , "SELECT * FROM orders_tbl");
    //     $data =  mysqli_fetch_all($result , MYSQLI_ASSOC);
    //     return $data;
    // }

    public function getInvoiceData($order_id)
    {
        $result = mysqli_query($this->conn, "SELECT CONCAT('OR-', id) AS invoice_id, order_date, expected_date, status, invoice_id, (SELECT full_name FROM employees WHERE id=suplier_id) AS Supplier_name FROM orders_tbl WHERE invmng_id='" . $_SESSION["empid"] . "'");
        $result_data = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $result_data;
    }
}
?>