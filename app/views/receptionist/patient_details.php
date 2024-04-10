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
            <a href="<?php echo URLROOT?>receptionist/register_patient" class="addbtn"><ion-icon name="add"></ion-icon> Add Patient </a>
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
                <th>Patient ID</th>
                <th>Patient Name</th>
                <th>Age</th>
                <th>Email</th>
                <th>Contact Number</th>
                <th>Address</th>
                <th>Action</th>
            </thead >
            <tbody>
                    <div class='table_body'>
                        <?php
                            foreach($data['patient_data'] as $patient){
                                $birthdate = new DateTime($patient['patient_dob']);
                                $today = new DateTime();
                                $age = $today->diff($birthdate)->y;
                                echo "<tr>";
                                echo "<td>PAT-".$patient['patient_id']."</td>";
                                echo "<td>".$patient['patient_name']."</td>";
                                echo "<td>".$age."</td>";
                                echo "<td>".$patient['patient_email']."</td>";
                                echo "<td>".$patient['patient_phone']."</td>";
                                echo "<td>".$patient['patient_address']."</td>";
                                echo "<td><a href='".URLROOT."receptionist/patient_details/".$patient['patient_id']."'><button class='view'>View</button></a></td>";
                                echo "</tr>";
                                
                            }
                        ?>
                    </div>
                </tbody>
            </table>
                <div class="pagination">
                <h5 id="table_data"></h5>
                <button onclick="previousPage()" id="prev">Previous</button>
                <button onclick="nextPage()" id="next">Next</button>
                </div>
            </div>
    </div>

    <!-- table js -->
    <script src="<?php echo APPROOT.'/public/js/components/table.js'?>"></script>
</body>
</html>