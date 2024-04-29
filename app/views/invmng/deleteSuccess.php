<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo APPROOT.'/public/css/invmng/deleteSuccess.css'?>">
    <script src="<?php echo APPROOT.'/public/js/invmng/deleteSuccess.js';?>"></script>
    <title>Delete Success</title>
</head>
<body>
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <p>Item deleted successfully.</p>
        </div>
    </div>

    <!-- Redirect or perform any other action after closing the modal -->
    <script>
        function closeModal() {
            var modal = document.getElementById("myModal");
            modal.style.display = "none";
            
            window.location.href = "http://localhost/labora/invmng/product";
        }

        var modal = document.getElementById("myModal");
        modal.style.display = "block";
    </script>
</body>
</html>
