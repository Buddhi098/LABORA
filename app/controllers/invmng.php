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
            $this->md_order_items = $this->model('M_order_item');
            // auth middleware

            $this->auth = new AuthMiddleware();
            $this->auth->authMiddleware('inventory_manager');
        }

        public function order(){

            $data = [];
            $table_data = $this->md_order->orderTableData();
            // // print_r($table_data);
            // // echo $table_data;
            // // die();
            // $data_set = [];
            // foreach($table_data as $data){
            //     $data['items'] = $this->md_order_items->getOrderItem($data['id']);
            //     $data_set[] = $data;
            // }
            $this->view("invmng/order" , $table_data);
        }
        public function getOrderItems($order_id){
            $data = $this->md_order_items->getOrderItem($order_id);

            echo json_encode($data);
            exit();
        }

        public function product(){

            $data = array();
            $result = $this->md_item->getAllData();
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
        
            // Fetch supplier data from the model
            $data = array();
            $suppliers = $this->md_supplier->getAllSupplier();
            // print_r($suppliers);
            // die();
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


        public function expiredChemicals(){

            $data = [];
            $this->view("invmng/expiredChemicals" , $data);
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
            $item_type = $data['itemType'];
            $manufacture = $data['manufacture'];
            $reorder_level = $data['reorderLimit'];
            $description = $data['description'];

            $result = $this->md_item->enterItems($item_name ,$item_type ,$manufacture , $reorder_level ,$description);

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
        


        public function itemDetails(){

            $data = [];
            $this->view("invmng/itemDetails" , $data);
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