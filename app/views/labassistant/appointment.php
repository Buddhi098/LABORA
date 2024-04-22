<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta http-equiv="refresh" content="600; url=http://localhost/labora/user/logout"> -->
    <link rel="stylesheet" href="<?php echo APPROOT.'/public/css/labassistant/appointment.css'?>">
    <script src="<?php echo APPROOT.'/public/js/labassistant/patient.js';?>"></script>
    <!-- static icons -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <!-- annimation icons -->
    <script src="https://cdn.lordicon.com/lordicon-1.1.0.js"></script>
    <title>Appointment</title>
</head>
<!--Only temporary-->
<body>
    <?php require_once 'components/nevbar.php' ?>
    <div class="container_1">

    <div class="table-container">
        <h2><i class="fa-solid fa-calendar-check"></i> Appointment</h2>
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
                <th>Index</th>
                <th>Patient Name</th>
                <th>Ref No</th>
                <th>Test Type</th>
                <th>Appointment Date</th>
                <th>Appointment Time</th>
                <th>Appointment Duration</th>
                <th>Appointment Status</th>
                <th>Appointment Notes</th>
        </thead >
        <tbody>
                <div class='table_body'>
                    <?php
                        $reversedArray = array_reverse( $data['appointments'], true);
                        if($data['appointments'] != null){
                            foreach ($reversedArray as $row) {
                                if($row['Appointment_Status']=='Pending'){
                                    $str = 'status-4';
                                }else if($row['Appointment_Status']=='Approved'){
                                    $str = 'status-3';
                                }else if($row['Appointment_Status']=='Rejected'){
                                    $str = 'status-5';
                                }else if($row['Appointment_Status']=='Completed'){
                                    $str = 'status-1';   
                                }else if($row['Appointment_Status']=='Canceled'){
                                    $str = 'status-5';
                                }else if($row['Appointment_Status']=='Expired'){
                                    $str = 'status-6';
                                }
                                echo '<tr>
                                <td>'.$row['Id'].'</td>
                                <td>'.$row['patient_email'].'</td>
                                <td>'.$row['Ref_No'].'</td>
                                <td>'.$row['Test_Type'].'</td>
                                <td>'.$row['Appointment_Date'].'</td>
                                <td>'.$row['Appointment_Time'].'</td>
                                <td>'.$row['Appointment_Duration'].'</td>
                                <td><div class="'.$str.'">'.$row['Appointment_Status'].'</div></td>
                                <td>'.$row['Appointment_Notes'].'</td>                        
                            </tr>';
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