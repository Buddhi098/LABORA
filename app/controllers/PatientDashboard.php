<?php
class PatientDashboard extends Controller
{
    private $md_appointment;
    private $md_testtype;

    private $md_user;

    private $auth;

    private $md_report;

    private $md_temp_prescription;

    private $md_holiday_calendar;
    public function __construct()
    {
        $this->md_appointment = $this->model('M_appointment');
        $this->md_testtype = $this->model('M_testtype');
        $this->md_user = $this->model('M_user');
        $this->md_report = $this->model('M_report');
        $this->md_temp_prescription = $this->model('M_temp_prescription');
        $this->md_holiday_calendar = $this->model('M_holiday_calendar');
        // check authentication
        $this->auth = new AuthMiddleware();
        $this->auth->authMiddleware("patient");

    }

    public function index()
    {

        $data = [];

        $this->dashboard();
    }


    public function appointment()
    {

        $data = array();

        $this->view("patientdashboard/appointment", $data);

    }

    public function getAppointmentData()
    {
        $data = array();
        $result = $this->md_appointment->getRowByEmail($_SESSION['useremail']);
        if ($result) {
            $data['dataset'] = $result;
        }

        echo json_encode($data);
        exit();
    }

    public function searchAppointment()
    {

        $data = array();
        $result = $this->md_appointment->getRowByEmail($_SESSION['useremail']);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Add each row as an associative array to the $data array
                $data[] = $row;
            }
        } else {
            $data = [
                [
                    'Id' => "",
                    'Ref_No' => '',
                    'Test_Type' => '',
                    'Appointment_Date' => '',
                    'Appointment_Time' => '',
                    'Appointment_Duration' => '',
                    'Appointment_Status' => '',
                    'Appointment_Notes' => '',
                ],
            ];
            $this->view("patientdashboard/appointment", $data);
        }

        $this->view("patientdashboard/appointment", $data);

    }

    public function dashboard()
    {

        $data = [];

        $medical_tests = $this->md_testtype->getRow();
        $data['medical_test'] = $medical_tests;

        $test_type_count = $this->md_testtype->getTestTypeCount();
        $data['test_type_count'] = $test_type_count;

        $number_of_reports = $this->md_report->getReportCount($_SESSION['useremail']);
        $data['number_of_reports'] = $number_of_reports;

        $total_refund_amount = $this->md_appointment->getTotalRefund($_SESSION['useremail']);
        $data['total_refund_amount'] = $total_refund_amount;

        $total_cost = $this->md_appointment->getTotalCost($_SESSION['useremail']);
        $data['total_cost'] = $total_cost;

        $graph_data = $this->md_appointment->getWeeklyAppointemntCount($_SESSION['useremail']);
        $data['graph_data'] = $graph_data;

        $upcomming_appointments = $this->md_appointment->getUpComingAppointments($_SESSION['useremail']);
        $data['upcomming_appointments'] = $upcomming_appointments;

        // print_r($data['graph_data']);
        // die();

        $this->view("patientdashboard/dashboard_2", $data);
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

    public function medicaltest()
    {

        $data = [];
        $this->view("patientdashboard/medicaltest", $data);
    }

    public function appointment_form()
    {

        $data = [
            'error' => ""
        ];

        if ($_SERVER['REQUEST_METHOD'] == "POST") {

            $test_type_id = trim($_POST['test-type']);
            $appointment_notes = trim($_POST['appointment-notes']);

            if (empty($data["error"])) {
                $formattedNumber = str_pad($this->md_appointment->getNextId(), 4, '0', STR_PAD_LEFT);

                $refno = 'LB-' . $formattedNumber;
                $test_type = $this->md_testtype->getDuration($test_type_id);

                $_SESSION['prescription'] = '';

                if (is_uploaded_file($_FILES["prescription"]['tmp_name'])) {
                    $is_valid_file = $this->verifyAndScanImage($_FILES["prescription"]);
                    if ($is_valid_file !== 1) {
                        $data['error'] = $is_valid_file;
                        echo json_encode($data);
                        exit();
                    }

                    // for saving prescription
                    $prescription_id = $this->md_temp_prescription->enterPrescription($_SESSION['useremail']);
                    $target_dir = "../app/storage/prescription/";
                    $image_name = $_FILES["prescription"]["name"];
                    $file_extention = pathinfo($image_name, PATHINFO_EXTENSION);
                    $target_file = $target_dir . 'PR-' . $prescription_id . '.' . $file_extention;

                    if (move_uploaded_file($_FILES["prescription"]["tmp_name"], $target_file)) {
                        $img_status = 'uploaded';
                    } else {
                        $img_status = 'not uploaded';
                    }

                    $_SESSION['prescription'] = 'PR-' . $prescription_id . '.' . $file_extention;
                }


                $appointment_status = "Pending";
                $_SESSION['status'] = $appointment_status;
                $_SESSION['refno'] = $refno;
                $_SESSION['appointment_duration'] = $test_type["Time_duration"];
                $_SESSION['Test_type'] = $test_type["Test_type"];
                $_SESSION['Test_cost'] = $test_type["price"];
                $_SESSION['appointment_status'] = $appointment_status;
                $_SESSION['appointment_notes'] = $appointment_notes;
                $_SESSION['test_type_id'] = $test_type_id;
                // $this->md_appointment->enterAppointmentData($_SESSION['refno'],$_SESSION['Test_type'], $_SESSION['date'],$_SESSION['$appointment_time'],$_SESSION['appointment_duration'],$_SESSION['status'],$_SESSION['appointment_notes'],$_SESSION['useremail']);
            }

        } else {
            $test_types = $this->md_testtype->getROw();
            $data['test_types'] = $test_types;
            $this->view("patientdashboard/appointment_form", $data);
        }

        $message = [
            'status' => 'success',
        ];
        echo json_encode($message);
        exit();

    }

    // Function to verify and scan uploaded image
    function verifyAndScanImage($uploadedFile)
    {

        if (!isset($uploadedFile['tmp_name']) || !is_uploaded_file($uploadedFile['tmp_name'])) {
            return 'No file uploaded.';
        }

        $allowedTypes = ['image/jpeg', 'image/png', 'application/pdf'];
        if (!in_array($uploadedFile['type'], $allowedTypes)) {
            return 'Invalid file type. Only JPEG, PNG, and PDF are allowed.';
        }

        $maxSize = 5 * 1024 * 1024;
        if ($uploadedFile['size'] > $maxSize) {
            return 'File size exceeds the limit. Maximum allowed size is 5 MB.';
        }

        return 1;
    }



    public function get_available_times($date)
    {
        if ($_SERVER['REQUEST_METHOD'] == "GET") {
            $date = new DateTime($date);
            $date = $date->format('Y-m-d');
            $_SESSION['date'] = $date;
            $timeString = $_SESSION['appointment_duration'];

            // Create a DateTime object with a specific time
            $dateTime = new DateTime($timeString);
            $time_duration = $dateTime->format('H:i:s');
            $total_time_duration_minutes = $dateTime->format('H') * 60 + $dateTime->format('i');
            $duration_interval = new DateInterval('PT' . $total_time_duration_minutes . 'M');


            $first_start_time = new DateTime('08:00:00');
            $first_end_time = new DateTime('12:00:00');
            $second_start_time = new DateTime('1:00:00');
            $second_end_time = new DateTime('5:00:00');

            $available_times = [];
            $available_start_times = [];
            $appointment_start_time = $first_start_time;
            $appointment_start_time_in_string = $appointment_start_time->format('H:i:s');
            while (true) {
                $appointment_end_time = $appointment_start_time->add($duration_interval);
                // print_r($appointment_end_time);
                // die();
                $appointment_end_time_in_string = $appointment_end_time->format('H:i:s');
                if ($appointment_end_time > $first_end_time) {
                    break;
                }
                // echo($appointment_start_time_in_string);
                // echo($appointment_end_time_in_string);
                // die();
                $sheduled_time = $this->md_testtype->getAvailableTime($date, $appointment_start_time_in_string, $appointment_end_time_in_string);

                if ($sheduled_time) {
                    $appointment_time = new DateTime($sheduled_time['Appointment_Time']);
                    $appointment_duration = new DateTime($sheduled_time['Appointment_Duration']);
                    $total_minutes = $appointment_duration->format('i') + ($appointment_duration->format('H') * 60);
                    $appointment_duration_interval = new DateInterval('PT' . $total_minutes . 'M');

                    $next_start_time = $appointment_time->add($appointment_duration_interval);
                    $appointment_start_time = $next_start_time;
                    $appointment_start_time_in_string = $appointment_start_time->format('H:i:s');
                    // echo($appointment_start_time_in_string);
                    // die();
                } else {
                    $available_start_times[] = $appointment_start_time_in_string;
                    $time_slot = substr($appointment_start_time_in_string, 0, 5) . ' AM - ' . substr($appointment_end_time_in_string, 0, 5) . ' AM';
                    $available_times[] = $time_slot;
                    $appointment_start_time = $appointment_end_time;
                    $appointment_start_time_in_string = trim($appointment_end_time_in_string);
                }

            }


            $appointment_start_time = $second_start_time;
            $appointment_start_time_in_string = $appointment_start_time->format('H:i:s');
            while (true) {
                $appointment_end_time = $appointment_start_time->add($duration_interval);
                $appointment_end_time_in_string = $appointment_end_time->format('H:i:s');
                if ($appointment_end_time > $second_end_time) {
                    break;
                }
                $sheduled_time = $this->md_testtype->getAvailableTime($date, $appointment_start_time_in_string, $appointment_end_time_in_string);
                // echo($sheduled_time);
                if ($sheduled_time) {
                    $appointment_time = new DateTime($sheduled_time['Appointment_Time']);
                    $appointment_duration = new DateTime($sheduled_time['Appointment_Duration']);
                    $total_minutes = $appointment_duration->format('i') + ($appointment_duration->format('H') * 60);
                    $appointment_duration_interval = new DateInterval('PT' . $total_minutes . 'M');

                    $next_start_time = $appointment_time->add($appointment_duration_interval);
                    $appointment_start_time = $next_start_time;
                    $appointment_start_time_in_string = $appointment_start_time->format('H:i:s');
                } else {
                    $available_start_times[] = $appointment_start_time_in_string;
                    $time_slot = substr($appointment_start_time_in_string, 0, 5) . ' PM - ' . substr($appointment_end_time_in_string, 0, 5) . ' PM';
                    $available_times[] = $time_slot;
                    $appointment_start_time = $appointment_end_time;
                    $appointment_start_time_in_string = trim($appointment_end_time_in_string);
                }

            }
            $totalMinutes = $dateTime->format('i') + ($dateTime->format('H') * 60);

            $data['time_slots'] = $available_times;
            $data['time_slots_value'] = $available_start_times;

            echo (json_encode($data));
            // echo json_encode($data);
            exit();
        }
    }

    public function set_available_times($time)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $_SESSION['appointment_time_as'] = $time;
            $_SESSION['cost'] = $_SESSION['Test_cost'];
        }
        $message = [
            'status' => 'success'
        ];
        echo json_encode($message);
        exit();
    }

    public function cancelAppointment($id)
    {
        $data = [];
        try {
            $appointment = $this->md_appointment->cancelAppointment($id);

            $data = [
                'status' => 'success'
            ];

            $subject = "Appointment Cancellation Notice";
            $body = "<p>Your appointment has been cancelled successfully.<br>
                        <strong>Appointment RefNo</strong>: ".$appointment['Ref_No']."</p>";

            sendEmail($_SESSION['useremail'] , $_SESSION['username'] , $body , $subject);

            echo json_encode($data);
            exit();
            
        } catch (Exception $e) {
            $error_msg = $e->getMessage();
            $data['status'] = $error_msg;

            echo json_encode($data);
            exit();
        }

    }

    public function editProfile()
    {

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $data = [
                'fullname' => trim($_POST['name']),
                'email' => $_SESSION['useremail'],
                'phone' => trim($_POST['phone']),
                'dob' => trim($_POST['dob']),
                'address' => trim($_POST['address']),
                'password' => trim($_POST['new_password']),
                'comfirm_password' => trim($_POST['confirm_password']),
            ];

            $img_status = 'not uploaded';
            $profile_rename = 'default.jpg';

            if (isset($_FILES["profileImage"])) {
                // $is_valid_file = $this->verifyAndScanImage($_FILES["profileImage"]);
                // if($is_valid_file !== 1){
                //     $data['error'] = $is_valid_file;
                //     echo json_encode($data);
                //     exit();
                // }

                $path = './img/profile/';
                $image_name = $_FILES["profileImage"]["name"];
                $file_extention = pathinfo($image_name, PATHINFO_EXTENSION);
                $target_file = $path . 'PP-' . $_SESSION['userid'] . '.' . $file_extention;
                $profile_rename = 'PP-' . $_SESSION['userid'] . '.' . $file_extention;

                if (move_uploaded_file($_FILES["profileImage"]["tmp_name"], $target_file)) {
                    $img_status = 'uploaded';
                } else {
                    $img_status = 'not uploaded';
                }

                $this->md_user->setProfileImage($profile_rename, $data['email']);
            }


            if ($data['password'] != '' && $data['comfirm_password'] != '') {
                if ($data['password'] != $data['comfirm_password']) {
                    $message['error'] = 'Password and Confirm Password does not match';
                    echo json_encode($message);
                    exit();
                } else {
                    $hashed_password = password_hash($data['password'], PASSWORD_DEFAULT);
                    $this->md_user->changePassword($hashed_password, $data['email']);
                }
            }
            if ($data['fullname'] != '') {
                $this->md_user->changeName($data['email'], $data['fullname']);
            }

            if ($data['phone'] != '') {
                $this->md_user->changePhone($data['email'], $data['phone']);
            }

            if ($data['dob'] != '') {
                $this->md_user->changeDob($data['email'], $data['dob']);
            }

            if ($data['address'] != '') {
                $this->md_user->changeAddress($data['email'], $data['address']);
            }

            $message = [
                'status' => 'success',
                'image_status' => $img_status
            ];

            echo json_encode($message);
            exit();

        } else {
            $current_user = $this->md_user->getUser($_SESSION['useremail']);
            if ($current_user['profile_img'] == '') {
                $current_user['profile_img'] = 'default.jpg';
            }
            $data = [
                'fullname' => $current_user['patient_name'],
                'email' => $_SESSION['useremail'],
                'phone' => $current_user['patient_phone'],
                'dob' => $current_user['patient_dob'],
                'address' => $current_user['patient_address'],
                'profile_image' => $current_user['profile_img']
            ];
        }

        $this->view('patientdashboard/profile', $data);

        //for avoiding form resubmission
        // stopResubmission();
    }


    public function report()
    {

        $data = array();
        $result = $this->md_report->getRowByEmail($_SESSION['useremail']);
        if ($result) {
            $data = $result;
        }

        $this->view("patientdashboard/reports", $data);

    }

    public function viewReport($report_ref_no)
    {
        $pdfPath = '../app/storage/medical_reports/'.$report_ref_no.'.pdf';
        if(file_exists($pdfPath)){
            $pdfContent = file_get_contents($pdfPath);
        }else{
            echo "Report Not Found";
            exit();
        }
        

        if ($pdfContent === false) {
            echo "Failed to read the PDF file.";
        } else {
            header('Content-Type: application/pdf');
            echo $pdfContent;
        }
    }

    public function deleteReport($ref_no)
    {

        $result = $this->md_report->deleteReportByRefNo($ref_no);

        if($result){
            $_SESSION['success_msg'] = 'Report deleted successfully';
        }
        
        header("location: http://localhost/labora/PatientDashboard/report");


    }

    public function getPaymentPage()
    {
        $data = array();

        if (!isset($_SESSION["appointment_time_as"])) {
            $this->view("patientdashboard/appointment_form", $data);
        } else {
            $data = [
                'test_name' => $_SESSION['Test_type'],
                'test_price' => $_SESSION['Test_cost']
            ];
            $this->view('patientdashboard/appointment_payment', $data);
        }
    }

    public function payment()
    {
        $jsonData = file_get_contents("php://input");


        $data = json_decode($jsonData, true);

        $merchant_id = '1225432';
        $order_id = uniqid();
        $amount = $_SESSION['Test_cost'];
        $currency = 'LKR';


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

        $output['hash'] = $hash;
        $output['merchant_id'] = $merchant_id;
        $output['order_id'] = $order_id;
        $output['payhere_amount'] = $amount;
        $output['payhere_currency'] = $currency;
        $output['first_name'] = $data['name'];
        $output['last_name'] = 'none';
        $output['email'] = $data['email'];
        $output['phone'] = $data['phone'];
        $output['address'] = $data['address'];
        $output['city'] = "Colombo";
        $output['country'] = "Sri Lanka";
        echo json_encode($output);



        exit();
    }

    public function doPayment()
    {
        try {
            $result = $this->md_appointment->doPayment($_SESSION['refno']);
            if ($result) {
                $this->sendAppointmentEmail('Online');
                $_SESSION['success_msg'] = 'Payment successful';
                $data = [
                    'success_msg' => 'payment_success'
                ];
            } else {
                $_SESSION['error_msg'] = 'Payment failed';
                $data = [
                    'error_msg' => 'payment_failed'
                ];
            }

            echo json_encode($data);
            exit();
        } catch (Exception $e) {
            $error_message = $e->getMessage();
            $data = [
                'error_msg' => 'Something went wrong. Try Again!',
            ];
            error_log($error_message);
            http_response_code(500);
            echo json_encode($data);
            exit();
        }
    }

    public function storeAppointment($method)
    {

        try {
            $isAvailable = $this->md_appointment->isAvailableDate($_SESSION['date'], $_SESSION['appointment_time_as']);
            if (!$isAvailable) {
                $data = [
                    'error_msg' => 'This time slot is already taken. Please select another time slot.'
                ];
                echo json_encode($data);
                exit();
            }

            // check unpaid appointment count
            $unpaid_appointment = $this->md_appointment->getUnpaidOnsiteAppointment($_SESSION['useremail']);

            if ($unpaid_appointment >= 2 && $method == 'onsite') {
                $data = [
                    'error_msg' => 'You have an maximum unpaid appointment. Please pay for the previous appointment to make a new appointment.'
                ];
                echo json_encode($data);
                exit();
            }

            $result = $this->md_appointment->enterAppointmentData(
                $_SESSION['refno'],
                $_SESSION['Test_type'],
                $_SESSION['date'],
                $_SESSION['appointment_time_as'],
                $_SESSION['appointment_duration'],
                $_SESSION['status'],
                $_SESSION['appointment_notes'],
                $_SESSION['useremail'],
                $method,
                'unpaid',
                $_SESSION['cost'],
                $_SESSION['prescription'],
                $_SESSION['test_type_id']
            );

            if ($result) {
                if ($method == 'onsite') {
                    $this->sendAppointmentEmail('Onsite');
                }
                $data = [
                    'success_msg' => 'payment_success'
                ];
            } else {
                $data = [
                    'error_msg' => 'payment_failed'
                ];
            }

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

    public function sendAppointmentEmail($method)
    {
        if ($method == 'Onsite') {
            $status = "Pending";
        } else {
            $status = "Paid";
        }
        $subject = 'Appointment Confirmation & Payment Details';

        $body = '<p style="font-family: Arial, sans-serif; line-height: 1.6; margin-bottom: 20px;">Dear ' . $_SESSION['username'] . ',</p>

                <p style="font-family: Arial, sans-serif; line-height: 1.6; margin-bottom: 20px;">We\'re confirming your upcoming appointment:</p>
                
                <ul style="list-style-type: none; padding: 0; margin-bottom: 20px;">
                    <li><strong>Date:</strong> ' . $_SESSION['date'] . '</li>
                    <li><strong>Time:</strong> ' . $_SESSION['appointment_time_as'] . '</li>
                    <li><strong>Duration:</strong> ' . $_SESSION['appointment_duration'] . '</li>
                </ul>
            
                <p style="font-family: Arial, sans-serif; line-height: 1.6; margin-bottom: 20px;"><strong>Payment:</strong></p>
                
                <ul style="list-style-type: none; padding: 0; margin-bottom: 20px;">
                    <li><strong>Method:</strong> ' . $method . '</li>
                    <li><strong>Status:</strong> ' . $status . '</li>
                    <li><strong>Amount:</strong> Rs.' . $_SESSION['cost'] . '</li>
                </ul>
            
                <p style="font-family: Arial, sans-serif; line-height: 1.6; margin-bottom: 20px;">If you have any questions or need to reschedule, please let us know.</p>
            
                <p style="font-family: Arial, sans-serif; line-height: 1.6; margin-bottom: 20px;">Thank you for choosing us.</p>
            
                <p style="font-family: Arial, sans-serif; line-height: 1.6; margin-bottom: 0;">Best regards,<br>
                LABORA<br>';

        sendEmail($_SESSION['useremail'], $_SESSION['username'], $body, $subject);
    }

    public function showReports()
    {
        $data = [];
        $this->view('patientdashboard\reports\abc.pdf', $data);
    }

    public function thankYouPage()
    {
        $data = [
            'appointment_date' => $_SESSION['date'],
            'appointment_time' => $_SESSION['appointment_time_as']
        ];
        $this->view('patientdashboard/appointment_finish', $data);
    }

    // for viewing the pass
    public function viewPass($appointment_id)
    {
        $appointment_data = $this->md_appointment->getAppointmentByID($appointment_id);
        $data['appointment_data'] = $appointment_data;
        $data['pass_key'] = $appointment_data['pass_code'];
        $this->view('patientdashboard/appointment_pass', $data);
    }
}
?>