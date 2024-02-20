<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta http-equiv="refresh" content="600; url=http://localhost/labora/user/logout"> -->
    <link rel="stylesheet" href="<?php echo APPROOT.'/public/css/receptionist/register.css'?>">
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
            <h2><i class="fa-solid fa-calendar-check"></i> Register Patient</h2>
            <div class="add">
            <a href="<?php echo URLROOT?>receptionist/patient_form" class="addbtn"><ion-icon name="add"></ion-icon> Add Patient </a>
            </div>
            <div class="search-container">
            <input type="text" class="search-box" id="searchInput" placeholder="Search...">
            <button class="search-button">Search</button>
            </div>
            <div class="filter-box">
                <div class="filter-section">
                    <select class="filter-box">
                    <option value="all">All</option>
                    <option value="category1">Category 1</option>
                    <option value="category2">Category 2</option>
                    </select>
                    <button class="filter-button">Filter By ID</button>
                </div>
                <div class="filter-section">
                    <select class="filter-box">
                    <option value="all">All</option>
                    <option value="category1">Category 1</option>
                    <option value="category2">Category 2</option>
                    </select>
                    <button class="filter-button">Filter By Email</button>
                </div>
            </div>
            <table id="myTable">
            <thead>
                <th>Index</th>
                <th>Patient ID</th>
                <th>Patient Name</th>
                <th>Contact Number</th>
                <th>Address</th>
            </thead >
            <tbody>
                    <div class='table_body'>
                    <tr>
                        <td>1</td>
                        <td>PAT001</td>
                        <td>John Doe</td>
                        <td>+94 123 456 789</td>
                        <td>123 Main Street, Colombo</td>
                        <!-- <td>30 minutes</td>
                        <td>Scheduled</td>
                        <td>Reminder call sent</td>
                        <td><button class="cancel">Cancel</button></td> -->
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>PAT002</td>
                        <td>Alice Smith</td>
                        <td>+94 987 654 321</td>
                        <td>456 Elm Road, Kandy</td>
                        <!-- <td>1 hour</td>
                        <td>Completed</td>
                        <td>N/A</td>
                        <td><button class="cancel del">Delete</button></td> -->
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>PAT003</td>
                        <td>Mary Johnson</td>
                        <td>+94 777 888 999</td>
                        <td>789 Oak Avenue, Galle</td>
                        <!-- <td>45 minutes</td>
                        <td>Canceled</td>
                        <td>Patient rescheduled</td>
                        <td><button class="cancel del">Delete</button></td> -->
                    </tr>
                        <tr>
                            <!-- <td>4</td>
                            <td>AP12345</td>
                            <td>Check-up</td>
                            <td>2023-11-15</td>
                            <td>10:00 AM</td>
                            <td>30 minutes</td>
                            <td>Scheduled</td>
                            <td>Reminder call sent</td>
                            <td><button class="cancel">Cancel</button></td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>AP54321</td>
                            <td>MRI Scan</td>
                            <td>2023-11-20</td>
                            <td>02:30 PM</td>
                            <td>1 hour</td>
                            <td>Completed</td>
                            <td>N/A</td>
                            <td><button class="cancel del">Delete</button></td>
                        </tr>
                        <tr>
                            <td>6</td>
                            <td>AP98765</td>
                            <td>Dental Check-up</td>
                            <td>2023-11-25</td>
                            <td>09:15 AM</td>
                            <td>45 minutes</td>
                            <td>Canceled</td>
                            <td>Patient rescheduled</td>
                            <td><button class="cancel del">Delete</button></td>
                        </tr>
                        <tr>
                            <td>7</td>
                            <td>AP12345</td>
                            <td>Check-up</td>
                            <td>2023-11-15</td>
                            <td>10:00 AM</td>
                            <td>30 minutes</td>
                            <td>Scheduled</td>
                            <td>Reminder call sent</td>
                            <td><button class="cancel">Cancel</button></td>
                        </tr>
                        <tr>
                            <td>8</td>
                            <td>AP54321</td>
                            <td>MRI Scan</td>
                            <td>2023-11-20</td>
                            <td>02:30 PM</td>
                            <td>1 hour</td>
                            <td>Completed</td>
                            <td>N/A</td>
                            <td><button class="cancel del">Delete</button></td>
                        </tr>
                        <tr>
                            <td>9</td>
                            <td>AP98765</td>
                            <td>Dental Check-up</td>
                            <td>2023-11-25</td>
                            <td>09:15 AM</td>
                            <td>45 minutes</td>
                            <td>Canceled</td>
                            <td>Patient rescheduled</td>
                            <td><button class="cancel del">Delete</button></td>
                        </tr> -->
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