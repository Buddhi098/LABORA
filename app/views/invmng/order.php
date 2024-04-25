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
    <link rel="stylesheet" href="<?php echo APPROOT.'/public/css/invmng/components/invTables.css'?>">

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
                <option value="category1">Placed Order</option>
                <option value="category2">Invoice Recieved</option>
                <option value="category1">Order Confirmed</option>
                <option value="category2">Completed</option>
                <option value="category1">Canceled</option>
                </select>
                <button class="filter-button">Filter By Status</button>
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
                <th>Action</th>
                
            </thead >
        <tbody>
                <div class='table_body'>
                    <?php foreach ($data['table_data'] as $order) {
                        if ($order['status'] === 'received invoice') {
                            $text = "Confirm";
                            $class = "btn-0 btn-8";
                        }
                        else if ($order['status'] === 'confirmed order') {
                            $text = "Add to Inventory";
                            $class = 'btn-0 btn-1';
                        }
                        else if ($order['status'] === 'Placed Order') {
                            $text = "Cancel";
                            $class = 'btn-0 btn-3';
                        }
                        else if ($order['status'] === 'complete') {
                            $text = "Remove";
                            $class = 'action-button-edit';
                        } 
                        else{
                            $text = " ";
                            $class = " ";
                        }

                        if ($order['status'] === 'Placed Order') {
                            $text_status = "Placed Order";
                            $class_status = 'status-4';
                        }
                        else if ($order['status'] === 'received invoice') {
                            $text_status = "Invoice Received";
                            $class_status = 'status-1';
                        }
                        else if ($order['status'] === 'confirmed order') {
                            $text_status = "Confirmed";
                            $class_status = 'status-3';
                        }
                        else if ($order['status'] === 'complete') {
                            $text_status = "Completed";
                            $class_status = 'status-2';
                        } 
                        else{
                            $text_status = "Canceled";
                            $class_status = 'status-5';
                        } 
                         
                         
                        echo "<tr>";
                        echo "<td>".$order['orderid']."</td>";
                        echo "<td>".$order['Supplier_name']."</td>";
                        echo "<td>".$order['order_date']."</td>";
                        echo "<td>".$order['expected_date']."</td>";
                        echo "<td>Not_Available</td>";
                        echo "<td><a class='" .$class_status ."'>" . $text_status . "</a></td>";
                        echo "<td><button class='action-button' onclick=\"getItems('".$order['id']."')\">View</button></td>";
                        echo "<td>Not_Available</td>";
                        echo "<td><button class='" .$class ."'>" . $text . "</button></td>";
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
        <!-- <button type="button" class="btn-primary">Save Changes</button> -->
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

