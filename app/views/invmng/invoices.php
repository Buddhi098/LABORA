<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta http-equiv="refresh" content="600; url=http://localhost/labora/user/logout"> -->
    <link rel="stylesheet" href="<?php echo APPROOT.'/public/css/invmng/invoice.css'?>">
    <script src="<?php echo APPROOT.'/public/js/invmng/invmng.js';?>"></script>
    <!-- static icons -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <!-- annimation icons -->
    <script src="https://cdn.lordicon.com/lordicon-1.1.0.js"></script>
    <title>Inventory Manager dashboard</title>
</head>
<body>
    <?php require_once 'components/dashnavbar.php' ?>
    <div class="container_1">

        <div class="tablename">
            <h3>Invoices</h3>
        </div>
        <div class="line"></div>
        <div class="searchbar">
            <input type="text" class="search" placeholder="Enter order ID">
            <a href="#" class="searchbtn">Search</a>
        </div>

        <div>
        <table>
        <thead>
        <tr>
        <th>Order ID</th>
        <th>Supplier Name</th>
        <th>Quotation Document</th>
        <th>Invoice Document</th>
        <th>Invoice Date</th>
        <th>Action</th>
    </tr>
        </thead>
        <tbody>
      
    <tr>
        <td>PO-001</td>
        <td>ABC Electronics</td>
        <td><a href="supplier_quotation_001.pdf">Supplier Quotation 001</a></td>
        <td><a href="supplier_invoice_001.pdf">Supplier Invoice 001</a></td>
        <td>2023-10-25</td>
        <td><a href="#" class="download"><ion-icon name="search"></ion-icon></a></td>
    </tr>
    <tr>
        <td>PO-002</td>
        <td>XYZ Supplies</td>
        <td><a href="supplier_quotation_002.pdf">Supplier Quotation 002</a></td>
        <td><a href="supplier_invoice_002.pdf">Supplier Invoice 002</a></td>
        <td>2023-11-15</td>
        <td><a href="#" class="download"><ion-icon name="search"></ion-icon></a></td>
    </tr>
          
            <!-- Add more rows as needed -->
        </tbody>
        </table>
        </div>
    </div>
</body>
</html>