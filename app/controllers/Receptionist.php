<?php
class receptionist extends Controller
{
    private $auth;
    private $m_user;

    private $md_appointment;
    private $md_testtype;
    private $md_temp_prescription;

    private $md_holiday;

    private $md_user;

    private $md_report;
    public function __construct()
    {
        $this->md_appointment = $this->model('M_appointment');
        $this->md_testtype = $this->model('M_testtype');
        $this->md_temp_prescription = $this->model('M_temp_prescription');
        $this->md_holiday = $this->model('M_holiday_calendar');
        $this->md_user = $this->model('M_user');
        $this->md_report = $this->model('M_report');

        $this->auth = new AuthMiddleware();
        $this->auth->authMiddleware('receptionist');
        $this->m_user = $this->model('M_user');
    }

    public function index()
    {

        $data = [];
        $this->dashboard();
    }

    public function register()
    {

        $data = [];
        $this->view("receptionist/register", $data);
    }

    public function approved_appointment()
    {

        $data = [];
        $appointment_data = $this->md_appointment->getApprovedAppointments();
        $data['appointment_data'] = $appointment_data;
        $this->view("receptionist/approved_appointment", $data);
    }

    public function complete_appointment()
    {

        $data = [];
        $appointment_data = $this->md_appointment->getCompleteAppointments();
        $data['appointment_data'] = $appointment_data;
        if (!isset($_SESSION['msg'])) {
            $_SESSION['msg'] = '';
        }
        $this->view("receptionist/complete_appointment", $data);
    }
    public function refunded_appointment()
    {
        $appointment_data = $this->md_appointment->getRenfundAppointment();
        $data = [];
        $data['appointment_data'] = $appointment_data;
        $this->view("receptionist/refunded_appointment", $data);
    }

    public function pending_appointment()
    {

        $data = [];
        $appointment_data = $this->md_appointment->getPendingAppointments();
        $data['appointment_data'] = $appointment_data;
        $this->view("receptionist/pending_appointment", $data);
    }


    public function dashboard()
    {

        $data = [];

        $total_patients = $this->md_user->getTotalPatient();
        $data['total_patients'] = $total_patients;

        $todayRevenue = $this->md_appointment->getTodayRevenue();
        $data['today_revenue'] = $todayRevenue;

        $today_appointment_count = $this->md_appointment->getTodayAppointmentCount();
        $data['today_appointment_count'] = $today_appointment_count;

        $today_refund_amount = $this->md_appointment->getTodayRefundCost();
        $data['today_refund_amount'] = $today_refund_amount;

        $today_appoinment = $this->md_appointment->getTodayAppointment();
        $data['today_appoinment'] = $today_appoinment;

        $appointment_graph = $this->md_appointment->getNextSevenDateAppointment();
        $data['graph_data'] = $appointment_graph;

        $this->view("receptionist/dashboard", $data);
    }

    public function profile()
    {

        $data = [];
        $this->view("receptionist/profile", $data);
    }

    public function payment()
    {

        $data = [];
        $this->view("receptionist/payment", $data);
    }
    public function register_patient()
    {

        $data = [];

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $name = trim($_POST['fullName']);
            $email = trim($_POST['email']);
            $phone = trim($_POST['phone']);
            $dob = trim($_POST['dob']);
            $gender = trim($_POST['gender']);
            $address = trim($_POST['address']);

            $random_password = $this->generateRandomString(8);

            $password = password_hash($random_password, PASSWORD_DEFAULT);

            $result = $this->m_user->enterUserData($name, $email, $password, $phone, $dob, $gender, $address);

            if ($result) {
                $data['success'] = "Patient Registered Successfully";
            } else {
                $data['error'] = $result;
            }
            if (isset($_SESSION['temp_mail'])) {
                if ($_SESSION['temp_mail'] === $email) {
                    unset($_SESSION['temp_mail']);
                    $data['temp'] = true;
                }
            }

            $data_set = [
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'address' => $address,
                'password' => $random_password
            ];
            $data['data_set'] = $data_set;

            echo json_encode($data);
            exit();
        } else {
            $this->view("receptionist/patient_form", $data);
        }
    }

    public function patient_details()
    {
        $data = [];
        $patient_data = $this->m_user->getAllPatient();
        $data['patient_data'] = $patient_data;
        $this->view("receptionist/patient_details", $data);
    }

    public function sendEmail()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $email = $_POST['email'];
            $name = $_POST['fullname'];
            $random_password = $_POST['password'];

            $subject = "Account Created";
            $body = "
                        <div style='font-family: Arial, sans-serif; background-color: #f5f5f5; padding: 20px;'>
                        <h1 style='color: #333; font-size: 24px; margin-bottom: 10px;'>Your account has been created successfully.</h1>
                        <p style='color: #666; font-size: 16px; margin-bottom: 20px;'>Your password is: <strong style='color: #007bff;'>{$random_password}</strong>.</p>
                        <p style='color: #666; font-size: 16px; margin-bottom: 20px;'>Please log in to your account and change your password as soon as possible to ensure the security of your account.</p>
                        <a href='http://localhost/labora/user/login' style='display: inline-block; background-color: #007bff; color: #fff; text-decoration: none; padding: 10px 20px; border-radius: 4px; font-size: 16px;'>Log In</a>
                        </div>
                        ";
            try {
                $email_status = sendEmail($email, $name, $body, $subject);
            } catch (Exception $e) {
                $email_status = false;
            }
        }
    }
    public function payment2_form()
    {

        $data = [];
        $this->view("receptionist/payment2_form", $data);
    }

    public function generateTempMail()
    {

        $username = $this->generateRandomString();
        $email = $username . '@gmail.com';

        while ($this->model('M_user')->isMailExist($email)) {
            $username = $this->generateRandomString();
            $email = $username . '@gmail.com';
        }

        $data['email'] = $email;

        $_SESSION['temp_mail'] = $email;

        echo json_encode($data);
        exit();
    }

    function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }


    // appointment Scheduling

    public function appointment_form($patient_email = null)
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
                    $prescription_id = $this->md_temp_prescription->enterPrescription($_SESSION['patient_email']);
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
            $_SESSION['patient_email'] = $patient_email;
            $test_types = $this->md_testtype->getROw();
            $data['test_types'] = $test_types;
            $data['patient_email'] = $patient_email;
            $this->view("receptionist/appointment_form", $data);
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


    public function storeAppointment()
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

            $result = $this->md_appointment->enterAppointmentData(
                $_SESSION['refno'],
                $_SESSION['Test_type'],
                $_SESSION['date'],
                $_SESSION['appointment_time_as'],
                $_SESSION['appointment_duration'],
                $_SESSION['status'],
                $_SESSION['appointment_notes'],
                $_SESSION['patient_email'],
                'onsite',
                'paid',
                $_SESSION['cost'],
                $_SESSION['prescription'],
                $_SESSION['test_type_id']
            );

            if ($result) {
                $data = [
                    'success_msg' => 'payment_success'
                ];
                $this->sendAppointmentEmail();
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

    public function sendAppointmentEmail()
    {
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
                    <li><strong>Method:</strong> Onsite</li>
                    <li><strong>Status:</strong> Paid</li>
                    <li><strong>Amount:</strong> Rs.' . $_SESSION['cost'] . '</li>
                </ul>
            
                <p style="font-family: Arial, sans-serif; line-height: 1.6; margin-bottom: 20px;">If you have any questions or need to reschedule, please let us know.</p>
            
                <p style="font-family: Arial, sans-serif; line-height: 1.6; margin-bottom: 20px;">Thank you for choosing us.</p>
            
                <p style="font-family: Arial, sans-serif; line-height: 1.6; margin-bottom: 0;">Best regards,<br>
                LABORA<br>';

        sendEmail($_SESSION['patient_email'], $_SESSION['username'], $body, $subject);
    }

    public function getAppointmentInvoice()
    {
        $user = $this->md_user->getUser($_SESSION['patient_email']);
        $data = [
            'refNo' => $_SESSION['refno'],
            'test_type' => $_SESSION['Test_type'],
            'appointment_date' => $_SESSION['date'],
            'appointment_time' => $_SESSION['appointment_time_as'],
            'appointment_duration' => $_SESSION['appointment_duration'],
            'price' => $_SESSION['cost'],
            'email' => $_SESSION['patient_email'],
            'name' => $user['patient_name'],
            'phone' => $user['patient_phone']
        ];

        $this->view('receptionist/appointment_invoice', $data);
    }


    public function setHoliday()
    {
        if (isset($_SERVER['REQUEST_METHOD']) == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $date = trim($_POST['date']);
            $reason = trim($_POST['reason']);

            $result = $this->md_holiday->enterHolidayData($date, $reason);
            if ($result) {
                $data['success'] = 'success';
            } else {
                $data['error'] = 'error';
            }

            echo json_encode($data);
            exit();
        }
    }

    public function getHolidays()
    {
        $holidays = $this->md_holiday->getHolidays();
        $data['holidays'] = $holidays;

        echo json_encode($data);
        exit();
    }

    public function deleteHoliday($id)
    {
        $result = $this->md_holiday->deleteHoliday($id);
        if ($result) {
            $data['msg'] = 'success';
        } else {
            $data['error'] = 'error';
        }

        echo json_encode($data);
    }


    public function getHolidaysCalendar($year, $month)
    {
        $result = $this->md_holiday->getAlldates($year, $month);
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


    public function getAppointmentPass($appointment_id)
    {
        $pass_key = $this->md_appointment->setPassKey($appointment_id);
        $appointment_data = $this->md_appointment->getAppointmentByID($appointment_id);

        $patient_name = $this->md_user->getPatientName($appointment_data['patient_email']);
        $data['appointment_data'] = $appointment_data;
        $data['pass_key'] = $pass_key;

        // send email to patient
        $subject = 'Appointment Pass';
        $body = '<p style="font-family: Arial, sans-serif; line-height: 1.6; margin-bottom: 20px;">Dear ' .  $patient_name . ',</p>

            <p style="font-family: Arial, sans-serif; line-height: 1.6; margin-bottom: 20px;">We\'re confirming your upcoming appointment:</p>
            
            <a href="'.URLROOT.'PatientDashboard/viewPass/'.$appointment_id.'" style="display: inline-block;
                   padding: 10px 20px;
                   background-color: #4CAF50;
                   color: white;
                   text-align: center;
                   text-decoration: none;
                   font-size: 16px;
                   border-radius: 5px;
                   border: none;
                   cursor: pointer;
                   transition: background-color 0.3s ease;">Get Pass</a>
            
            <p style="font-family: Arial, sans-serif; line-height: 1.6; margin-bottom: 20px;">This appointment pass is your ticket to your scheduled medical test at LABORA. Please present this pass upon arrival to ensure a smooth check-in process.</p>
            
            <p style="font-family: Arial, sans-serif; line-height: 1.6; margin-bottom: 20px;">If you have any questions or need to reschedule, please let us know.</p>
            
            <p style="font-family: Arial, sans-serif; line-height: 1.6; margin-bottom: 20px;">Thank you for choosing us.</p>
            
            <p style="font-family: Arial, sans-serif; line-height: 1.6; margin-bottom: 0;">Best regards,<br>
            LABORA<br>';

        sendEmail($appointment_data['patient_email'],  $patient_name, $body, $subject);

        $this->view('receptionist/appointment_pass', $data);

    }

    public function viewPass($appointment_id)
    {
        $appointment_data = $this->md_appointment->getAppointmentByID($appointment_id);
        $data['appointment_data'] = $appointment_data;
        $data['pass_key'] = $appointment_data['pass_code'];
        $this->view('receptionist/appointment_pass', $data);
    }

    public function getPaymentForm($id, $email)
    {
        $appointment_data = $this->md_appointment->getPriceByID($id);
        $result = $this->md_appointment->payAppointment($id);
        $user = $this->md_user->getUser($email);
        $data['appointment'] = $appointment_data;
        $data['user'] = $user;

        $subject = 'Payment Confirmation';
        $body = '<p style="font-family: Arial, sans-serif; line-height: 1.6; margin-bottom: 20px;">Dear ' . $user['patient_name'] . ',</p>

            <p style="font-family: Arial, sans-serif; line-height: 1.6; margin-bottom: 20px;">We\'re confirming your payment for '.$id.' Appointment</p>
            
            <p style="font-family: Arial, sans-serif; line-height: 1.6; margin-bottom: 20px;">If you have any questions or need to reschedule, please let us know.</p>
            
            <p style="font-family: Arial, sans-serif; line-height: 1.6; margin-bottom: 20px;">Thank you for choosing us.</p>
            
            <p style="font-family: Arial, sans-serif; line-height: 1.6; margin-bottom: 0;">Best regards,<br>
            LABORA<br>';

        sendEmail($email, $user['patient_name'], $body, $subject);

        $this->view('receptionist/payment_invoice', $data);
    }

    public function removeAppointment($appointment_id)
    {
        $result = $this->md_appointment->removeAppointment($appointment_id);
        if ($result) {
            $_SESSION['msg'] = 'success';
        } else {
            $_SESSION['msg'] = 'error';
        }

        header('Location: ' . URLROOT . 'receptionist/complete_appointment');
    }

    public function getRefundInovoice($appointment_id, $email)
    {
        $isComplete = $this->md_appointment->isRefundComplete($appointment_id);
        if ($isComplete) {
            $appointment_data = $this->md_appointment->getAppointmentByID($appointment_id);
            $user = $this->md_user->getUser($email);
            $data['appointment'] = $appointment_data;
            $data['user'] = $user;

            $this->view('receptionist/refund_invoice', $data);
        } else {
            $refund_key = $this->md_appointment->setRefundKey($appointment_id);
            $user = $this->md_user->getUser($email);
            $name = $user['patient_name'];
            $link = URLROOT . 'RefundConfirm/confirmRefund/' . $refund_key;
            $this->sendRefundEmail($email, $name, $link);
            $data = [
                'error' => 'Refund is not completed yet'
            ];
            $this->view('receptionist/refund_info', $data);
        }
    }

    public function sendRefundEmail($email, $name, $link)
    {

        $subject = 'Refund Confirmation';
        $body = '<p style="font-family: Arial, sans-serif; line-height: 1.6; margin-bottom: 20px;">Dear ' . $name . ',</p>

            <p style="font-family: Arial, sans-serif; line-height: 1.6; margin-bottom: 20px;">We\'re confirming your refund request. Please click the link below to confirm the refund.</p>
            
            <a href="' . $link . '" style="display: inline-block; background-color: #007bff; color: #fff; text-decoration: none; padding: 10px 20px; border-radius: 4px; font-size: 16px;">Confirm Refund</a>
            
            <p style="font-family: Arial, sans-serif; line-height: 1.6; margin-bottom: 20px;">If you have any questions or need to reschedule, please let us know.</p>
            
            <p style="font-family: Arial, sans-serif; line-height: 1.6; margin-bottom: 20px;">Thank you for choosing us.</p>
            
            <p style="font-family: Arial, sans-serif; line-height: 1.6; margin-bottom: 0;">Best regards,<br>
            LABORA<br>';

        sendEmail($email, $name, $body, $subject);

    }

    // for retrieving the medical reports

    public function report()
    {

        $data = array();
        $result = $this->md_report->getAllReportsForReceptionist();
        if ($result) {
            $data = $result;
        }

        $this->view("receptionist/reports", $data);

    }

    public function viewReport($report_ref_no)
    {
        $pdfPath = '../app/storage/medical_reports/'.$report_ref_no.'.pdf';

        $pdfContent = file_get_contents($pdfPath);

        if ($pdfContent === false) {
            echo "Failed to read the PDF file.";
        } else {
            header('Content-Type: application/pdf');
            echo $pdfContent;
        }
    }

}
?>