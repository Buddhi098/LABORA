<?php
    class Report extends Controller{
        private $md_chart;

        private $auth;
        public function __construct(){
            $this->md_chart = $this->model('M_chart');

            $this->auth = new AuthMiddleware();
            $this->auth->authMiddleware('admin');
        }

        // Finance report
        public function finance_report(){
            $data = [];
            //chart1
            $test_graph = $this->md_chart->getCost();
            $data['graph_data'] = $test_graph;

            //char2
            $revenue_data = $this->md_chart->getSevenDayRevenue();
            $data['revenue_data'] = $revenue_data;

            //chart3
            $revenue_month = $this->md_chart->getMonthRevenue();
            $data['revenue_month'] = $revenue_month;

            $this->view("admin/finance_report" , $data);
        }
        //chart3 filter
        // Assuming this is a method in your controller class
        public function fetchChartData() {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Retrieve start and end month values from the AJAX request
                $requestData = json_decode(file_get_contents("php://input"), true);
                $startMonth =  $requestData['startMonth'];
                $endMonth =  $requestData['endMonth'];
                // $endMonth = $_POST['endMonth'];

                // Call the model method to fetch filtered chart data
                $chartData = $this->md_chart->getChartDataByMonthRange($startMonth, $endMonth);

                // Return the data as JSON response
                header('Content-Type: application/json');
                echo json_encode([$chartData]);
                exit;
            }
        }
       

        // public function appointment_report(){

        //     $data = [];

        //     // Chart2
        //     // $appointment_graph = $this->md_chart->getNextSevenDateAppointment();
        //     // $data['graph_data'] = $appointment_graph;

        //     $app_data = $this->md_chart->getSevenDay();
        //     $data['app_data'] = $app_data;

        //     $this->view("admin/appointment_report" , $data);
        // }

        public function appointment_report() {
            $data = [];
    
            // Retrieve appointment data from model
            $app_data = $this->md_chart->getSevenDay();
    
            if ($app_data !== false) {
                // If data retrieval is successful, store it in $data array
                $data['app_data'] = $app_data;
            } else {
                // Handle case where data retrieval failed
                $data['error'] = "Failed to retrieve appointment data.";
            }
    
            // Load the view and pass data to it
            $this->view("admin/appointment_report", $data);
        }
        public function test_report(){

            $data = [];
            $this->view("admin/test_report" , $data);
        }

        
    }
?>