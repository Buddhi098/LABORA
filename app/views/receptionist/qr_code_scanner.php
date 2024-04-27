<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>QR Code Scanner</title>
    <link rel="stylesheet" href="styles.css" />
    <script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="<?php echo APPROOT . '/public/css/receptionist/qr_code_scanner.css' ?>">
</head>

<body>
    <?php require_once 'components/nevbar.php' ?>
    <div class="container_1">
        <div class="container_9">
            <h1 class="title"><i class="fa-solid fa-qrcode"></i> QR Code Scanner</h1>
            <p class="subtitle">You Can Scan Patient's QR Code Here</p>
            <div class="scanner-container">
                <video id="preview"></video>
                <i class="fas fa-qrcode scanner-icon"></i>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
</body>

</html>

<script>
    let scanner = new Instascan.Scanner({
        video: document.getElementById("preview"),
    });
    scanner.addListener("scan", function (content) {
        const passKey = extractPassKeyFromLink(content);
        passKey1 = passKey.trim();
        console.log(passKey1);
        if (passKey1) {
            const baseLink = window.location.origin;
            const refNo = <?php echo json_encode($data['ref_no']); ?>;
            const link = `${baseLink}/labora/receptionist/checkPassValidity/${passKey1}/${refNo}`
            
            fetch(link)
            .then(response => response.json())
            .then(data => {
                console.log(data);
                if(data.success){
                    window.open(`${baseLink}/labora/receptionist/viewReport/${refNo}` , '_blank')
                } else {
                    window.location.href = `${baseLink}/labora/receptionist/showInvalidQRPage`;
                }
            }).catch(error => {
                console.error(error);
            });
            
        } else {
            alert("QR Code Invalid");
        }
    });
    Instascan.Camera.getCameras().then((cameras) => {
        if (cameras.length > 0) {
            scanner.start(cameras[0]);
        } else {
            console.error("No Camera Found");
        }
    });

    function extractPassKeyFromLink(link) {

    const pattern = /\/checkPassValidity\/([^\/]+)/;

    const match = pattern.exec(link);

    if (match && match.length >= 2) {
        return match[1]; 
    } else {
        return null; 
    }
}
</script>