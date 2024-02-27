<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta http-equiv="refresh" content="600; url=http://localhost/labora/user/logout"> -->
    <link rel="stylesheet" href="<?php echo APPROOT.'/public/css/receptionist/patient_form.css'?>">
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
    <h1>Register Patient</h1>
    <form class="appointment-form">
        <div class="form-group">
            <label for="test-type">Patient Name:</label>
            <input type="text" id="test-type" name="test-type" required>
        </div>
        <div class="form-group">
            <label for="test-type">Phone:</label>
            <input type="text" id="test-type" name="test-type" required>
        </div>
        <div class="form-group">
            <label for="test-type">Email:</label>
            <input type="text" id="test-type" name="test-type" required>
        </div>
        <div class="form-group">
            <label for="test-type">Address:</label>
            <input type="text" id="test-type" name="test-type" required>
        </div>
        <div class="form-group">
            <label for="appointment-date">Date of Birth:</label>
            <input type="date" id="appointment-date" name="appointment-date" required>
        </div>
        <div class="form-group">
        <label for="gender">Gender:</label><br>
        <form action="">
            <input type="radio" name="gender" value="male" checked> Male
            <input type="radio" name="gender" value="female"> Female
            <input type="radio" name="gender" value="other"> Other
            </form><br>

            <div class="form-group"><br>
            <label for="test-type">User Name:</label>
            <input type="text" id="test-type" name="test-type" required>
            </div>
            <div class="form-group">
            <label for="test-type">Password:</label>
            <input type="text" id="test-type" name="test-type" required>
            </div>
        </div>
        </div>
        <button type="submit" class="button">Submit</button>
    </form>
    </div>
</body>
</html>