<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo APPROOT.'/public/css/invmng/editInventoryForm.css'?>">
    <script src="<?php echo APPROOT.'/public/js/invmng/invmng.js';?>"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://cdn.lordicon.com/lordicon-1.1.0.js"></script>
    <title>Edit Inventory Item</title>
</head>
<body>
<?php require_once 'components/addinventory_nav.php' ?>
    <div class="container_1">
        <div class="form-container">
            <h2>Edit Inventory Item</h2>
            <p>Update the inventory item details below.</p>
            <form id="editInventoryForm">

                <div class="form-row">
                    <div class="form-group">
                        <label for="itemID"><i class="fas fa-user icon"></i> Item ID</label>
                        <input type="text" id="itemId" name="itemId" placeholder="<?php echo $data['id']; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="itemName">Item Name</label>
                        <input type="text" id="itemName" name="itemName" placeholder="<?php echo $data['Item_name']; ?>" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="reorderLimit">Reorder Limit</label>
                        <input type="number" id="reorderLimit" name="reorderLimit" placeholder="<?php echo $data['reorder_limit']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="manufacture">Manufacture</label>
                        <input type="text" id="manufacture" name="manufacture" placeholder="<?php echo $data['manufacturer']; ?>" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group" style="width: 100%;">
                        <label for="description">Description</label>
                        <textarea id="description" name="description" placeholder="<?php echo $data['description']; ?>" ></textarea>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group" style="width: 100%;">
                        <button type="submit">Update</button>
                    </div>
                </div>

            </form>
        </div>
    </div>

    <div class="success-message-container" id="successMessage">
        <p>Success! Your action was completed.</p>
        <span class="close-button" onclick="hideSuccessMessage()">×</span>
    </div>

    <div class="error-message-container" id="ErrorMessage">
        <p>Error! Your action was failed.</p>
        <span class="close-button" onclick="hideSuccessMessage()">×</span>
    </div>

    <script>
        document.getElementById('editInventoryForm').addEventListener('submit', function(event) {
            event.preventDefault();

            const formData = new FormData(this);
            let data = {};
            for (var pair of formData.entries()) {
                data[pair[0]] = sanitize(pair[1]);
            }
            console.log(data);

            baseUrl = window.location.origin;
            const id = document.getElementById('id').value;
            const url = `${baseUrl}/labora/invmng/updateInventoryItem/${id}`;
            console.log(url);

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
                    if (responseData['msg']) {
                        showSuccessMessage();
                    } else {
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