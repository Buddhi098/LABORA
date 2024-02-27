<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta http-equiv="refresh" content="600; url=http://localhost/labora/user/logout"> -->
    <link rel="stylesheet" href="<?php echo APPROOT.'/public/css/supplier/dashboard.css'?>">
    <script src="<?php echo APPROOT.'/public/js/labassistant/patient.js';?>"></script>
    <!-- static icons -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <!-- annimation icons -->
    <script src="https://cdn.lordicon.com/lordicon-1.1.0.js"></script>
    <title>Labassistant dashboard</title>
</head>
<body>
    <?php require_once 'components/nevbar.php' ?>

    <div class="container_1">
        <div class="boxset-1">
            <div class="box box-1">
                <span>65</span><br>
                <h5>Number of Reports Received</h5><br>
                <p>patient are kept up to date with real-time updates to their medical history.</p>
            </div>
            <div class="box box-2">
                <span>6</span><br>
                <h5>Number of Medical Test Types</h5><br>
                <p>This box provides a snapshot of the variety of medical test types the patient has undergone. </p>
            </div>
            <div class="box box-3">
                <span>600$</span><br>
                <h5>Medical Test Expenses</h5><br>
                <p>The total expenses will automatically update as new costs are incurred. </p>
            </div>
            <div class="box box-4">
                <span>MRI</span><br>
                <h5>Most Frequent Test</h5><br>
                <p>This box identifies the primary medical test type that the patient has taken most often.</p>
            </div>
        </div>
    </div>
</body>
</html>