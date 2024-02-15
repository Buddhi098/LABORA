<?php
    class Admin extends Controller{
        public function __construct(){

        }

        public function index(){

            $data = [];
            $this->view("admin/Admin" , $data);
        }

        public function medicaltest(){


            $data = [];
            $this->view("admin/medicaltest" , $data);
        }

        public function userAccount(){


            $data = [];
            $this->view("admin/userAccount" , $data);
        }

        public function dashboard(){

            $data = [];
            $this->view("admin/dashboard" , $data);
        }

        public function reports(){

            $data = [];
            $this->view("admin/reports" , $data);
        }

        public function payment(){

            $data = [];
            $this->view("admin/payment" , $data);
        }
        public function user_form(){

            $data = [];
            $this->view("admin/user_form" , $data);
        }
    }
?>