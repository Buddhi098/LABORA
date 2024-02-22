<?php
    class MLT extends Controller{
        private $auth;

        public function __construct(){
            $this->auth = new AuthMiddleware();
            $this->auth->authMiddleware('MLT');
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

            $data = [];
            $this->view("mlt/medicalTests" , $data);
        }
        public function test_form(){

            $data = [];
            $this->view("mlt/test_form" , $data);
        }
    }
?>