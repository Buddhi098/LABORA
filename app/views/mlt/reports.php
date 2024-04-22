<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta http-equiv="refresh" content="600; url=http://localhost/labora/user/logout"> -->
    <link rel="stylesheet" href="<?php echo APPROOT . '/public/css/mlt/reports.css' ?>">
    <script src="<?php echo APPROOT . '/public/js/mlt/mlt.js'; ?>"></script>
    <!-- static icons -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <!-- annimation icons -->
    <script src="https://cdn.lordicon.com/lordicon-1.1.0.js"></script>
    <title>Report</title>
</head>

<body>
    <?php require_once 'components/nevbar.php' ?>
    <div class="container_1">

        <div class="table-container">
            <h2><i class="fa-solid fa-calendar-check"></i> Medical Reports</h2>
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
                    <th>Patient Email</th>
                    <th>Test Category</th>
                    <th>Status</th>
                    <th>Report</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    <div class='table_body'>
                        <?php
                        if ($data['reports'] != null) {
                            foreach ($data['reports'] as $report) {
                                if ($report['report_status'] == 'Review By MLT') {
                                    $status_cls = 'status-4';
                                } else if ($report['report_status'] == 'Completed') {
                                    $status_cls = 'status-1';
                                } else if ($report['report_status'] == 'Rejected') {
                                    $status_cls = 'status-5';
                                } else if ($report['report_status'] == 'Approved') {
                                    $status_cls = 'status-3';
                                }
                                echo "<tr>";
                                echo "<td>" . $report['ref_no'] . "</td>";
                                echo "<td>" . $report['email'] . "</td>";
                                echo "<td>" . $report['test_type'] . "</td>";
                                echo "<td><div class='" . $status_cls . "'>" . $report['report_status'] . "</td>";
                                echo "<td><a href='" . APPROOT . "/mlt/viewReport/" . $report['ref_no'] . "' target='_blank'><button class='btn-0 btn-2'>View</button></a></td>";
                                if ($report['report_status'] == 'Review By MLT') {
                                    echo "<td><button class='btn-0 btn-2' onclick=\"openModal1('" . $report['ref_no'] . "')\">Approve</button><button class='btn-0 btn-3' onclick=\"openModal3('" . $report['ref_no'] . "')\">Reject</button></td>";
                                } else if ($report['report_status'] == 'Completed' || $report['report_status'] == 'Rejected') {
                                    echo "<td><button class='btn-0 btn-3' onclick=\"openModal3('" . $report['ref_no'] . "')\">Remove</button></td>";
                                }else if($report['report_status'] == 'Approved'){
                                    echo "<td><button class='btn-0 btn-1' onclick=\"openModal4('" . $report['ref_no'] . "')\">Complete</button></td>";
                                }

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

    <!-- for showing sucess message -->
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

    <!-- change status warning message -->
    <div id="deleteModal2" class="warning-modal">
        <div class="warning-modal-content">
            <span class="close2">&times;</span>
            <p id="warning_msg2">Are You Sure You Want Approve?</p>
            <div class="btn-container">
                <button id="yesBtn2">Yes</button>
                <button id="noBtn2">No</button>
                <input type="hidden" value="" id="hidden_id2">
            </div>
        </div>
    </div>

    <script>

        var modal1 = document.getElementById("deleteModal2");


        var span1 = document.getElementsByClassName("close2")[0];


        var yesBtn1 = document.getElementById("yesBtn2");
        var noBtn1 = document.getElementById("noBtn2");


        span1.onclick = function () {
            modal1.style.display = "none";
        }

        function openModal1(id) {
            console.log(id)

            document.getElementById('hidden_id2').value = id;
            modal1.style.display = "block";
        }

        // this use on view

        yesBtn1.onclick = function () {
            console.log("Item deleted");
            modal1.style.display = "none";

            let ref_no = document.getElementById('hidden_id2').value;
            const baseLink = window.location.origin;
            const link = `${baseLink}/labora/mlt/approveReport/${ref_no}`;
            window.location.href = link;
        }

        noBtn1.onclick = function () {
            modal1.style.display = "none";
        }

        window.onclick = function (event) {
            if (event.target == modal1) {
                modal1.style.display = "none";
            }
        }
    </script>


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

    <script>
        var modal3 = document.getElementById("customModal3");

        function openModal3(id) {
            document.getElementById('hidden3').value = id;
            modal3.style.display = "block";
        }

        function closeModal3() {
            modal3.style.display = "none";
        }

        var reason_btn = document.getElementById('reason_btn');
        reason_btn.onclick = function () {
            let ref_no = document.getElementById('hidden3').value;
            let reason = document.getElementById('rejection-reason').value;
            const baseLink = window.location.origin;
            const link = `${baseLink}/labora/mlt/rejectReport/${ref_no}/${reason}`;
            window.location.href = link;
        }
    </script>


    <!-- Remove warning message -->
    <div id="deleteModal3" class="warning-modal">
        <div class="warning-modal-content">
            <span class="close3 close2">&times;</span>
            <p id="warning_msg3">Are You Sure You Want Remove?</p>
            <div class="btn-container">
                <button class="yesBtn" id="yesBtn3">Yes</button>
                <button class="noBtn" id="noBtn3">No</button>
                <input type="hidden" value="" id="hidden_id3">
            </div>
        </div>
    </div>

    <script>

        var modal3 = document.getElementById("deleteModal3");


        var span3 = document.getElementsByClassName("close3")[0];


        var yesBtn3 = document.getElementById("yesBtn3");
        var noBtn3 = document.getElementById("noBtn3");


        span3.onclick = function () {
            modal3.style.display = "none";
        }

        function openModal3(id) {
            console.log(id)

            document.getElementById('hidden_id3').value = id;
            modal3.style.display = "block";
        }

        // this use on view

        yesBtn3.onclick = function () {
            console.log("Item deleted");
            modal3.style.display = "none";

            let ref_no = document.getElementById('hidden_id3').value;
            const baseLink = window.location.origin;
            const link = `${baseLink}/labora/mlt/removeReport/${ref_no}`;
            window.location.href = link;
        }

        noBtn3.onclick = function () {
            modal3.style.display = "none";
        }

        window.onclick = function (event) {
            if (event.target == modal3) {
                modal3.style.display = "none";
            }
        }
    </script>


    <!-- change status to complete -->

    <!-- change status warning message -->
    <div id="deleteModal4" class="warning-modal">
        <div class="warning-modal-content">
            <span class="close4 close2">&times;</span>
            <p id="warning_msg4">Are You Sure You Want Complete?</p>
            <div class="btn-container">
                <button class="yesBtn" id="yesBtn4">Yes</button>
                <button class="noBtn" id="noBtn4">No</button>
                <input type="hidden" value="" id="hidden_id4">
            </div>
        </div>
    </div>

    <script>

        var modal4 = document.getElementById("deleteModal4");


        var span4 = document.getElementsByClassName("close4")[0];


        var yesBtn4 = document.getElementById("yesBtn4");
        var noBtn4 = document.getElementById("noBtn4");


        span4.onclick = function () {
            modal4.style.display = "none";
        }

        function openModal4(id) {
            console.log(id)

            document.getElementById('hidden_id4').value = id;
            modal4.style.display = "block";
        }

        // this use on view

        yesBtn4.onclick = function () {
            console.log("Item deleted");
            modal4.style.display = "none";

            let ref_no = document.getElementById('hidden_id4').value;
            const baseLink = window.location.origin;
            const link = `${baseLink}/labora/mlt/completeReport/${ref_no}`;
            window.location.href = link;
        }

        noBtn4.onclick = function () {
            modal4.style.display = "none";
        }

        window.onclick = function (event) {
            if (event.target == modal4) {
                modal4.style.display = "none";
            }
        }
    </script>

    <!-- import table javascript -->
    <script src="<?php echo APPROOT . '/public/js/components/table.js' ?>"></script>
</body>

</html>