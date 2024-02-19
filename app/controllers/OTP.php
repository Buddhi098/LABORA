<?php
    class OTP extends Controller{
        private $md_otp;
        private $md;
        public function __construct(){
            $this->md_otp = $this->model('M_OTP'); 
            $this->md = $this->model("M_user");
        }

        public function submitOTP(){
            //to block direct access
            if(!isset($_SESSION["regdone"])){
                header("location: http://localhost/labora/user/register");
            }

            $data = [
                'otperr' => "",
            ];
                
            if($_SERVER['REQUEST_METHOD']=="POST"){
                $submiOTP = $_POST['1'].$_POST['2'].$_POST['3'].$_POST['4'];
                if($this->md_otp->isExistEmail($_SESSION["email"])){
                    $OTP_code = $this->md_otp->getOTP($_SESSION["email"]);

                    if(empty($submiOTP)){
                        $data['otperr'] = "Please enter OTP";
                    }elseif($submiOTP==$OTP_code){
                        //to block direct access
                        $_SESSION['submitted'] = "submit";
                        unset($_SESSION["regdone"]);

                        header("location: http://localhost/labora/OTP/registrationSuccessful");
                    }else{
                        
                        // user have only 3 chances for enter invalid OTP
                        $_SESSION["otpchance"] = $_SESSION["otpchance"] - 1;

                        $data['otperr'] = "Invalid OTP. You have ".$_SESSION["otpchance"]." attempts remaining.";

                        if($_SESSION["otpchance"]==0){
                            $this->md_otp->dropOTP($_SESSION["email"]);
                            unset($_SESSION['name']);
                            unset($_SESSION['email']);
                            unset($_SESSION['phone']);
                            unset($_SESSION['password']);
                            unset($_SESSION['dob']);
                            unset($_SESSION["gender"]);
                            unset($_SESSION['address']);
                            unset($_SESSION["regdone"]);
                            header("location: http://localhost/labora/user/register");
                        }
                    }
                    
                }else{
                    echo "<script>
                            alert('Invalid Email! Please enter valid email');
                            </script>";
                }
            }

            $this->view('OTP' , $data);
            //for avoiding form resubmission
            // stopResubmission();    
        }




        public function registrationSuccessful(){
            // block direct access
            if(!isset($_SESSION['submitted'])){
                header("location: http://localhost/labora/OTP/submitOTP");
            }else{
                unset($_SESSION['submitted']);
                if(isset($_SESSION['name']) && isset($_SESSION['email']) && isset($_SESSION['password']) && isset($_SESSION['phone']) && isset($_SESSION['dob']) && isset($_SESSION['gender']) && isset($_SESSION['address'])){
                    $this->md->enterUserData($_SESSION["name"],$_SESSION["email"],$_SESSION["password"], $_SESSION["phone"],$_SESSION["dob"],$_SESSION["gender"] ,$_SESSION["address"]);
                    $this->md_otp->dropOTP($_SESSION["email"]);
                    unset($_SESSION['name']);
                    unset($_SESSION['email']);
                    unset($_SESSION['phone']);
                    unset($_SESSION['password']);
                    unset($_SESSION['dob']);
                    unset($_SESSION["gender"]);
                    unset($_SESSION['address']);
                    unset($_SESSION["otpchance"]);
                }else{
                    echo "<script>
                                alert('ReEnter Data!');
                                </script>";
                    header("location: http://localhost/labora/user/register");
                }
            }

            $data = [];
            $this->view('Regfinish' , $data);

        }
    }

        
?>
 