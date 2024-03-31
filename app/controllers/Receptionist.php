<?php
    class receptionist extends Controller{
        private $auth;
        public function __construct(){
            $this->auth = new AuthMiddleware();
            $this->auth->authMiddleware('receptionist');
        }

        public function index(){

            $data = [];
            $this->view("receptionist/dashboard" , $data);
        }

        public function register(){

            $data = [];
            $this->view("receptionist/register" , $data);
        }

        public function appointment(){

            $data = [];
            $this->view("receptionist/appointment" , $data);
        }

        public function dashboard(){

            $data = [];
            $this->view("receptionist/dashboard" , $data);
        }

        public function profile(){

            $data = [];
            $this->view("receptionist/profile" , $data);
        }

        public function payment(){

            $data = [];
            $this->view("receptionist/payment" , $data);
        }
        public function patient_form(){

            $data = [];
            $this->view("receptionist/patient_form" , $data);
        }
        public function appointment_form(){

            $data = [];
            $this->view("receptionist/appointment_form" , $data);
        }
        public function payment2_form(){

            $data = [];
            $this->view("receptionist/payment2_form" , $data);
        }
    }
?>