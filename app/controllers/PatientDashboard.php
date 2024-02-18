<?php
    class PatientDashboard extends Controller{
        private $md_appointment;
        private $md_testtype;

        private $md_user;

        private $auth;

        private $md_report;
        public function __construct(){
            $this->md_appointment = $this->model('M_appointment');
            $this->md_testtype = $this->model('M_testtype');
            $this->md_user = $this->model('M_user');
            $this->md_report = $this->model('M_report');

            // checo authentication
            $this->auth = new AuthMiddleware();
            $this->auth->authMiddleware("patient");

        }

        public function index(){

            $data = [];
            $this->view("patientdashboard/Dashboard" , $data);
        }


        public function appointment(){
            
            $data = array();
            $result = $this->md_appointment->getRowByEmail($_SESSION['useremail']);
            if($result){
                $data['dataset'] = $result;
            }
            
            $this->view("patientdashboard/appointment" , $data);
            
        }

        public function searchAppointment(){
            
            $data = array();
            $result = $this->md_appointment->getRowByEmail($_SESSION['useremail']);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    // Add each row as an associative array to the $data array
                    $data[] = $row;
                }
            }else{
                $data = [[
                    'Id'=> "",
                    'Ref_No' => '',
                    'Test_Type' => '',
                    'Appointment_Date' => '',
                    'Appointment_Time'=> '',
                    'Appointment_Duration'=> '',
                    'Appointment_Status'=> '',
                    'Appointment_Notes'=> '',
                ],];
                $this->view("patientdashboard/appointment" , $data);
            }
            
            $this->view("patientdashboard/appointment" , $data);
            
        }

        public function dashboard(){

            $data = [];
            $medical_tests = $this->md_testtype->getRow();
            $data['medical_test'] = $medical_tests;
            $this->view("patientdashboard/dashboard" , $data);
        }

        public function medicaltest(){

            $data = [];
            $this->view("patientdashboard/medicaltest" , $data);
        }

        public function appointment_form(){

            $data = [
                'dateerr' => ""
            ];

            if($_SERVER['REQUEST_METHOD']=="POST"){
                // $currentDate = date('Y-m-d');
                $jsonData = file_get_contents("php://input");
                $data = json_decode($jsonData, true);

                $test_type_id = trim($data['test-type']);
                $appointment_notes = trim($data['appointment-notes']);

                if(empty($data["dateerr"])){
                $formattedNumber = str_pad($this->md_appointment->getNextId(), 4, '0', STR_PAD_LEFT);

                $refno = 'LB-'.$formattedNumber;
                $test_type = $this->md_testtype->getDuration($test_type_id);
                
                $appointment_status = "Pending Approval";
                $_SESSION['status'] = $appointment_status;
                $_SESSION['refno'] = $refno;
                $_SESSION['appointment_duration'] = $test_type["Time_duration"];
                $_SESSION['Test_type'] = $test_type["Test_type"];
                $_SESSION['Test_cost'] = $test_type["price"];
                $_SESSION['appointment_status'] = $appointment_status;
                $_SESSION['appointment_notes'] = $appointment_notes;
                // $this->md_appointment->enterAppointmentData($_SESSION['refno'],$_SESSION['Test_type'], $_SESSION['date'],$_SESSION['$appointment_time'],$_SESSION['appointment_duration'],$_SESSION['status'],$_SESSION['appointment_notes'],$_SESSION['useremail']);
                }

            }else{
                $test_types = $this->md_testtype->getROw();
                $data['test_types'] = $test_types;
                $this->view("patientdashboard/appointment_form" , $data);
            }
            

            $message = [
                'status' => 'success'
            ];
            echo json_encode($message);
            exit();
        }

        public function get_available_times($date){
            if($_SERVER['REQUEST_METHOD']=="GET"){
                $date = new DateTime($date);
                $date = $date->format('Y-m-d');
                $_SESSION['date'] = $date;
                $timeString = $_SESSION['appointment_duration'];

                // Create a DateTime object with a specific time
                $dateTime = new DateTime($timeString);
                $time_duration =  $dateTime->format('H:i:s');
                $total_time_duration_minutes = $dateTime->format('H') * 60 + $dateTime->format('i');
                $duration_interval = new DateInterval('PT'.$total_time_duration_minutes .'M');


                $first_start_time = new DateTime('08:00:00');
                $first_end_time = new DateTime('12:00:00');
                $second_start_time = new DateTime('1:00:00');
                $second_end_time = new DateTime('5:00:00');

                $available_times = [];
                $available_start_times = [];
                $appointment_start_time = $first_start_time;
                $appointment_start_time_in_string = $appointment_start_time->format('H:i:s');
                while(true){
                    $appointment_end_time = $appointment_start_time->add($duration_interval);
                    // print_r($appointment_end_time);
                    // die();
                    $appointment_end_time_in_string = $appointment_end_time->format('H:i:s');
                    if($appointment_end_time>$first_end_time){
                        break;
                    }
                    // echo($appointment_start_time_in_string);
                    // echo($appointment_end_time_in_string);
                    // die();
                    $sheduled_time = $this->md_testtype->getAvailableTime($date , $appointment_start_time_in_string , $appointment_end_time_in_string);
                    
                    if($sheduled_time){ 
                        $appointment_time = new DateTime($sheduled_time['Appointment_Time']);
                        $appointment_duration = new DateTime($sheduled_time['Appointment_Duration']);
                        $total_minutes = $appointment_duration->format('i') + ($appointment_duration->format('H') * 60);
                        $appointment_duration_interval = new DateInterval('PT'.$total_minutes .'M');

                        $next_start_time = $appointment_time->add($appointment_duration_interval);
                        $appointment_start_time =$next_start_time;
                        $appointment_start_time_in_string = $appointment_start_time->format('H:i:s');
                        // echo($appointment_start_time_in_string);
                        // die();
                    }else{
                        $available_start_times[] = $appointment_start_time_in_string;
                        $time_slot = substr($appointment_start_time_in_string , 0 , 5).' AM - '.substr($appointment_end_time_in_string , 0 , 5).' AM';
                        $available_times[] = $time_slot;
                        $appointment_start_time = $appointment_end_time;
                        $appointment_start_time_in_string = trim($appointment_end_time_in_string);
                    }

                }


                $appointment_start_time = $second_start_time;
                $appointment_start_time_in_string = $appointment_start_time->format('H:i:s');
                while(true){
                    $appointment_end_time = $appointment_start_time->add($duration_interval);
                    $appointment_end_time_in_string = $appointment_end_time->format('H:i:s');
                    if($appointment_end_time>$second_end_time){
                        break;
                    }
                    $sheduled_time = $this->md_testtype->getAvailableTime($date , $appointment_start_time_in_string , $appointment_end_time_in_string);
                    // echo($sheduled_time);
                    if($sheduled_time){
                        $appointment_time = new DateTime($sheduled_time['Appointment_Time']);
                        $appointment_duration = new DateTime($sheduled_time['Appointment_Duration']);
                        $total_minutes = $appointment_duration->format('i') + ($appointment_duration->format('H') * 60);
                        $appointment_duration_interval = new DateInterval('PT'.$total_minutes .'M');

                        $next_start_time = $appointment_time->add($appointment_duration_interval);
                        $appointment_start_time =$next_start_time;
                        $appointment_start_time_in_string = $appointment_start_time->format('H:i:s');
                    }else{
                        $available_start_times[] = $appointment_start_time_in_string;
                        $time_slot = substr($appointment_start_time_in_string , 0 , 5).' PM - '.substr($appointment_end_time_in_string , 0 , 5).' PM';
                        $available_times[] = $time_slot;
                        $appointment_start_time = $appointment_end_time;
                        $appointment_start_time_in_string = trim($appointment_end_time_in_string);
                    }

                }
                $totalMinutes = $dateTime->format('i') + ($dateTime->format('H') * 60);

                $data['time_slots'] = $available_times;
                $data['time_slots_value'] = $available_start_times;
                
                echo(json_encode($data));
                // echo json_encode($data);
                exit();
            }
        }

        public function set_available_times($time){
            if($_SERVER['REQUEST_METHOD']=='GET'){
                $_SESSION['appointment_time_as'] = $time;
            }
            $message = [
                'status' => 'success'
            ];
            echo json_encode($message);
            exit();
        }

        public function cancelAppointment($id){
            $data=[];
            $this->md_appointment->cancelAppointment($id);
            header("Location: http://localhost/labora/PatientDashboard/appointment");
        }

        public function editProfile(){

            if($_SERVER['REQUEST_METHOD']=="POST"){
                $_POST = filter_input_array(INPUT_POST , FILTER_SANITIZE_STRING);

                $data = [
                    'fullname' => trim($_POST['fullname']),
                    'email' => $_SESSION['useremail'],
                    'phone' => trim($_POST['phone']),
                    'dob' => trim($_POST['dob']),
                    'address' => trim($_POST['address'])
                ];

                $this->md_user->changeName($data['email'] , $data['fullname']);
                $this->md_user->changePhone($data['email'] , $data['phone']);
                $this->md_user->changeDob($data['email'] , $data['dob']);
                $this->md_user->changeAddress($data['email'] , $data['address']);

            }else{
                $current_user=$this->md_user->getUser( $_SESSION['useremail']);
                $data = [
                    'fullname' => $current_user['patient_name'],
                    'email' => $_SESSION['useremail'],
                    'phone' => $current_user['patient_phone'],
                    'dob' => $current_user['patient_dob'],
                    'address' => $current_user['patient_address'],
                ];
            }

            $this->view('patientdashboard/profile' , $data);

            //for avoiding form resubmission
            stopResubmission();
        }


        public function report(){
            
            $data = array();
            $result = $this->md_report->getRowByEmail($_SESSION['useremail']);
            if ($result) {
                $data = $result;
            }
            
            $this->view("patientdashboard/reports" , $data);
            
        }

        public function deleteReport($id , $path){ 
  
            // Use unlink() function to delete a file 
            echo $path;
            if (!unlink('C:\\xampp\\htdocs\\uploads\\'.$path)) { 
                $this->md_report->deleteFromId($id);
            }
            header("location: http://localhost/labora/PatientDashboard/report");


        }

        public function getPaymentPage(){
            $data = [
                'test_name' => $_SESSION['Test_type'],
                'test_price' => $_SESSION['Test_cost']
            ];
            $this->view('patientdashboard/appointment_payment' , $data);
        }

        public function payment(){
            $jsonData = file_get_contents("php://input");

            
            $data = json_decode($jsonData, true);

            $merchant_id         = '1225432';
            $order_id            = uniqid();
            $amount      = $_SESSION['Test_cost'];
            $currency    = 'LKR';
            

            $merchant_secret = 'NDIxODgwNzQyMjI2MDM0Mjg5MTIyNjAyNDI3MDYzNDQwOTQ5NjE='; // Replace with your Merchant Secret

            $hash = strtoupper(
                md5(
                    $merchant_id . 
                    $order_id . 
                    number_format($amount, 2, '.', '') . 
                    $currency .  
                    strtoupper(md5($merchant_secret)) 
                ) 
            );

            // store payment amount in session varibale for store database;
            $_SESSION['cost'] = $amount;

            $output['hash'] =  $hash;
            $output['merchant_id'] =  $merchant_id;
            $output['order_id'] =  $order_id;
            $output['payhere_amount'] =  $amount;
            $output['payhere_currency'] =  $currency;
            $output['first_name'] = $data['name'];
            $output['last_name'] =  'none';
            $output['email'] =  $data['email'];
            $output['phone'] =  $data['phone'];
            $output['address'] =  $data['address'];
            $output['city'] =  "Colombo";
            $output['country'] =  "Sri Lanka";
            echo json_encode($output);



            exit();
        }

        public function storeAppointment()
        {
            $this->md_appointment->enterAppointmentData($_SESSION['refno'],$_SESSION['Test_type'], $_SESSION['date'],$_SESSION['appointment_time_as'],$_SESSION['appointment_duration'],$_SESSION['status'],$_SESSION['appointment_notes'],$_SESSION['useremail'],'online' ,'paid',$_SESSION['cost']);
            exit();
        }

        public function storeOnsiteAppointment()
        {

            try {
                $this->md_appointment->enterAppointmentData($_SESSION['refno'], $_SESSION['Test_type'], $_SESSION['date'], $_SESSION['appointment_time_as'], $_SESSION['appointment_duration'], $_SESSION['status'], $_SESSION['appointment_notes'], $_SESSION['useremail'], 'onsite', 'unpaid', $_SESSION['cost']);
            
                $data = [
                    'success_msg' => 'payment_success'
                ];
            
                echo json_encode($data);
                exit();
            } catch (Exception $e) {

                $error_message = $e->getMessage();
                $data = [
                    'error_msg' => 'Something went wrong. Try Again!',
                    'error' => $error_message
                ];
                

                error_log($error_message);
            
                http_response_code(500); 
                echo json_encode($data);
                exit();
            }
            
        }
        
        public function showReports(){
            $data = [];
            $this->view('patientdashboard\reports\abc.pdf' , $data);
        }

}
?>

