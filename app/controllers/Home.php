<?php
    class Home extends Controller{
        private $md_testtype;

        private $md_contact_us;
        public function __construct(){
            $this->md_testtype = $this->model('M_testtype');
            $this->md_contact_us = $this->model('M_contact_us');
        }
        public function index(){
            $this->view("Home" , []);
        }

        public function getService($id , $table_id=0){
            if($id == 0){
                $result = $this->md_testtype->getRowNew();
                $table_id_ = $result['table_id'];
                $result = $result['result'];
            }else{
                $result = $this->md_testtype->getRowNew();
                $table_id_ = $table_id;
                $result = $result['result'];
            }
            $preparation = $this->md_testtype->getPreparationsById($table_id_);
            $data['result'] = $result;
            $data['preparation'] = $preparation;

            exit(json_encode($data));
        }

        public function submitContactUs(){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $_POST = filter_input_array(INPUT_POST , FILTER_SANITIZE_STRING);

                $name = trim($_POST['name']);
                $email = trim($_POST['email']);
                $tel = trim($_POST['tel']);
                $subject = trim($_POST['subject']);
                $message = trim($_POST['message']);

                $data = [
                    'name' => $name,
                    'email' => $email,
                    'tel' => $tel,
                    'subject' => $subject,
                    'message' => $message
                ];

                $this->md_contact_us->submitContactUs($data);

                $this->view("thank_you" , []);


            }
        }
    }
    
?>