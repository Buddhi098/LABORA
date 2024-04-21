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
                <th>Test Type</th>
                <th>Time To Do</th>
                <th>Price</th>
                <th>Status</th>
                <th>Action</th>
            </thead >
        <tbody>
                <div class='table_body'>

                <?php
  
                $reversedArray = array_reverse($data, true);
                foreach ($reversedArray as $row) {
                    $testId = $row['Test_ID'];
                    $testName = $row['Test_Name'];
                    $testType = $row['Test_Type'];
                    $TimeToDo = $row['TimeToDo'];
                    $cost = $row['cost'];
                    $status = $row['Status'];
                    $availabilityClass = strtolower($status) === 'available' ? 'available' : 'not-available';

                    echo '<tr>
                    <td>'.$row['Test_ID'].'</td>
                    <td>'.$row['Test_Name'].'</td>
                    <td>'.$row['Test_Type'].'</td>
                    <td>'.$row['TimeToDo'].'</td>
                    <td>'.$row['cost'].'</td>

                    <td>
                        <span id="availability_'.$testId.'">
                            <button class="availability-button '.$availabilityClass.'" onclick="toggleAvailability('.$testId.')">'.$status.'</button>
                        </span>
                    </td>
                
                    <td><a href="#" class="action-button">Edit</a> <a href="http://localhost/labora/mlt/deleteTest/'.$row['Test_ID'].'" class="action-button">Delete</a></td>
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
