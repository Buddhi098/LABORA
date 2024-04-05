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
    <?php require_once 'components/nevbar.php' ?>
    <div class="container_1">

    <div class="table-container">
        <h2><i class="fa-solid fa-calendar-check"></i> Products</h2>
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
                <button class="filter-button">Filter By Email</button>
            </div>
        </div>
        <table id="myTable">
            <thead>
                    <th>Index</th>
                    <th>Supplier</th>
                    <th>Added Date</th>
                    <th>Expire Date</th>
                    <th>Quantity</th>
                    <th>Action</th>
            </thead >
        <tbody>
                <div class='table_body'>
                <?php
                $reversedArray = array_reverse($data, true);
                if(count($reversedArray)>1){
                    foreach ($reversedArray as $index => $row) {
                        echo '
                        <tr>
                        <td>'.$index.'</td>
                        <td>'.$row['subID'].'</td>
                        <td>'.$row['item_type'].'</td>
                        <td>'.$row['reorder_limit'].'</td>
                        <td>'.$row['description'].'</td>
                        <td><a href="http://localhost/labora/invmng/itemDetails" class="action-button">Edit</a> <a href="http://localhost/labora/admin/deleteEmployee/" class="action-button">Delete</a></td>
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

    <!-- import table javascript -->
    <script src="<?php echo APPROOT.'/public/js/components/table.js'?>"></script>
</body>
</html>