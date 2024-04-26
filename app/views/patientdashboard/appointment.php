<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta http-equiv="refresh" content="600; url=http://localhost/labora/user/logout"> -->
    <link rel="stylesheet" href="<?php echo APPROOT . '/public/css/patientdashboard/appointment.css' ?>">
    <script src="<?php echo APPROOT . '/public/js/patientdashboard/patient.js'; ?>"></script>
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
                <a href="http://localhost/labora/PatientDashboard/appointment_form" class="addbtn"><ion-icon
                        name="add"></ion-icon> Schedule appointment</a>
            </div>
            <div class="search-container">
                <input type="text" class="search-box" id="searchInput" placeholder="Search...">
                <button class="search-button">Search</button>
            </div>

            <div class="filter-box">
                <div class="filter-section">
                    <select class="filter-box" id="filterbyPaymentStatus">
                        <option value="all">All</option>
                        <option value="paid">Paid</option>
                        <option value="unpaid">Unpaid</option>
                    </select>
                    <button class="filter-button" onclick="filterByPaymentStatus()">Payment Status</button>
                </div>
                <div class="filter-section">
                    <select class="filter-box" id="filterByStatus">
                        <option value="all">All</option>
                        <option value="Pending">Pending</option>
                        <option value="Canceled">Canceled</option>
                        <option value="Approved">Approved</option>
                        <option value="Rejected">Rejected</option>
                        <option value="Expired">Expired</option>
                        <option value="Completed">Completed</option>
                    </select>
                    <button class="filter-button" onclick="filterByStatus()">Filter By Status</button>
                </div>
            </div>
            <table id="myTable">
                <thead>
                    <th>Ref No</th>
                    <th>Test Type</th>
                    <th>Appointment Date</th>
                    <th>Appointment Time</th>
                    <th>Appointment Duration</th>
                    <th>Appointment Status</th>
                    <th>Payment Status</th>
                    <th>Reject Reason</th>
                    <th>Action</th>
                </thead>
                <tbody class="tbody" id="t_body">
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
            <lord-icon src="https://cdn.lordicon.com/guqkthkk.json" trigger="in" delay="15" state="in-reveal">
            </lord-icon>
        </div>
        <p> Success! Appointment Scheduled.</p>
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

    <!-- table js -->
    <script src="<?php echo APPROOT . '/public/js/components/table.js' ?>"></script>

    <!-- waring modal -->
    <script src="<?php echo APPROOT . '/public/js/components/warningModal.js' ?>"></script>


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

    <!--data Modal -->
    <div class="modal" id="customModal4">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Medical Test Details</h4>
                <button type="button" onclick="closeModal4()">&times;</button>
            </div>
            <div class="modal-body">
                <p id="modal_info">Data Not Found</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-primary" onclick="closeModal4()">Close</button>
            </div>
        </div>
    </div>
    </div>




    <!-- warining modal yes button -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            getTableData();
        });

        let dataset = [];

        // get table data
        function getTableData() {
            const baseLink = window.location.origin;
            const link = `${baseLink}/labora/PatientDashboard/getAppointmentData/`
            fetch(link)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('HTTP error! Status: ${response.status}');
                    }
                    return response.json()
                })
                .then(data => {
                    console.log(data)
                    let mockup = ''
                    dataset = data['dataset']
                    data['dataset'].reverse()
                    data['dataset'].forEach((row, index) => {
                        if (row['payment_status'] == 'paid') {
                            str = 'status-3'
                        } else if (row['payment_status'] == 'unpaid') {
                            str = 'status-5'
                        }

                        if (row['Appointment_Status'] == 'Pending') {
                            str2 = 'status-4'
                        } else if (row['Appointment_Status'] == 'Approved') {
                            str2 = 'status-3'
                        } else if (row['Appointment_Status'] == 'Canceled') {
                            str2 = 'status-5'
                        } else if (row['Appointment_Status'] == 'Rejected') {
                            str2 = 'status-5'
                        } else if (row['Appointment_Status'] == 'Completed') {
                            str2 = 'status-1'
                        } else if (row['Appointment_Status'] == 'Expired') {
                            str2 = 'status-8'
                        }


                        btn_disable = 'disabled'
                        btn_clz = 'button_disabled'
                        if (row['Appointment_Status'] == 'Pending' || row['Appointment_Status'] == 'Approved') {
                            btn_disable = ''
                            btn_clz = ''
                        }

                        str5 = ''
                        str5_btn = ''
                        if (!row['reject_note']) {
                            str5 = 'disabled'
                            str5_btn = 'button_disabled'
                        }
                        mockup += `<tr>
                            <td>${row['Ref_No']}</td>
                            <td>${row['Test_Type']}</td>
                            <td>${row['Appointment_Date']}</td>
                            <td>${row['Appointment_Time']}</td>
                            <td>${row['Appointment_Duration']}</td>
                            <td><span class="status-indicator1 ${str2}" id="status">${row['Appointment_Status']}</span></td>
                            <td><div class="${str} payment_status">${row['payment_status']}</div></td>
                            <td><button class="btn-0 btn-2 ${str5_btn}" onclick="openModal4('${index}')" ${str5}>View</button></td>
                            <td><button onclick="openModal('${row['Id']}')" id="btn${row['Id']}" class="btn-0 btn-2 ${btn_clz}" ${btn_disable}>Cancel</button></td>
                        </tr>`
                    })
                    document.getElementById('t_body').innerHTML = mockup;
                    showPage(1)
                    makeStatus()

                })
                .catch(Error => {
                    console.error('Error fetching data: ', Error)
                })
        }


        function openModal4(id) {
            var modal = document.getElementById("customModal4");
            modal.style.display = "flex";
            document.getElementById('modal_info').innerHTML = dataset[id]['reject_note']
        }

        function closeModal4() {
            var modal = document.getElementById("customModal4");
            modal.style.display = "none";
        }

        window.onclick = function (event) {
            var modal = document.getElementById("customModal4");
            if (event.target === modal) {
                modal.style.display = "none";
            }
        };

        // filer by appointment status functions
        function filterByStatus() {
            let value = document.getElementById('filterByStatus').value;
            console.log(value);
            if (value == 'all') {
                location.reload();
            }
            let rows = document.querySelectorAll('.tbody tr');

            console.log(rows);

            rows.forEach(row => {
                let status = row.querySelector('td .status-indicator1').innerText;
                console.log(status)
                if (value === '' || status === value) {
                    row.style.display = 'table-row';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        // filer by payment status functions
        function filterByPaymentStatus() {
            let value = document.getElementById('filterbyPaymentStatus').value;
            console.log(value);
            if (value == 'all') {
                location.reload();
            }
            let rows = document.querySelectorAll('.tbody tr');

            console.log(rows);

            rows.forEach(row => {
                let status = row.querySelector('td .payment_status').innerText;
                console.log(status)
                if (value === '' || status === value) {
                    row.style.display = 'table-row';
                } else {
                    row.style.display = 'none';
                }
            });
        }




        // // make status color
        // function makeStatus() {
        //     let statuses = document.querySelectorAll('.status-indicator');
        //     statuses.forEach(status => {
        //         let text = status.innerText.trim();
        //         if (text === 'Pending') {
        //             status.classList.add('pending');
        //         } else if (text === 'Canceled') {
        //             status.classList.add('rejected');
        //             const row = status.closest('tr');

        //             const button = row.querySelector('.action-button');

        //             button.disabled = true;
        //             button.style.opacity = 0.8
        //             button.style.cursor = 'not-allowed'

        //         } else if (text === 'Approved') {
        //             status.classList.add('approved');
        //         } else if (text = 'Complete') {
        //             const row = status.closest('tr');

        //             const button = row.querySelector('.action-button');

        //             button.disabled = true;
        //             button.style.opacity = 0.8
        //             button.style.cursor = 'not-allowed'
        //         }
        //     });
        // };



        yesBtn.onclick = function () {
            //   console.log("Item deleted");
            let id = document.getElementById('hidden_id').value;

            let baseLink = window.location.origin;
            let link = `${baseLink}/labora/PatientDashboard/cancelAppointment/${id}`
            showLoadingModal();
            fetch(link)
                .then(response => {
                    if (!response.ok) {
                        throw new Error("HTTP error! Status: ${response.status}")
                    }
                    return response.json();
                })
                .then(data => {
                    console.log(data);
                    if (data['status'] == 'success') {
                        showSuccessMessage();
                        let cancelBtn = document.getElementById('btn' + id);
                        cancelBtn.disabled = true;
                        cancelBtn.classList.add('button_disabled')
                        getTableData();
                    } else {
                        showErrorMessage();
                    }
                    hideLoadingModal();
                })
                .catch(error => {
                    console.error('Error fetching data ', error);
                    hideLoadingModal();
                })

            modal.style.display = "none";
        }
    </script>
</body>

</html>