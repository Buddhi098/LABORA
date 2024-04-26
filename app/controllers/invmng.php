<?php
    class invmng extends Controller{
        private $md_product;
        private $md_supplier;

        private $md_item;
        private $auth;
        private $md_order;

        private $md_order_items;
        public function __construct(){
            $this->md_dashboard = $this->model('M_invDashboard'); 
            $this->md_product = $this->model('M_product'); 
            $this->md_supplier = $this->model('M_employee');
            $this->md_item = $this->model('M_items');
            $this->md_order = $this->model('M_orders_tbl');
            $this->md_expire = $this->model('M_expiredChemicals');
            $this->md_order_items = $this->model('M_order_item');
            $this->md_issue = $this->model('M_issue_chemicals');
            $this->md_request_item = $this->model('M_request_items');
            // auth middleware

            $this->auth = new AuthMiddleware();
            $this->auth->authMiddleware('inventory_manager');
        }

        public function Index(){

            $this-> sendEmailExpiredItem();
        }

        public function order(){
            $data = [];
            $table_data = $this->md_order->orderTableData();
            $data['table_data'] = $table_data;
            $this->view("invmng/order" , $data);
        }

        public function getRequestItems($request_id){
            $data = $this->md_request_item->getRequestItem($request_id);

            echo json_encode($data);
            exit();
        }

        public function getOrderItems($order_id){
            $data = $this->md_order_items->getOrderItem($order_id);

            echo json_encode($data);
            exit();
        }
        
        public function getItemDetails($id)
        {
            $data = $this->md_item->getItemDetail($id);

            echo json_encode($data);
            exit();
        }

        public function expiredChemicals(){
            $data = [];
            $table_data = $this->md_item->getExpiredItem();
            $this->view("invmng/expiredChemicals" , $table_data);
        }

        public function deleteExpiredItem($itemId)
        {
            
            $result = $this->md_item->deleteExpiredItem($itemId);

            if ($result) {
                // Item deleted successfully
                echo json_encode(['success' => true]);
            } else {
                // Error occurred during deletion
                echo json_encode(['success' => false, 'error' => 'An error occurred while deleting the item']);
            }
        }

        public function filterExpiredItems($startDate, $endDate) {
            $data = $this->md_item->getFilteredExpiredItems($startDate, $endDate);
            echo json_encode($data); // Return JSON response instead of rendering a view
        }
        
        


        public function product(){

            $data = array();
            $result = $this->md_product->getAllData();
            if (count($result) > 0) {
                $data = $result;
            }else{
                $data = [[
                    'Item_Id'=> "",
                    'Item_name' => '',
                   'item_type' => '',
                    'reorder_limit' => '',
                    'description' => '',
                    'manufacturer' => ''
                ],];
                $this->view("invmng/product" , $data);
            }

            $this->view("invmng/product" , $data);
        }

        public function supplier(){
    
            $data = array();
            $suppliers = $this->md_supplier->getAllSupplier();
        
            if (count($suppliers) > 0) {
                $data = $suppliers;
            }else{
                $data = [[
                    'full_name'=> "",
                    'email' => '',
                    'phone' => '',
                    'dob' => '',
                    'address' => '',
                ],];
                $this->view("invmng/supplier" , $data);
            }
            $this->view("invmng/supplier", $data);
        }

        public function dashboard(){
            $data = [];

            $totalOrders = $this->md_dashboard->getTotalOrders();
            $data['total_orders'] = $totalOrders;

            $totalStockValue = $this->md_dashboard->getTotalStockValue();
            $data['total_stock_value'] = $totalStockValue;

            $totalWastageValue = $this->md_dashboard->getTotalWastageValue();
            $data['total_wastage_value'] = $totalWastageValue;

            $belowAlertQuantity = $this->md_dashboard->getBelowAlertQuantity();
            $data['below_alert_quantity'] = $belowAlertQuantity;

            $newExpiryQuantity = $this->md_dashboard->getNewExpiryQuantity();
            $data['new_expiry_quantity'] = $newExpiryQuantity;

            $pendingInvoiceQuantity = $this->md_dashboard->getPendingInvoiceQuantity();
            $data['pending_invoice_quantity'] = $pendingInvoiceQuantity;

            $invoiceToCheckQuantity = $this->md_dashboard->getInvoiceToCheckQuantity();
            $data['invoice_to_check'] = $invoiceToCheckQuantity;

            
          
      
            $this->view("invmng/dashboard" ,   $data);
        }


        public function issueChemicals(){

            $data = [];
            $request_data = $this -> md_issue->getAllData();
            $data['request_data'] = $request_data;
            $this->view("invmng/issueChemicals" , $data);
        }

        public function reorder(){

            $data = [];
            $data = $this -> md_item->getReorderData();
            $this->view("invmng/reorder" , $data);
        }

        public function invoices(){

            $data = [];
            $this->view("invmng/invoices" , $data);
        }

        public function quotations(){

            $data = [];
            $this->view("invmng/quotations" , $data);
        }
        
        public function addInventoryForm(){
    
            $jsonData = file_get_contents("php://input");

            $data = json_decode($jsonData, true);

            $item_name = $data['itemName'];
            // $item_type = $data['itemType'];
            $manufacture = $data['manufacture'];
            $reorder_level = $data['reorderLimit'];
            $description = $data['description'];
            $unit_of_measure = $data['unitOfMeasure'];

            $result = $this->md_item->enterItems($item_name  ,$manufacture , $reorder_level ,$description, $unit_of_measure);

            if($result){
                $msg = [
                    'msg' => true
                ];
                echo json_encode($msg);
                exit();
            }else{
                $msg = [
                    'msg' => false
                ];
                echo json_encode($msg);
                exit();
            }
        }

        public function getAddItemForm(){
            $data = []; 
            $this->view("invmng/addInventoryForm" , $data);
        }

        // public function getEditForm() {
        //     $itemId = $_GET['id'];
        //     $data = [];
        //     $data = $this -> md_item->getAllDataByID($itemId);
        //     $this->view('invmng/editInventoryForm', $data);
        // }
    
        // public function updateInventoryItem() {
        //     $jsonData = file_get_contents("php://input");
        //     $data = json_decode($jsonData, true);
    
        //     $itemName = $data['Item_name'];
        //     $manufacture = $data['manufacturer'];
        //     $reorderLimit = $data['reorder_limit'];
        //     $unitOfMeasure = $data['unit_of_measure'];
        //     $description = $data['description'];
    
        //     $result = $this->md_item->updateItem($itemName, $manufacture, $reorderLimit, $unitOfMeasure, $description);
    
        //     if ($result) {
        //         $msg = ['msg' => true];
        //         echo json_encode($msg);
        //         exit();
        //     } else {
        //         $msg = ['msg' => false];
        //         echo json_encode($msg);
        //         exit();
        //     }
        // }

        public function getEditForm($id)
        {
            
            
                $itemData = $this->md_item->getAllDataByID($id);
// print_r($itemData);
// die();
                $data = [
                    'itemID' => $itemData[0]['id'],
                    'itemName' => $itemData[0]['Item_name'],
                    'manufacturer' => $itemData[0]['manufacturer'],
                    'reorderLimit' => $itemData[0]['reorder_limit'],
                    'unitOfMeasure' => $itemData[0]['unit_of_measure'],
                    'description' => $itemData[0]['description']
                ];

                $this->view('invmng/editInventoryForm', $data);
        
        }

        public function editInventoryDetails(){

            if($_SERVER['REQUEST_METHOD']=="POST"){
                $data = [
                    'id' => trim($_POST['itemId']),
                    'Item_name' => trim($_POST['itemName']),
                    'manufacturer' => trim($_POST['manufacture']),
                    'reorder_limit' => trim($_POST['reorderLimit']),
                    'unit_of_measure' => trim($_POST['unitOfMeasure']),
                    'description' => trim($_POST['description']),
                ];
                
                if($data['Item_name'] != ''){
                    $this->md_item->changeName($data['id'] , $data['Item_name']);
                }

                if($data['manufacturer'] != ''){
                    $this->md_item->changeManufacturer($data['id'] , $data['manufacturer']);
                }

                if($data['reorder_limit'] != ''){
                    $this->md_item->changeReorderLimit($data['id'] , $data['reorder_limit']);
                }

                if($data['unit_of_measure'] != ''){
                    $this->md_item->changeUnitOfMeasure($data['id'] , $data['unit_of_measure']);
                }

                if($data['description'] != ''){
                    $this->md_item->changeDescription($data['id'] , $data['description']);
                }

                $message = [
                    'status' => 'success',
                ];

                echo json_encode($message);
                exit();

            }
        }
        

        // public function itemDetails(){
        //     $data = array();
        //     $result = $this->md_item->getItemDetails();
        //     if (count($result) > 0) {
        //         $data = $result;
        //     }else{
        //         $data = [[
        //             'id'=> "",
        //             'item_name' => '',
        //             'expire_date' => '',
        //             'quantity' => ''
        //         ],];
        //         $this->view("invmng/itemDetails" , $data);
        //     }

        //     $this->view("invmng/itemDetails" , $data);
        // }

        public function itemDetails($itemId)
        {
            $data = $this->md_item->getItemDetailsWithExpiry($itemId);
            $this->view('invmng/itemDetails', $data);
        }


        public function invnavbar(){

            $data = [];
            $this->view("invmng/invnavbar" , $data);
        }

        public function getorderForm(){

            $data = [];
            $rowData = $this->md_item->getAllData();
            $item_name = [];
            foreach($rowData as $index => $dt){
                $item_name[$index]['item_name'] = $dt['Item_name'];
                $item_name[$index]['item_id'] = $dt['id'];
            }

            $rowData2 = $this->md_supplier->getAllSupplier();
            $supplier = [];
            foreach($rowData2 as $index => $dt){
                $supplier[$index]['sup_name'] = $dt['full_name'];
                $supplier[$index]['sup_id'] = $dt['id'];
            }
            $data['item_name'] = $item_name;
            $data['supplier_name'] = $supplier;

            $this->view("invmng/orderForm" , $data);
        }

        public function getReorderForm(){

            $data = [];
            $rowData = $this->md_item->getReorderData();
            $item_name = [];
            foreach($rowData as $index => $dt){
                $item_name[$index]['item_name'] = $dt['Item_name'];
                $item_name[$index]['item_id'] = $dt['id'];
            }

            $rowData2 = $this->md_supplier->getAllSupplier();
            $supplier = [];
            foreach($rowData2 as $index => $dt){
                $supplier[$index]['sup_name'] = $dt['full_name'];
                $supplier[$index]['sup_id'] = $dt['id'];
            }
            $data['item_name'] = $item_name;
            $data['supplier_name'] = $supplier;

            $this->view("invmng/reorderForm" , $data);
        }

        public function submitOrderForm(){

            $formData = file_get_contents('php://input');

            $data = json_decode($formData , true);

            $expected_date = $data['expected_date'];
            $supplier_id = $data['supplier'];
            $items = $data['items'];


            $order_id = $this->md_order->enterOrder($_SESSION['empid'] , $expected_date , "Placed Order" , $supplier_id);

            foreach($items as $item){
                $item_name = $this->md_item->getNameById($item['itemName']);

                $set_item = $this->md_order_items->enterOrderItem($order_id , $item['itemName'] ,$item_name , $item['quantity'] ,$item['specialNote'] );        
            }

            $msg = [
                'msg' => true
            ];
            echo json_encode($msg);
           
            exit();      
            
        }



        public function deleteItem($item_id){
            if ($this->md_product->getItemById($item_id)) {
                if ($this->md_product->deleteItemById($item_id)) {
                    // Item successfully deleted
                    $this->view("invmng/deleteSuccess");
                } else {
                    // Failed to delete item
                    echo "Error deleting item with ID $item_id.";
                }
            } else {
                // Item does not exist
                echo "Item with ID $item_id does not exist.";
            }
        }

        function sendEmailExpiredItem(){
            $result = mysqli_query($this->conn, "SELECT id, item_id, item_name, quantity, expire_date 
                                                FROM order_item 
                                                WHERE expire_date <= CURDATE() + INTERVAL 21 DAY 
                                                ORDER BY expire_date ASC");
            $expiredItems = mysqli_fetch_all($result, MYSQLI_ASSOC);
    
            $body = '<h2>Items with Expiry Date Within the Next Twenty One Days:</h2>';
            $body .= '<table border="1">
                        <tr>
                            <th>ID</th>
                            <th>Item ID</th>
                            <th>Item Name</th>
                            <th>Quantity</th>
                            <th>Expire Date</th>
                        </tr>';
        
            foreach ($expiredItems as $item) {
                $body .= '<tr>';
                $body .= '<td>' . $item['id'] . '</td>';
                $body .= '<td>' . $item['item_id'] . '</td>';
                $body .= '<td>' . $item['item_name'] . '</td>';
                $body .= '<td>' . $item['quantity'] . '</td>';
                $body .= '<td>' . $item['expire_date'] . '</td>';
                $body .= '</tr>';
            }
        
            $body .= '</table>';
        
            $user = $_SESSION['user'];
            $name = $user['name'];
            $email = $user['email'];
            $subject = 'Items with Expiry Date Within the Next Twenty One Days';
        
            sendEmail($email, $name, $body, $subject);
        
            return $expiredItems;
        }

    }
?>