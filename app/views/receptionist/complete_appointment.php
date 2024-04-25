<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- <meta http-equiv="refresh" content="600; url=http://localhost/labora/user/logout"> -->
<link rel="stylesheet" href="<?php echo APPROOT.'/public/css/receptionist/complete_appointment.css'?>">
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
    <h2><i class="fa-solid fa-calendar-check"></i>Complete Appointments</h2>
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
                            echo "<tr>";
                            echo "<td>".$appointment['Ref_No']."</td>";
                            echo "<td>".$appointment['patient_email']."</td>";
                            echo "<td>".$appointment['Test_Type']."</td>";
                            echo "<td>".$appointment['Appointment_Date']."</td>";
                            echo "<td>".$appointment['Appointment_Time']."</td>";
                            echo "<td>".$appointment['Appointment_Notes']."</td>";
                            echo "<td><div class='status-1'>".$appointment['Appointment_Status']."</div></td>";
                            echo "<td><div class='status-3'>".$appointment['payment_status']."</div></td>";
                            echo "<td><a href='".URLROOT."receptionist/viewPass/".$appointment['Id']."' target='_blank'><button class='btn-0 btn-2 viewbtn'>View Pass</button></a> <a><button class='btn-0 btn-3 viewbtn' onclick=\"openModal('".$appointment['Id']."')\"><i class='fa-solid fa-trash'></i> Remove</button></a></td>";
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


<!-- delete waring message -->
<div id="deleteModal" class="warning-modal">
    <div class="warning-modal-content">
        <span class="close">&times;</span>
        <p>Are you sure you want to Remove?</p>
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
        <lord-icon
        src="https://cdn.lordicon.com/guqkthkk.json"
        trigger="in"
        delay="15"
        state="in-reveal">
        </lord-icon>
    </div>
    <p> Success! Removed Appointment.</p>
    <span class="close-button" onclick="hideSuccessMessage()">×</span>
</div>

<div class="error-message-container" id="ErrorMessage">
    <div class="icon">
        <lord-icon
        src="https://cdn.lordicon.com/akqsdstj.json"
        trigger="in"
        delay="15"
        state="in-reveal">
        </lord-icon>
    </div>
    <p id="error_msg">Error! Your action was failed.</p>
    <span class="close-button" onclick="hideSuccessMessage()">×</span>
</div>

<script src="<?php echo APPROOT.'/public/js/components/warningModal.js'?>"></script>

<script>

let yesButton = document.getElementById('yesBtn');
yesButton.addEventListener('click', function() {
    let id = document.getElementById('hidden_id').value;
    console.log(id);
    window.location.href = "<?php echo URLROOT; ?>receptionist/removeAppointment/" + id;
    modal.style.display = "none";
});


    window.onload = function() {
        var msg = <?php echo json_encode($_SESSION['msg']); ?>;
        <?php unset($_SESSION['msg']); ?>
        if(msg=='success'){
            showSuccessMessage();
        }else if(msg=='error'){
            showErrorMessage();
        }
    };
</script>

<!-- import table javascript -->
<script src="<?php echo APPROOT.'/public/js/components/table.js'?>"></script>
</body>
</html>