<?php
    class supplier extends Controller{

        private $md_appointment;
        //private $md_testtype;

        // private $md_catalog;
        // private $md_quotation;

        private $md_user;

        private $auth;
        public function __construct(){

            $this->md_appointment = $this->model('M_appointment');
            $this->md_user = $this->model('M_user');

            // set auth middleware
            $this->auth = new AuthMiddleware();
            $this->auth->authMiddleware('supplier');
        }

        public function f_Supplier(){
            
            $data = [];
            $this->view("supplier/" , $data);
        }

       

        public function index(){

            $data = [];
            $this->view("supplier/dashboard" , $data);
        }

        //Data that inserted in catalog table
        public function catalog(){
            
            $data = array();
            $result = $this->md_catalog->getRow();
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    // Add each row as an associative array to the $data array
                    $data[] = $row;
                }
            }else{
                $data = [[
                    'product_id'=> "",
                    "product_name"=> "",
                    'quantity' => '',
                    'price' => '',
                    'description' => '',
                    'availability' => '',
                ],
                ];
                $this->view("supplier/catalog" , $data);
            }
            
            $this->view("supplier/catalog" , $data);
            
        }

        public function quotation(){

            $data = [];
            $this->view("supplier/quotation" , $data);
        }

        public function inventory(){

            $data = [];
            $this->view("supplier/inventory" , $data);
        }

         //*Only temporary*//
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
                $this->view("supplier/quotation" , $data);
            }
            
            $this->view("supplier/quotation" , $data);
        }

        public function cancelAppointment($id){

            $data = [];
            $row = $this->md_appointment->getRowList($id);
            if($row['Appointment_Status']=='Pending Approval'){
                $this->md_appointment->cancelAppointment($id);
            }
            header("Location: http://localhost/labora/supplier/quotation");
        }

        public function sendAppointment($id){

            $data=[];
            $this->md_appointment->sendAppointment($id);
            header("Location: http://localhost/labora/supplier/quotation");
        }


        
        
    }
?>