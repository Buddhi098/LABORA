<?php
    class supplier extends Controller{
        
        // private $md_invoice;
        private $md_supplier_item_quantity_chart;
        private $md_holiday_calendar;

        private $auth;

        private $m_order;
        private $m_order_item;
        private $m_invoice;
        private $m_employee;

        public function __construct(){
            $this->m_order = $this->model('M_orders_tbl');
            $this->m_order_item = $this->model('M_order_item');
            $this->m_invoice = $this->model('M_invoice');
            $this->m_employee = $this->model('M_employee');
            // // auth middleware

            $this->auth = new AuthMiddleware();
            $this->auth->authMiddleware('supplier');

            // $this->md_invoice = $this->model('M_order_invoice');
            $this->md_holiday_calendar = $this->model('M_holiday_calendar');

            $this->md_supplier_item_quantity_chart=$this->model('M_supplier_item_quantity_chart');

        }

        
        public function index(){

            $data = [];
            $this->dashboard();
        }

        public function dashboard(){

            $data = [];
            $pending_orders = $this->m_order->getPendingOrders();
            $cancelled_orders = $this->m_order->getCancelledOrders();
            $Send_inovice = $this->m_order->getSendInoviceCount();
            $supplier_count = $this->m_employee->getSupplierCount();

            $data['pending_orders'] = $pending_orders;
            $data['cancelled_orders'] = $cancelled_orders;
            $data['Send_inovice'] = $Send_inovice;
            $data['supplier_count'] = $supplier_count;


            $chart_data = $this->m_order->getMonthlyRevenue();

            $data['chart_data'] = $chart_data;
            
            $this->view("supplier/dashboard" , $data);


        }

        public function getHolidays($year, $month)
        {
            $result = $this->md_holiday_calendar->getAlldates($year, $month);
            if ($result) {
                echo json_encode($result);
                exit();
            } else {
                $data = [
                    'error' => 'No holidays found'
                ];
                echo json_encode($data);
                exit();
            }
    
        }

        public function getOrderItems($order_id){
            $data = $this->m_order_item->getOrderItem($order_id);

            echo json_encode($data);
            exit();
        }

        public function orders(){
            $data = [];
            $table_data = $this->m_order->orderTableDataForSupplier();
            $data['table_data'] = $table_data;
            $this->view("supplier/orders" , $data);
        }

        public function getInvoice($order_id){
            $item = $this->m_order_item->getOrderItemForSupplier($order_id);
            $data['item'] = $item;
            $_SESSION['order_id'] = $order_id;

            $supplier = $this->m_employee->getSupplier($_SESSION['empid']);
            $data['supplier'] = $supplier;
            $this->view("supplier/invoice" , $data);
        }

        public function sendInvoice(){
            $data1 = file_get_contents("php://input");
            $input_data = json_decode($data1, true);
            $order_id = $_SESSION['order_id'];

            $inv_id = $this->m_order->getInventoryManagerID($order_id);

            $change_order_status = $this->m_order->updateStatus($order_id, 'Send Invoice');

            $invoice_id = $this->m_invoice->setInvoice($_SESSION['empid'], $inv_id, 'Send Invoice', $order_id);

            $setOrderInvoice = $this->m_order->updateInvoiceID($invoice_id, $order_id);

            foreach ($input_data['items'] as $item) {
                $result = $this->m_order_item->updatePriceAndExpireDate($order_id, $item['itemId'], $item['price'], $item['expireDate']);
            }

            $_SESSION['success_msg'] = 'Invoice sent successfully';

            $data['success_msg'] = 'Invoice sent successfully';


            echo json_encode($data);
            exit();

        }

        public function viewInvoice($order_id){
            $item = $this->m_order_item->getOrderItemForSupplier($order_id);
            $_SESSION['order_id'] = $order_id;
            $data['item'] = $item;

            $supplier = $this->m_employee->getSupplier($_SESSION['empid']);
            $data['supplier'] = $supplier;
            $this->view("supplier/invoice_view" , $data);
        }

        public function cancelOrder($order_id){
            $change_order_status = $this->m_order->updateStatus($order_id, 'Cancelled');
            $_SESSION['success_msg'] = 'Order cancelled successfully';
            $data['success_msg'] = 'Order cancelled successfully';
            

            $this->orders();
        }
    }
    
?>