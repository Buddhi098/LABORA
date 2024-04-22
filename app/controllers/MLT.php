<?php
class MLT extends Controller
{
    private $auth;
    private $md_test_type;

    private $md_test_form;

    private $md_holiday;

    private $md_appointment;

    private $md_report;

    public function __construct()
    {
        $this->auth = new AuthMiddleware();
        $this->auth->authMiddleware('MLT');
        $this->md_test_type = $this->model('M_testtype');
        $this->md_test_form = $this->model('M_test_form');
        $this->md_holiday = $this->model('M_holiday_calendar');
        $this->md_appointment = $this->model('M_appointment');
        $this->md_report = $this->model('M_report');
    }

    public function index()
    {

        $data = [];

        $this->dashboard();
    }

    public function reports()
    {

        $data = [];
        $reports = $this->md_report->getReportForMLT();
        $data['reports'] = $reports;
        $this->view("mlt/reports", $data);
    }

    public function appointment()
    {
        $appointment = $this->md_appointment->getAppointmentForMlt();
        $data = [
            'appointment' => $appointment
        ];
        $this->view("mlt/appointment", $data);
    }

    public function dashboard()
    {
        $pending_appointment_count = $this->md_appointment->getpendingAppointmentCount();
        $review_report_count = $this->md_report->getReviewReportCount();
        $get_test_catergory_count = $this->md_test_type->getTestTypeCount();

        $review_reports = $this->md_report->getReviewReport();

        $data = [
            'pending_appointment_count' => $pending_appointment_count,
            'review_report_count' => $review_report_count,
            'get_test_catergory_count' => $get_test_catergory_count,
            'review_report' => $review_reports
        ];

        $this->view("mlt/dashboard", $data);
    }

    public function profile()
    {

        $data = [];
        $this->view("mlt/profile", $data);
    }

    public function medicalTests()
    {

        $data = [];

        $test_types = $this->md_test_type->getAllActiveTests();
        $data['test_types'] = $test_types;
        $this->view("mlt/medicalTests", $data);
    }
    public function test_form()
    {
        $data = [];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'test-category-name' => isset($_POST['test-category-name']) ? $_POST['test-category-name'] : null,
                'description' => isset($_POST['description']) ? $_POST['description'] : null,
                'preparation' => isset($_POST['preparation']) ? $_POST['preparation'] : null,
                'time-duration' => isset($_POST['time-duration']) ? $_POST['time-duration'] : null,
                'price' => isset($_POST['price']) ? $_POST['price'] : null
            ];

            $result = $this->md_test_type->setTestType($data['test-category-name'], $data['description'], $data['preparation'], $data['time-duration'], $data['price']);

            if ($result) {
                $msg['success'] = 'Test type added successfully';
            } else {
                $msg['error'] = 'Failed to add test type';
            }

            echo json_encode($msg);
            exit();

        } else {
            $this->view("mlt/test_form", $data);
        }

    }

    public function getFormTemplateGenerator()
    {
        $data = [];
        $this->view("mlt/template_form", $data);
    }

    public function setFormTemplate()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'form-name' => isset($_POST['form-name']) ? $_POST['form-name'] : null,
                'form-fields' => isset($_POST['form-fields']) ? json_decode($_POST['form-fields'], true) : null
            ];
    

            if ($data['form-fields'] === null) {
                $msg['error'] = 'Invalid JSON data';
            } else {
                $result = $this->md_test_form->addTestForm($_SESSION['test_id'], $data['form-fields']);
    
                if($result){
                    $msg['success'] = 'Form template added successfully';
                    $_SESSION['success_msg'] = 'Form template added successfully';
                } else {
                    $msg['error'] = 'Failed to add form template';
                    $_SESSION['error_msg'] = 'Failed to add form template'; 
                }
            }
    
            echo json_encode($msg);
            exit();
        }
    }

    public function getTestDescription($id){
            $result = $this->md_test_type->getDescriptionById($id);

            echo json_encode($result);
            exit();
    }
    public function getPreparations($id){
        $result = $this->md_test_type->getPreparationsById($id);

        echo json_encode($result);
        exit();
    }

    public function changeAvailabilityStatus($id){
        $result = $this->md_test_type->changeAvailabilityStatus($id);
        if($result){
            $msg['success'] = 'Changed Availability status';
        }else{
            $msg['error'] = 'Error occured';
        }

        echo json_encode($msg);
        exit();
    }
    
    public function removeTest($id){
        $result = $this->md_test_type->removeTestById($id);
        if($result){
            $msg['success'] = 'Test removed successfully';
        }else{
            $msg['error'] = 'Error occured';
        }

        echo json_encode($msg);
        exit();
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

    public function setAppointmentApproved($ref_no){
        $result = $this->md_appointment->setApprovedAppointment($ref_no);
        $_SESSION['success_msg'] = 'Appointment approved successfully';
        $data = [];
        header('Location: ' . URLROOT . '/MLT/appointment');
    }

    public function setAppointmentRejected($ref_no , $reason){
        $result = $this->md_appointment->setRejectedAppointment($ref_no, $reason);
        $_SESSION['success_msg'] = 'Appointment rejected successfully';

        header('Location: ' . URLROOT . '/MLT/appointment');
    }

    public function removeAppointmentMLT($ref_no){
        $result = $this->md_appointment->removeAppointmentMLT($ref_no);
        $_SESSION['success_msg'] = 'Appointment removed successfully';

        header('Location: ' . URLROOT . '/MLT/appointment');
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

    public function approveReport($ref_no){
        $result = $this->md_report->approveReport($ref_no);
        if($result){
            $_SESSION['success_msg'] = 'Report approved successfully';
        }

        header('Location: ' . URLROOT . '/MLT/reports');
    }

    public function rejectReport($ref_no , $reason){
        $result = $this->md_report->rejectReport($ref_no, $reason);
        if($result){
            $_SESSION['success_msg'] = 'Report rejected successfully';
        }

        header('Location: ' . URLROOT . '/MLT/reports');
    }

    public function removeReport($ref_no){
        $result = $this->md_report->removeReportForMLT($ref_no);
        if($result){
            $_SESSION['success_msg'] = 'Report removed successfully';
        }

        header('Location: ' . URLROOT . '/MLT/reports');
    }

    public function completeReport($ref_no){
        $result = $this->md_report->completeReport($ref_no);
        if($result){
            $_SESSION['success_msg'] = 'Report completed successfully';
        }

        header('Location: ' . URLROOT . '/MLT/reports');
    }


}
?>