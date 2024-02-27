<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta http-equiv="refresh" content="600; url=http://localhost/labora/user/logout"> -->
    <link rel="stylesheet" href="<?php echo APPROOT.'/public/css/invmng/dashboard.css'?>">
    <script src="<?php echo APPROOT.'/public/js/invmng/invmng.js';?>"></script>
    <!-- static icons -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <!-- annimation icons -->
    <script src="https://cdn.lordicon.com/lordicon-1.1.0.js"></script>
    <title>Inventory Manager dashboard</title>
</head>
<body>
    <?php require_once 'components/nevbar.php' ?>

    <div class="container_1">
        <div class="boxset-1">
            <a href="http://localhost/labora/invmng/expiredChemicals">
                <div class="box box-1">
                    <span>3</span><br>
                    <h5>Expiered Chemicals</h5><br>
                    <p>This shows the no of chemicals expires on that day.</p>
                </div>
            </a>

            <a href="http://localhost/labora/invmng/reorder">
                <div class="box box-3">
                    <span>3</span><br>
                    <h5>Items has reached reorder limit</h5><br>
                    <p>No of items which have reached their reeorder limit shows here. </p>
                </div>
            </a> 

            <a href="http://localhost/labora/invmng/quotations">
                <div class="box box-2">
                    <span>2</span><br>
                    <h5>No of quotations recieved</h5><br>
                    <p>No of quotations which has recieved on that day shows here. </p>
                </div>
            </a>

            <a href="http://localhost/labora/invmng/invoices">
                <div class="box box-3">
                    <span>2</span><br>
                    <h5>Invoice has recieved</h5><br>
                    <p>This box identifies the no of invoices recieved from the suppliers on that day.</p>
                </div>
            </a>   
            
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