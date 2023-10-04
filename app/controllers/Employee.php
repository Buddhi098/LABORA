<?php 
    class Employee extends Controller{
        private $md_emp;
        public function __construct(){
            $this->md_emp = $this->model('M_employee');
        }
        public function login(){
            if($this->isLoggedIn()){
                header('location: http://localhost/labora/Employee/employee');
            }
            if($_SERVER['REQUEST_METHOD']=="POST"){
                $_POST = filter_input_array(INPUT_POST , FILTER_SANITIZE_STRING);
                $data = [
                    'email' => trim($_POST['employee-Email']),
                    'password' => trim($_POST['employee-password']),
                    'emailerr' => '',
                    'passworderr' => '',
                    'empemailerr' => '',
                    'emppassworderr' => ''
                ];
                // print_r($data);
                // echo $data['email'];
                if(!($this->md_emp->isExistEmail($data['email']))){
                    $data['empemailerr'] = "Acccount not found";
                }

                $hashedpassword = $this->md_emp->getPassword($data['email']); 

                // if(!password_verify($data['password'], $hashedpassword)){
                //     $data['passworderr'] = "Password incorrect";
                // }
                if($hashedpassword!=$data['password']){
                    $data['emppassworderr'] = "Password incorrect";
                }

                if(empty($data['empemailerr']) && empty($data['emppassworderr'])){
                    $_SESSION["login"] = true;
                    $user = $this->md_emp->getUser($data['email']);
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

        public function employee(){
            if(!isset($_SESSION['empid'])){
                header("location: http://localhost/labora/user/logout");
            }else{
                if((time()-$_SESSION['last_login_timestamp'])>600){
                    header("location: http://localhost/labora/user/logout");
                }else{
                    $_SESSION['last_login_timestamp'] = time();
                }
            }

            $data = [];
            $this->view("employee" , $data);
        }


        public function createUserSession($user){
            $_SESSION['empname'] = $user['empname'];
            $_SESSION['empid'] = $user['empid'];
            $_SESSION['last_login_timestamp'] = time();
            header("Location: ".URLROOT."Employee/employee");
        }

        public function logout(){
            unset($_SESSION['empname']);
            unset($_SESSION['empid']);
            session_destroy();
            header("Location: ".URLROOT."user/login");
        }

        public function isLoggedIn(){
            if(isset($_SESSION['empname'])){
                return true;
            }else{
                return false;
            }
        }
    }

?>