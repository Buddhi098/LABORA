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
    <title>Patient dashboard</title>
</head>
<body>
    <?php require_once 'components/nevbar.php' ?>

    <div class="container_1">
        <div class="boxset_1">

            <div class="box box_1">
                <div class="text">
                    <h5>Number of Appointments Received</h5>
                    <h1>35</h1>
                    <p><i class="fa-solid fa-arrow-right" style="color: #ff0000;"></i> Appointments are validating with a special procedure. Appointments can schedule in both physical or online methods.</p>
                </div>
                <div class="icon">
                    <i class="fa-solid fa-file-contract"></i>
                </div>
            </div>

            <div class="box box_2">
                <div class="text">
                    <h5>Number of Medical Test Types</h5>
                    <h1>10</h1>
                    <p><i class="fa-solid fa-arrow-right" style="color: #ff0000;"></i> This box provides a snapshot of the variety of medical test types the patient has undergone.</p>
                </div>
                <div class="icon">
                    <i class="fa-solid fa-hand-holding-medical"></i>
                </div>
            </div>

            <div class="box box_2">
                <div class="text">
                    <h5>Total Medical Test Expenses</h5>
                    <h1>Rs. 4000</h1>
                    <p><i class="fa-solid fa-arrow-right" style="color: #ff0000;"></i> All the medical tests cost, done in previous month.</p>
                </div>
                <div class="icon">
                    <i class="fa-solid fa-money-bill-trend-up"></i>
                </div>
            </div>

            <div class="box box_2">
                <div class="text">
                    <h5>Most frequently requested Test</h5>
                    <h1>Full Blood Count(FBC)</h1>
                    <p><i class="fa-solid fa-arrow-right" style="color: #ff0000;"></i> Most number of patients requested test type in previous month</p>
                </div>
                <div class="icon">
                    <i class="fa-solid fa-vials"></i>
                </div>
            </div>

        </div>
        

    <script src="<?php echo APPROOT.'/public/js/patientdashboard/dashboard.js';?>"></script>


</body>
</html>