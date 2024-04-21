<?php
    class Admin extends Controller{
        private $md_employee;
        private $md_chart;

        private $auth;
        public function __construct(){
            $this->md_employee = $this->model('M_employee');
            $this->md_chart = $this->model('M_chart');

            $this->auth = new AuthMiddleware();
            $this->auth->authMiddleware('admin');
        }

        public function index(){
            $data = [];
            $this->view("admin/medicaltest" , $data);
        }

        public function medicaltest(){
            $data = [];
            $this->view("admin/medicaltest" , $data);
        }

        public function userAccount(){
            
            $data = array();
            $result = $this->md_employee->getRow();
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {;
                        $data[] = $row;
                }
            }else{
                $data = [[
                    'id'=> "",
                    'full_name' => '',
                    'email' => '',
                    'phone' => '',
                    'dob'=> '',
                    'address'=> '',
                    'gender'=> '',
                    'role'=> '',
                ],];
            }

            $this->view("admin/userAccount" , $data);
        }



        public function dashboard(){

            $data = [];
            $this->view("admin/dashboard" , $data);
        }

        // report
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
       

        public function appointment_report(){

            $data = [];
            $this->view("admin/appointment_report" , $data);
        }
        public function test_report(){

            $data = [];
            $this->view("admin/test_report" , $data);
        }

        public function payment(){

            $data = [];
            $this->view("admin/payment" , $data);
        }

        public function addUser(){
            if($_SERVER['REQUEST_METHOD']=="POST"){
                $_POST = filter_input_array(INPUT_POST , FILTER_SANITIZE_STRING);

                $role = trim($_POST['employeeRole']);
                $fullname = trim($_POST['full_name']);
                $email = trim($_POST['email']);
                $phone = trim($_POST['phone']);
                $dob = $_POST['dob'];
                $address = trim($_POST['address']);
                $gender = trim($_POST['gender']);
                $data = [
                    // error variable
                    'emailerr' => '',
                    'fullname' => $fullname,
                    'email' => $email,
                    'phone' => $phone,
                    'dob' => $dob,
                    'address' => $address,
                    'gender' => $gender,
                    'role' => $role
                ];
                //input validation

                if($this->md_employee->isEnteredEmail($email)){
                    $data['emailerr'] = 'This email already exist';
                }

                if(empty($data['emailerr'])){
                    $password = $this->generateRandomPassword();
                    $subject = 'Your New Employee Account Credentials';
                    $body = 'Dear'.$fullname.',<br>

                    Welcome to our team! Your employee account details are as follows:<br>
                    
                    Username:'.$email.'<br>
                    Password:'.$password.'.';

                    sendEmail($email , $fullname , $body , $subject);
                    $hashed_password = password_hash($password,PASSWORD_DEFAULT);
                    $this->md_employee->enterUserData($fullname,$email,$phone,$dob,$address ,$gender ,$role, $hashed_password);
                    header('location: http://localhost/labora/admin/userAccount');
                }

            }else{

                // initial state
                $data = [
                    // error variable
                    'emailerr' => '',
                    'fullname' => '',
                    'email' => '',
                    'phone' => '',
                    'dob' => '',
                    'address' => '',
                    'gender'=> '',
                    'role' => '',
                ];
            }

            $this->view('admin/user_form' , $data);
            // for avoiding form resubmission
            stopResubmission();      

        }

        function generateRandomPassword($length = 12) {
            // Define character sets
            $upperCaseChars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $lowerCaseChars = 'abcdefghijklmnopqrstuvwxyz';
            $digitChars = '0123456789';
            $specialChars = '!@#$%^&*()-_+=[]{}|;:,.<>?';
        
            // Create a pool of characters to choose from
            $characters = $upperCaseChars . $lowerCaseChars . $digitChars . $specialChars;
        
            // Initialize the password variable
            $password = '';
        
            // Generate the random password
            for ($i = 0; $i < $length; $i++) {
                $password .= $characters[random_int(0, strlen($characters) - 1)];
            }
        
            return $password;
        }

        public function deleteEmployee($email){
            $this->md_employee->deleteFromMail($email);
            header('location: http://localhost/labora/admin/userAccount');
        }

    }
?>