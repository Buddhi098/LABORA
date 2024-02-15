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

        <div class="tablename">
            <h3>User Accounts</h3>
        </div>
        <div class="line"></div>
        <div class="searchbar">
            <input type="text" class="search" placeholder="Enter name">
            <a href="#" class="searchbtn">Search</a>
        </div>

        <div class="filter">
            <form action="#" method="post">
                <!-- <input type="text" class="test-type" placeholder="Enter test type"> -->
                <select type="text" class="test-type">
                    <option value="option1">All</option>
                    <option value="option2">Supplier</option>
                    <option value="option3">MLT</option>
                    <option value="option2">Lab Assistant</option>
                    <option value="option2">Inventory Manager</option>
                    <option value="option2">Receptionist</option>

                </select>
                <!-- <input type="date" class="from">
                <input type="date" class="to"> -->
                <button type="submit" class="submit button">Filter</button>
            </form>
        </div>
        <div class="add">          
            <a href="http://localhost/labora/patientdashboard/user_form" class="addbtn"><ion-icon name="add"></ion-icon> Add User</a>
         </div>
         
        <table>
            <thead>
                <tr>
                    <th>Index</th>
                    <th>User Id</th>
                    <th>Name</th>
                    <th>Role</th>
                    <th>Mobile</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>MLT123</td>
                    <td>John Silva</td>
                    <td>MLT</td>
                    <td>071-1234567</td>
                    <!-- Add actions or links for this row -->
                    <td>
                        <a href="#" class="download"><ion-icon name="create-outline"></ion-icon></a>
                        <a href="#" class="delete"><ion-icon name="trash"></ion-icon></a>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>LA1-456</td>
                    <td>Lisa Perera</td>
                    <td>Lab Assistant 1</td>
                    <td>077-9876543</td>
                    <!-- Add actions or links for this row -->
                    <td>
                        <a href="#" class="download"><ion-icon name="create-outline"></ion-icon></a>
                        <a href="#" class="delete"><ion-icon name="trash"></ion-icon></a>
                    </td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>LA2-789</td>
                    <td>Mark Fernando</td>
                    <td>Lab Assistant 2</td>
                    <td>076-5432109</td>
                    <!-- Add actions or links for this row -->
                    <td>
                        <a href="#" class="download"><ion-icon name="create-outline"></ion-icon></a>
                        <a href="#" class="delete"><ion-icon name="trash"></ion-icon></a>
                    </td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>INV456</td>
                    <td>Susan Rajapakse</td>
                    <td>Inventory Manager</td>
                    <td>072-4567890</td>
                    <!-- Add actions or links for this row -->
                    <td>
                        <a href="#" class="download"><ion-icon name="create-outline"></ion-icon></a>
                        <a href="#" class="delete"><ion-icon name="trash"></ion-icon></a>
                    </td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>REC123</td>
                    <td>Mike Wijesinghe</td>
                    <td>Receptionist</td>
                    <td>071-9876543</td>
                    <!-- Add actions or links for this row -->
                    <td>
                        <a href="#" class="download"><ion-icon name="create-outline"></ion-icon></a>
                        <a href="#" class="delete"><ion-icon name="trash"></ion-icon></a>
                    </td>
                </tr>
                <tr>
                    <td>6</td>
                    <td>SUPP1</td>
                    <td>Linda Perera</td>
                    <td>Supplier 1</td>
                    <td>075-1234567</td>
                    <!-- Add actions or links for this row -->
                    <td>
                        <a href="#" class="download"><ion-icon name="create-outline"></ion-icon></a>
                        <a href="#" class="delete"><ion-icon name="trash"></ion-icon></a>
                    </td>
                </tr>
                <tr>
                    <td>7</td>
                    <td>SUPP2</td>
                    <td>David Fernando</td>
                    <td>Supplier 2</td>
                    <td>076-9876543</td>
                    <!-- Add actions or links for this row -->
                    <td>
                        <a href="#" class="download"><ion-icon name="create-outline"></ion-icon></a>
                        <a href="#" class="delete"><ion-icon name="trash"></ion-icon></a>
                    </td>
                </tr>
                <tr>
                    <td>8</td>
                    <td>SUPP3</td>
                    <td>Susan Silva</td>
                    <td>Supplier 3</td>
                    <td>070-5432109</td>
                    <!-- Add actions or links for this row -->
                    <td>
                        <a href="#" class="download"><ion-icon name="create-outline"></ion-icon></a>
                        <a href="#" class="delete"><ion-icon name="trash"></ion-icon></a>
                    </td>
                </tr>
                <!-- You can add more rows with similar data as needed -->
            </tbody>
        </table>
        </div>
    </div>
</body>
</html>