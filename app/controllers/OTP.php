<?php
    class OTP extends Controller{
        private $md_otp;
        private $md;
        public function __construct(){
            $this->md_otp = $this->model('M_OTP'); 
            $this->md = $this->model("M_user");
        }

        public function submitOTP($fullname,$email,$password,$phone,$dob,$address){
            $data = [
                'fullname' => $fullname,
                'email' => $email,
                'password' => $password,
                'phone' => $phone,
                'dob' => $dob,
                'address' => $address,
                'otperr' => ""
            ];

            if($_SERVER['REQUEST_METHOD']=="POST"){
                $submiOTP = $_POST['1'].$_POST['2'].$_POST['3'].$_POST['4'];
                if($this->md_otp->isExistEmail($email)){
                    $OTP_code = $this->md_otp->getOTP($email);
                }else{
                    die("Email not found");
                }
                if(empty($submiOTP)){
                    $data['otperr'] = "Please enter OTP";
                }elseif($submiOTP==$OTP_code){
                    $this->md->enterUserData($fullname,$email,$password,$phone,$dob,$address);
                    header("location: http://localhost/labora/OTP/registrationSuccessful");
                }else{
                    $data['otperr'] = "Invalid OTP";
                }
            }

            $this->view('OTP' , $data);
        }




        public function registrationSuccessful(){
            $data = [];
            $this->view('Regfinish' , $data);
        }
    }

        
?>
 