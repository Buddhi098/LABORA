<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta http-equiv="refresh" content="600; url=http://localhost/labora/user/logout"> -->
    <link rel="stylesheet" href="<?php echo APPROOT.'/public/css/labassistant/dashboard.css'?>">
    <script src="<?php echo APPROOT.'/public/js/patientdashboard/patient.js';?>"></script>
    <!-- static icons -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <!-- annimation icons -->
    <script src="https://cdn.lordicon.com/lordicon-1.1.0.js"></script>
    <title>Supplier dashboard</title>
</head>
<body>
    <?php require_once 'components/nevbar.php' ?>

    <div class="container_1">
        <div class="boxset-1">
            <div class="box box-1">
                <span>4</span><br>
                <h5>Number of Approvals Received in a week</h5><br>
                <p>Suppliers are waiting for the approvals of the quotations</p>
            </div>
            <div class="box box-2">
                <span>10</span><br>
                <h5>Number of Quotations send in a week</h5><br>
                <p>Suppliers send the quotation details for the order</p>
            </div>
            <div class="box box-3">
                <span>200$</span><br>
                <h5>Total costs for sold Items</h5><br>
                <p>Total cost will updated for the supplied items in a week</p>
            </div>
            <div class="box box-4">
                <span>Syringe</span><br>
                <h5>Most requested Item</h5><br>
                <p>This box provides highly requested item in a week</p>
            </div>
        </div>
    </div>

    <!--<div class="container_2">
        <div class="boxset-2">
            <div class="message box-1"></div>
            <div class="notify box-1"></div>
        </div>
    </div>-->
</body>
</html>