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
                                <td> <button href="#" class="btn-0 btn-3" onclick=\'deleteItem("'.$row['id'].'")\'>Remove from the Inventory</button></td>
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
       
    <!-- Confirmation Modal for Removing Item -->
    <div class="confirmation-modal" id="confirmRemoveModal">
        <div class="confirmation-modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <p>Are you sure you want to remove this item?</p>
            <div class="btn-container">
                <button id="confirmRemoveBtn">Yes</button>
                <button onclick="closeModal()">No</button>
            </div>
        </div>
    </div>

    <script>
        function filterExpiredItems() {
            const startDate = document.getElementById('expiryRangeStart').value;
            const endDate = document.getElementById('expiryRangeEnd').value;
            const url = `<?php echo base_url('invmng/filterExpiredItems')?>/${startDate}/${endDate}`;

            fetch(url)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    updateTable(data);
                })
                .catch(error => {
                    console.error('There was a problem with the fetch operation:', error);
                    showErrorMessage('An error occurred while fetching data');
                });
        }

        function updateTable(data) {
            const tableBody = document.querySelector('.table_body');
            tableBody.innerHTML = ''; // Clear existing content
            if (data.length === 0) {
                tableBody.innerHTML = '<tr><td colspan="6">No data available</td></tr>';
            } else {
                data.forEach(row => {
                    tableBody.innerHTML += `
                        <tr>
                            <td>${row.id}</td>
                            <td>${row.item_id}</td>
                            <td>${row.item_name}</td>
                            <td>${row.expire_date}</td>
                            <td>${row.quantity}</td>
                            <td><button href="#" class="btn-0 btn-3" onclick="deleteItem('${row.id}')">Remove from the Inventory</button></td>
                        </tr>`;
                });
            }
        }

        function deleteItem(itemId) {
            const baseLink = window.location.origin;
            const link = `${baseLink}/labora/invmng/deleteExpiredItem/${itemId}`;

            fetch(link, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                showSuccessMessage('Item deleted successfully');
                filterExpiredItems(); // Refresh the table after successful deletion
            })
            .catch(error => {
                console.error('There was a problem with the fetch operation:', error);
                showErrorMessage('An error occurred while deleting the item');
            });
        }

        function closeModal() {
            document.getElementById('confirmRemoveModal').style.display = 'none';
        }

        function showSuccessMessage(message) {
            const successModal = document.createElement('div');
            successModal.classList.add('success-modal');
            successModal.textContent = message;
            document.body.appendChild(successModal);

            setTimeout(() => {
                successModal.classList.add('fade-out');
                setTimeout(() => {
                    document.body.removeChild(successModal);
                }, 500);
            }, 3000);
        }

        function showErrorMessage(message) {
            const errorModal = document.createElement('div');
            errorModal.classList.add('error-modal');
            errorModal.textContent = message;
            document.body.appendChild(errorModal);

            setTimeout(() => {
                errorModal.classList.add('fade-out');
                setTimeout(() => {
                    document.body.removeChild(errorModal);
                }, 500);
            }, 3000);
        }
    </script>
</body>
</html>
