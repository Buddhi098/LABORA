<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- <meta http-equiv="refresh" content="600; url=http://localhost/labora/user/logout"> -->
<link rel="stylesheet" href="<?php echo APPROOT.'/public/css/patientdashboard/appointment.css'?>">
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
    <h2><i class="fa-solid fa-calendar-check"></i>Appointment</h2>
    <div class="add">
        <a href="http://localhost/labora/PatientDashboard/appointment_form" class="addbtn"><ion-icon name="add"></ion-icon> Schedule appointment</a>
        </div>
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
            <select class="filter-box" id="filterByStatus">
            <option value="all">All</option>
            <option value="Pending">Pending</option>
            <option value="Canceled">Canceled</option>
            <option value="Approved">Approved</option>
            <!-- Add more filter options as needed -->
            </select>
            <button class="filter-button" onclick="filterByStatus()">Filter By Status</button>
        </div>
    </div>
    <table id="myTable">
    <thead>
            <th>Index</th>
            <th>Ref No</th>
            <th>Test Type</th>
            <th>Appointment Date</th>
            <th>Appointment Time</th>
            <th>Appointment Duration</th>
            <th>Appointment Status</th>
            <th>Payment Status</th>
            <th>Appointment Notes</th>
            <th>Action</th>
    </thead >
    <tbody id="t_body">
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
        <p>Are you sure you want to Cancel?</p>
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
    <p> Success! Appointment Scheduled.</p>
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

<!-- table js -->
<script src="<?php echo APPROOT.'/public/js/components/table.js'?>"></script>

<!-- waring modal -->
<script src="<?php echo APPROOT.'/public/js/components/warningModal.js'?>"></script>




<!-- warining modal yes button -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        getTableData();
    });


    // get table data
    function getTableData(){
        const baseLink = window.location.origin;
        const link =`${baseLink}/labora/PatientDashboard/getAppointmentData`

        fetch(link)
        .then(response => {
            if(!response.ok){
                throw new Error('HTTP error! Status: ${response.status}');
            }
            return response.json()
        })
        .then(data => {
            console.log(data)
            let mockup = ''
            data['dataset'].reverse()
            data['dataset'].forEach(row => {
                mockup += `<tr>
                            <td>${row['Id']}</td>
                            <td>${row['Ref_No']}</td>
                            <td>${row['Test_Type']}</td>
                            <td>${row['Appointment_Date']}</td>
                            <td>${row['Appointment_Time']}</td>
                            <td>${row['Appointment_Duration']}</td>
                            <td><span class="status-indicator" id="status">${row['Appointment_Status']}</span></td>
                            <td>${row['payment_status']}</td>
                            <td>${row['Appointment_Notes']}</td>
                            <td><button onclick="openModal('${row['Id']}')" id="btn${row['Id']}" class="action-button">Cancel</button></td>
                        </tr>`
            })
            document.getElementById('t_body').innerHTML = mockup;
            showPage(1)
            makeStatus()

        })
        .catch(Error=>{
            console.error('Error fetching data: ', Error)
        })
    }

    // filer functions
    function filterByStatus() {
let value = document.getElementById('filterByStatus').value;
console.log(value);
let rows = document.querySelectorAll('.table-container tr');

console.log(rows);

rows.forEach(row => {
    let status = row.querySelector('td .status-indicator').innerText;
    console.log(status)
    if (value === '' || status === value) {
        row.style.display = 'table-row';
    } else {
        row.style.display = 'none';
    }
});
}




    // make status color
    function makeStatus(){
            let statuses = document.querySelectorAll('.status-indicator'); 
            statuses.forEach(status => { 
                let text = status.innerText.trim(); 
                if(text === 'Pending'){
                    status.classList.add('pending');
                } else if(text === 'Canceled'){
                    status.classList.add('rejected');
                    const row = status.closest('tr');
        
                    const button = row.querySelector('.action-button');

                    button.disabled = true;
                    button.style.opacity = 0.8
                    button.style.cursor = 'not-allowed'

                } else if(text === 'Approved'){
                    status.classList.add('approved');
                } else if(text = 'Complete'){
                    const row = status.closest('tr');
        
                    const button = row.querySelector('.action-button');

                    button.disabled = true;
                    button.style.opacity = 0.8
                    button.style.cursor = 'not-allowed'
                }
        });
    };



    yesBtn.onclick = function() {
    //   console.log("Item deleted");
        let id = document.getElementById('hidden_id').value;

        let baseLink = window.location.origin;
        let link = `${baseLink}/labora/PatientDashboard/cancelAppointment/${id}`

        fetch(link)
        .then(response => {
        if(!response.ok){
            throw new Error("HTTP error! Status: ${response.status}")
        }
        return response.json();
        })
        .then(data => {
        console.log(data);
        if(data['status']=='success'){
            showSuccessMessage();
            getTableData();
        }else{
            showErrorMessage();
        }
        })
        .catch(error => {
        console.error('Error fetching data ', error)
        })

        modal.style.display = "none";
    }
</script>
</body>
</html>