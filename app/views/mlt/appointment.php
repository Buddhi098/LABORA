<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta http-equiv="refresh" content="600; url=http://localhost/labora/user/logout"> -->
    <link rel="stylesheet" href="<?php echo APPROOT . '/public/css/mlt/appointment.css' ?>">
    <script src="<?php echo APPROOT . '/public/js/mlt/mlt.js'; ?>"></script>
    <!-- static icons -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <!-- annimation icons -->
    <script src="https://cdn.lordicon.com/lordicon-1.1.0.js"></script>
    <title>MLT dashboard</title>
</head>

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
                        <option value="category1">Pending</option>
                        <option value="category2">Completed</option>
                    </select>
                    <button class="filter-button">Filter By Status</button>
                </div>
                <div class="filter-section">
                    <input type="date" id="filterDate">
                    <button class="filter-button">Filter by Date</button>
                </div>
            </div>
            <table id="myTable">
                <thead>
                    <th>Ref No</th>
                    <th>Email</th>
                    <th>Test category</th>
                    <th>Appointment Date</th>
                    <th>Appointment Time</th>
                    <th>Appointment Status</th>
                    <th>Note</th>
                    <th>Payment Status</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    <div class='table_body'>

                        <?php
                        if (isset($data['appointment']) && !empty($data['appointment'])) {
                            foreach ($data['appointment']['pending_appointment'] as $index => $appointment) {
                                if ($appointment['payment_status'] === 'paid') {
                                    $status = 'status-1';
                                } else if ($appointment['payment_status'] === 'unpaid') {
                                    $status = 'status-5';
                                }

                                if ($appointment['Appointment_Status'] === 'Pending') {
                                    $status_str = 'status-4';
                                }
                                echo "<tr>";
                                echo "<td>" . $appointment['Ref_No'] . "</td>";
                                echo "<td>" . $appointment['patient_email'] . "</td>";
                                echo "<td>" . $appointment['Test_Type'] . "</td>";
                                echo "<td>" . $appointment['Appointment_Date'] . "</td>";
                                echo "<td>" . $appointment['Appointment_Time'] . "</td>";
                                echo "<td><div class='" . $status_str . "'>" . $appointment['Appointment_Status'] . "</div></td>";
                                echo "<td><button class='btn-0 btn-2' onclick=\"openModal2('" . $appointment['Appointment_Notes'] . "')\">View</button></td>";
                                echo "<td><div class='" . $status . "'>" . $appointment['payment_status'] . "<div></td>";
                                echo "<td><button class='btn-0 btn-2' onclick='openModal(`" . $appointment['Ref_No'] . "`)'>Approved</button><button class='btn-0 btn-3' onclick='openModal3(`" . $appointment['Ref_No'] . "`)'>Reject</button></td>";
                                echo "</tr>";
                            }


                            foreach ($data['appointment']['other_appointment'] as $index => $appointment) {
                                if ($appointment['payment_status'] === 'paid') {
                                    $status = 'status-1';
                                } else if ($appointment['payment_status'] === 'unpaid') {
                                    $status = 'status-5';
                                }

                                if ($appointment['Appointment_Status'] === 'Pending') {
                                    $status_str = 'status-4';
                                } else if ($appointment['Appointment_Status'] === 'Approved') {
                                    $status_str = 'status-3';
                                } else if ($appointment['Appointment_Status'] === 'Completed') {
                                    $status_str = 'status-1';
                                } else if ($appointment['Appointment_Status'] === 'Canceled') {
                                    $status_str = 'status-5';
                                } else if ($appointment['Appointment_Status'] === 'Rejected') {
                                    $status_str = 'status-5';
                                } else if ($appointment['Appointment_Status'] === 'Expired') {
                                    $status_str = 'status-6';
                                }
                                echo "<tr>";
                                echo "<td>" . $appointment['Ref_No'] . "</td>";
                                echo "<td>" . $appointment['patient_email'] . "</td>";
                                echo "<td>" . $appointment['Test_Type'] . "</td>";
                                echo "<td>" . $appointment['Appointment_Date'] . "</td>";
                                echo "<td>" . $appointment['Appointment_Time'] . "</td>";
                                echo "<td><div class='" . $status_str . "'>" . $appointment['Appointment_Status'] . "</div></td>";
                                echo "<td><button class='btn-0 btn-2' onclick=\"openModal2('" . $appointment['Appointment_Notes'] . "')\">View</button></td>";
                                echo "<td><div class='" . $status . "'>" . $appointment['payment_status'] . "<div></td>";
                                echo "<td><button class='btn-0 btn-3' onclick='openModal4(`" . $appointment['Ref_No'] . "`)'>Remove</button></td>";
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
                <button onclick="previousPage()">Previous</button>
                <button onclick="nextPage()" id="next">Next</button>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal" id="customModal">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Appointment Details</h4>
                <button type="button" onclick="closeModal2()">&times;</button>
            </div>
            <div class="modal-body">
                <p id="modal_info">Data Not Found</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-primary" onclick="closeModal2()">Close</button>
            </div>
        </div>
    </div>

    <!--reject Modal -->
    <div class="modal" id="customModal3">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Reason for Rejection</h4>
                <button type="button" onclick="closeModal3()">&times;</button>
            </div>
            <div class="modal-body" style="height:250px;">
                <label for="rejection-reason" style="font-family: Arial, sans-serif; color: #555;">Please provide the
                    reason for rejecting the appointment</label>
                <br>
                <textarea id="rejection-reason" rows="8" cols="60"
                    style="font-family: Arial, sans-serif; font-size: 14px; border: 1px solid #ccc; border-radius: 4px; padding: 8px;margin-top:10px;"></textarea>
            </div>
            <div class="modal-footer">
                <input type="hidden" value="" id="hidden3">
                <button type="button" class="btn-primary" id='reason_btn'>Submit</button>
                <button type="button" class="btn-primary" onclick="closeModal3()">Close</button>
            </div>
        </div>
    </div>

    <!-- change status warning message -->
    <div id="deleteModal" class="warning-modal">
        <div class="warning-modal-content">
            <span class="close">&times;</span>
            <p id="warning_msg">Are You Sure You Want Approve?</p>
            <div class="btn-container">
                <button id="yesBtn">Yes</button>
                <button id="noBtn">No</button>
                <input type="hidden" value="" id="hidden_id">
            </div>
        </div>
    </div>

    <!-- remove warning message -->
    <div id="deleteModal2" class="warning-modal">
        <div class="warning-modal-content">
            <span class="close2">&times;</span>
            <p id="warning_msg2">Are You Sure You Want Remove?</p>
            <div class="btn-container">
                <button id="yesBtn2">Yes</button>
                <button id="noBtn2">No</button>
                <input type="hidden" value="" id="hidden_id3">
            </div>
        </div>
    </div>

    <!-- pop success & error messages -->
    <!-- popup success messages -->
    <div class="success-message-container" id="successMessage">
        <div class="icon">
            <lord-icon src="https://cdn.lordicon.com/guqkthkk.json" trigger="in" delay="15" state="in-reveal">
            </lord-icon>
        </div>
        <p id="success_msg"> Success! Add New Medical Test.</p>
        <span class="close-button" onclick="hideSuccessMessage()">×</span>
    </div>

    <div class="error-message-container" id="ErrorMessage">
        <div class="icon">
            <lord-icon src="https://cdn.lordicon.com/akqsdstj.json" trigger="in" delay="15" state="in-reveal">
            </lord-icon>
        </div>
        <p id="error_msg">Error! Your action was failed.</p>
        <span class="close-button" onclick="hideSuccessMessage()">×</span>
    </div>


    <!-- loading modal -->
    <div id="loading-modal" class="loading_modal">
        <div class="loading_modal-content">
            <div class="loader">
                <div class="circle"></div>
                <div class="circle"></div>
                <div class="circle"></div>
                <div class="circle"></div>
            </div>
            <p>Sending Email...</p>
        </div>
    </div>

    <script src="<?php echo APPROOT . '/public/js/components/warningModal.js' ?>"></script>

    <script>

        // for view appointment note
        function openModal2(note) {
            var modal = document.getElementById("customModal");
            modal.style.display = "flex";

            document.getElementById("modal_info").innerHTML = note;
        }

        function closeModal2() {
            var modal = document.getElementById("customModal");
            modal.style.display = "none";
        }

        // Close the modal if the user clicks outside of it
        window.onclick = function (event) {
            var modal = document.getElementById("customModal");
            if (event.target === modal) {
                modal.style.display = "none";
            }
        };


        // for approve appointment

        let yesBtn1 = document.getElementById('yesBtn');
        yesBtn1.addEventListener('click', function () {
            let ref_no = document.getElementById('hidden_id').value;
            const baseLink = window.location.origin;
            const link = `${baseLink}/labora/mlt/setAppointmentApproved/${ref_no}`;
            window.location.href = link;
        });





    </script>

    <!-- import table javascript -->
    <script src="<?php echo APPROOT . '/public/js/components/table.js' ?>"></script>

    <script>

        window.onload = showMessage();

        function showMessage() {
            let success = '<?php echo isset($_SESSION["success_msg"]) ? json_encode($_SESSION["success_msg"]) : ""; ?>';
            <?php unset($_SESSION["success_msg"]); ?>;
            if (success.trim() !== "") {
                console.log(success);
                document.getElementById('success_msg').innerHTML = success;
                showSuccessMessage();
            }
        }


    </script>

    <!-- for reject appointment -->

    <script>

        function openModal3(ref_no) {
            console.log('open', ref_no);
            var modal = document.getElementById("customModal3");
            modal.style.display = "flex";

            document.getElementById("hidden3").value = ref_no;

        }

        function closeModal3() {
            var modal = document.getElementById("customModal3");
            modal.style.display = "none";
        }

        // Close the modal if the user clicks outside of it
        window.onclick = function (event) {
            var modal = document.getElementById("customModal3");
            if (event.target === modal) {
                modal.style.display = "none";
            }
        };

        let reasonBtn = document.getElementById('reason_btn');
        reasonBtn.addEventListener('click', () => {
            let ref_no = document.getElementById('hidden3').value;
            let reason = document.getElementById('rejection-reason').value;
            const baseLink = window.location.origin;
            const link = `${baseLink}/labora/mlt/setAppointmentRejected/`;
            closeModal3();
            showLoadingModal();
            const formData = new FormData();
            formData.append('reason', reason);
            formData.append('ref_no', ref_no);
            fetch(link, {
                method: 'POST',
                body: formData
            }).then(res => {
                if(!res.ok){
                    throw new Error('Failed to reject appointment');
                }

                return res.json()
            }).then(data => {
                if(data.success){
                    window.location.reload();
                }
                hideLoadingModal();
            }).catch(err => {
                console.log(err);
                hideLoadingModal();
            });
        });
    </script>


    <!-- remove appointment -->

    <script>

        var modal2 = document.getElementById("deleteModal2");


        var span2 = document.getElementsByClassName("close2")[0];


        var yesBtn2 = document.getElementById("yesBtn2");
        var noBtn2 = document.getElementById("noBtn2");


        span2.onclick = function () {
            modal2.style.display = "none";
        }

        function openModal4(id) {
            console.log(id, 'asdsa');

            document.getElementById('hidden_id3').value = id;
            modal2.style.display = "block";
        }

        // this use on view

        yesBtn2.onclick = function () {
            let ref_no = document.getElementById('hidden_id3').value;
            const baseLink = window.location.origin;
            const link = `${baseLink}/labora/mlt/removeAppointmentMLT/${ref_no}`;
            window.location.href = link;
        }

        noBtn2.onclick = function () {
            modal2.style.display = "none";
        }

        window.onclick = function (event) {
            if (event.target == modal2) {
                modal2.style.display = "none";
            }
        }
    </script>

</body>

</html>