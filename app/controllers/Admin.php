<?php
    class Admin extends Controller{
        private $md_employee;
        private $md_chart;


        private $md_holiday_calendar;

        private $auth;
        public function __construct(){
            $this->md_employee = $this->model('M_employee');
            $this->md_chart = $this->model('M_chart');

            $this->md_holiday_calendar = $this->model('M_holiday_calendar');

            $this->auth = new AuthMiddleware();
            $this->auth->authMiddleware('admin');
        }

        public function index(){
            $data = [];

            $this->dashboard();
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

            $total_patients = $this->md_chart->getTotalUser();
            $data['total_users'] = $total_patients;

            $total_patients = $this->md_chart->getTotalPatient();
            $data['total_patients'] = $total_patients;

            $today_appointment_count = $this->md_chart->getTodayAppointmentCount();
            $data['today_appointment_count'] = $today_appointment_count;

            $today_revenue = $this->md_chart->getTodayRevenue();
            $data['today_revenue'] = $today_revenue;

            //chart
            $test_graph = $this->md_chart->patientByGender();
            $data['graph_data'] = $test_graph;

            $test_graph2 = $this->md_chart->appointmentSchedule();
            $data['graph_data2'] = $test_graph2;

            $test_graph3 = $this->md_chart->paymentStatus();
            $data['graph_data3'] = $test_graph3;

            $revenue_month = $this->md_chart->getMonthRevenue();
            $data['revenue_month'] = $revenue_month;

            $this->view("admin/dashboard" , $data);
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


        public function editProfile($email)
        {
            $data = [];
    
                $current_user = $this->md_employee->getUser($email);
                $data = [
                    'full_name' => $current_user['full_name'],
                    'email' =>  $current_user['email'],
                    'phone' => $current_user['phone'],
                    'dob' => $current_user['dob'],
                    'address' => $current_user['address'],
                    'role' => $current_user['role'],
                ];
            
    
            $this->view('admin/profile', $data);
    
            //for avoiding form resubmission
            // stopResubmission();
        }

        public function editDetails(){

            if($_SERVER['REQUEST_METHOD']=="POST"){
                $data = [
                    'full_name' => trim($_POST['full_name']),
                    'email' =>trim($_POST['email']),
                    'phone' => trim($_POST['phone']),
                    'dob' => trim($_POST['dob']),
                    'address' => trim($_POST['address']),
                    'password' => trim($_POST['new_password']),
                    'comfirm_password' => trim($_POST['confirm_password']),
                ];
                
                if ($data['password'] != '' && $data['comfirm_password'] != '') {
                    if ($data['password'] != $data['comfirm_password']) {
                        $message['error'] = 'Password and Confirm Password does not match';
                        echo json_encode($message);
                        exit();
                    } else {
                        $hashed_password = password_hash($data['password'], PASSWORD_DEFAULT);
                        $this->md_employee->changePassword($hashed_password, $data['email']);
                    }
                }
                if ($data['full_name'] != '') {
                    $this->md_employee->changeName($data['email'], $data['full_name']);
                }

                if ($data['email'] != '') {
                    $this->md_employee->changeMail($data['full_name'], $data['email']);
                }
    
                if ($data['phone'] != '') {
                    $this->md_employee->changePhone($data['email'], $data['phone']);
                }
    
                if ($data['dob'] != '') {
                    $this->md_employee->changeDob($data['email'], $data['dob']);
                }
    
                if ($data['address'] != '') {
                    $this->md_employee->changeAddress($data['email'], $data['address']);
                }
                
                $message = [
                    'status' => 'success',
                ];

                echo json_encode($message);
                header('Location: http://localhost/labora/admin/userAccount');
                exit();

            }
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