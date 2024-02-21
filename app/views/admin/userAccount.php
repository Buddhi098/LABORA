<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta http-equiv="refresh" content="600; url=http://localhost/labora/user/logout"> -->
    <link rel="stylesheet" href="<?php echo APPROOT.'/public/css/admin/userAccount.css'?>">
    <script src="<?php echo APPROOT.'/public/js/admin/patient.js';?>"></script>
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
        <h2><i class="fa-solid fa-calendar-check"></i>User Accounts</h2>
        <div class="add">
            <a href="<?php echo URLROOT?>admin/addUser" class="addbtn"><ion-icon name="add"></ion-icon> Add Employee</a>
        </div>
        <div class="search-container">
        <input type="text" class="search-box" id="searchInput" placeholder="Search...">
        <button class="search-button">Search</button>
        </div>

        <div class="filter-box">
            <div class="filter-section">
                <select class="filter-box">
                    <option value="option1">All</option>
                    <option value="option2">Supplier</option>
                    <option value="option3">MLT</option>
                    <option value="option2">Lab Assistant</option>
                    <option value="option2">Inventory Manager</option>
                    <option value="option2">Receptionist</option>
                </select>
                <button class="filter-button">Filter By Roll</button>
            </div>
        </div>
        <table id="myTable">
            <thead>
                    <th>Index</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Date Of Birth</th>
                    <th>Address</th>
                    <th>gender</th>
                    <th>role</th>
                    <th></th>
            </thead >
        <tbody>
                <div class='table_body'>
                <?php
                
                $reversedArray = array_reverse($data , true);
                if(count($reversedArray)>1){
                    foreach ($reversedArray as $row) {
                        echo '<tr>
                        <td>'.$row['id'].'</td>
                        <td>'.$row['full_name'].'</td>
                        <td>'.$row['email'].'</td>
                        <td>'.$row['phone'].'</td>
                        <td>'.$row['dob'].'</td>
                        <td>'.$row['address'].'</td>
                        <td>'.$row['gender'].'</td>
                        <td>'.$row['role'].'</td>
                        <td><a href="#" class="action-button">Edit</a> <a href="http://localhost/labora/admin/deleteEmployee/'.$row['email'].'" class="action-button">Delete</a></td>
                        </tr>';
                    }
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
</body>
</html>