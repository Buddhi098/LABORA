<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta http-equiv="refresh" content="600; url=http://localhost/labora/user/logout"> -->
    <link rel="stylesheet" href="<?php echo APPROOT.'/public/css/patientdashboard/reports.css'?>">
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
        <div class="table-container">
        <h2><i class="fa-solid fa-calendar-check"></i>Medical Reports</h2>
        <div class="search-container">
        <input type="text" class="search-box" id="searchInput" placeholder="Search...">
        <button class="search-button">Search</button>
        </div>
        <div class="filter-box">
            <div class="filter-section">
                <!-- Add your filter options here -->
                <select class="filter-box">
                <option value="all">All</option>
                <option value="category1">Category 1</option>
                <option value="category2">Category 2</option>
                <!-- Add more filter options as needed -->
                </select>
                <button class="filter-button">Filter By ID</button>
            </div>
            <div class="filter-section">
                <!-- Add your filter options here -->
                <select class="filter-box">
                <option value="all">All</option>
                <option value="category1">Category 1</option>
                <option value="category2">Category 2</option>
                <!-- Add more filter options as needed -->
                </select>
                <button class="filter-button">Filter By Email</button>
            </div>
        </div>
        <table id="myTable">
        <thead>
            <th>Index</th>
            <th>Ref No</th>
            <th>Test Type</th>
            <th>Date</th>
            <th>Message</th>
            <th>Actions</th>
        </thead >
        <tbody>
                <div class='table_body'>
                    <?php
                    
                    $reversedArray = array_reverse($data, true);
                    if(count($reversedArray)>1){
                        foreach ($reversedArray as $row) {
                            echo '<tr>
                            <td>'.$row['id'].'</td>
                            <td>'.$row['ref_no'].'</td>
                            <td>'.$row['test_type'].'</td>
                            <td>'.$row['date'].'</td>
                            <td>'.$row['message'].'</td>
                            <td><a href="http://localhost/uploads/'.$row['path'].'" >View</a> <a href="http://localhost/labora/PatientDashboard/deleteReport/'.$row['id'].'/'.$row['path'].'">delete</a></td>
                        </tr>';
                        }
                    }
                    
                    ?>   
                    <!-- Add more rows as needed -->
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

    <script src="<?php echo APPROOT.'/public/js/components/table.js'?>"></script>
</body>
</html>