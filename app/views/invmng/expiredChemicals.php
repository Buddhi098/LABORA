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
            <h2><i class="fa-solid fa-calendar-check"></i>Chemicals about to Expire</h2>

            <label for="expiryRange">Select Date Range</label>
            <input type="date" id="expiryRangeStart" name="expiryRangeStart">
            <input type="date" id="expiryRangeEnd" name="expiryRangeEnd">
            <button onclick="filterExpiredItems()">Filter</button>

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