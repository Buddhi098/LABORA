<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta http-equiv="refresh" content="600; url=http://localhost/labora/user/logout"> -->
    <link rel="stylesheet" href="<?php echo APPROOT.'/public/css/invmng/expiredChemicals.css'?>">
    <script src="<?php echo APPROOT.'/public/js/invmng/invmng.js';?>"></script>
    <!-- static icons -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <!-- annimation icons -->
    <script src="https://cdn.lordicon.com/lordicon-1.1.0.js"></script>
    <title>Inventory Manager dashboard</title>
</head>
<body>
    <?php require_once 'components/navinventory.php' ?>
    <div class="container_1"> 
        <div class="table-container">
            <h2><i class="fa-solid fa-calendar-check"></i>Expiry Chemicals </h2>

            <!-- <div class="filter-box">
                <div class="filter-section">
                    <label for="start-date">Start Date:</label>
                    <input type="date" id="start-date">
                    <label for="end-date">End Date:</label>
                    <input type="date" id="end-date">
                    <button id="filter-btn">Filter</button>
                </div>
            </div> -->

            <div class="search-container">
        <input type="text" class="search-box" id="searchInput" placeholder="Search...">
        <button class="search-button">Search</button>
        </div>

            <table id="myTable">
                <thead>
                    <th>Index</th>
                    <th>Item Id</th>
                    <th>Item Name</th>
                    <th>Expire Date</th>
                    <th>Quantity</th>
                    <th>Action</th>
                </thead >
                <tbody class='table_body'>
                    <?php
                    if (empty($data)) {
                        echo '<tr><td colspan="6">No data available</td></tr>';
                    } else {
                        foreach ($data as $row) {
                            echo '
                            <tr>
                                <td>'.$row['id'].'</td>
                                <td>'.$row['item_id'].'</td>
                                <td>'.$row['item_name'].'</td>
                                <td>'.$row['expire_date'].'</td>
                                <td>'.$row['quantity'].'</td>
                                <td> <button href="#" class="btn-0 btn-3" onclick=\'deleteExpiredItem("'.$row['id'].'")\'>Remove from the Inventory</button></td>
                            </tr>';
                        }
                    }
                    ?>
                </tbody>
            </table>
            <div class="pagination">
                <h5 id="table_data"></h5>
                <button onclick="previousPage()" >Previous</button>
                <button onclick="nextPage()" id="next">Next</button>
            </div>
        </div>
    </div>
       
       <!-- Confirmation Modal for Removing Chemical -->
<div class="confirmation-modal" id="confirmRemoveModal">
    <div class="confirmation-modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <p>Are you sure you want to remove this Chemical?</p>
        <div class="btn-container">
            <button id="confirmRemoveBtn">Yes</button>
            <button onclick="closeModal()">No</button>
        </div>
        <!-- Hidden input field to store the item ID -->
        <input type="hidden" id="confirmItemID">
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
       window.onload = function() {
            showMessage();
        }

        function showMessage() {
            let success = '<?php echo isset($_SESSION["success_msg"]) ? json_encode($_SESSION["success_msg"]) : ""; ?>';
            <?php unset($_SESSION["success_msg"]); ?>;
            if (success.trim() !== "") {
                console.log(success);
                document.getElementById('success_msg').innerHTML = success;
                showSuccessMessage();
            }
        }

        function showSuccessMessage() {
            var successMessage = document.getElementById('successMessage');
            successMessage.classList.add('show-message');

            // Set a timeout to hide the message after 2 seconds (2000 milliseconds)
            setTimeout(function() {
                hideSuccessMessage();
            }, 1500);
        }

        function hideSuccessMessage() {
            var successMessage = document.getElementById('successMessage');
            successMessage.classList.remove('show-message');
        }
    </script>

     <!-- import table javascript -->
     <script src="<?php echo APPROOT.'/public/js/components/table.js'?>"></script>

</body>
</html>


<script>
     
    function deleteExpiredItem(item_id) {
        document.getElementById('confirmItemID').value = item_id;

        document.getElementById('confirmRemoveModal').style.display = 'block';
        document.getElementById('confirmRemoveBtn').addEventListener('click', confirmRemove);

    }
        // Item removal confirmation
    
    function confirmRemove() {
    var item_id = document.getElementById('confirmItemID').value;
    console.log(item_id);

    const baseLink = window.location.origin;
    const link = `${baseLink}/labora/invmng/deleteExpiredItem/${item_id}`;

    window.location.href = link;

    closeModal();
}

    function closeModal() {
        // Remove the event listeners from the "Yes" buttons
        document.getElementById('confirmRemoveBtn').removeEventListener('click', confirmRemove);
        document.getElementById('confirmRemoveModal').style.display = 'none';
        document.getElementById('customModal').style.display = 'none';
    }

    </script>

<!-- <script>
    document.getElementById('filter-btn').addEventListener('click', function() {
    var startDate = document.getElementById('start-date').value;
    var endDate = document.getElementById('end-date').value;

    if (startDate && endDate) {
        // Construct the URL for fetching filtered data
        const baseLink = window.location.origin;
        const link = `${baseLink}/labora/invmng/getExpiredItemsByDateRange?startDate=${startDate}&endDate=${endDate}`;
        
        fetch(link)
    .then(response => {
        console.log('Response:', response);
        if (response.ok) {
            return response.json();
        } else {
            throw new Error('Network response was not ok');
        }
    })
    .then(data => {
        updateTable(data);
    })
    .catch(error => {
        console.error('Error:', error);
    });

        // Make an AJAX request to fetch the filtered data
        fetch(link)
            .then(response => response.json())
            .then(data => {
                // Update the table with the filtered data
                updateTable(data);
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }
});


function updateTable(data) {
    var tableBody = document.querySelector('.table_body');
    tableBody.innerHTML = ''; // Clear the existing table rows

    if (data.length === 0) {
        tableBody.innerHTML = '<tr><td colspan="6">No data available</td></tr>';
    } else {
        data.forEach(function(row) {
            var tr = document.createElement('tr');

            var tdId = document.createElement('td');
            tdId.textContent = row.id;
            tr.appendChild(tdId);

            var tdItemId = document.createElement('td');
            tdItemId.textContent = row.item_id;
            tr.appendChild(tdItemId);

            var tdItemName = document.createElement('td');
            tdItemName.textContent = row.item_name;
            tr.appendChild(tdItemName);

            var tdExpireDate = document.createElement('td');
            tdExpireDate.textContent = row.expire_date;
            tr.appendChild(tdExpireDate);

            var tdQuantity = document.createElement('td');
            tdQuantity.textContent = row.quantity;
            tr.appendChild(tdQuantity);

            var tdAction = document.createElement('td');
            var removeButton = document.createElement('button');
            removeButton.textContent = 'Remove from the Inventory';
            removeButton.classList.add('btn-0', 'btn-3');
            removeButton.addEventListener('click', function() {
                deleteExpiredItem(row.id);
            });
            tdAction.appendChild(removeButton);
            tr.appendChild(tdAction);

            tableBody.appendChild(tr);
        });
    }
}

</script>
 -->
