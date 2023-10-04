<?php
    class PatientDashboard extends Controller{
        public function __construct(){

        }

        public function patient(){
            if(!isset($_SESSION['userid'])){
                header("location: http://localhost/labora/user/logout");
            }else{
                if((time()-$_SESSION['last_login_timestamp'])>600){
                    header("location: http://localhost/labora/user/logout");
                }else{
                    $_SESSION['last_login_timestamp'] = time();
                }
            }

            $data = [];
            $this->view("patientdashboard/Patient" , $data);
        }
    }
?>