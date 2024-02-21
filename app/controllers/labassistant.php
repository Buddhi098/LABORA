<?php
    class labassistant extends Controller{
        private $md_appointment;
        private $md_testtype;
        private $md_user;
        
        private $auth;
        public function __construct(){
            $this->md_appointment = $this->model('M_appointment');
            $this->md_testtype = $this->model('M_testtype');
            $this->md_user = $this->model('M_user');

            // set auth middleware
            $this->auth = new AuthMiddleware();
            $this->auth->authMiddleware('lab_assistant');
        }

        public function index(){

            $data = [];
            $this->view("labassistant/dashboard" , $data);
        }

        public function reports(){

            $data = [];
            $this->view("labassistant/reports" , $data);
        }

        public function appointment(){
            
            $data = array();
            $result = $this->md_appointment->getRow();
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    // Add each row as an associative array to the $data array
                    if($row['Appointment_Status']=='Pending Approval' || $row['Appointment_Status']=='Send to MLT'){
                        $row['patient_name'] = $this->md_user->getUserName($row['patient_email']);
                        $data[] = $row;
                    }
                    
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
                    'patient_name' => ''
                ],];
                $this->view("labassistant/appointment" , $data);
            }
            
            $this->view("labassistant/appointment" , $data);
        }

        public function patientdetails(){
            
            $data = array();
            $result = $this->md_user->getRow();
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    // Add each row as an associative array to the $data array
                    $data[] = $row;
                }
            }else{
                $data = [[
                    'patient_id'=> "",
                    "patient_name"=> "",
                    'patient_email' => '',
                    'patient_phone' => '',
                    'patient_dob' => '',
                    'patient_gender' => '',
                    'patient_address' => ''
                ],
                ];
                $this->view("labassistant/patientdetails" , $data);
            }
            
            $this->view("labassistant/patientdetails" , $data);
            
        }

        public function inventory(){
            
            $data = array();
            $result = $this->md_appointment->getRow();
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    // Add each row as an associative array to the $data array
                    $data[] = $row;
                }
            }else{
                $data = [
                    'Id'=> "",
                    'Ref_no' => '',
                ];
                $this->view("labassistant/inventory" , $data);
            }
            
            $this->view("labassistant/inventory" , $data);
            
        }

        public function dashboard(){

            $data = [];
            $this->view("labassistant/dashboard" , $data);
        }

        public function cancelAppointment($id){

            $data = [];
            $row = $this->md_appointment->getRowList($id);
            if($row['Appointment_Status']=='Pending Approval'){
                $this->md_appointment->cancelAppointment($id);
            }
            header("Location: http://localhost/labora/labassistant/appointment");
        }

        public function sendAppointment($id){

            $data=[];
            $this->md_appointment->sendAppointment($id);
            header("Location: http://localhost/labora/labassistant/appointment");
        }

        
    }
?>

