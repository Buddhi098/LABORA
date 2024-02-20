<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta http-equiv="refresh" content="600; url=http://localhost/labora/user/logout"> -->
    <link rel="stylesheet" href="<?php echo APPROOT.'/public/css/invmng/orderForm.css'?>">
    <!-- <script src="<?php echo APPROOT.'/public/js/invmng/invmng.js';?>"></script> -->
    <!-- static icons -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <!-- annimation icons -->
    <script src="https://cdn.lordicon.com/lordicon-1.1.0.js"></script>
    <title>Inventory Manager dashboard</title>
</head>
<body>
    <?php require_once 'components/invnavbar.php' ?>
    <div class="container_1">
        
    <div class="container_form">
    <h1>Create New Order</h1>
    <p>Place Your Order Here</p>
    <button id="addItem" type="button">Add Item</button>
    <form id="orderForm">
      <div id="items">
        <div class="item">
          <select name="itemName" class="select" required>
            <option value="">Select Item Name</option>
              <?php
                $mockup = '';
                foreach($data['item_name'] as $dt) {
                    $mockup .= '<option value="'.$dt['item_id'].'">'.trim($dt['item_name']).'</option>';
                }
                echo $mockup;
              ?>

          </select>
          <input type="number" name="quantity" placeholder="Quantity" required>
          <input type="text" name="specialNote" placeholder="Special Note">
          <button class="removeItem" type="button">Remove</button>
        </div>
      </div>
          <div class="form-group">
            <label for="expected-date" class="form-label">Expected date:</label>
            <input type="date" id="expected-date" class="form-input" min="<?php echo date('Y-m-d'); ?>">
        </div>
        <div class="form-group">
            <label for="supplier" class="form-label">Supplier:</label>
            <select id="supplier" class="form-select">
                <option value="">Select Supplier</option>
                <?php
                  $mockup = '';
                  foreach($data['supplier_name'] as $dt) {
                      $mockup .= '<option value="'.$dt['sup_id'].'">'.trim($dt['sup_name']).'</option>';
                  }
                  echo $mockup;
                ?>
                <!-- Add more options as needed -->
            </select>
        </div>
      <button id="submit" type="submit">Submit Order</button>
    </form>
  </div>
    
    </div>


    <!-- pop msg -->
    <div class="success-message-container" id="successMessage">
        <p>Success! You Successfully Placed Order.</p>
        <span class="close-button" onclick="hideSuccessMessage()">×</span>
    </div>

    <div class="error-message-container" id="ErrorMessage">
        <p>Error! Your action was failed.</p>
        <span class="close-button" onclick="hideSuccessMessage()">×</span>
    </div>
</body>
</html>


<script>
    document.addEventListener('DOMContentLoaded', function() {
      const addItemButton = document.getElementById('addItem');
      const itemsContainer = document.getElementById('items');

      addItemButton.addEventListener('click', function() {
        const newItem = document.createElement('div');
        newItem.classList.add('item');
        newItem.innerHTML = `
          <select name="itemName" class="select" required>
            <option value="">Select Item Name</option>
            <?php
                $mockup = '';
                foreach($data['item_name'] as $dt) {
                    $mockup .= '<option value="'.$dt['item_id'].'">'.trim($dt['item_name']).'</option>';
                }
                echo $mockup;
            ?>
            <!-- Add more options as needed -->
          </select>
          <input type="number" name="quantity" placeholder="Quantity" required>
          <input type="text" name="specialNote" placeholder="Special Note">
          <button class="removeItem" type="button">Remove</button>
        `;
        itemsContainer.appendChild(newItem);
      });

      itemsContainer.addEventListener('click', function(event) {
        if (event.target.classList.contains('removeItem')) {
          event.target.parentElement.remove();
        }
      });

      const orderForm = document.getElementById('orderForm');
      orderForm.addEventListener('submit', function(event) {
        event.preventDefault(); 
        let formdata = new FormData(orderForm)
        let items = {}
        let item = {}
        let i = 0;
        let j = 0;
        for(data of formdata.entries()){
          item[data[0]] = sanitize(data[1]);
          i++;
          if(i%3==0){
            items[j] = item;
            item = {};
            j++;
          }
        }

        let expected_date = document.getElementById('expected-date').value;
        let supplier = document.getElementById('supplier').value

        let order = {};
        order['items'] = items;
        order['expected_date'] = expected_date;
        order['supplier'] = supplier;


        console.log(order);

        baseUrl = window.location.origin
        const url = `${baseUrl}/labora/invmng/submitOrderForm`

        console.log(url)

        const options = {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify(order)
        }

        fetch(url , options)
        .then(response => {
            if(!response.ok){
              throw new Error('Network response was not ok');
            }
            return response.json()

        })
        .then(responseData => {
          // console.log(responseData);

          let btn = document.getElementById('submit')
          btn.disabled = true;
          btn.classList.add('btn-disable')

          if(responseData['msg']){
                showSuccessMessage();
          }else{
                showErrorMessage();
          }

        }).catch(error =>{
          console.error('There wa a problem with the fetch operation' , error.message);
        })



      });
    });
  </script>