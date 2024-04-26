<?php
    class CheckQRCode extends Controller {
        private $md_appointment;
        public function __construct(){
            $this->md_appointment = $this->model('M_appointment');
        }

        // this function should import to labassitant
        public function checkPassValidity($pass_key){
            $appointment = $this->md_appointment->getAppointmentByPassKey($pass_key);
            $data['appointment'] = $appointment;
            if($appointment){
                $this->view('receptionist/valid_qrcode' ,$data );
            }else{
                $this->view('receptionist/invalid_qrcode' ,$data );
            }
        }
    }


?>