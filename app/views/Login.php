<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo APPROOT.'/public/css/login.css'?>">
    <title>Login Form</title>
    <script src="<?php echo APPROOT.'\public\js\login.js';?>"></script>
</head>
<body onload="patient()">
    <?php require_once 'components/home.php'?>
    <div class="login-container">
        <h1>SIGN IN TO YOUR ACCOUNT</h1>
        <div class="login-button" >
            <button onclick="employee()" id="employee-button">AS A <span>EMPLOYEE</span></button>
            <button onclick="patient()" id="patient-button">AS A <span>PATIENT</span></button>
        </div>

        <div class="employee" id="employee">
            <form action="<?php echo URLROOT?>Employee/login?>" method="post">
                <div class="form-group">
                    <label for="employee-Email">Email</label><br>
                    <input type="email" id="employee-Email" name="employee-Email" value="" required><br>
                </div>
                <div class="form-group">
                    <label for="employee-password">Password</label><br>
                    <input type="password" id="employee-password" name="employee-password" value=""><br>
                    <span class="formerr"><?php echo $data['empformerr'];?></span>
                    <a href="#">Forgot Password</a>
                </div>
                <button type="submit" name="submit" class="btn-login button">Login</button>
                <p>Not yet a member?<a href="">Please contact admin</a></p>
            </form>
        </div>

        <div class="patient" id="patient">
                <form action="<?php echo URLROOT?>User/login?>" method="post">
                    <div class="form-group patient">
                        <label for="employee-Email">Email</label><br>
                        <input type="email" id="patient-Email" name="patient-Email" value="" value='' required><br>
                    </div>
                    <div class="form-group patient">
                        <label for="employee-password">Password</label><br>
                        <input type="password" id="patient-password" name="patient-password" value="" value='' required><br>
                        <span class="formerr"><?php echo $data['formerr'];?></span>
                        <a href="<?php echo URLROOT.'user/passwordRecover'?>">Forgot Password</a>
                    </div>
                    <button type="submit" name="submit" class="btn-login button">Login</button>
                    <p>Not yet a member?<a href="<?php echo URLROOT.'user/register'?>">SignUp Now</a></p>
                </form>
        </div>
    </div>
    
</body>
</html>

<script>
    document.addEventListener('DOMContentLoaded', function() {
    sessionStorage.clear(); 
    });

</script>