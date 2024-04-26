<?php
    class supplier extends Controller{
        
        // private $md_invoice;
        private $md_supplier_item_quantity_chart;

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

            $this->md_supplier_item_quantity_chart=$this->model('M_supplier_item_quantity_chart');

        }

        
        public function index(){

            $data = [];
            $this->view("supplier/dashboard" , $data);
        }

        public function dashboard(){

            $data = [];
            
            $ItemQuantity_graph = $this->md_supplier_item_quantity_chart->getItemQuantityData();
            $data['graph_data'] = $ItemQuantity_graph;
           

            // //char2
            // $revenue_data = $this->md_chart->getSevenDayRevenue();
            // $data['revenue_data'] = $revenue_data;

            // //chart3
            // $revenue_month = $this->md_chart->getMonthRevenue();
            // $data['revenue_month'] = $revenue_month;

            // $data=[1,2,3];
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