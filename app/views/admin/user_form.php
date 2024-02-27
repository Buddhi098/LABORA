<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta http-equiv="refresh" content="600; url=http://localhost/labora/user/logout"> -->
    <link rel="stylesheet" href="<?php echo APPROOT.'/public/css/admin/user_form.css'?>">
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
        <div class="form">
            <h1>User Registration</h1>
            <form action="http://localhost/labora/admin/addUser"  method="post" class="appointment-form">
                <div class="form-group">
                    <label for="employeeRole">Select Employee Role:</label>
                    <select id="employeeRole" name="employeeRole">
                        <option value="lab_assistant">Lab Assistant</option>
                        <option value="receptionist">Receptionist</option>
                        <option value="MLT">Medical Lab Technician</option>
                        <option value="inventory_manager">Inventory Manager</option>
                        <option value="supplier">Supplier </option>
                        <option value="admin">Admin </option>
                        <!-- Add more options as needed -->
                    </select>
                </div>
                <div class="form-group">
                    <label for="full_name">Full Name:</label>
                    <input type="text" id="full_name" name="full_name" required>
                </div>
                <div class="form-group">
                    <label for="phone">Phone:</label>
                    <input type="text" id="phone" name="phone" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="text" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="address">Address:</label>
                    <input type="text" id="address" name="address" required>
                </div>
                <div class="form-group">
                    <label for="dob">Date of Birth:</label>
                    <input type="date" id="dob" name="dob" required>
                </div>
                <div class="form-group">
                <label for="gender">Gender:</label><br>
                    <input type="radio" id="gender" name="gender" value="male" checked> Male
                    <input type="radio" id="gender" name="gender" value="female"> Female
                    <input type="radio" id="gender" name="gender" value="other"> Other<br>
                </div>
                <button type="submit" class="sub-button">Submit</button>
            </form>

        </div>
    
    </div>
</body>
</html>