<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta http-equiv="refresh" content="600; url=http://localhost/labora/user/logout"> -->
    <link rel="stylesheet" href="<?php echo APPROOT . '/public/css/supplier/orders.css' ?>">
    <script src="<?php echo APPROOT . '/public/js/invmng/invmng.js'; ?>"></script>
    <!-- static icons -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <!-- annimation icons -->
    <script src="https://cdn.lordicon.com/lordicon-1.1.0.js"></script>
    <title>Orders</title>
</head>

<body>
    <?php require_once 'components/nevbar.php' ?>
    <div class="container_1">
        <link rel="stylesheet" href="<?php echo APPROOT . '/public/css/invmng/components/invTables.css' ?>">

        <div class="table-container">
            <h2><i class="fa-solid fa-calendar-check"></i> Order Requests</h2>
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
                    <th>Order Date</th>
                    <th>Expected Delivery Date</th>
                    <th>Total Cost</th>
                    <th>Status</th>
                    <th>Items Ordered</th>
                    <th>Invoice</th>
                    <th>Action</th>

                </thead>
                <tbody>
                    <div class='table_body'>
                        <?php foreach ($data['table_data'] as $order) {

                            if ($order['status'] === 'Placed Order') {
                                $class_status = 'status-4';
                            } else if ($order['status'] === 'Send Invoice') {
                                $class_status = 'status-1';
                            } else if ($order['status'] === 'Approved') {
                                $class_status = 'status-3';
                            } else if ($order['status'] === 'Completed') {
                                $class_status = 'status-2';
                            } else if ($order['status'] === 'Cancelled') {
                                $class_status = 'status-5';
                            }

                            if (!$order['invoice_id']) {
                                $btn_cls1 = 'button_disabled';
                                $btn1 = 'disabled';
                            } else {
                                $btn_cls1 = '';
                                $btn1 = '';
                            }

                            if ($order['status'] !== 'Placed Order') {
                                $btn_cls2 = 'button_disabled';
                                $btn2 = 'disabled';
                            } else {
                                $btn_cls2 = '';
                                $btn2 = '';
                            }
                            echo "<tr>";
                            echo "<td>" . $order['orderid'] . "</td>";
                            echo "<td>" . $order['Supplier_name'] . "</td>";
                            echo "<td>" . $order['order_date'] . "</td>";
                            echo "<td>" . $order['expected_date'] . "</td>";
                            echo "<td><div class='" . $class_status . "'>" . $order['status'] . "</div></td>";
                            echo "<td><button class='action-button' onclick=\"getItems('" . $order['id'] . "')\">View</button></td>";
                            echo "<td><button class='btn-0 btn-2 " . $btn_cls1 . "'  " . $btn1 . " onclick=\"viewInvoice('" . $order['id'] . "')\"><i class='fa-solid fa-eye'></i> View</button></td>";
                            echo "<td><button class='btn-0 btn-2 " . $btn_cls2 . "' " . $btn2 . " onclick=\"getInvoice('" . $order['id'] . "')\"><i class='fa-solid fa-file-invoice'></i> Invoice</button> <button class='btn-0 btn-3 " . $btn_cls2 . "' " . $btn2 . " onclick=\"openModal2('" . $order['id'] . "')\"><i class='fa-solid fa-ban'></i> Cancel</button></td>";
                            echo "</tr>";

                        }

                        ?>

                    </div>
                </tbody>
            </table>
            <div class="pagination">
                <h5 id="table_data"></h5>
                <button onclick="previousPage()" id="prev">Previous</button>
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
        window.onload = showMessage();

        function showMessage() {
            let success = '<?php echo isset($_SESSION["success_msg"]) ? json_encode($_SESSION["success_msg"]) : ""; ?>';
            <?php unset($_SESSION["success_msg"]); ?>;
            if (success.trim() !== "") {
                console.log(success);
                document.getElementById('success_msg').innerHTML = success;
                showSuccessMessage();
            }
        }
    </script>

    <!-- import table javascript -->
    <script src="<?php echo APPROOT . '/public/js/components/table.js' ?>"></script>
</body>

</html>


<script>
    function getItems(order_id) {
        console.log(order_id);

        baseLink = window.location.origin
        link = `${baseLink}/labora/supplier/getOrderItems/${order_id}`
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
                for (let i = 0; i < data.length; i++) {
                    mockup += `
                        <tr>
                        <td>${data[i]['item_id']}</td>
                        <td>${data[i]['item_name']}</td>
                        <td>${data[i]['quantity']}</td>
                        <td>${data[i]['note']}</td>
                        </tr>`
                }
                console.log(mockup)
                document.getElementById('modal_body').innerHTML = mockup;

            })
            .catch(error => {
                console.error('There was a problem with the fetch operation:', error);
            });

        openModal();

    }

    function getInvoice(order_id) {
        console.log(order_id);
        const baseLink = window.location.origin;
        const link = `${baseLink}/labora/supplier/getInvoice/${order_id}`;
        window.location.href = link;
    }
</script>

<script>
    function viewInvoice(order_id) {
        console.log(order_id);
        const baseLink = window.location.origin;
        const link = `${baseLink}/labora/supplier/viewInvoice/${order_id}`;
        window.location.href = link;
    }
</script>

<!-- cancel order -->

<script>

    var modal = document.getElementById("deleteModal");


    var span = document.getElementsByClassName("close")[0];


    var yesBtn = document.getElementById("yesBtn");
    var noBtn = document.getElementById("noBtn");


    span.onclick = function () {
        modal.style.display = "none";
    }

    function openModal2(id, msg = '') {
        console.log(id)
        console.log(msg)

        if (msg != '') {
            document.getElementById('warning_msg').innerHTML = msg
        }
        document.getElementById('hidden_id').value = id;
        modal.style.display = "block";
    }

    noBtn.onclick = function () {
        modal.style.display = "none";
    }

    window.onclick = function (event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

    let yesbtn2 = document.getElementById('yesBtn');
    yesbtn2.addEventListener('click', function () {
        let order_id = document.getElementById('hidden_id').value;
        cancelOrder(order_id);
    });
    function cancelOrder(order_id) {
        console.log(order_id);
        const baseLink = window.location.origin;
        const link = `${baseLink}/labora/supplier/cancelOrder/${order_id}`;
        window.location.href = link;
    }
</script>