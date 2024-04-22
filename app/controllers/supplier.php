<?php
    class supplier extends Controller{
        
        private $md_invoice;

        public function __construct(){
            // $this->md_product = $this->model('M_product'); 
            // $this->md_supplier = $this->model('M_employee');
            // $this->md_item = $this->model('M_items');
            // $this->md_order = $this->model('M_orders_tbl');
            // $this->md_order_items = $this->model('M_order_item');
            // // auth middleware

            // $this->auth = new AuthMiddleware();
            // $this->auth->authMiddleware('inventory_manager');

            // $this->md_invoice = $this->model('M_order_invoice');
        }

        
        public function index(){

            $data = [];
            $this->view("supplier/dashboard" , $data);
        }

        public function dashboard(){

            $data = [];
            $this->view("supplier/dashboard" , $data);
        }

    
        public function inventory(){

            $data = [];
            $this->view("supplier/inventory" , $data);


        }  

        public function invoice(){

            $data = [];
            $this->view("supplier/invoice" , $data);


        }
        
    }
?>