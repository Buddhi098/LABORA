<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta http-equiv="refresh" content="600; url=http://localhost/labora/user/logout"> -->
    <link rel="stylesheet" href="<?php echo APPROOT.'/public/css/mlt/medicalTests.css'?>">
    <script src="<?php echo APPROOT.'/public/js/mlt/patient.js';?>"></script>
    <!-- static icons -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <!-- annimation icons -->
    <script src="https://cdn.lordicon.com/lordicon-1.1.0.js"></script>
    <title>MLT dashboard</title>
</head>
<body>
    <?php require_once 'components/nevbar.php' ?>

    <div class="container_1">

    <div class="table-container">
        <h2><i class="fa-solid fa-calendar-check"></i>Testing Details</h2>
        <div class="add">
            <a href="<?php echo URLROOT?>MLT/test_form" class="addbtn"><ion-icon name="add"></ion-icon> Create New</a>
        </div>
        <div class="search-container">
        <input type="text" class="search-box" id="searchInput" placeholder="Search...">
        <button class="search-button">Search</button>
        </div>

        <div class="filter-box">
        </div>
        <table id="myTable">
            <thead>
                <th>Test ID</th>
                <th>Test Name</th>
                <th>Short Name</th>
                <th>Test Type</th>
                <th>Availability</th>
                <th>Action</th>
            </thead >
        <tbody>
                <div class='table_body'>
                <!-- <tr>
                    <td>1</td>
                    <td>Blood Test</td>
                    <td>BT</td>
                    <td>Check-up</td>
                    <td><button class="cancel ">yes</button></td>
                    <td><a href="#" class="download"><ion-icon name="create-outline"></ion-icon></a>
                    <a href="#" class="delete"><ion-icon name="trash"></ion-icon></a></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>X-ray Examination</td>
                    <td>XRE</td>
                    <td>MRI Scan</td>
                    <td><button class="cancel del">no</button></td>
                    <td><a href="#" class="download"><ion-icon name="create-outline"></ion-icon></a>
                    <a href="#" class="delete"><ion-icon name="trash"></ion-icon></a></td>
                </tr> -->

                <?php
                // <td>'.$row['availability'].'</td>
                // <td><button class="cancel">'.$row['availability'].'</button></td>

                // <td><a href="#" class="cancel">Edit</a>
                // <a href="http://localhost/labora/mltdashboard/deleteTest/'.$row['test_name'].'" class="cancel">Delete</a></td>
                $reversedArray = array_reverse($data, true);
                foreach ($reversedArray as $row) {
                    echo '<tr>
                    <td>'.$row['id'].'</td>
                    <td>'.$row['test_name'].'</td>
                    <td>'.$row['short_name'].'</td>
                    <td>'.$row['test_type'].'</td>
                    <td><span id="availability_1"><button class="availability-button yes" onclick="toggleAvailability(1)">'.$row['availability'].'</button></span></td>
                                      
                    <td><a href="#" class="download"><ion-icon name="create-outline"></ion-icon></a>
                    <a href="http://localhost/labora/mlt/deleteTest/'.$row['id'].'" class="delete"><ion-icon name="trash"></ion-icon></a></td>
                </tr>';
                }
                ?>
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
    <script src="<?php echo APPROOT.'/public/js/mlt/medicalTests.js'?>"></script>
</body>
</html>