<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta http-equiv="refresh" content="600; url=http://localhost/labora/user/logout"> -->
    <link rel="stylesheet" href="<?php echo APPROOT.'/public/css/patientdashboard/dashboard.css'?>">
    <script src="<?php echo APPROOT.'/public/js/patientdashboard/patient.js';?>"></script>
    <!-- static icons -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <!-- annimation icons -->
    <script src="https://cdn.lordicon.com/lordicon-1.1.0.js"></script>
    <title>Lab assistant dashboard</title>
</head>
<body>
    <?php require_once 'components/nevbar.php' ?>

    <div class="container_1">
        <div class="boxset_1">

            <div class="box box_1">
                <div class="text">
                    <h5>Number of Orders</h5>
                    <h1>30</h1>
                    <p><i class="fa-solid fa-arrow-right" style="color: #ff0000;"></i>Total number of orders received form the inventory manager in previous month.</p>
                </div>
                <div class="icon">
                <i class="fa-solid fa-bars"></i>
                </div>
            </div>

            <div class="box box_2">
                <div class="text">
                    <h5>Number of Pending Orders</h5>
                    <h1>10</h1>
                    <p><i class="fa-solid fa-arrow-right" style="color: #ff0000;"></i>These orders are still pending check the availability on items and chemicals.</p>
                </div>
                <div class="icon">
                <i class="fa-solid fa-hourglass-start"></i>
                </div>
            </div>

            <div class="box box_2">
                <div class="text">
                    <h5>Number of Rejected Orders</h5>
                    <h1>5</h1>
                    <p><i class="fa-solid fa-arrow-right" style="color: #ff0000;"></i>Rejecting the orders because of unavailability of items or chemicals or lack of producers.</p>
                </div>
                <div class="icon">
                <i class="fa-solid fa-xmark"></i>
                </div>
            </div>

            <div class="box box_2">
                <div class="text">
                    <h5>Number of sent out quotations</h5>
                    <h1>15</h1>
                    <p><i class="fa-solid fa-arrow-right" style="color: #ff0000;"></i>Quotations are sent after confirmation of items or chemicals</p>
                </div>
                <div class="icon">
                <i class="fa-solid fa-file-import"></i>
                </div>
            </div>

        </div>
        

    <script src="<?php echo APPROOT.'/public/js/patientdashboard/dashboard.js';?>"></script>


</body>
</html>