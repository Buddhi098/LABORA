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
            <h2>Edit Inventory Form</h2>
            <p>Update the inventory chemical details below.</p>
            <form id="editInventoryForm">

                <div class="form-row">
                    <div class="form-group">
                        <label for="itemID">Chemical ID</label>
                        <input type="text" id="itemId" name="itemId" value="<?php echo $data['itemID']; ?>" readonly>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="itemName">Chemical Name</label>
                        <input type="text" id="itemName" name="itemName" value="<?php echo $data['itemName']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="manufacturer">Manufacturer</label>
                        <input type="text" id="manufacturer" name="manufacturer" value="<?php echo $data['manufacturer']; ?>" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="reorderLimit">Reorder Limit</label>
                        <input type="number" id="reorderLimit" name="reorderLimit" value="<?php echo $data['reorderLimit']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="unitOfMeasure">Unit of Measurement</label>
                        <input type="text" id="unitOfMeasure" name="unitOfMeasure" value="<?php echo $data['unitOfMeasure']; ?>"  required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group" style="width: 100%;">
                        <label for="description">Description</label>
                        <textarea id="description" name="description" value="<?php echo $data['description']; ?>" ></textarea>
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
        
        const editInventoryForm = document.getElementById('editInventoryForm');

        editInventoryForm.addEventListener('submit', e=> {
            e.preventDefault(); 

            const formData = new FormData(editInventoryForm);
            const baseLink = window.location.origin;
            const link = `${baseLink}/labora/invmng/editInventoryDetails`;

            fetch(link, {
            method: 'POST',
                body: formData
            })
            .then(res => {
                if (!res.ok) {
                    throw new Error('Error in updating chemical details');
                }
                return res.json();
            })
            .then(data => {
                console.log(data);
                if(data[status]="success"){
                    showSuccessMessage()
                }else{
                    showErrorMessage()
                }
            })
            .catch(err => {
                showErrorMessage()
                console.error(err);
            });
        });

    </script>
    
</body>
</html>