<?php
        class M_invDashboard{
            protected $conn;
            public function __construct(){
                $this->conn = new Database;
                $this->conn = $this->conn->dbObject();
            }


        public function getTotalOrders() {
            $result = mysqli_query($this->conn , 'SELECT * 
            FROM orders_tbl 
            WHERE status = "Placed Order" 
            OR status = "received invoice" 
            OR status = "confirmed order"
            OR status = "complete order" ');
           
            $total_orders = mysqli_num_rows($result) ;
            return $total_orders ;
        }
        
        public function getTotalStockValue() {
            $result = mysqli_query($this->conn , 'SELECT SUM(price * quantity) AS total_stock_value 
            FROM order_item
            WHERE expire_date IS NOT NULL AND expire_date > CURRENT_DATE;
            ');
            $result = mysqli_fetch_all($result , MYSQLI_ASSOC);
            
            if(!empty($result[0]['total_stock_value '])){
                return $result[0]['total_stock_value '];
            }else{
                return 0;
            }
        }

        public function getTotalWastageValue() {
            $result = mysqli_query($this->conn , 'SELECT SUM(price * quantity) AS total_wastage_value
            FROM order_item
            WHERE expire_date IS NOT NULL AND expire_date < CURRENT_DATE;
            ');
            $result = mysqli_fetch_all($result , MYSQLI_ASSOC);
                        
            if(!empty($result[0]['total_wastage_value '])){
                return $result[0]['total_wastage_value '];
            }else{
                return 0;
            }
        }

        public function getBelowAlertQuantity() {
            $result = mysqli_query($this->conn , 'SELECT COUNT(*) AS below_alert_quantity 
            FROM inventory_items
            WHERE reorder_limit >= quantity;
            ');
            $result = mysqli_fetch_all($result , MYSQLI_ASSOC);
            
            if(!empty($result[0]['below_alert_quantity'])){
                return $result[0]['below_alert_quantity'];
            }else{
                return 0;
            }
        }

        public function getNewExpiryQuantity() {
            $result = mysqli_query($this->conn , 'SELECT SUM(quantity) AS new_expiry_quantity 
            FROM order_item
            WHERE expire_date BETWEEN CURRENT_DATE AND CURRENT_DATE + INTERVAL 21 DAY;
            ');
            $result = mysqli_fetch_all($result , MYSQLI_ASSOC);
            
            if(!empty($result[0]['new_expiry_quantity'])){
                return $result[0]['new_expiry_quantity'];
            }else{
                return 0;
            }
        }

        public function getPendingInvoiceQuantity() {
            $result = mysqli_query($this->conn , 'SELECT COUNT(*) AS pending_invoice_quantity
            FROM orders_tbl 
            WHERE status = "Placed Order" ;
            ');
            $result = mysqli_fetch_all($result , MYSQLI_ASSOC);
            
            if(!empty($result[0]['pending_invoice_quantity'])){
                return $result[0]['pending_invoice_quantity'];
            }else{
                return 0;
            }
        }

        public function getInvoiceToCheckQuantity() {
            $result = mysqli_query($this->conn , 'SELECT COUNT(*) AS invoice_to_check
            FROM orders_tbl 
            WHERE status = "received invoice" ;
            ');
            $result = mysqli_fetch_all($result , MYSQLI_ASSOC);
            
            if(!empty($result[0]['invoice_to_check'])){
                return $result[0]['invoice_to_check'];
            }else{
                return 0;
            }
        }
           
    }
?>

