<?php

class AuthMiddleware {

    public function __construct() {
    }
    public function authMiddleware($userRole) {
        if(isset($_SESSION['role']) && $_SESSION['role'] == $userRole && (time() - $_SESSION['last_login_timestamp']) < 10000){
            $_SESSION['last_login_timestamp'] = time();
            return true;
        }else {
            
            header("Location: http://localhost/labora/user/logout");
            exit();
        }
    }
}

?>

