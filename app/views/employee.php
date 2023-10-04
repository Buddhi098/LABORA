<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="600; url=http://localhost/labora/user/logout">
    <link rel="stylesheet" href="<?php echo APPROOT.'/public/css/patient.css'?>">

    <title>Patient dashboard</title>
</head>
<body>
    <h1>Welcome to Employee dashboard <?php echo $_SESSION['empname'];?></h1>
    <a href="http://localhost/labora/user/logout">Logout</a>
</body>
</html>