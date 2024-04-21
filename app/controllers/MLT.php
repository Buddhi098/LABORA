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
                    'Test_Id'=> "",
                    'Test_Name' => '',
                    'Test_Type' => '',
                    'TimeToDo' => '',
                    'cost' => '',
                    'Status'=> '',
                ],];
            }
            // $data = [];
            $this->view("mlt/medicalTests" , $data);
        }
        public function test_form(){

            $data = [];
            $this->view("mlt/test_form" , $data);
        }

        public function deleteTest($Test_ID){
            $this->md_test->deleteFromTest($Test_ID);
            header('location: http://localhost/labora/mlt/medicalTests');
        }

        public function updateAvailability() {
            $data = json_decode(file_get_contents('php://input'), true);

            if (!empty($data['testId']) && !empty($data['newAvailability'])) {
                $testId = $data['testId'];
                $newAvailability = $data['newAvailability'];

                // Assuming you have a model method to update availability in the database
                $success = $this->md_test->updateAvailability($testId, $newAvailability);

                if ($success) {
                    // Return success response if needed
                    http_response_code(200);
                    echo json_encode(['message' => 'Availability updated successfully']);
                    exit;
                }
            }

            // Return error response if failed to update
            http_response_code(500);
            echo json_encode(['message' => 'Failed to update availability']);
            exit;
        }

        
    }
?>