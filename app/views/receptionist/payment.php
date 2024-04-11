<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta http-equiv="refresh" content="600; url=http://localhost/labora/user/logout"> -->
    <link rel="stylesheet" href="<?php echo APPROOT.'/public/css/receptionist/payment.css'?>">
    <script src="<?php echo APPROOT.'/public/js/receptionist/recept.js';?>"></script>
    <!-- static icons -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <!-- annimation icons -->
    <script src="https://cdn.lordicon.com/lordicon-1.1.0.js"></script>
    <title>Receptionist dashboard</title>
</head>
<body>
    <?php require_once 'components/nevbar.php' ?>
    <div class="container_1">

    <div class="table-container">
        <h2><i class="fa-solid fa-calendar-check"></i>Appointments</h2>
        <div class="add">
            <a href="<?php echo URLROOT?>receptionist/payment_form" class="addbtn"><ion-icon name="add"></ion-icon>Add Payment</a>
        </div>
        <div class="search-container">
        <input type="text" class="search-box" id="searchInput" placeholder="Search...">
        <button class="search-button">Search</button>
        </div>

        <div class="filter-box">
            <div class="filter-section">
                <input type="date" id="filterDate">
                <button class="filter-button" >Filter by Date</button>
            </div>
        </div>
        <table id="myTable">
            <thead>
                <th>Index</th>
                <th>Bill No</th>
                <th>Patient ID</th>
                <th>Patient Name</th>
                <th>Test Type</th>
                <th>Payment Date</th>
                <th>Payment Time</th>
                <th>Payment Amount(Rs)</th>
            </thead >
            <tbody>
                <div class='table_body'>
                <tr>
                    <td>1</td>
                    <td>AP12345</td>
                    <td>PAT001</td>
                    <td>John Doe</td>
                    <td>Blood Test</td>
                    <td>2023-11-15</td>
                    <td>10:00 AM</td>
                    <td>2000</td>
                    <!-- <td><button class="cancel">Cancel</button></td> -->
                </tr>
                <tr>
                    <td>2</td>
                    <td>AP54321</td>
                    <td>PAT002</td>
                    <td>Alice Smith</td>
                    <td>MRI Scan</td>
                    <td>2023-11-20</td>
                    <td>02:30 PM</td>
                    <td>1000</td>
                    <!-- <td><button class="cancel del">Delete</button></td> -->
                </tr>
                <tr>
                    <td>3</td>
                    <td>AP98765</td>
                    <td>PAT003</td>
                    <td>Mary Johnson</td>
                    <td>Check-up</td>
                    <td>2023-11-25</td>
                    <td>09:15 AM</td>
                    <td>800</td>
                    <!-- <td><button class="cancel del">Delete</button></td> -->
                </tr>
                <tr>
                    <td>4</td>
                    <td>AP12345</td>
                    <td>PAT004</td>
                    <td>Robert Wilson</td>
                    <td>Blood Test</td>
                    <td>2023-11-15</td>
                    <td>10:00 AM</td>
                    <td>700</td>
                    <!-- <td><button class="cancel">Cancel</button></td> -->
                </tr>
                <tr>
                    <td>5</td>
                    <td>AP54321</td>
                    <td>PAT005</td>
                    <td>Lisa Brown</td>
                    <td>MRI Scan</td>
                    <td>2023-11-20</td>
                    <td>02:30 PM</td>
                    <td>3500</td>
                    <!-- <td><button class="cancel del">Delete</button></td> -->
                </tr>
                <tr>
                    <td>6</td>
                    <td>AP98765</td>
                    <td>PAT006</td>
                    <td>Michael Davis</td>
                    <td>Check-up</td>
                    <td>2023-11-25</td>
                    <td>09:15 AM</td>
                    <td>1200</td>
                    <!-- <td><button class="cancel del">Delete</button></td> -->
                </tr>
                <tr>
                    <td>7</td>
                    <td>AP12345</td>
                    <td>PAT007</td>
                    <td>Susan Lee</td>
                    <td>Blood Test</td>
                    <td>2023-11-15</td>
                    <td>10:00 AM</td>
                    <td>800</td>
                    <!-- <td><button class="cancel">Cancel</button></td> -->
                </tr>
                <tr>
                    <td>8</td>
                    <td>AP54321</td>
                    <td>PAT008</td>
                    <td>David Clark</td>
                    <td>MRI Scan</td>
                    <td>2023-11-20</td>
                    <td>02:30 PM</td>
                    <td>3500</td>
                    <!-- <td><button class="cancel del">Delete</button></td> -->
                </tr>
                <tr>
                    <td>9</td>
                    <td>AP98765</td>
                    <td>PAT009</td>
                    <td>Karen Rodriguez</td>
                    <td>Check-up</td>
                    <td>2023-11-25</td>
                    <td>09:15 AM</td>
                    <td>1500</td>
                    <!-- <td><button class="cancel del">Delete</button></td> -->
                </tr>
                </div>
            </tbody>
        </table>
            <div class="pagination">
            <h5 id="table_data"></h5>
            <button onclick="previousPage()" >Previous</button>
            <button onclick="nextPage()" id="next">Next</button>
            </div>
        </div>
    </div>

    <!-- import table javascript -->
    <script src="<?php echo APPROOT.'/public/js/components/table.js'?>"></script>
</body>
</html>