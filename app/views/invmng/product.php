<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta http-equiv="refresh" content="600; url=http://localhost/labora/user/logout"> -->
    <link rel="stylesheet" href="<?php echo APPROOT.'/public/css/invmng/product.css'?>">
    <script src="<?php echo APPROOT.'/public/js/invmng/invmng.js';?>"></script>
    <!-- static icons -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

     <!-- import modal css and js -->
     <script src="<?php echo APPROOT.'/public/js/components/modal.js'?>"></script>
    <link rel="stylesheet" href="<?php echo APPROOT.'/public/css/components/modal.css'?>">

    <!-- annimation icons -->
    <script src="https://cdn.lordicon.com/lordicon-1.1.0.js"></script>
    <title>Inventory Manager dashboard</title>

</head>
<body>
    <?php require_once 'components/navinventory.php' ?>
    <div class="container_1">

    <link rel="stylesheet" href="<?php echo APPROOT.'/public/css/invmng/components/invTables.css'?>">

    <div class="table-container">
        <h2><i class="fa-solid fa-calendar-check"></i>Chemicals</h2>
        <div class="add">
            <a href="<?php echo URLROOT?>invmng/getAddItemForm" class="addbtn"><ion-icon name="add"></ion-icon> Add Item</a>
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
                <button class="filter-button">Filter By Name</button>
            </div>
        </div>
        <table id="myTable">
            <thead>
                    <th>Index</th>
                    <th>Chemical Name</th>
                   
                    <th>Reorder Limit</th>
                    <th>Quantity in Stock</th>
                    <th>Unit of measure</th>
                    <th>More Details</th>     
                    <th>Note</th>                    
                    <th>Action</th>
            </thead >
        <tbody>
                <div class='table_body'>
                <?php
                    if($data[0]['Item_name'] != '') {
                        foreach ($data as $index => $row) {
                            echo '
                            <tr>
                                <td>'.$row['id'].'</td>
                                <td>'.$row['Item_name'].'</td>  
                              
                                <td>'.$row['reorder_limit'].'</td>
                                <td>'.$row['quantity'].'</td>
                                <td>'.$row['unit_of_measure'].'</td>
                                <td>
                                <button href="#" class="action-button" onclick="getItems('.$row['id'].','.$row['quantity'].')">View</button>
                                </td>
                               
                                <td>'.$row['description'].'</td>
                                <td>
                                <a href="http://localhost/labora/invmng/getEditForm/'.$row['id'].'" class="action-button-edit">Edit</a>
                                
                                <button href="#" class="action-button-delete" onclick="removeItem('.$row['id'].')">Remove</button>
                                </td>
                            </tr>';
                        }
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
    
    <!-- Modal for Item Details -->
    <div class="modal" id="customModal">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Item Details</h4>
                <button type="button" onclick="closeModal()">&times;</button>
            </div>
            <div class="modal-body">
                <table class="simple_table">
                    <thead>
                        <tr>
                            <th>Category ID</th>
                            <th>Supplier ID</th>
                            <th>Expiry Date</th>
                            <th>Quantity</th>
                        </tr>
                    </thead>
                    <tbody id="modal_body">
                        
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-primary" onclick="closeModal()">Close</button>
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


            setTimeout(function() {
                hideSuccessMessage();
            }, 1500);
        }

        function hideSuccessMessage() {
            var successMessage = document.getElementById('successMessage');
            successMessage.classList.remove('show-message');
        }
    </script>
    
    <script src="<?php echo APPROOT.'/public/js/components/table.js'?>"></script>

</body>   
</html>

<script>
    function getItems(id, total_quantity) {
    if (total_quantity > 0) {
        baseLink = window.location.origin;
        link = `${baseLink}/labora/invmng/getItemDetails/${id}`;
        console.log(link);
        fetch(link)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (data === false) { 
                    
                    const modalBody = document.getElementById('modal_body');
                    modalBody.innerHTML = '<tr><td colspan="4">No Chemicals in the stock</td></tr>';
                    openModal();
                } else {
                    console.log(data);
                    mockup = '';
                    for (let i = 0; i < data.length; i++) {
                        mockup += `
                            <tr>
                                <td>${data[i]['id']}</td>
                                <td>${data[i]['suplier_id']}</td>
                                <td>${data[i]['expire_date']}</td>
                                <td>${data[i]['quantity']}</td>
                            </tr>`;
                    }
                    console.log(mockup);
                    document.getElementById('modal_body').innerHTML = mockup;
                    openModal();
                }
            })
            .catch(error => {
                console.error('There was a problem with the fetch operation:', error);
            });
    } else {
       
        const modalBody = document.getElementById('modal_body');
        modalBody.innerHTML = '<tr><td colspan="4">No Chemicals in the stock</td></tr>';
        openModal();
    }
}
</script>

<script>

function removeItem(item_id) {
    document.getElementById('confirmItemID').value = item_id;

    document.getElementById('confirmRemoveModal').style.display = 'block';
    document.getElementById('confirmRemoveBtn').addEventListener('click', confirmRemove);

}
    
function confirmRemove() {
    var item_id = document.getElementById('confirmItemID').value;
    console.log(item_id);

    const baseLink = window.location.origin;
    const link = `${baseLink}/labora/invmng/removeItem/${item_id}`;
 
    window.location.href = link;
    closeModal();
}

function closeModal() {
    
    document.getElementById('confirmRemoveBtn').removeEventListener('click', confirmRemove);
    document.getElementById('confirmRemoveModal').style.display = 'none';
    document.getElementById('customModal').style.display = 'none';
}
</script>
