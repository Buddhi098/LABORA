<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta http-equiv="refresh" content="600; url=http://localhost/labora/user/logout"> -->
    <link rel="stylesheet" href="<?php echo APPROOT . '/public/css/labassistant/report.css' ?>">
    <script src="<?php echo APPROOT . '/public/js/labassistant/patient.js'; ?>"></script>
    <!-- static icons -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <!-- annimation icons -->
    <script src="https://cdn.lordicon.com/lordicon-1.1.0.js"></script>
    <title>Patient Reports</title>
</head>

<body>
    <?php require_once 'components/nevbar.php' ?>
    <div class="container_1">

        <div class="table-container">
            <h2><i class="fa-solid fa-calendar-check"></i> Patient Reports</h2>
            <div class="add">
                <a href="http://localhost/labora/labassistant/getSignForm" class="addbtn"><ion-icon
                        name="add"></ion-icon> Import Signature</a>
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
                    <th>Test Name</th>
                    <th>Report Status</th>
                    <th>Report</th>
                    <th>Reject Note</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    <div class='table_body'>
                        <?php
                        foreach ($data['reports'] as $index => $report) {
                            $btn = '<button class="btn-0 btn-1 button_disabled" onclick="openModal(\'' . $report['ref_no'] . '\')" disabled><i class="fas fa-paper-plane"></i> Send MLT</button>';
                            $report_view_btn = '<a href="' . URLROOT . 'labassistant/viewReport/' . $report['ref_no'] . '" target="_blank"><button class="btn-0 btn-2">View</button></a>';
                            if ($report['report_status'] == 'Pending') {
                                $report_view = '<a href="' . URLROOT . 'labassistant/viewReport/' . $report['ref_no'] . '" target="_blank"><button class="btn-0 btn-2 button_disabled" disabled>View</button></a>';
                                $str = 'status-8';
                                $btn = '<a href="' . URLROOT . 'labassistant/getMedicalReportForm/' . $report['test_type_id'] . '/' . $report['email'] . '/' . $report['ref_no'] . '"><button class="btn-0 btn-2"><i class="fas fa-marker"></i> Report</button></a>';
                            } else if ($report['report_status'] == 'Created') {
                                $btn = '<button class="btn-0 btn-1" onclick="openModal(\'' . $report['ref_no'] . '\')"><i class="fas fa-paper-plane"></i> Send MLT</button>';
                                $str = 'status-2';
                            } else if ($report['report_status'] == 'Rejected') {
                                $btn = '<a href="' . URLROOT . 'labassistant/getMedicalReportForm/' . $report['test_type_id'] . '/' . $report['email'] . '/' . $report['ref_no'] . '"><button class="btn-0 btn-2"><i class="fas fa-marker"></i> Report</button></a>';
                                $str = 'status-5';
                            } else if ($report['report_status'] == 'Approved') {
                                $str = 'status-3';
                            } else if ($report['report_status'] == 'Review By MLT') {
                                $str = 'status-2';
                            } else if ($report['report_status'] == 'Completed') {
                                $str = 'status-3';
                            }

                            if ($report['reject_note'] == '') {
                                $disabled = 'disabled';
                                $disable_cls = 'button_disabled';
                            } else {
                                $disabled = '';
                                $disable_cls = '';
                            }
                            echo '<tr>
                            <td>' . $report['ref_no'] . '</td>
                            <td>' . $report['email'] . '</td>
                            <td>' . $report['test_type'] . '</td>
                            <td><span class="' . $str . '">' . $report['report_status'] . '<span></td>
                            <td>' . $report_view_btn . '</td>
                            <td><button class="btn-0 btn-2 ' . $disable_cls . '" ' . $disabled . ' onclick=\'openModal5("' . $index . '")\'>View</button></td>
                            <td>' . $btn . '</td>             
                        </tr>';
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
    <!-- pop success & error messages -->
    <!-- popup success messages -->
    <div class="success-message-container" id="successMessage">
        <div class="icon">
            <lord-icon src="https://cdn.lordicon.com/guqkthkk.json" trigger="in" delay="15" state="in-reveal">
            </lord-icon>
        </div>
        <p id="success_msg"> Success!</p>
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

    <!-- delete waring message -->
    <div id="deleteModal" class="warning-modal">
        <div class="warning-modal-content">
            <span class="close">&times;</span>
            <p>Are you sure you want to Send to MLT?</p>
            <div class="btn-container">
                <button id="yesBtn">Yes</button>
                <button id="noBtn">No</button>
                <input type="hidden" value="" id="hidden_id">
            </div>
        </div>
    </div>

    <!-- waring modal -->
    <script src="<?php echo APPROOT . '/public/js/components/warningModal.js' ?>"></script>


    <script>
        window.onload = function () {
            let sucess_msg = <?php if (isset($_SESSION['success_msg'])) {
                echo json_encode($_SESSION['success_msg']);
            } else {
                echo '';
            }
            ; ?>;
            <?PHP unset($_SESSION['success_msg']); ?>
            if (sucess_msg != '') {
                document.getElementById('success_msg').innerHTML = sucess_msg;
                showSuccessMessage();
            } else {
                showErrorMessage();
            }
            console.log(sucess_msg);
        };
    </script>

    <script>
        let yesBtn1 = document.getElementById('yesBtn');
        yesBtn1.addEventListener('click', () => {
            let ref_no = document.getElementById('hidden_id').value;
            window.location.href = `http://localhost/labora/labassistant/reportSendToMLT/${ref_no}`;
        })
    </script>


    <!-- Modal -->
    <div class="modal" id="customModal5">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Medical Test Details</h4>
                <button type="button" onclick="closeModal5()">&times;</button>
            </div>
            <div class="modal-body">
                <p id="modal_info5">Data Not Found</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-primary" onclick="closeModal5()">Close</button>
            </div>
        </div>
    </div>

    <script>
        function openModal5(id) {
            var modal = document.getElementById("customModal5");
            modal.style.display = "flex";
            console.log(id);

            // Assuming $data['reports'] is a PHP array that gets JSON encoded
            let rejectNotes = <?php echo json_encode($data['reports']) ?>;
            let rejectNote = rejectNotes[id]['reject_note'];

            console.log(rejectNote);
            document.getElementById('modal_info5').innerHTML = rejectNote;
        }


        function closeModal5() {
            var modal = document.getElementById("customModal5");
            modal.style.display = "none";
        }

        // Close the modal if the user clicks outside of it
        window.onclick = function (event) {
            var modal = document.getElementById("customModal5");
            if (event.target === modal) {
                modal.style.display = "none";
            }
        };

    </script>


    <!-- import table javascript -->
    <script src="<?php echo APPROOT . '/public/js/components/table.js' ?>"></script>
</body>

</html>