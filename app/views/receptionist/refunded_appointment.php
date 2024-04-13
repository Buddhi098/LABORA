<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta http-equiv="refresh" content="600; url=http://localhost/labora/user/logout"> -->
    <link rel="stylesheet" href="<?php echo APPROOT.'/public/css/receptionist/refunded_appointment.css'?>">
    <!-- static icons -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <!-- annimation icons -->
    <script src="https://cdn.lordicon.com/lordicon-1.1.0.js"></script>
    <title>Receptionist dashboard</title>
</head>
<body>
    <?php require_once 'components/appointment_nevbar.php' ?>
    <div class="container_1">

    <div class="table-container">
        <h2><i class="fa-solid fa-calendar-check"></i>Appointments</h2>
        <div class="add">
            <a href="<?php echo URLROOT?>receptionist/appointment_form" class="addbtn"><ion-icon name="add"></ion-icon>Schedule appointment</a>
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
                <th>Ref No</th>
                <th>Patient Email</th>
                <th>Test Category</th>
                <th>Appointment Date</th>
                <th>Appointment Time</th>
                <th>Appointment Notes</th>
                <th>Appointment Status</th>
                <th>Payment Status</th>
                <th>Action</th>
            </thead >
            <tbody>
                <div class='table_body'>
                    <?php
                        if($data['appointment_data']){
                            foreach($data['appointment_data'] as $appointment){
                                if($appointment['Appointment_Status'] == 'Pending' && $appointment['payment_status'] == 'unpaid'){
                                    $button = "<td><button class='btn btn-1' onclick='cancelAppointment(".$appointment['Id'].")'>Pay Now</button></td>";
                                }else if($appointment['Appointment_Status'] == 'Pending' && $appointment['payment_status'] == 'paid'){
                                    $button = "<td><button class='btn btn-2' onclick='cancelAppointment(".$appointment['Id'].")'>Get PASS</button></td>";
                                }else{
                                    
                                }
                                echo "<tr>";
                                echo "<td>".$appointment['Ref_No']."</td>";
                                echo "<td>".$appointment['patient_email']."</td>";
                                echo "<td>".$appointment['Test_Type']."</td>";
                                echo "<td>".$appointment['Appointment_Date']."</td>";
                                echo "<td>".$appointment['Appointment_Time']."</td>";
                                echo "<td>".$appointment['Appointment_Notes']."</td>";
                                echo "<td>".$appointment['Appointment_Status']."</td>";
                                echo "<td>".$appointment['payment_status']."</td>";
                                echo "<td><a href='".URLROOT."receptionist/appointment_details/".$appointment['Id']."'><button class='viewbtn'>View</button></a></td>";
                                echo "</tr>";
                            }
                        }else{
                            echo '<tr><td colspan="100%" class="empty_msg">No data available in the table.</td></tr>';
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