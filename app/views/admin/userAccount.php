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
                <select class="filter-box" id="roleFilter" onchange="filterByRole()">
                    <option value="All">All</option>
                    <option value="Supplier">Supplier</option>
                    <option value="MLT">MLT</option>
                    <option value="Lab_Assistant">Lab Assistant</option>
                    <option value="Inventory_Manager">Inventory Manager</option>
                    <option value="Receptionist">Receptionist</option>
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
                        <td><a href="http://localhost/labora/admin/editProfile" class="action-button">Edit</a> <a href="http://localhost/labora/admin/deleteEmployee/'.$row['email'].'" class="action-button">Delete</a></td>
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

    <script>
        function filterByRole() {
            var select = document.getElementById('roleFilter');
            var filter = select.value.toUpperCase();
            var table = document.getElementById('myTable');
            var rows = table.querySelectorAll('tbody tr');

            for (var i = 0; i < rows.length; i++) {
                var roleCell = rows[i].querySelector('td:nth-child(8)'); // Assuming role cell is in the 8th column
                var roleText = roleCell.textContent || roleCell.innerText;

                if (filter === 'ALL' || roleText.toUpperCase() === filter.toUpperCase()) {
                    rows[i].style.display = ''; // Show the row
                } else {
                    rows[i].style.display = 'none'; // Hide the row
                }
            }
        }
    </script>
</body>
</html>