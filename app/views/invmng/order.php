<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta http-equiv="refresh" content="600; url=http://localhost/labora/user/logout"> -->
    <link rel="stylesheet" href="<?php echo APPROOT.'/public/css/invmng/order.css'?>">
    <script src="<?php echo APPROOT.'/public/js/invmng/invmng.js';?>"></script>
    <!-- static icons -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <!-- annimation icons -->
    <script src="https://cdn.lordicon.com/lordicon-1.1.0.js"></script>
    <title>Inventory Manager dashboard</title>
</head>
<body>
    <?php require_once 'components/nevbar.php' ?>
    <div class="container_1">

    <div class="table-container">
        <h2><i class="fa-solid fa-calendar-check"></i> Purchase Order</h2>
        <div class="add">
            <a href="<?php echo URLROOT?>invmng/getorderForm" class="addbtn"><ion-icon name="add"></ion-icon> Make an order</a>
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
                <button class="filter-button">Filter By Email</button>
            </div>
        </div>
        <table id="myTable">
            <thead>
                <th>Order ID</th>
                <th>Supplier Name</th>
                <th>Order Date</th>
                <th>Expected Delivery Date</th>
                <th>Total Cost</th>
                <th>Status</th>
                <th>Items Ordered</th>
                <th>Invoices</th>
                <th>action</th>
            </thead >
        <tbody>
                <div class='table_body'>
                    <?php
                    $array = array_reverse($data , true);

                    foreach($array as $index=>$row){
                        echo '
                            <tr>
                            <td>'.$row['orderid'].'</td>
                            <td>'.$row['Supplier_name'].'</td>
                            <td>'.$row['order_date'].'</td>
                            <td>'.$row['expected_date'].'</td>
                            <td>Not_Available</td>
                            <td>'.$row['status'].'</td>
                            <td><button href="#" class="action-button" onclick="getItems('.$row['id'].')">View</button></td>
                            <td>Not_Available</td>
                            <td><button href="#" class="action-button" style="padding:7px 10px;">Cancel</button> <button href="http://localhost/labora/admin/deleteEmployee/" class="action-button" style="padding:7px 10px;">Delete</button></td>
                            </tr>';

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
        <h4 class="modal-title"><i class="fa-solid fa-flask"></i> Ordered Items</h4>
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
        <button type="button" class="btn-primary">Save Changes</button>
      </div>

    </div>
  </div>

    <!-- import table javascript -->
    <script src="<?php echo APPROOT.'/public/js/components/table.js'?>"></script>
</body>
</html>

<script>
    function getItems(order_id){
                console.log(order_id);

                baseLink = window.location.origin
                link = `${baseLink}/labora/invmng/getOrderItems/${order_id}`
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