<?php
    class MLT extends Controller{
        private $auth;
        private $md_test;

        public function __construct(){
            $this->auth = new AuthMiddleware();
            $this->auth->authMiddleware('MLT');
            $this->md_test = $this->model('M_medicaltests');

        }

        public function index(){

            $data = [];
            $this->view("mlt/dashboard" , $data);
        }

        public function reports(){

            $data = [];
            $this->view("mlt/reports" , $data);
        }

        public function appointment(){

            $data = [];
            $this->view("mlt/appointment" , $data);
        }

        public function dashboard(){

            $data = [];
            $this->view("mlt/dashboard" , $data);
        }

        public function profile(){

            $data = [];
            $this->view("mlt/profile" , $data);
        }

        public function medicalTests(){

            $data = array();
            $result = $this->md_test->getRow();
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {;
                        $data[] = $row;
                }
            }else{
                $data = [[
                    'id'=> "",
                    'test_name' => '',
                    'short_name' => '',
                    'test_type' => '',
                    'availability'=> '',
                ],];
            }
            // $data = [];
            $this->view("mlt/medicalTests" , $data);
        }
        public function test_form(){

            $data = [];
            $this->view("mlt/test_form" , $data);
        }

        public function deleteTest($id){
            $this->md_test->deleteFromTest($id);
            header('location: http://localhost/labora/mlt/medicalTests');
        }

        public function updateAvailability() {
            // Get the test ID and new availability from the AJAX request
            $testId = $_GET['testId'];
            $newAvailability = $_GET['newAvailability'];
            
            // Call the model method to update availability
            $model = new MedicalTestsModel(); // Assuming you've included the model file
            $success = $model->updateAvailability($testId, $newAvailability);
            
            // Send response back to client
            if ($success) {
                echo "Availability updated successfully";
            } else {
                echo "Error updating availability";
            }
        }
        
    }
?>