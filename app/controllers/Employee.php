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
                    'empformerr' => '',
                    'formerr' => '',
                ];
                // print_r($data);
                // echo $data['email'];
                if(!($this->md_emp->isExistEmail($data['email']))){
                    $data['empformerr'] = "Incorrect username or password";
                }

                $hashedpassword = $this->md_emp->getPassword($data['email']); 

                // if(!password_verify($data['password'], $hashedpassword)){
                //     $data['passworderr'] = "Password incorrect";
                // }
                if($hashedpassword!=$data['password']){
                    $data['empformerr'] = "Incorrect username or password";
                }

                if(empty($data['empformerr'])){
                    $_SESSION["login"] = true;
                    $user = $this->md_emp->getUser($data['email']);
                    $this->createUserSession($user);
                }else{
                    $_SESSION['login'] = false;
                }

            }else{
                $data = [
                    'empformerr' => '',
                    'formerr' => '',
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
            $_SESSION['username'] = $user['full_name'];
            $_SESSION['empid'] = $user['id'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['last_login_timestamp'] = time();
            
            if($user['role']=='lab_assistant'){
                header("Location: ".URLROOT."labassistant/");
            }else if($user['role']=='admin'){
                header("Location: ".URLROOT."admin/");
            }else if($user["role"]== "inventory_manager"){
                header("Location: ".URLROOT."invmng/dashboard");
            }else if($user["role"]== "receptionist"){
                header("Location: ".URLROOT."receptionist/");
            }else if($user["role"]=="MLT"){
                header("Location: ".URLROOT."MLT/");
            }else if($user["role"]=="supplier"){
                header("Location: ".URLROOT."supplier/");
            }else if($user["role"]=="inventory_manager"){
                header("Location: ".URLROOT."invmng/");
            }
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