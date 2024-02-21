<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta http-equiv="refresh" content="600; url=http://localhost/labora/user/logout"> -->
    <link rel="stylesheet" href="<?php echo APPROOT.'/public/css/invmng/reorder.css'?>">
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
            <h3>Items to reorder</h3>
        </div>
        <div class="line"></div>
        

        <div>
        <table>
        <thead>
        <tr>
        <th>Item ID</th>
        <th>Item Name</th>
       
        <th>Quantity in Stock</th>
        <th>Reorder Level</th>
        <th>Action</th>
    </tr>
        </thead>
        <tbody>
     
    <tr>
        <td>1001</td>
        <td>Chemical A</td>
       
        <td>8</td>
        <td>10</td>
        <td><a href="http://localhost/labora/invmng/orderForm" class="download"><ion-icon name="cart"></ion-icon></a></td>
    </tr>
    <tr>
        <td>1002</td>
        <td>Chemical B</td>
    
        <td>18</td>
        <td>20</td>
        <td><a href="http://localhost/labora/invmng/orderForm" class="download"><ion-icon name="cart"></ion-icon></a></td>
    </tr>
    <tr>
        <td>1003</td>
        <td>Chemical D</td>
    
        <td>3</td>
        <td>5</td>
        <td><a href="http://localhost/labora/invmng/orderForm" class="download"><ion-icon name="cart"></ion-icon></a></td>
    </tr>
           
            <!-- Add more rows as needed -->
        </tbody>
        </table>
        </div>
    </div>
</body>
</html>