<?php
    class invmng extends Controller{
        private $md_product;
        private $md_supplier;

        private $md_item;
        private $auth;
        private $md_order;

        private $md_order_items;
        public function __construct(){
            $this->md_product = $this->model('M_product'); 
            $this->md_supplier = $this->model('M_employee');
            $this->md_item = $this->model('M_items');
            $this->md_order = $this->model('M_orders_tbl');
            $this->md_expire = $this->model('M_expiredChemicals');
            $this->md_order_items = $this->model('M_order_item');
            $this->md_supply_requests = $this->model('M_issue_chemicals');
            $this->md_request_item = $this->model('M_request_items');
            // auth middleware

            $this->auth = new AuthMiddleware();
            $this->auth->authMiddleware('inventory_manager');
        }

        public function order(){
            $data = [];
            $table_data = $this->md_order->orderTableData();
            $this->view("invmng/order" , $table_data);
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
            $data = $this->md_item->getItemDetailsWithExpiry($id);
            
            echo json_encode($data);
            exit();
        }

        public function expiredChemicals(){
            $data = [];
            $table_data = $this->md_expire->getExpiredItem();
            $this->view("invmng/expiredChemicals" , $table_data);
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
            $this->view("invmng/dashboard" , $data);
        }

        public function issueChemicals(){

            $data = [];
            $data = $this -> md_supply_requests->getAllData();
            $this->view("invmng/issueChemicals" , $data);
        }

        public function reorder(){

            $data = [];
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

            $result = $this->md_item->enterItems($item_name  ,$manufacture , $reorder_level ,$description);

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

        public function getEditForm($itemId) {
            $data = $this->md_item->getItemById($itemId);
            require_once 'views/editInventoryForm.php';
        }
    
        public function updateItem($itemId) {
            $jsonData = file_get_contents("php://input");
            $data = json_decode($jsonData, true);
    
            $itemName = $data['itemName'];
            $manufacture = $data['manufacture'];
            $reorderLimit = $data['reorderLimit'];
            $description = $data['description'];
    
            $result = $this->md_item->updateItem($itemId, $itemName, $manufacture, $reorderLimit, $description);
    
            if ($result) {
                $msg = ['msg' => true];
                echo json_encode($msg);
                exit();
            } else {
                $msg = ['msg' => false];
                echo json_encode($msg);
                exit();
            }
        }

        // public function editInventoryForm(){
    
        //     $jsonData = file_get_contents("php://input");

            
        //     $data = json_decode($jsonData, true);

        //     $item_name = $data['itemName'];
        //     // $item_type = $data['itemType'];
        //     $manufacture = $data['manufacture'];
        //     $reorder_level = $data['reorderLimit'];
        //     $description = $data['description'];

        //     $result = $this->md_item->editItems($item_name  ,$manufacture , $reorder_level ,$description);

        //     if($result){
        //         $msg = [
        //             'msg' => true
        //         ];
        //         echo json_encode($msg);
        //         exit();
        //     }else{
        //         $msg = [
        //             'msg' => false
        //         ];
        //         echo json_encode($msg);
        //         exit();
        //     }
        // }

       

        // public function getEditItemForm(){
        //     $data = []; 
        //     $this->view("invmng/editInventoryForm" , $data);
        // }
        

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

            // print_r($data);
            // die();

            $this->view("invmng/orderForm" , $data);
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

       


    }
?>