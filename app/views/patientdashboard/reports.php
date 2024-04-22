<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta http-equiv="refresh" content="600; url=http://localhost/labora/user/logout"> -->
    <link rel="stylesheet" href="<?php echo APPROOT.'/public/css/patientdashboard/reports.css'?>">
    <script src="<?php echo APPROOT.'/public/js/patientdashboard/patient.js';?>"></script>
    <!-- static icons -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <!-- annimation icons -->
    <script src="https://cdn.lordicon.com/lordicon-1.1.0.js"></script>
    <title>Patient dashboard</title>
</head>
<body>
    <?php require_once 'components/nevbar.php' ?>
    <div class="container_1">
        <div class="table-container">
        <h2><i class="fa-solid fa-calendar-check"></i>Medical Reports</h2>
        <div class="search-container">
        <input type="text" class="search-box" id="searchInput" placeholder="Search...">
        <button class="search-button">Search</button>
        </div>
        <div class="filter-box">
            <div class="filter-section">
                <!-- Add your filter options here -->
                <select class="filter-box">
                <option value="all">All</option>
                <option value="category1">Category 1</option>
                <option value="category2">Category 2</option>
                <!-- Add more filter options as needed -->
                </select>
                <button class="filter-button">Filter By ID</button>
            </div>
            <div class="filter-section">
                <!-- Add your filter options here -->
                <select class="filter-box">
                <option value="all">All</option>
                <option value="category1">Category 1</option>
                <option value="category2">Category 2</option>
                <!-- Add more filter options as needed -->
                </select>
                <button class="filter-button">Filter By Email</button>
            </div>
        </div>
        <table id="myTable">
        <thead>
            <th>Index</th>
            <th>Ref No</th>
            <th>Test Type</th>
            <th>Date</th>
            <th>Report Status</th>
            <th>Actions</th>
        </thead >
        <tbody>
                <div class='table_body'>
                    <?php
                    if(!empty($data)){
                        $reversedArray = array_reverse($data, true);
                        foreach ($reversedArray as $row) {
                            if ($row['report_status'] == 'Pending') {
                                $str = 'status-8';
                            } else if ($row['report_status'] == 'Created') {
                                $str = 'status-2';
                            } else if ($row['report_status'] == 'Rejected') {
                                $str = 'status-5';
                            } else if ($row['report_status'] == 'Approved') {
                                $str = 'status-3';
                            } else if ($row['report_status'] == 'Review By MLT') {
                                $str = 'status-2';
                            } else if ($row['report_status'] == 'Completed') {
                                $str = 'status-3';
                            }
                            echo '<tr>
                            <td>'.$row['id'].'</td>
                            <td>'.$row['ref_no'].'</td>
                            <td>'.$row['test_type'].'</td>
                            <td>'.$row['date'].'</td>
                            <td><div class="'.$str.'">'.$row['report_status'].'</div></td>
                            <td><a href="' . APPROOT . "/PatientDashboard/viewReport/" . $row['ref_no'] . '" target=_blank"" ><button class="btn-0 btn-2">View</button></a> <a><button class="btn-0 btn-3" onclick=\'openModal("'.$row['ref_no'].'")\'>Delete</button></a></td>
                        </tr>';
                        }
                    }else{
                        echo '<tr><td colspan="100%" class="empty_msg">No data available in the table.</td></tr>';
                    }
                    
                    ?>   
                    <!-- Add more rows as needed -->
                </div>
            </tbody>
        </table>
            <div class="pagination">
            <h5 id="table_data"></h5>
            <button onclick="previousPage()" id="prev">Previous</button>
            <button onclick="nextPage()" id="next">Next</button>
            </div>
        </div>
    </div>

    <!-- delete waring message -->
    <div id="deleteModal" class="warning-modal">
        <div class="warning-modal-content">
            <span class="close">&times;</span>
            <p>Are you sure you want to Delete Permanently?</p>
            <div class="btn-container">
                <button id="yesBtn">Yes</button>
                <button id="noBtn">No</button>
                <input type="hidden" value="" id="hidden_id">
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

    <!-- waring modal -->
    <script src="<?php echo APPROOT . '/public/js/components/warningModal.js' ?>"></script>

    <script>
        let yesBtn1 = document.getElementById('yesBtn');
        yesBtn1.addEventListener('click' , ()=>{
            let ref_no= document.getElementById('hidden_id').value;
            console.log('zczx');
            window.location.href = "<?php echo URLROOT.'/PatientDashboard/deleteReport/'?>" + ref_no;
        })
    </script>

    <script src="<?php echo APPROOT.'/public/js/components/table.js'?>"></script>
</body>
</html>