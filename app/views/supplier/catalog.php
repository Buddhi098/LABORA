<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta http-equiv="refresh" content="600; url=http://localhost/labora/user/logout"> -->
    <link rel="stylesheet" href="<?php echo APPROOT.'/public/css/supplier/catalog.css'?>">
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

      <!--<div class="tablename">
            <h3>Appointment</h3>
        </div>
        <div class="line"></div>
        <div class="searchbar">
            <input type="text" class="search" placeholder="Enter reference number">
            <a href="#" class="searchbtn">Search</a>
        </div>

        <div class="filter">
            <form action="#" method="post">
                <input type="text" class="test-type" placeholder="Enter test type">
                <input type="date" class="from">
                <input type="date" class="to">
                <button type="submit" class="submit button">Filter</button>
            </form>
        </div>
        <div>-->
        <table>
        <thead>
            <tr>
                <th>Product ID</th>
                <th>Product Name</th>
                <th>quantity</th>
                <th>price</th>
                <th>Description</th>
                <th>availability</th>
                
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($data as $row) {
                echo '<tr>
                <td>'.$row['product_id'].'</td>
                <td>'.$row["product_name"].'</td>
                <td>'.$row['quantity'].'</td>
                <td>'.$row['price'].'</td>
                <td>'.$row['description'].'</td>
                <td>'.$row['availability'].'</td>      
            </tr>';
            }
            ?>
            
            <!-- Add more rows as needed -->
        </tbody>
        </table>
        </div>
    </div>
</body>
</html>