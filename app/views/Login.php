<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo APPROOT.'/public/css/login.css'?>">
    <title>Login Form</title>
</head>
<body>
    <?php require_once 'components/home.php'?>
    <div class="login-container">
        <div class="login-box">
            <h2>Login as <span>Employee</span></h2>
            <div class="horizontal-line"></div>
            <form action="<?php echo URLROOT?>Employee/login?>" method="post">
                <div class="form-group">
                    <input type="email" id="employee-Email" name="employee-Email" placeholder="Email" value="" required><br>
                    <span class="formerr"><?php echo $data['empemailerr'];?></span>
                </div>
                <div class="form-group">
                    <input type="password" id="employee-password" name="employee-password" value="" placeholder="Password"><br>
                    <span class="formerr"><?php echo $data['emppassworderr'];?></span>
                </div>
                <button type="submit" name="submit" class="btn-login button">Login</button>
            </form>
        </div>
        <div class="vertical-line"></div>
        <div class="login-box">
            <h2>Login as <span>Patient</span></h2>
            <div class="horizontal-line"></div>
            <form action="<?php echo URLROOT?>User/login?>" method="post">
                <div class="form-group patient">
                    <input type="email" id="patient-Email" name="patient-Email" value="" placeholder="Email" value='' required><br>
                    <span class="formerr"><?php echo $data['emailerr'];?></span>
                </div>
                <div class="form-group patient">
                    <input type="password" id="patient-password" name="patient-password" value="" placeholder="Password" value='' required><br>
                    <span class="formerr"><?php echo $data['passworderr'];?></span>
                </div>
                <button type="submit" name="submit" class="btn-login button">Login</button>
            </form>
        </div>
    </div>
</body>
</html>
