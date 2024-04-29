<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta http-equiv="refresh" content="600; url=http://localhost/labora/user/logout"> -->
    <link rel="stylesheet" href="<?php echo APPROOT . '/public/css/labassistant/order.css' ?>">
    <script src="<?php echo APPROOT . '/public/js/invmng/invmng.js'; ?>"></script>
    <!-- static icons -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <!-- annimation icons -->
    <script src="https://cdn.lordicon.com/lordicon-1.1.0.js"></script>
    <title>Labassistant dashboard</title>
</head>

<body>
    <?php require_once 'components/nevbar.php' ?>
    <div class="container_1">

        <div class="table-container">
            <h2><i class="fa-solid fa-calendar-check"></i> Item Requests</h2>
            <div class="add">
                <a href="<?php echo URLROOT ?>labassistant/getorderForm" class="addbtn"><ion-icon name="add"></ion-icon>
                    Make Request</a>
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
                    <button class="filter-button">Filter By Status</button>
                </div>
            </div>
            <table id="myTable">
                <thead>
                    <th>ID</th>
                    <th>Request Date</th>
                    <th>Delivered Date</th>
                    <th>Status</th>
                    <th>Items Ordered</th>
                    <th>Note</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    <div class='table_body'>
                        <?php
                        $array = array_reverse($data['request_order'], true);

                        foreach ($array as $index => $row) {
                            $disbale_str = 'button_disabled';
                            $disabled = 'disabled';
                            if ($row['status'] == 'Pending') {
                                $str_class = 'status-4';
                                $disbale_str = '';
                                $disabled = '';
                            } else if ($row['status'] == 'Approved') {
                                $str_class = 'status-3';
                            } else if ($row['status'] == 'Canceled') {
                                $str_class = 'status-8';
                            } else if ($row['status'] == 'Denied') {
                                $str_class = 'status-5';
                            } else {
                                $str_class = '';
                            }

                            if ($row['delivered_date'] == '0000-00-00' || $row['delivered_date'] == null) {
                                $row['delivered_date'] = 'Not Delivered';
                            }
                            echo '
                            <tr>
                            <td>OR-' . $row['id'] . '</td>
                            <td>' . $row['request_date'] . '</td>
                            <td>' . $row['delivered_date'] . '</td>
                            <td><div class="' . $str_class . '">' . $row['status'] . '</div></td>
                            <td><button href="#" class="action-button" onclick="getItems(' . $row['id'] . ')">View</button></td>
                            <td>' . $row['note'] . '</td>
                            <td><button class="btn-0 btn-3 '.$disbale_str.'" onclick=\'openModal2("' . $row['id'] . '")\' '.$disabled.'>Cancel</button></td>
                            </tr>';

                        }

                        ?>

                    </div>
                </tbody>
            </table>
            <div class="pagination">
                <h5 id="table_data"></h5>
                <button onclick="previousPage()" id='prev'>Previous</button>
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


    <!-- pop success & error messages -->
    <!-- popup success messages -->
    <div class="success-message-container" id="successMessage">
        <div class="icon">
            <lord-icon src="https://cdn.lordicon.com/guqkthkk.json" trigger="in" delay="15" state="in-reveal">
            </lord-icon>
        </div>
        <p id="success_msg"> Success! Item Request Placed.</p>
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
            let success = <?php echo isset($_SESSION["success_msg"]) ? json_encode($_SESSION["success_msg"]) : ""; ?>;
            <?php unset($_SESSION["success_msg"]); ?>;
            if (success.trim() !== "") {
                console.log(success);
                document.getElementById('success_msg').innerHTML = success;
                showSuccessMessage();
            }
        }
    </script>



    <!-- delete waring message -->
    <div id="deleteModal2" class="warning-modal">
        <div class="warning-modal-content">
            <span class="close2">&times;</span>
            <p>Are you sure you want to Cancel?</p>
            <div class="btn-container">
                <button id="yesBtn2">Yes</button>
                <button id="noBtn2">No</button>
                <input type="hidden" value="" id="hidden_id2">
            </div>
        </div>
    </div>

    <script>

        var modal2 = document.getElementById("deleteModal2");


        var span2 = document.getElementsByClassName("close2")[0];


        var yesBtn2 = document.getElementById("yesBtn2");
        var noBtn2 = document.getElementById("noBtn2");


        span2.onclick = function () {
            modal2.style.display = "none";
        }

        function openModal2(id) {
            console.log(id)

            document.getElementById('hidden_id2').value = id;
            modal2.style.display = "block";
        }

        noBtn2.onclick = function () {
            modal2.style.display = "none";
        }

        window.onclick = function (event) {
            if (event.target == modal2) {
                modal2.style.display = "none";
            }
        }
        yesBtn2.addEventListener('click', () => {
            let id = document.getElementById('hidden_id2').value;
            console.log(id);
            window.location.href = `<?php echo URLROOT ?>labassistant/cancelRequestOrder/${id}`;

        })
    </script>


    <!-- import table javascript -->
    <script src="<?php echo APPROOT . '/public/js/components/table.js' ?>"></script>
</body>

</html>

<script>
    function getItems(order_id) {
        console.log(order_id);

        baseLink = window.location.origin
        link = `${baseLink}/labora/labassistant/getRequestItems/${order_id}`
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
</script>