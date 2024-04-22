<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Import Signature Photo</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="<?php echo APPROOT . '/public/css/labassistant/addSign.css' ?>">
</head>

<body>
    <?php require_once 'components/nevbar.php' ?>
    <div class="container_1">
        <div class="container_4">
            <h1><i class="fas fa-signature"></i> Import Signature Photo</h1>
            <p class="subtitle">Add your professional signature photo</p>
            <div class="image-container">
                <img id="preview" src="#" alt="Signature Preview" />
            </div>
            <form action="<?php echo URLROOT . 'labassistant/getSignForm' ?>" method='post'
                enctype='multipart/form-data'>
                <input type="file" id="file-input" name="image" accept="image/*" required />
                <button type='submit' class="upload-btn">
                    <i class="fas fa-upload"></i> Upload Photo
                </button>
            </form>
            <p style='text-align:center; color:red;'><?php if (isset($data['error'])) {
                echo $data['error'];
            } ?></p>
        </div>
    </div>
</body>

</html>

<script>
    const fileInput = document.getElementById("file-input");
    const preview = document.getElementById("preview");

    fileInput.addEventListener("change", () => {
        const file = fileInput.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = () => {
                preview.src = reader.result;
            };
            reader.readAsDataURL(file);
        } else {
            preview.src = "#";
        }
    });
</script>