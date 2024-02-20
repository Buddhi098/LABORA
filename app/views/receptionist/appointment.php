<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta http-equiv="refresh" content="600; url=http://localhost/labora/user/logout"> -->
    <link rel="stylesheet" href="<?php echo APPROOT.'/public/css/receptionist/appointment.css'?>">
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
            <a href="<?php echo URLROOT?>receptionist/appointment_form" class="addbtn"><ion-icon name="add"></ion-icon>Schedule appointment</a>
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
                <th>Ref No</th>
                <th>Patient ID</th>
                <th>Patient Name</th>
                <th>Test Type</th>
                <th>Appointment Date</th>
                <th>Appointment Time</th>
                <th>Appointment Notes</th>
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
                        <td>-</td>
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
                        <td>-</td>
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
                        <td>-</td>
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
                        <td>-</td>
                        <!-- <td><button class="cancel">Cancel</button></td> -->
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