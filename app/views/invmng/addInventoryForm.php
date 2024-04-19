<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta http-equiv="refresh" content="600; url=http://localhost/labora/user/logout"> -->
    <link rel="stylesheet" href="<?php echo APPROOT.'/public/css/invmng/addInventoryForm.css'?>">
    <script src="<?php echo APPROOT.'/public/js/invmng/invmng.js';?>"></script>
    <!-- static icons -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <!-- annimation icons -->
    <script src="https://cdn.lordicon.com/lordicon-1.1.0.js"></script>
    <title>Inventory Manager dashboard</title>
</head>
<body>
<?php require_once 'components/addinventory_nav.php' ?>
    <div class="container_1">

            <div class="form-container">
            <h2>Inventory Entry Form</h2>
            <p>Please fill out the form below to enter new inventory details.</p>
            <form id="inventoryForm">
                <div class="form-row">
                    <div class="form-group">
                        <label for="itemName">Item Name</label>
                        <input type="text" id="itemName" name="itemName" required>
                    </div>
                    <div class="form-group">
                        <label for="manufacture">Manufacture</label>
                        <input type="text" id="manufacture" name="manufacture" required>
                    </div>
                <!-- <div class="form-group">
                    <label for="itemType">Item Type</label>
                    <select id="itemType" name="itemType" required>
                    <option value="">Select Item Type</option>
                    <option value="Chemical">Chemicals</option>
                    <option value="Equipment">Equipment</option>
                    </select>
                </div> -->
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="reorderLimit">Reorder Limit</label>
                        <input type="number" id="reorderLimit" name="reorderLimit" required>
                    </div>
                    <div class="form-group">
                        <label for="unitOfMeasure">Unit of Measurement</label>
                        <input type="text" id="unitOfMeasure" name="unitOfMeasure" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group" style="width: 100%;">
                        <label for="description">Description</label>
                        <textarea id="description" name="description"></textarea>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group" style="width: 100%;">
                        <button type="submit">Submit</button>
                    </div>
                </div>
            </form>
            </div>
    </div>
    <!-- pop msg -->
    <div class="success-message-container" id="successMessage">
        <p>Success! Your action was completed.</p>
        <span class="close-button" onclick="hideSuccessMessage()">×</span>
    </div>

    <div class="error-message-container" id="ErrorMessage">
        <p>Error! Your action was failed.</p>
        <span class="close-button" onclick="hideSuccessMessage()">×</span>
    </div>

<script>
  document.getElementById('inventoryForm').addEventListener('submit', function(event) {
    event.preventDefault();

    const formData = new FormData(this);
    let data = {};
    for (var pair of formData.entries()) {
      data[pair[0]] = sanitize(pair[1]);
    }
    console.log(data)

    baseUrl = window.location.origin
    
    const url = `${baseUrl}/labora/invmng/addInventoryForm`;
    console.log(url)
    const options = {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json' 
        },
        body: JSON.stringify(data) 
    };

    fetch(url, options)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json(); 
        })
        .then(responseData => {

            console.log('Response:', responseData);
            if(responseData['msg']){
                document.getElementById('inventoryForm').querySelectorAll('input').forEach(input => {
                    input.value = '';
                });

                document.getElementById('inventoryForm').querySelectorAll('textarea').forEach(textarea => {
                    textarea.value = '';
                });
                showSuccessMessage();
            }else{
                showErrorMessage();
            }
        })
        .catch(error => {
            console.error('There was a problem with the fetch operation:', error.message);
        });

    });
</script>
</body>
</html>