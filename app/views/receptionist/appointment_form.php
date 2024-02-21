<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta http-equiv="refresh" content="600; url=http://localhost/labora/user/logout"> -->
    <link rel="stylesheet" href="<?php echo APPROOT.'/public/css/receptionist/appointment_form.css'?>">
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
    <h1>Schedule Appointment</h1>
    <form class="appointment-form">
        <div class="form-group">
            <label for="test-type">Patient Name:</label>
            <input type="text" id="test-type" name="test-type" required>
        </div>
        <div class="form-group">
            <label for="test-type">Test Name:</label>
            <input type="text" id="test-type" name="test-type" required>
        </div>
        <div class="form-group">
            <label for="appointment-date">Appointment Date:</label>
            <input type="date" id="appointment-date" name="appointment-date" required>
        </div>
        <div class="form-group">
            <label for="appointment-time">Appointment Time:</label>
            <input type="time" id="appointment-time" name="appointment-time" required>
        </div>
        <div class="form-group">
            <label for="appointment-notes">Appointment Notes:</label>
            <textarea id="appointment-notes" name="appointment-notes" rows="4"></textarea>
        </div>
        <button type="submit" class="button">Submit</button>
    </form>
    </div>
</body>
</html>