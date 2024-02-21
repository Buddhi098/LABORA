<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta http-equiv="refresh" content="600; url=http://localhost/labora/user/logout"> -->
    <link rel="stylesheet" href="<?php echo APPROOT.'/public/css/admin/medicaltest.css'?>">
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
        <h2><i class="fa-solid fa-calendar-check"></i> Medical Tests</h2>
        <div class="search-container">
        <input type="text" class="search-box" id="searchInput" placeholder="Search...">
        <button class="search-button">Search</button>
        </div>

        <div class="filter-box">
            <div class="filter-section">
                <select class="filter-box">
                <option value="all">All</option>
                <option value="category1">Blood Tests</option>
                <option value="category2">Imaging Tests</option>
                <option value="category2">Urine Tests</option>
                </select>
                <button class="filter-button">Filter By Test Type </button>
            </div>
        </div>
        <table id="myTable">
        <thead>
                <th>Index</th>
                <th>Test ID</th>
                <th>Test Name</th>
                <th>Short Name</th>
                <th>Test Type</th>
                <th>No. of Tests</th>
        </thead >
        <tbody>
                <div class='table_body'>
                <tr>
                    <td>1</td>
                    <td>SL-001</td>
                    <td>Blood Test</td>
                    <td>Blood</td>
                    <td>Medical</td>
                    <td>100</td>
                    <!-- Add actions or links for this row -->
                    <!-- <td>
                        <a href="#" class="download"><ion-icon name="arrow-down-circle"></ion-icon></a>
                        <a href="#" class="delete"><ion-icon name="trash"></ion-icon></a>
                    </td> -->
                </tr>
                <tr>
                    <td>2</td>
                    <td>SL-002</td>
                    <td>X-Ray Scan</td>
                    <td>X-Ray</td>
                    <td>Medical</td>
                    <td>50</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>SL-003</td>
                    <td>Ultrasound</td>
                    <td>USG</td>
                    <td>Medical</td>
                    <td>75</td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>SL-004</td>
                    <td>CT Scan</td>
                    <td>CT</td>
                    <td>Medical</td>
                    <td>30</td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>SL-005</td>
                    <td>ECG</td>
                    <td>ECG</td>
                    <td>Medical</td>
                    <td>45</td>
                </tr>
                <tr>
                    <td>6</td>
                    <td>SL-006</td>
                    <td>MRI</td>
                    <td>MRI</td>
                    <td>Medical</td>
                    <td>25</td>
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