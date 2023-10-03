<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Successful</title>
    <link rel="stylesheet" href="<?php echo APPROOT.'/public/css/regfinish.css'?>">
</head>
<body>
    <?php require_once 'components/home.php'?>
    <div class="success-message">
        <h2>Registration Successful</h2>
        <p>Thank you for registering! You can now log in using your credentials.</p>
        <a href="<?php echo URLROOT?>user/login" class="button">Log In</a>
    </div>
</body>
</html>
