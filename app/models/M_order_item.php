<?php
class M_order_item
{
    protected $conn;
    public function __construct()
    {
        $this->conn = new Database;
        $this->conn = $this->conn->dbObject();
    }


    public function enterOrderItem($order_id, $item_id, $item_name, $quantity, $note)
    {
        $result = mysqli_query($this->conn, "INSERT INTO order_item(order_id , item_id , item_name, quantity , note  ) VALUES ('$order_id', '$item_id', '$item_name', '$quantity' , '$note' )");
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    // public function getAllData(){
    //     $result = mysqli_query($this->conn , "SELECT * FROM order_item");
    //     $data =  mysqli_fetch_all($result , MYSQLI_ASSOC);

    //     return $data;
    // }

    public function getOrderItem($order_id)
    {
        $result = mysqli_query($this->conn, "SELECT 
                CONCAT('IT-' , id) AS item_id , 
                item_name , 
                quantity  , 
                note 
                FROM order_item 
                WHERE order_id='$order_id'");
        $result_data = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $result_data;
    }

    public function getSupplierItems($supplier_id)
    {
        $result = mysqli_query($this->conn, "SELECT DISTINCT
                oi.item_id,
                ii.Item_name
            FROM 
                order_item oi
            LEFT JOIN 
                orders_tbl o ON o.id = oi.order_id
            LEFT JOIN 
                inventory_items ii ON oi.item_id = ii.id
            WHERE 
                o.suplier_id = '$supplier_id'
            ORDER BY 
                ii.id ASC;
            ");
        $result_data = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $result_data;
    }

    // public function removeOrderItem($item_id){
    //     $result = mysqli_query($this->conn, "DELETE FROM 
    //      order_item 
    //      WHERE item_id='$item_id';");
    //     return $result;
    // }

    public function getExpiredItem()
    {
        $result = mysqli_query($this->conn, "SELECT id, item_id, item_name, quantity, expire_date 
                FROM order_item 
                WHERE expire_date <= CURDATE() AND is_removed = 0
                ORDER BY expire_date ASC;
                ");
        $result = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $result;
    }

    public function deleteExpiredItem($itemId)
    {
        $result = mysqli_query($this->conn, "UPDATE order_item 
                SET is_removed = 1
                WHERE id = '$itemId';");

        return $result;

    }

    // public function getExpiredItemsByDateRange($startDate, $endDate)
    // {
    //     $result = mysqli_query($this->conn , "SELECT id, item_id, item_name, expire_date, quantity
    //             FROM order_item
    //             WHERE expire_date >= '$startDate' AND expire_date <= '$endDate';
    //             ");

    //     $data = mysqli_fetch_all($result , MYSQLI_ASSOC);
    //     return $data;
    // }

    public function getExpiredItemsByDateRange($startDate, $endDate)
    {
        $query = "SELECT id, item_id, item_name, expire_date, quantity 
                        FROM order_item 
                        WHERE expire_date >= ? AND expire_date <= ?";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ss", $startDate, $endDate);
        $stmt->execute();
        $result = $stmt->get_result();

        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        $stmt->close();
        return $data;
    }

    public function getOrderItemForSupplier($order_id)
    {
        // Prepare the statement with placeholders
        $stmt = mysqli_prepare($this->conn, "SELECT 
                            order_item.id,
                            CONCAT('IT-', order_item.id) AS item_id , 
                            inventory_items.item_name AS item_name , 
                            order_item.quantity , 
                            order_item.note ,
                            inventory_items.unit_of_measure AS unit,
                            order_item.price,
                            order_item.expire_date,
                            order_item.item_id
                            FROM order_item 
                            INNER JOIN inventory_items ON order_item.item_id = inventory_items.id
                            WHERE order_item.order_id = ?");

        // Bind the parameter to the statement
        mysqli_stmt_bind_param($stmt, "s", $order_id);

        // Execute the statement
        mysqli_stmt_execute($stmt);

        // Get the result
        $result = mysqli_stmt_get_result($stmt);

        // Fetch all rows into an associative array
        $result_data = mysqli_fetch_all($result, MYSQLI_ASSOC);

        // Close the statement
        mysqli_stmt_close($stmt);

        return $result_data;
    }

    public function updatePriceAndExpireDate($order_id, $item_id, $price, $expire_date)
    {
        $result = mysqli_query($this->conn, "UPDATE order_item SET price='$price', expire_date='$expire_date' WHERE order_id='$order_id' AND id='$item_id'");
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

}
?>