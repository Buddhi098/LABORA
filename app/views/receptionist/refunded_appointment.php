<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta http-equiv="refresh" content="600; url=http://localhost/labora/user/logout"> -->
    <link rel="stylesheet" href="<?php echo APPROOT . '/public/css/receptionist/refunded_appointment.css' ?>">
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
            <div class="search-container">
                <input type="text" class="search-box" id="searchInput" placeholder="Search...">
                <button class="search-button">Search</button>
            </div>

            <div class="filter-box">
                <div class="filter-section">
                    <select class="filter-box" id='filter2'>
                        <option value="all">All</option>
                        <option value="pending">Pending</option>
                        <option value="refunded">Refunded</option>
                    </select>
                    <button class="filter-button"
                        onclick="filterFunction('filter2' , 'tbody tr' , 'td .refund')">Refund Status</button>
                </div>
            </div>
            <table id="myTable">
                <thead>
                    <th>Ref No</th>
                    <th>Patient Email</th>
                    <th>Test Category</th>
                    <th>Appointment Date</th>
                    <th>Refund Status</th>
                    <th>Refund Amount</th>
                    <th>Appointment Status</th>
                    <th>Payment Status</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    <div class='table_body'>
                        <?php
                        if ($data['appointment_data']) {
                            foreach ($data['appointment_data'] as $appointment) {
                                if ($appointment['refund_status'] == 'refunded') {
                                    $str = 'disabled';
                                    $status_cls = 'status-1';
                                    $btn_cls = 'button_disabled';
                                } else {
                                    $str = '';
                                    $status_cls = 'status-4';
                                    $btn_cls = '';
                                }
                                echo "<tr>";
                                echo "<td>" . $appointment['Ref_No'] . "</td>";
                                echo "<td>" . $appointment['patient_email'] . "</td>";
                                echo "<td>" . $appointment['Test_Type'] . "</td>";
                                echo "<td>" . $appointment['Appointment_Date'] . "</td>";
                                echo "<td><div class='".$status_cls." refund'>" . $appointment['refund_status'] . "</div></td>";
                                echo "<td>Rs. " . $appointment['cost'] . ".00</td>";
                                echo "<td><div class='status-5'>" . $appointment['Appointment_Status'] . "</div></td>";
                                echo "<td><div class='status-1'>" . $appointment['payment_status'] . "</div></td>";
                                echo "<td><a><button class='viewbtn btn-0 btn-2 ".$btn_cls."' onclick=\"openWarningModal('" . $appointment['Id'] . "' , '" . $appointment['patient_email'] . "')\" " . $str . ">Pay Refund</button></a></td>";
                                echo "</tr>";
                            }
                        } else {
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

    <!-- delete waring message -->
    <div id="deleteModal" class="warning-modal">
        <div class="warning-modal-content">
            <span class="close">&times;</span>
            <p>Are you sure you want to Pay Refund?</p>
            <div class="btn-container">
                <button id="yesBtn">Yes</button>
                <button id="noBtn">No</button>
                <input type="hidden" value="" id="hidden_id">
                <input type="hidden" value="" id="hidden_email">
            </div>
        </div>
    </div>

    <script src="<?php echo APPROOT . '/public/js/components/warningModal.js' ?>"></script>

    <script>
        function openWarningModal(id, email) {
            console.log(id)
            console.log(email);
            document.getElementById('hidden_id').value = id;
            document.getElementById('hidden_email').value = email;
            modal.style.display = "block";
        }

        yesBtn.onclick = function () {
            const baseLink = window.location.origin
            const id = document.getElementById('hidden_id').value;
            const email = document.getElementById('hidden_email').value;
            const link = `${baseLink}/labora/receptionist/getRefundInovoice/${id}/${email}`
            window.open(link, '_blank');
            modal.style.display = "none";
        }
    </script>
    <!-- import table javascript -->
    <script src="<?php echo APPROOT . '/public/js/components/table.js' ?>"></script>
</body>

</html>