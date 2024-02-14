<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta http-equiv="refresh" content="600; url=http://localhost/labora/user/logout"> -->
    <link rel="stylesheet" href="<?php echo APPROOT.'/public/css/mlt/dashboard.css'?>">
    <script src="<?php echo APPROOT.'/public/js/mlt/patient.js';?>"></script>
    <!-- static icons -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <!-- annimation icons -->
    <script src="https://cdn.lordicon.com/lordicon-1.1.0.js"></script>
    <title>MLT dashboard</title>
</head>
<body>
    <?php require_once 'components/nevbar.php' ?>

    <div class="container_1">
        <div class="boxset-1">
            <div class="box box-1">
                <span>12</span><br>
                <h5>Number of Appointments Received</h5><br>
                <p>Number of appointments to be completed</p>
            </div>
            <div class="box box-2">
                <span>6</span><br>
                <h5>Number of Medical Reports</h5><br>
                <p>Number of reports to be validated</p>
            </div>
            <!-- <div class="box box-3">
                <span>600$</span><br>
                <h5>Medical Test Expenses</h5><br>
                <p>The total expenses will automatically update as new costs are incurred. </p>
            </div> -->
            <div class="box box-4">
                <span>13</span><br>
                <h5>Number of Medical Test</h5><br>
                <p>Current number of medical tests performed</p>
            </div>
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