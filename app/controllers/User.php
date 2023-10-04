<?php     
    //Import PHPMailer classes into the global namespace
    //These must be at the top of your script, not inside a function
    use \PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
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
                $data = [
                    // error variable
                    'passworderr' => '',
                    'emailerr' => ''
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
                    $this->sendtOTP($email , $fullname);
                    $_SESSION["name"] = $fullname;
                    $link = URLROOT.'/OTP/submitOTP/'.$fullname.'/'.$email.'/'.$password.'/'.$phone.'/'.$dob.'/'.$address;
                    header("location: $link");
                    // $this->md->enterUserData($fullname,$email,$password,$confirmpassword,$phone,$dob,$address);
                }

            }else{

                // initial state
                $data = [
                    // error variable
                    'passworderr' => '',
                    'emailerr' => ''
                ];
            }

            $this->view('Signup' , $data);

            //for avoding form resubmission
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
                    'emailerr' => '',
                    'passworderr' => '',
                    'empemailerr' => '',
                    'emppassworderr' => ''
                ];
                // print_r($data);
                // echo $data['email'];
                if(!($this->md->isExistEmail($data['email']))){
                    $data['emailerr'] = "Acccount not found";
                }

                $hashedpassword = $this->md->getPassword($data['email']); 

                if(!password_verify($data['password'], $hashedpassword)){
                    $data['passworderr'] = "Password incorrect";
                }

                if(empty($data['emailerr']) && empty($data['passworderr'])){
                    $_SESSION["login"] = true;
                    $user = $this->md->getUser($data['email']);
                    $this->createUserSession($user);
                }else{
                    $_SESSION['login'] = false;
                }

            }else{
                $data = [
                    'emailerr' => '',
                    'passworderr' => '',
                    'empemailerr' => '',
                    'emppassworderr' => ''
                ];
            }

            $this->view('Login' , $data);

            stopResubmission();
        }

        public function createUserSession($user){
            $_SESSION['username'] = $user['name'];
            $_SESSION['userid'] = $user['id'];
            $_SESSION['last_login_timestamp'] = time();
            header("Location: ".URLROOT."PatientDashboard/patient");
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
        function generateOTP() {
            // Generate a random 4-digit number
            $min = 1000; 
            $max = 9999; 
            $randomNumber = rand($min, $max);
        
            // Ensure the number is exactly 4 digits by padding with leading zeros if necessary
            $formattedNumber = str_pad($randomNumber, 4, '0', STR_PAD_LEFT);
        
            return $formattedNumber;
        }



        public function sendtOTP($email , $name){
            
            //Load Composer's autoloader
            require 'PHPMailer-master/src/Exception.php';
            require 'PHPMailer-master/src/PHPMailer.php';
            require 'PHPMailer-master/src/SMTP.php';
            //Create an instance; passing `true` enables exceptions
            $mail = new PHPMailer(true);
            $OTP_code = $this->generateOTP();
            try {
                //Server settings
                $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = 'cs29groupproject@gmail.com';                     //SMTP username
                $mail->Password   = 'azwq irtg fuej dfxs';                               //SMTP password
                $mail->SMTPSecure = 'ssl';            //Enable implicit TLS encryption
                $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                //Recipients
                $mail->setFrom('cs29groupproject@gmail.com', 'Labora');
                $mail->addAddress($email, $name);     //Add a recipient

                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'Your One-Time Password (OTP) for Registration';
                $mail->Body    = 'As part of our security measures, we require you to verify your identity. Please find below your One-Time Password (OTP):OTP Code:'.$OTP_code;

                $mail->send();

                $this->md_otp->enterOTP($email , $OTP_code);

            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        }
    }
?>