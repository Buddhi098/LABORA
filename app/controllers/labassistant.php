<?php


class labassistant extends Controller
{
    private $md_appointment;
    private $md_testtype;
    private $md_user;

    private $md_report;

    private $md_report_form;

    private $md_holiday;

    private $md_item;

    private $md_lab_order;
    private $md_lab_order_item;

    private $auth;
    public function __construct()
    {
        $this->md_appointment = $this->model('M_appointment');
        $this->md_testtype = $this->model('M_testtype');
        $this->md_user = $this->model('M_user');
        $this->md_report = $this->model('M_report');
        $this->md_report_form = $this->model('M_test_form');
        $this->md_holiday = $this->model('M_holiday_calendar');
        $this->md_item = $this->model('M_items');
        $this->md_lab_order = $this->model('M_lab_order');
        $this->md_lab_order_item = $this->model('M_lab_order_item');

        // set auth middleware
        $this->auth = new AuthMiddleware();
        $this->auth->authMiddleware('lab_assistant');
    }

    public function index()
    {

        $data = [];
        $this->dashboard();
    }

    public function appointment()
    {

        $data = array();
        $result = $this->md_appointment->getAllAppointment();
        $data['appointments'] = $result;

        $this->view("labassistant/appointment", $data);
    }

    public function patientdetails()
    {

        $data = array();
        $result = $this->md_user->getRow();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Add each row as an associative array to the $data array
                $data[] = $row;
            }
        } else {
            $data = [
                [
                    'patient_id' => "",
                    "patient_name" => "",
                    'patient_email' => '',
                    'patient_phone' => '',
                    'patient_dob' => '',
                    'patient_gender' => '',
                    'patient_address' => ''
                ],
            ];
            $this->view("labassistant/patientdetails", $data);
        }

        $this->view("labassistant/patientdetails", $data);

    }

    public function itemRequest()
    {

        $data = array();
        $result = $this->md_lab_order->getRequestOrder();
        $data['request_order'] = $result;

        $this->view("labassistant/order", $data);

    }

    public function dashboard()
    {
        $data = [];
        $pending_reports = $this->md_report->getPendingReportsCount();
        $pending_appointment = $this->md_appointment->getPendingAppointmentCount();
        $patient_count = $this->md_user->getTotalPatient();
        $item_request = '100';

        $pending_medical_reports = $this->md_report->getPendingReports();

        $data = [
            'pending_appointment_count' => $pending_appointment,
            'review_report_count' => $pending_reports,
            'item_request' => $item_request,
            'patient_count' => $patient_count,
            'pending_medical_reports' => $pending_medical_reports
        ];

        $this->view("labassistant/dashboard", $data);
    }

    public function Report()
    {
        $result = $this->md_report->getAllreports();
        $data['reports'] = $result;

        $this->view("labassistant/report", $data);
    }

    public function getMedicalReportForm($test_type_id, $email, $report_ref_no)
    {
        $result = $this->md_report_form->getTestFormById($test_type_id);
        $data['tests'] = $result;
        $_SESSION['email_data'] = $email;
        $test_name = $this->md_testtype->getTestNameById($test_type_id);
        $_SESSION['test_name'] = $test_name;
        $_SESSION['ref_no'] = $report_ref_no;

        $this->view("labassistant/report_form", $data);
    }

    public function getMedicalReport()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data1 = $_POST;
            $email = $_SESSION['email_data'];
            $patient = $this->md_user->getUser($email);
            $data['patient'] = $patient;
            $data['test_data'] = $data1;
            $data['test_name'] = $_SESSION['test_name'];

            $_SESSION['patient'] = $patient;
            $_SESSION['test_data'] = $data1;

            $this->view("labassistant/report_template", $data);
        }
    }

    public function getSignForm()
    {
        $data = [];

        if ($_SERVER["REQUEST_METHOD"] == "POST" and isset($_FILES["image"])) {

            $is_valid_file = $this->verifyAndScanImage($_FILES["image"]);

            if ($is_valid_file !== 1) {
                $data['error'] = $is_valid_file;
                $this->view('labassistant/addSign', $data);
                return;
            }
            $targetDirectory = "../app/storage/lab_signs/";
            $filename = $_FILES["image"]["name"];
            $file_extension = pathinfo($filename, PATHINFO_EXTENSION);
            $targetFile = $targetDirectory . 'lab_sign' . '.' . $file_extension;

            if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
                $data['success'] = "The file " . basename($_FILES["image"]["name"]) . " has been uploaded.";
            } else {
                $data['error'] = "Sorry, there was an error uploading your file.";
            }

            $this->view('labassistant/addSign', $data);
        }

        $this->view('labassistant/addSign', $data);
    }

    public function verifyAndScanImage($uploadedFile)
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

    public function getSign()
    {

        $this->sendFile('lab_signs/lab_sign.jpg');

    }

    public function saveReport()
    {
        try {

            // get Age
            $birthdate = new DateTime($_SESSION['patient']['patient_dob']);
            $currentDate = new DateTime();
            $age = $currentDate->diff($birthdate)->y;

            $pdf = new PDF();
            $pdf->AddPage();

            // Patient Details Section
            $pdf->SetFillColor(235, 245, 255); // Light blue color
            $pdf->SetDrawColor(51, 102, 153); // Dark blue color
            $pdf->SetLineWidth(0.2);
            $sectionX = $pdf->GetX();
            $sectionY = $pdf->GetY();
            $sectionWidth = $pdf->GetPageWidth() - 10; // Decreased padding
            $sectionHeight = 40; // Decreased height
            $pdf->Rect($sectionX, $sectionY, $sectionWidth - 10, $sectionHeight - 10, ''); // Rectangle with fill and border

            $pdf->SetFont('Arial', 'B', 14);
            $pdf->SetTextColor(51, 102, 153); // Dark blue color
            $pdf->Cell(0, 10, 'Patient Details', 0, 1, 'C');

            $pdf->SetFillColor(240, 240, 240); // Light gray color
            // $pdf->SetDrawColor(204, 204, 204); // Light gray color
            // $pdf->RoundedRect($sectionX + 5, $sectionY + 15, $sectionWidth - 10, 20, 5, '1111', 'DF'); // Rounded rectangle with fill and border

            $pdf->SetFont('Arial', 'B', 12);
            $pdf->SetTextColor(51, 51, 51); // Dark gray color
            $labelWidth = 35;
            $valueWidth = ($sectionWidth - $labelWidth - 15) / 3; // Divide remaining width into 3 columns
            $pdf->SetX($sectionX + 10); // Set X position with left padding

            // Patient details in horizontal cells
            $pdf->Cell(20, 8, 'Name:', 0, 0);
            $pdf->SetFont('Arial', '', 12);
            $pdf->Cell(35, 8, $_SESSION['patient']['patient_name'], 0, 0);

            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(20, 8, 'Age:', 0, 0);
            $pdf->SetFont('Arial', '', 12);
            $pdf->Cell(35, 8, $age, 0, 0);

            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(20, 8, 'Gender:', 0, 0);
            $pdf->SetFont('Arial', '', 12);
            $pdf->Cell(35, 8, $_SESSION['patient']['patient_gender'], 0, 1); // Move to next line

            $pdf->SetX($sectionX + 10); // Set X position with left padding

            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(20, 8, 'Ref. No.:', 0, 0);
            $pdf->SetFont('Arial', '', 12);
            $pdf->Cell(35, 8, 'PAT-' . $_SESSION['patient']['patient_id'], 0, 0);

            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(20, 8, 'Phone:', 0, 0);
            $pdf->SetFont('Arial', '', 12);
            $pdf->Cell(35, 8, $_SESSION['patient']['patient_phone'], 0, 1);

            $pdf->Ln(10);

            // Medical Test Details
            $pdf->SetFont('Arial', 'B', 14);
            $pdf->Cell(0, 10, $_SESSION['test_name'], 0, 1);
            $pdf->SetFont('Arial', '', 12);

            // Set table header colors
            $pdf->SetFillColor(51, 102, 153); // Dark blue color
            $pdf->SetTextColor(255, 255, 255); // White text color

            // Set table header font
            $pdf->SetFont('Arial', 'B', 12);

            // Table header row
            $pdf->Cell(48, 12, 'Investigation', 1, 0, 'C', true); // Fill cell with dark blue color
            $pdf->Cell(48, 12, 'Result', 1, 0, 'C', true);
            $pdf->Cell(48, 12, 'Refference Value', 1, 0, 'C', true);
            $pdf->Cell(48, 12, 'Unit', 1, 1, 'C', true); // Move to next line

            // Set table row colors
            $pdf->SetFillColor(235, 245, 255); // Light blue color
            $pdf->SetTextColor(51, 51, 51); // Dark gray text color

            // Set table row font
            $pdf->SetFont('Arial', '', 10);
            $pdf->SetLineWidth(0.2);

            // Increase cell padding
            // $pdf->SetCellPadding(5);

            for ($i = 0; $i < count($_SESSION['test_data']['label']); $i++) {
                // Table rows
                $pdf->Cell(48, 8, $_SESSION['test_data']['label'][$i], 1, 0, 'L', true); // Fill cell with light blue color
                $pdf->Cell(48, 8, $_SESSION['test_data']['value'][$i], 1, 0, 'C', true);
                $pdf->Cell(48, 8, $_SESSION['test_data']['refval'][$i], 1, 0, 'C', true);
                $pdf->Cell(48, 8, $_SESSION['test_data']['unit'][$i], 1, 1, 'C', true); // Move to next line
            }
            // Add more rows as needed

            // Output the PDF
            $pdf->Output('../app/storage/medical_reports/' . $_SESSION['ref_no'] . '.pdf', 'F');

            $this->md_report->reportCreated($_SESSION['ref_no']);

            $_SESSION['success_msg'] = "Report generated successfully.";
            $data['status'] = 'success';
        } catch (Exception $e) {
            // Handle the exception here, for example:
            $data['status'] = 'error';
            $_SESSION['success_msg'] = "Report generation failed.";
        }

        echo json_encode($data);
        exit();

    }


    public function reportSendToMLT($ref_no)
    {
        $data = [];

        $result = $this->md_report->reportSendToMLT($ref_no);
        if ($result) {
            $_SESSION['success_msg'] = "Report sent to MLT successfully.";
        } else {
            $_SESSION['success_msg'] = "Report sending failed.";
        }

        header('Location: ' . URLROOT . '/labassistant/report');
    }

    public function viewReport($report_ref_no)
    {
        $pdfPath = '../app/storage/medical_reports/' . $report_ref_no . '.pdf';

        $pdfContent = file_get_contents($pdfPath);

        if ($pdfContent === false) {
            echo "Failed to read the PDF file.";
        } else {
            header('Content-Type: application/pdf');
            echo $pdfContent;
        }
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

    public function getorderForm()
    {

        $data = [];
        $rowData = $this->md_item->getAllData();
        $item_name = [];
        foreach ($rowData as $index => $dt) {
            $item_name[$index]['item_name'] = $dt['Item_name'];
            $item_name[$index]['item_id'] = $dt['id'];
        }
        $data['item_name'] = $item_name;

        $this->view("labassistant/orderForm", $data);
    }

    public function submitRequestOrder()
    {
        $formData = file_get_contents('php://input');

        $data = json_decode($formData, true);

        $items = $data['items'];
        $note = $data['note'];

        $storeOrderId = $this->md_lab_order->enterLabOrder($note);

        foreach ($items as $item) {
            $item_name = $this->md_item->getNameById($item['itemName']);

            $set_item = $this->md_lab_order_item->enterLabOrderItem($storeOrderId, $item['itemName'], $item_name, $item['quantity'], $item['specialNote']);
        }

        $msg = [
            'msg' => true
        ];
        echo json_encode($msg);

        exit();
    }

    public function getRequestItems($order_id)
    {
        $result = $this->md_lab_order_item->getRequestItems($order_id);
        echo json_encode($result);
        exit();
    }

    public function cancelRequestOrder($order_id){
        $result = $this->md_lab_order->cancelOrder($order_id);
        if($result){
            $_SESSION['success_msg'] = "Order cancelled successfully.";
        }else{
            $_SESSION['error_msg'] = "Order cancelling failed.";
        }
        header('Location: ' . URLROOT . '/labassistant/itemRequest');
    }







}
?>