<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta http-equiv="refresh" content="600; url=http://localhost/labora/user/logout"> -->
    <link rel="stylesheet" href="<?php echo APPROOT.'/public/css/invmng/issueChemicals.css'?>">
    <script src="<?php echo APPROOT.'/public/js/invmng/invmng.js';?>"></script>
    <!-- static icons -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <!-- annimation icons -->
    <script src="https://cdn.lordicon.com/lordicon-1.1.0.js"></script>
    <title>Supply Requests dashboard</title>
</head>
<body>
    <?php require_once 'components/nevbar.php' ?>

    

    <div class="container_1">

    <link rel="stylesheet" href="<?php echo APPROOT.'/public/css/invmng/components/invTables.css'?>">

    <div class="table-container">
        <h2><i class="fa-solid fa-calendar-check"></i>Supply Requests</h2>
       
        <div class="search-container">
        <input type="text" class="search-box" id="searchInput" placeholder="Search...">
        <button class="search-button">Search</button>
        </div>

        <div class="filter-box">
            <div class="filter-section">
                <select class="filter-box">
                <option value="all">All</option>
                <option value="pending">Pending</option>
                <option value="approved">Approved</option>
                <option value="fulfilled">Fulfilled</option>
                <option value="denied">Denied</option>
                </select>
                <button class="filter-button">Filter By Status</button>
            </div>
        </div>

        <table id="myTable">
            <thead>
                <th>Request ID</th>          
                <th>Request Date</th>
                <th>Delivery Date</th>
                <th>Status</th>
                <th>Items Requested</th>
                <th>Note</th>
                <th>Action</th>
            </thead>
            <tbody>
                <div class='table_body'>
                    <?php foreach($data['request_data'] as $request){

                        if ($request['status'] === 'Pending') {
                            $text_1 = "Approve";
                            $class_1 = "btn-0 btn-8";
                            $text_2 = "Deny";
                            $class_2 = "btn-0 btn-3";
                        }
                        else if ($request['status'] === 'Approved') {
                            $text_1 = "";
                            $class_1 = '';
                            $text_2 = " ";
                            $class_2 = " ";
                        }
                        else if ($request['status'] === 'Canceled') {
                            $text_1 = "Remove";
                            $class_1 = 'btn-0 btn-9';
                            $text_2 = " ";
                            $class_2 = " ";
                        }
                        else if($request['status'] === 'Denied') {
                            $text_1 = "Remove";
                            $class_1 = 'btn-0 btn-9';
                            $text_2 = " ";
                            $class_2 = " ";
                        } 

                        if ($request['status'] === 'Pending') {
                            $text_status = "Pending Approval";
                            $class_status = "status-4";
                        }
                        else if ($request['status'] === 'Approved') {
                            $text_status = "Approved";
                            $class_status = "status-2";
                        }
                        else if ($request['status'] === 'Canceled') {
                            $text_status = "Canceled";
                            $class_status = "status-5";
                        }
                        else if ($request['status'] === 'Denied') {
                            $text_status = "Canceled";
                            $class_status = "status-5";
                        }
                   
                         
                         echo "<tr>";
                         echo "<td>".$request['request_id']."</td>";
                         echo "<td>".$request['request_date']."</td>";
                         echo "<td>".$request['delivered_date']."</td>";
                         echo "<td><a class='" .$class_status ."'>" . $text_status . "</a></td>";
                         echo "<td><button class='action-button' onclick=\"getItems('".$request['id']."')\">View</button></td>";
                         echo "<td>".$request['note']."</td>";
                         echo "<td>
                                <button class='".$class_1."' onclick=\"handleRequestAction('".$request['id']."','".$request['status']."')\">" . $text_1 . "</button>
                        
                                <button class='".$class_2."' onclick=\"denyRequest('".$request['id']."')\">" . $text_2 . "</button>
                            </td>";
                        echo "</tr>";
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


    <!-- Modal -->
  <div class="modal" id="customModal">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><i class="fa-solid fa-flask"></i> Requested Items</h4>
        <button type="button" onclick="closeModal()">&times;</button>
      </div>
      <div class="modal-body">
            <table class="simple_table">
            <thead>
                <tr>
                    <th>Item ID</th>
                    <th>Item Name</th>
                    <th>Quantity</th>
                    <th>Note</th>
                </tr>
            </thead>
            <tbody id="modal_body">
                
            </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn-primary" onclick="closeModal()">Close</button>
        <!-- <button type="button" class="btn-primary">Save Changes</button> -->
      </div>

    </div>
  </div>

        <!-- Confirmation Modal for Approving Request -->
<div class="confirmation-modal" id="confirmApproveModal">
    <div class="confirmation-modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <p>Are you sure you want to approve this request?</p>
        <div class="btn-container">
            <button id="confirmApproveBtn">Yes</button>
            <button onclick="closeModal()">No</button>
        </div>
        <!-- Hidden input field to store the request ID -->
        <input type="hidden" id="confirmRequestID">
    </div>
</div>

<!-- Confirmation Modal for Denying Request -->
<div class="confirmation-modal" id="confirmDenyModal">
    <div class="confirmation-modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <p>Are you sure you want to deny this request?</p>
        <div class="btn-container">
            <button id="confirmDenyBtn">Yes</button>
            <button onclick="closeModal()">No</button>
        </div>
        <!-- Hidden input field to store the request ID -->
        <input type="hidden" id="confirmRequestID">
    </div>
</div>

<!-- Confirmation Modal for Removing Request -->
<div class="confirmation-modal" id="confirmRemoveModal">
    <div class="confirmation-modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <p>Are you sure you want to remove this request?</p>
        <div class="btn-container">
            <button id="confirmRemoveBtn">Yes</button>
            <button onclick="closeModal()">No</button>
        </div>
        <!-- Hidden input field to store the request ID -->
        <input type="hidden" id="confirmRequestID">
    </div>
</div>

<!-- Success/Failure Modal -->
<div id="messageModal" class="modal">
  <div class="modal-content">
    <span class="close" onclick="closeMessageModal()">&times;</span>
    <p id="messageText"></p>
  </div>
</div>


    <!-- import table javascript -->
    <script src="<?php echo APPROOT.'/public/js/components/table.js'?>"></script>
</body>
</html>

<script>
    function getItems(request_id){
                console.log(request_id);

                baseLink = window.location.origin
                link = `${baseLink}/labora/invmng/getRequestItems/${request_id}`
                console.log(link);
                fetch(link)
                .then(response => {
                    if (!response.ok) {
                    throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    console.log(data);
                    mockup = ''
                    for(let i=0 ; i < data.length ; i++){
                        mockup += `
                        <tr>
                        <td>${data[i]['item_id']}</td>
                        <td>${data[i]['item_name']}</td>
                        <td>${data[i]['quantity']}</td>
                        <td>${data[i]['note']}</td>
                        </tr>`
                    }
                    console.log(mockup)
                    document.getElementById('modal_body').innerHTML =mockup;

                })
                .catch(error => {
                    console.error('There was a problem with the fetch operation:', error);
                });

                openModal();

            }
</script>


<script>

// Function to handle the button click based on the request status
function handleRequestAction(request_id, status) {
    document.getElementById('confirmRequestID').value = request_id;

    if (status === 'Pending') {
        document.getElementById('confirmApproveModal').style.display = 'block';
        document.getElementById('confirmApproveBtn').addEventListener('click', confirmApprove);
    } else if (status === 'Canceled' || status === 'Denied') {
        document.getElementById('confirmRemoveModal').style.display = 'block';
        document.getElementById('confirmRemoveBtn').addEventListener('click', confirmRemove);
    }
}

// Function to deny a supply request
function denyRequest(request_id) {
    document.getElementById('confirmDenyModal').style.display = 'block';
    document.getElementById('confirmRequestID').value = request_id;

    // Add event listener to the "Yes" button
    document.getElementById('confirmDenyBtn').addEventListener('click', confirmDeny);
}

// Function to handle approval confirmation
function confirmApprove() {
    var request_id = document.getElementById('confirmRequestID').value;
    console.log(request_id);

    const baseLink = window.location.origin;
    const link = `${baseLink}/labora/invmng/approveSupplyRequest/${request_id}`;
  
    window.location.href = link;

    closeModal();
}

// Function to handle denial confirmation
function confirmDeny() {
    var request_id = document.getElementById('confirmRequestID').value;

    console.log(request_id);

    const baseLink = window.location.origin;
    const link = `${baseLink}/labora/invmng/denySupplyRequest/${request_id}`;

    window.location.href = link;
  
    closeModal();
}

// Function to handle request removal confirmation
function confirmRemove() {
    var request_id = document.getElementById('confirmRequestID').value;
    console.log(request_id);

    const baseLink = window.location.origin;
    const link = `${baseLink}/labora/invmng/removeSupplyRequest/${request_id}`;
 
    window.location.href = link;
    closeModal();
}


function closeModal() {
    // Remove the event listeners from the "Yes" buttons
    document.getElementById('confirmApproveBtn').removeEventListener('click', confirmApprove);
    document.getElementById('confirmDenyBtn').removeEventListener('click', confirmDeny);
    document.getElementById('confirmRemoveBtn').removeEventListener('click', confirmRemove);

    document.getElementById('confirmApproveModal').style.display = 'none';
    document.getElementById('confirmDenyModal').style.display = 'none';
    document.getElementById('confirmRemoveModal').style.display = 'none';
    document.getElementById('customModal').style.display = 'none';
}


</script>
