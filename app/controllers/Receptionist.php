<?php
    class Receptionist extends Controller{
        private $auth;
        public function __construct(){
            $this->auth = new AuthMiddleware();
            $this->auth->authMiddleware('Receptionist');
        }

        public function index(){

            $data = [];
            $this->view("Receptionist/dashboard" , $data);
        }

        public function register(){

            $data = [];
            $this->view("Receptionist/register" , $data);
        }

        public function appointment(){

            $data = [];
            $this->view("Receptionist/appointment" , $data);
        }

        public function dashboard(){

            $data = [];
            $this->view("Receptionist/dashboard" , $data);
        }

        public function profile(){

            $data = [];
            $this->view("Receptionist/profile" , $data);
        }

        public function payment(){

            $data = [];
            $this->view("Receptionist/payment" , $data);
        }
        public function patient_form(){

            $data = [];
            $this->view("Receptionist/patient_form" , $data);
        }
        public function appointment_form(){

            $data = [];
            $this->view("Receptionist/appointment_form" , $data);
        }
        public function payment2_form(){

            $data = [];
            $this->view("Receptionist/payment2_form" , $data);
        }
    }
?>