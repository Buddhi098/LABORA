<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta http-equiv="refresh" content="600; url=http://localhost/labora/user/logout"> -->
    <link rel="stylesheet" href="<?php echo APPROOT.'/public/css/receptionist/dashboard.css'?>">
    <script src="<?php echo APPROOT.'/public/js/receptionist/recept.js';?>"></script>
    <!-- static icons -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <!-- annimation icons -->
    <script src="https://cdn.lordicon.com/lordicon-1.1.0.js"></script>
    <title>Receptionist dashboard</title>
</head>
<body>
    <?php require_once 'components/nevbar.php' ?>

    <div class="container_1">
        <div class="boxset-1">
            <div class="box box-1">
                <span>6</span><br>
                <h5>Register Patient</h5><br>
                <p>Number of patients registered in a day</p>
            </div>
            <div class="box box-2">
                <span>8</span><br>
                <h5>Appointment</h5><br>
                <p>Number of appointments in a day</p>
            </div>
            <div class="box box-3">
                <span>Rs 6000</span><br>
                <h5>Payment</h5><br>
                <p>Total amount of payments received in a day</p>
            </div>
            <!-- <div class="box box-4">
                <span>MRI</span><br>
                <h5>Most Frequent Test</h5><br>
                <p>This box identifies the primary medical test type that the patient has taken most often.</p>
            </div> -->
        </div>
    </div>

    <div class="container_2">
        <div class="boxset-2">
            <div class="message box-1"></div>
            <div class="notify box-1"></div>
        </div>
    </div>
</body>
</html>