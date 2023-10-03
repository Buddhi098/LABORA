<?php
    class PatientDashboard extends Controller{
        public function __construct(){

        }

        public function patient(){
            $data = [];
            $this->view("Patient" , $data);
        }
    }
?>