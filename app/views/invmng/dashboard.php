<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo APPROOT.'/public/css/invmng/dashboard.css'?>">
    <script src="<?php echo APPROOT.'/public/js/invmng/dashboard.js';?>"></script>
    <!-- static icons -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <!-- annimation icons -->
    <script src="https://cdn.lordicon.com/lordicon-1.1.0.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Inventory Manager dashboard</title>
</head>

<body>
    <?php require_once 'components/nevbar.php' ?>

    <div class="container_1">
        <div class="boxset_1">

            <div class="box box_1">
                <div class="text">
                    <h5>Number of Items in Stock</h5>
                    <h1>125</h1>
                    <p><i class="fa-solid fa-arrow-right" style="color: #ff0000;"></i> Keep track of your inventory and never run out of stock.</p>
                </div>
                <div class="icon">
                    <i class="fa-solid fa-boxes-stacked"></i>
                </div>
            </div>

            <div class="box box_2">
                <div class="text">
                    <h5>Number of Low Stock Items</h5>
                    <h1>10</h1>
                    <p><i class="fa-solid fa-arrow-right" style="color: #ff0000;"></i> Get notified when items reach a low stock threshold.</p>
                </div>
                <div class="icon">
                    <i class="fa-solid fa-exclamation-triangle"></i>
                </div>
            </div>

            <div class="box box_2">
                <div class="text">
                    <h5>Number of Suppliers</h5>
                    <h1>5</h1>
                    <p><i class="fa-solid fa-arrow-right" style="color: #ff0000;"></i> Manage relationships with your suppliers.</p>
                </div>
                <div class="icon">
                    <i class="fa-solid fa-truck-moving"></i>
                </div>
            </div>

            <div class="box box_2">
                <div class="text">
                    <h5>Total Stock Value</h5>
                    <h1>Rs. 50000</h1>
                    <p><i class="fa-solid fa-arrow-right" style="color: #ff0000;"></i> Keep track of your inventory investments.</p>
                </div>
                <div class="icon">
                    <i class="fa-solid fa-money-check-dollar"></i>
                </div>
            </div>

        </div>

    </div>
    <div class="bar-chart-container"></div>
    <script src="<?php echo APPROOT.'/public/js/invmng/dashboard.js';?>"></script>


</body>

</html>