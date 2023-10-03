<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo APPROOT.'/public/css/otpbox.css'?>">
    <title>OTP Submit Box</title>
    
</head>
<body>
    <?php require_once 'components/home.php'?>
    <div class="otp-container">
        <h2><img src="<?php echo APPROOT.'/public/img/envelope-otp.svg'?>" alt="">Verify your email!</h2>
        <p><center>Please enter the 4-digit verification code that was send to you email.</center></p>
        <form action="<?php echo 'http://localhost/labora/OTP/submitOTP/'.$data['fullname'].'/'.$data['email'].'/'.$data['password'].'/'.$data['phone'].'/'.$data['dob'].'/'.$data['address'];?>" method="post">
        <input type="text" name="1" class="otp-input" maxlength="1">
        <input type="text" name="2" class="otp-input" maxlength="1">
        <input type="text" name="3" class="otp-input" maxlength="1">
        <input type="text" name="4" class="otp-input" maxlength="1"><br>
        <span class="err"><?php echo $data['otperr'];?></span><br>
        <button type="submit" class="submit-btn button">Submit</button>
        </form>
        
    </div>
</body>
</html>
