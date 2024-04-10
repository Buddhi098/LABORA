<?php
    class receptionist extends Controller{
        private $auth;
        private $m_user;
        public function __construct(){
            $this->auth = new AuthMiddleware();
            $this->auth->authMiddleware('receptionist');
            $this->m_user = $this->model('M_user');
        }

        public function index(){

            $data = [];
            $this->view("receptionist/dashboard" , $data);
        }

        public function register(){

            $data = [];
            $this->view("receptionist/register" , $data);
        }

        public function appointment(){

            $data = [];
            $this->view("receptionist/appointment" , $data);
        }

        public function dashboard(){

            $data = [];
            $this->view("receptionist/dashboard" , $data);
        }

        public function profile(){

            $data = [];
            $this->view("receptionist/profile" , $data);
        }

        public function payment(){

            $data = [];
            $this->view("receptionist/payment" , $data);
        }
        public function register_patient(){

            $data = [];

            if($_SERVER['REQUEST_METHOD']=="POST"){
                $_POST = filter_input_array(INPUT_POST , FILTER_SANITIZE_STRING);

                $name = trim($_POST['fullName']);
                $email = trim($_POST['email']);
                $phone = trim($_POST['phone']);
                $dob = trim($_POST['dob']);
                $gender = trim($_POST['gender']);
                $address = trim($_POST['address']);

                $random_password = $this->generateRandomString(8);

                $password = password_hash($random_password , PASSWORD_DEFAULT);

                $result = $this->m_user->enterUserData($name , $email, $password , $phone , $dob , $gender , $address );

                if($result){
                    $data['success'] = "Patient Registered Successfully";
                }else{
                    $data['error'] =$result;
                }
                if(isset($_SESSION['temp_mail'])){
                    if($_SESSION['temp_mail'] === $email){
                        unset($_SESSION['temp_mail']);
                        $data['temp'] = true;  
                    }
                }

                $data_set = [
                    'name' => $name,
                    'email' => $email,
                    'phone' => $phone,
                    'address' => $address,
                    'password' => $random_password
                ];
                $data['data_set'] = $data_set; 

                echo json_encode($data);
                exit();
            }else{
                $this->view("receptionist/patient_form" , $data);
            }
        }

        public function patient_details(){
            $data = [];
            $patient_data = $this->m_user->getAllPatient();
            $data['patient_data'] = $patient_data;
            $this->view("receptionist/patient_details" , $data);
        }

        public function sendEmail(){
            if($_SERVER['REQUEST_METHOD']=='POST'){
                $_POST = filter_input_array(INPUT_POST , FILTER_SANITIZE_STRING);

                $email = $_POST['email'];
                $name = $_POST['fullname'];
                $random_password = $_POST['password'];

                $subject = "Account Created";
                $body = "
                        <div style='font-family: Arial, sans-serif; background-color: #f5f5f5; padding: 20px;'>
                        <h1 style='color: #333; font-size: 24px; margin-bottom: 10px;'>Your account has been created successfully.</h1>
                        <p style='color: #666; font-size: 16px; margin-bottom: 20px;'>Your password is: <strong style='color: #007bff;'>{$random_password}</strong>.</p>
                        <p style='color: #666; font-size: 16px; margin-bottom: 20px;'>Please log in to your account and change your password as soon as possible to ensure the security of your account.</p>
                        <a href='http://localhost/labora/user/login' style='display: inline-block; background-color: #007bff; color: #fff; text-decoration: none; padding: 10px 20px; border-radius: 4px; font-size: 16px;'>Log In</a>
                        </div>
                        ";
                try{
                    $email_status = sendEmail($email , $name , $body , $subject);
                }catch(Exception $e){
                    $email_status = false;
                }
            }
        }
        public function appointment_form(){

            $data = [];
            $this->view("receptionist/appointment_form" , $data);
        }
        public function payment2_form(){

            $data = [];
            $this->view("receptionist/payment2_form" , $data);
        }

        public function generateTempMail(){

            $username =$this->generateRandomString();
            $email = $username . '@gmail.com';

            while($this->model('M_user')->isMailExist($email)){
                $username =$this->generateRandomString();
                $email = $username . '@gmail.com';
            }

            $data['email'] = $email;

            $_SESSION['temp_mail'] = $email;

            echo json_encode($data);
            exit();
        }

        function generateRandomString($length = 10) {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
        }



    }
?>