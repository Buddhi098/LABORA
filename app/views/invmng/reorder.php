<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta http-equiv="refresh" content="600; url=http://localhost/labora/user/logout"> -->
    <link rel="stylesheet" href="<?php echo APPROOT.'/public/css/invmng/reorder.css'?>">
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

        <h2><i class="fa-solid fa-calendar-check"></i>Chemicals Below Alert Quantity</h2>
        
        <div class="add">
            <a href="<?php echo URLROOT?>invmng/getReorderForm" class="addbtn"><ion-icon name="add"></ion-icon> Make an order</a>
        </div>
        <div class="search-container">
        <input type="text" class="search-box" id="searchInput" placeholder="Search...">
        <button class="search-button">Search</button>
        </div>

        <table id="myTable">
            <thead>
                    <th>Item Id</th>
                    <th>Item Name</th>
                    <th>Quantity in the stock</th>
                    <th>Reorder Limit</th>
                    
            </thead >
        <tbody>
                <div class='table_body'>
                <?php
                $reversedArray = array_reverse($data, true);
               
                    foreach ($reversedArray as $index => $row) {
                        echo '
                        <tr>
                        <td>'.$row['id'].'</td>
                        <td>'.$row['Item_name'].'</td>
                        <td>'.$row['id'].'</td>
                        <td>'.$row['reorder_limit'].'</td>
                      
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
       
    </div>
</body>
</html>