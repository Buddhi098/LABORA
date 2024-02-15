<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta http-equiv="refresh" content="600; url=http://localhost/labora/user/logout"> -->
    <link rel="stylesheet" href="<?php echo APPROOT.'/public/css/admin/dashboard.css'?>">
    <script src="<?php echo APPROOT.'/public/js/admin/admin.js';?>"></script>
    <!-- static icons -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <!-- annimation icons -->
    <script src="https://cdn.lordicon.com/lordicon-1.1.0.js"></script>
    <title>Admin dashboard</title>
</head>
<body>
    <?php require_once 'components/nevbar.php' ?>

    <div class="container_1">
        <div class="boxset-1">
            <div class="box box-1">
                <span>8</span><br>
                <h5>Number of User Accounts</h5><br>
                <!-- <p>patient are kept up to date with real-time updates to their medical history.</p> -->
            </div>
            <div class="box box-2">
                <span>16</span><br>
                <h5>Number of Medical Tests</h5><br>
                <p>Provides the number of medical tests performed today</p>
            </div>
            <div class="box box-3">
                <span>Rs 16000</span><br>
                <h5>Total Revenue</h5><br>
                <p>Today, received total payment </p>
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