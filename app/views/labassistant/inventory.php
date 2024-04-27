<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta http-equiv="refresh" content="600; url=http://localhost/labora/user/logout"> -->
    <link rel="stylesheet" href="<?php echo APPROOT.'/public/css/labassistant/inventory.css'?>">
    <script src="<?php echo APPROOT.'/public/js/labassistant/patient.js';?>"></script>
    <!-- static icons -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <!-- annimation icons -->
    <script src="https://cdn.lordicon.com/lordicon-1.1.0.js"></script>
    <title>Lab assistant dashboard</title>
</head>
<body>
    <?php require_once 'components/nevbar.php' ?>
    <div class="container_1">

        <div class="tablename">
            <h3>Appointment</h3>
        </div>
        <div class="line"></div>
        <div class="searchbar">
            <input type="text" class="search" placeholder="Enter reference number">
            <a href="#" class="searchbtn">Search</a>
        </div>

        <div class="filter">
            <form action="#" method="post">
                <input type="text" class="test-type" placeholder="Enter test type">
                <input type="date" class="from">
                <input type="date" class="to">
                <button type="submit" class="submit button">Filter</button>
            </form>
        </div>
        <div>
        <table>
        <thead>
            <tr>
                <th>Index</th>
                <th>Ref No</th>
                <th>Test Type</th>
                <th>Appointment Date</th>
                <th>Appointment Time</th>
                <th>Appointment Duration</th>
                <th>Appointment Status</th>
                <th>Appointment Notes</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($data as $row) {
                echo '<tr>
                <td>'.$row['Id'].'</td>
                <td>'.$row['Ref_No'].'</td>
                <td>'.$row['Test_Type'].'</td>
                <td>'.$row['Appointment_Date'].'</td>
                <td>'.$row['Appointment_Time'].'</td>
                <td>'.$row['Appointment_Duration'].'</td>
                <td>'.$row['Appointment_Status'].'</td>
                <td>'.$row['Appointment_Notes'].'</td>
                <td><a href="http://localhost/labora/labassistant/cancelAppointment/'.$row['Id'].'" class="cancel">Cancel</a><a href="http://localhost/labora/labassistant/cancelAppointment/'.$row['Id'].'" class="cancel">Send</a></td>
                
            </tr>';
            }
            ?>
            
            <!-- Add more rows as needed -->
        </tbody>
        </table>
        </div>
    </div>

     <script src="<?php echo APPROOT.'/public/js/components/table.js'?>"></script>
</body>
</html>