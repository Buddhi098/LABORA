<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="600; url=http://localhost/labora/user/logout">
    <link rel="stylesheet" href="<?php echo APPROOT.'/public/css/patientdashboard/patient.css'?>">
    <script src="<?php echo APPROOT.'/public/js/patientdashboard/patient.js';?>"></script>

    <title>Patient dashboard</title>
</head>
<body>
    <h1>Welcome to patient dashboard <?php echo $_SESSION['username'];?></h1>
    <a href="http://localhost/labora/user/logout">Logout</a>
</body>
</html>