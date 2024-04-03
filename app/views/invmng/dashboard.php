<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta http-equiv="refresh" content="600; url=http://localhost/labora/user/logout"> -->
    <link rel="stylesheet" href="<?php echo APPROOT.'/public/css/invmng/dashboard.css'?>">
    <script src="<?php echo APPROOT.'/public/js/invmng/dashboard.js';?>"></script>
    <!-- static icons -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <!-- annimation icons -->
    <script src="https://cdn.lordicon.com/lordicon-1.1.0.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.46.0/apexcharts.min.js" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.35.3/apexcharts.min.js"></script>

    <title>Inventory Manager dashboard</title>
</head>
<body>
    <?php require_once 'components/nevbar.php' ?>
    
    <div class="container_1">
    <main class="main-container">
        <!-- <div class="main-title">
            <p class="font-weight-bold">DASHBOARD</p> 
        </div> -->
        <div class="main-cards">

            <div class="card">
                <div class="card-inner">
                    <p class="text-primary">PRODUCTS</p>
                    <span class="material-icons-outlined text-blue" style="color: #246dec;">inventory_2</span> 
                </div>
                <span class="text-primary font-weight-bold">249</span>
            </div>

            <div class="card">
                <div class="card-inner">
                    <p class="text-primary">PURCHASE ORDERS</p>
                    <span class="material-icons-outlined text-orange" style="color: #f5b74f;">add_shopping_cart</span> 
                </div>
                <span class="text-primary font-weight-bold">83</span>
            </div>

            <div class="card">
                <div class="card-inner">
                    <p class="text-primary">SALES ORDERS</p>
                    <span class="material-icons-outlined text-green"  style="color: #367952;">shopping_cart</span> 
                </div>
                <span class="text-primary font-weight-bold">79</span> 
            </div>

            <div class="card">
                <div class="card-inner">
                    <p class="text-primary">INVENTORY ALERTS</p>
                    <span class="material-icons-outlined text-red" style="color: #cc3c43;">notification_important</span> 
                </div>
                <span class="text-primary font-weight-bold">56</span> 
            </div>

        </div>

        <!-- <div class="charts">
            <div class="charts-card">
                <p class="chart-title">Top 5 Products</p> 
                <div id="bar-chart"></div>
            </div>
            
            <div class="charts-card">
                <p class="chart-title">Purchase and Sales Orders</p> 
                <div id="area-chart"></div>
            </div>
        </div> -->
        
    </main>
    </div>
   


        <!-- <div class="boxset-1">
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
        </div> -->
  
</body>
</html>