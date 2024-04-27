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
                    if(count($data) > 0) {
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
                                
                                <a href="" class="action-button-delete">Remove</a>
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

    <!-- import table javascript -->
    <script src="<?php echo APPROOT.'/public/js/components/table.js'?>"></script>

</body>   
</html>

<script>
function getItems(id, quantity) {
    if (quantity > 0) {
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
            })
            .catch(error => {
                console.error('There was a problem with the fetch operation:', error);
            });

        openModal();
    } else {
        // Display "No items in stock" message
        const modalBody = document.getElementById('modal_body');
        modalBody.innerHTML = '<tr><td colspan="4">No Chemicals in the stock</td></tr>';
        openModal();
    }
}
</script>
<!-- <script>
    function getItems(id){
                console.log(id);

                baseLink = window.location.origin
                link = `${baseLink}/labora/invmng/getItemDetails/${id}`
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
                        <td>${data[i]['id']}</td>
                        <td>${data[i]['supplier_id']}</td>
                        <td>${data[i]['expire_date']}</td>
                        <td>${data[i]['quantity']}</td>
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
</script> -->