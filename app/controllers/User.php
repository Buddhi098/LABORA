<?php     
    class User extends Controller{
        private $md;
        private $md_otp;
        public function __construct(){
            $this->md = $this->model('M_user');
            $this->md_otp = $this->model('M_OTP');
        }
        public function register(){
            if($_SERVER['REQUEST_METHOD']=="POST"){
                $_POST = filter_input_array(INPUT_POST , FILTER_SANITIZE_STRING);

                $fullname = trim($_POST['patient_name']);
                $email = trim($_POST['patient_email']);
                $password = trim($_POST['password']);
                $confirmpassword = trim($_POST['confirm_password']);
                $phone = trim($_POST['patient_phone']);
                $dob = $_POST['patient_dob'];
                $address = trim($_POST['patient_address']);
                $gender = trim($_POST['gender']);
                $data = [
                    // error variable
                    'passworderr' => '',
                    'emailerr' => '',
                    'username' => $fullname,
                    'email' => $email,
                    'password' => $password,
                    'confirmpassword' => $confirmpassword,
                    'phone' => $phone,
                    'dob' => $dob,
                    'address' => $address,
                ];
                //input validation
                if($password!=$confirmpassword){
                    $data['passworderr'] = 'Password does not match';
                }else{
                    $password = password_hash($_POST['password'],PASSWORD_DEFAULT);
                }

                if($this->md->isEnteredEmail($email)){
                    $data['emailerr'] = 'This email already exist';
                }

                if(empty( $data['passworderr']) && empty($data['emailerr'])){
                    $this->sendOTP($email , $fullname);

                    $_SESSION["name"] = $fullname;
                    $_SESSION["email"] = $email;
                    $_SESSION["password"] = $password;
                    $_SESSION["phone"] = $phone;
                    $_SESSION["dob"] = $dob;
                    $_SESSION["gender"] = $gender;
                    $_SESSION["address"] = $address;
                    $_SESSION["otpchance"] = 3;
                    $link = URLROOT.'OTP/submitOTP/';
                    //to block direct access
                    $_SESSION['regdone'] = "regdone";
                    header("location: $link");
                    // $this->md->enterUserData($fullname,$email,$password,$confirmpassword,$phone,$dob,$address);
                }

            }else{

                // initial state
                $data = [
                    // error variable
                    'passworderr' => '',
                    'emailerr' => '',
                    'username' => '',
                    'email' => '',
                    'password' => '',
                    'confirmpassword' =>'',
                    'phone' => '',
                    'dob' => '',
                    'address' => ''
                ];
            }

            $this->view('Signup' , $data);
            // for avoiding form resubmission
            stopResubmission();      

        }



        public function login(){
            if($this->isLoggedIn()){
                header('location: http://localhost/labora/PatientDashboard/patient');
            }
            if($_SERVER['REQUEST_METHOD']=="POST"){
                $_POST = filter_input_array(INPUT_POST , FILTER_SANITIZE_STRING);
                $data = [
                    'email' => trim($_POST['patient-Email']),
                    'password' => trim($_POST['patient-password']),
                    'formerr' => '',
                    'empformerr' => ''
                ];
                // print_r($data);
                // echo $data['email'];

                $hashedpassword = $this->md->getPassword($data['email']); 

                if((!password_verify($data['password'], $hashedpassword)) || (!($this->md->isExistEmail($data['email'])))){
                    $data['formerr'] = "Incorrect email or password";
                }

                if(empty($data['formerr'])){
                    $_SESSION["login"] = true;
                    $user = $this->md->getUser($data['email']);
                    $this->createUserSession($user);
                }else{
                    $_SESSION['login'] = false;
                }

            }else{
                $data = [
                    'formerr'=>'',
                    'empformerr' => ''
                ];
            }

            $this->view('Login' , $data);

            //for avoiding form resubmission
            stopResubmission();
        }

        public function createUserSession($user){
            $_SESSION['username'] = $user['patient_name'];
            $_SESSION['userid'] = $user['patient_id'];
            $_SESSION['useremail'] = $user['patient_email'];
            $_SESSION['last_login_timestamp'] = time();
            $_SESSION['role'] = 'patient';
            if($user['profile_img'] == ''){
                $_SESSION['profile_image'] = 'default.jpg';
            }else{
            $_SESSION['profile_image'] = $user['profile_img'];
            }
            header("Location: ".URLROOT."PatientDashboard/dashboard");
        }

        public function logout(){
            unset($_SESSION['username']);
            unset($_SESSION['userid']);
            session_destroy();
            header("Location: ".URLROOT."user/login");
        }

        public function isLoggedIn(){
            if(isset($_SESSION['username'])){
                return true;
            }else{
                return false;
            }
        }


        // OTP verification part
        function sendOTP($email , $name) {

            $min = 1000; 
            $max = 9999; 
            $randomNumber = rand($min, $max);
        
     
            $formattedNumber = str_pad($randomNumber, 4, '0', STR_PAD_LEFT);

            // for sending email
            $Subject = 'Your One-Time Password (OTP) for Registration';
            $Body    = 'As part of our security measures, we require you to verify your identity. Please find below your One-Time Password (OTP):OTP Code:'.$formattedNumber;
            sendEmail($email, $name, $Body, $Subject);
            $this->md_otp->enterOTP($email , $formattedNumber);
        }
    }
?>