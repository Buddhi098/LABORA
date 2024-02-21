<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta http-equiv="refresh" content="600; url=http://localhost/labora/user/logout"> -->
    <link rel="stylesheet" href="<?php echo APPROOT.'/public/css/supplier/form_item.css'?>">
    <link rel="stylesheet" href="css/form_item.css">
    <script src="<?php echo APPROOT.'/public/js/supplier/quotation.js';?>"></script>
    <!-- static icons -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <!-- annimation icons -->
    <script src="https://cdn.lordicon.com/lordicon-1.1.0.js"></script>
    <title>Item form</title>
</head>
<body>
    
    <div class="container_1">
    <h1>Catalogue Item</h1>
    <form>
        <div class="form-group">
            <!--<label for="category">Select Category</label>-->
            <!-- <select id="category" name="category">
                <option value="lab_assistant">Reagents</option>
                <option value="receptionist">Equipment</option>
                <option value="MLT">Consumables</option>
                <option value="inventory_manager">Inventory Manager</option>
                <option value="supplier">Supplier </option>
                <option value="admin">Admin </option> -->
                <!-- Add more options as needed -->
            <!--</select> -->
        
        </div>
        <div class="form-group">
            <label for="id">Supplier_name:</label>
            <input type="text" id="id" name="id" required>
        </div>
        <div class="form-group">
            <label for="product_name">product_name:</label>
            <input type="text" id="product_name" name="product_name" required>
        </div>
        <div class="form-group">
            <label for="quantity">quantity:</label>
            <input type="text" id="quantity" name="quantity" required>
        </div>
        <div class="form-group">
            <label for="price">price(per unit)</label>
            <input type="text" id="price" name="price" required>
        </div><div class="form-group">
            <label for="dob">purchase Date:</label>
            <input type="date" id="dob" name="dob" required>
        </div>

        <div class="form-group">
            <label for="address">notes:</label>
            <input type="text" id="notes" name="notes" required>
        </div>
        
        <!-- <div class="form-group">
        <label for="gender">Gender:</label><br>
            <input type="radio" id="gender" name="gender" value="male" checked> Male
            <input type="radio" id="gender" name="gender" value="female"> Female
            <input type="radio" id="gender" name="gender" value="other"> Other<br>
        </div> -->
        <button type="submit" class="button">Submit</button>
    </form>
    </div>
</body>
</html>