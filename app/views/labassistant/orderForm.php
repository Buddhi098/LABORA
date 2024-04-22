<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- <meta http-equiv="refresh" content="600; url=http://localhost/labora/user/logout"> -->
  <link rel="stylesheet" href="<?php echo APPROOT . '/public/css/labassistant/orderForm.css' ?>">
  <!-- <script src="<?php echo APPROOT . '/public/js/invmng/invmng.js'; ?>"></script> -->
  <!-- static icons -->
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
  <!-- annimation icons -->
  <script src="https://cdn.lordicon.com/lordicon-1.1.0.js"></script>
  <title>Lab Assistant dashboard</title>
</head>

<body>
  <?php require_once 'components/nevbar.php' ?>
  <div class="container_1">

    <div class="container_form">
      <h1>Create New Request</h1>
      <p>Place Your Item Request Here</p>
      <button id="addItem" type="button">Add Item</button>
      <form id="orderForm">
        <div id="items">
          <div class="item">
            <select name="itemName" class="select" required>
              <option value="">Select Item Name</option>
              <?php
              $mockup = '';
              foreach ($data['item_name'] as $dt) {
                $mockup .= '<option value="' . $dt['item_id'] . '">' . trim($dt['item_name']) . '</option>';
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
          <label for="expected-date" class="form-label">Note</label>
          <textarea placeholder="Enter text here"
            style="padding: 10px; border: 1px solid #ccc; border-radius: 3px; font-size: 16px; width: 100%; height: 100px; resize: vertical; transition: border-color 0.3s ease;"
            onfocus="this.style.borderColor='#4d90fe'; this.style.boxShadow='0 0 5px rgba(77, 144, 254, 0.5)';"
            onblur="this.style.borderColor='#ccc'; this.style.boxShadow='none';" id="note"></textarea>
        </div>
        <button id="submit" type="submit">Submit Order</button>
    </div>
    </form>
  </div>
  </div>


  <!-- pop success & error messages -->
  <!-- popup success messages -->
  <div class="success-message-container" id="successMessage">
    <div class="icon">
      <lord-icon src="https://cdn.lordicon.com/guqkthkk.json" trigger="in" delay="15" state="in-reveal">
      </lord-icon>
    </div>
    <p> Success! Appointment Scheduled.</p>
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

</html>


<script>
  document.addEventListener('DOMContentLoaded', function () {
    const addItemButton = document.getElementById('addItem');
    const itemsContainer = document.getElementById('items');

    addItemButton.addEventListener('click', function () {
      const newItem = document.createElement('div');
      newItem.classList.add('item');
      newItem.innerHTML = `
          <select name="itemName" class="select" required>
            <option value="">Select Item Name</option>
            <?php
            $mockup = '';
            foreach ($data['item_name'] as $dt) {
              $mockup .= '<option value="' . $dt['item_id'] . '">' . trim($dt['item_name']) . '</option>';
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

    itemsContainer.addEventListener('click', function (event) {
      if (event.target.classList.contains('removeItem')) {
        event.target.parentElement.remove();
      }
    });

    const orderForm = document.getElementById('orderForm');
    orderForm.addEventListener('submit', function (event) {
      event.preventDefault();
      let formdata = new FormData(orderForm)
      let items = {}
      let item = {}
      let i = 0;
      let j = 0;
      for (data of formdata.entries()) {
        item[data[0]] = data[1];
        i++;
        if (i % 3 == 0) {
          items[j] = item;
          item = {};
          j++;
        }
      }

      let note = document.getElementById('note').value;

      let order = {};
      order['items'] = items;
      order['note'] = note;

      console.log(order);

      baseUrl = window.location.origin
      const url = `${baseUrl}/labora/labassistant/submitRequestOrder`

      console.log(url)

      const options = {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(order)
      }

      fetch(url, options)
        .then(response => {
          if (!response.ok) {
            throw new Error('Network response was not ok');
          }
          return response.json()

        })
        .then(responseData => {
          // console.log(responseData);

          let btn = document.getElementById('submit')
          btn.disabled = true;
          btn.classList.add('btn-disable')

          if (responseData['msg']) {
            showSuccessMessage();
          } else {
            showErrorMessage();
          }

        }).catch(error => {
          console.error('There wa a problem with the fetch operation', error.message);
        })



    });
  });
</script>