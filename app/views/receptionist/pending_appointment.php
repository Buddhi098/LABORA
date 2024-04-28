<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta http-equiv="refresh" content="600; url=http://localhost/labora/user/logout"> -->

    <link rel="stylesheet" href="<?php echo APPROOT.'/public/css/receptionist/pending_appointment.css'?>">
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
        <h2><i class="fa-solid fa-calendar-check"></i>Pending Appointments</h2>
        <div class="search-container">
        <input type="text" class="search-box" id="searchInput" placeholder="Search...">
        <button class="search-button">Search</button>
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
                <th>Payment</th>
            </thead >
            <tbody>
                <div class='table_body'>
                    <?php
                        if($data['appointment_data']){
                            foreach($data['appointment_data'] as $appointment){
                                echo "<tr>";
                                echo "<td>".$appointment['Ref_No']."</td>";
                                echo "<td>".$appointment['patient_email']."</td>";
                                echo "<td>".$appointment['Test_Type']."</td>";
                                echo "<td>".$appointment['Appointment_Date']."</td>";
                                echo "<td>".$appointment['Appointment_Time']."</td>";
                                echo "<td>".$appointment['Appointment_Notes']."</td>";
                                echo "<td>".$appointment['Appointment_Status']."</td>";
                                echo "<td>".$appointment['payment_status']."</td>";
                                echo "<td>Rs.".$appointment['cost'].".00</td>";
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
            <button onclick="previousPage()" id='prev'>Previous</button>
            <button onclick="nextPage()" id="next">Next</button>
            </div>
        </div>
    </div>

    <script>
        function getPass(id){
            const baseLink = window.location.origin;
            const link = `${baseLink}/labora/receptionist/getAppointmentPass/${id}`;
            window.open(link , '_blank');
        }

        function getPaymentForm(id , email){
            console.log(id , email)
            const baseLink = window.location.origin;
            const link = `${baseLink}/labora/receptionist/getPaymentForm/${id}/${email}`;
            window.open(link , '_blank');
        
        }
    </script>

    <!-- import table javascript -->
    <script src="<?php echo APPROOT.'/public/js/components/table.js'?>"></script>
</body>
</html>