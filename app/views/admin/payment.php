<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta http-equiv="refresh" content="600; url=http://localhost/labora/user/logout"> -->
    <link rel="stylesheet" href="<?php echo APPROOT.'/public/css/admin/payment.css'?>">
    <script src="<?php echo APPROOT.'/public/js/admin/admin.js';?>"></script>
    <!-- static icons -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <!-- annimation icons -->
    <script src="https://cdn.lordicon.com/lordicon-1.1.0.js"></script>
    <title>Admin dashboard</title>
</head>
<body>
    <?php require_once 'components/nevbar.php' ?>
    <div class="container_1">

    <div class="table-container">
        <h2><i class="fa-solid fa-calendar-check"></i> Payment Details</h2>
        <div class="search-container">
        <input type="text" class="search-box" id="searchInput" placeholder="Search...">
        <button class="search-button">Search</button>
        </div>

        <div class="filter-box">
            <!-- <div class="filter-section">
                <select class="filter-box"> -->
                <input type="date" id="filterDate">
                <button class="filter-button" onclick="filterTableByDate()">Filter by Date</button>
                <!-- </select>
            </div> -->
        </div>
        <table id="myTable">
        <thead>
            <th>Index</th>
            <th>Bill No</th>
            <th>Patient</th>
            <th>Test Name</th>
            <th>Date</th>
            <th>Price(Rs)</th>
        </thead >
        <tbody>
                <div class='table_body'>
                    <tr>
                        <td>1</td>
                        <td>SL-001</td>
                        <td>Alice Silva</td>
                        <td>Blood Test</td>
                        <td>2024-10-29</td>
                        <td>2500</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>SL-002</td>
                        <td>John Perera</td>
                        <td>X-Ray Scan</td>
                        <td>2023-10-30</td>
                        <td>3500</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>SL-003</td>
                        <td>Mary Fernando</td>
                        <td>Ultrasound</td>
                        <td>2023-10-30</td>
                        <td>2800</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>SL-004</td>
                        <td>David Rajapakse</td>
                        <td>CT Scan</td>
                        <td>2023-10-30</td>
                        <td>4500</td>
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
    <script src="<?php echo APPROOT.'/public/js/admin/table.js'?>"></script>
</body>
</html>