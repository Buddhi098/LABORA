<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medical Report Generator</title>
    <link rel="stylesheet" href="<?php echo APPROOT . '/public/css/labassistant/report_form.css' ?>">
</head>

<body>
    <?php require_once 'components/nevbar.php' ?>

    <div class="container_1">
        <?php if (!empty($data['tests'])) { ?>
            <div class="container_3">
                <h1 class="form-title"><i class="fas fa-notes-medical icon"></i>Blood Medical Report</h1>
                <p class="form-subtitle">You can generate a medical report by filling out this form.</p>
                <form id="conversion-form" method='POST' action="<?php echo URLROOT.'labassistant/getMedicalReport'?>" target='_blank'>
                    <?php
                    foreach ($data['tests'] as $test) {
                        echo "<div class='form-group'>
                        <label for='value'>" . $test['label'] . "</label>
                        <div class='input-group'>
                            <input type='" . $test['input_type'] . "' class='value' name='value[]' placeholder='Enter a value' required>
                            <input type='text' class='unit' name='unit[]' placeholder='Unit'>
                            <input type='text' class='reference-value' name='refval[]' placeholder='Reference Value'>
                            <input type='hidden' class='reference-value' name='label[]' placeholder='Reference Value' value='".$test['label']."'>
                        </div>";
                    }
                    ?>
                    <button type="submit"><i class="fas fa-save icon"></i>Create Report</button>
                </form>
                <div id="result"></div>
            </div>
        <?php } else {
            echo "<p style='text-align:center; margin-top:30px ; color: red; padding:20px ; background-color:#ff00001f;'>Report Form Not Available</p>";
        } ?>

    </div>

</body>


<!-- <script>
    let form = document.getElementById('conversion-form');
    form.addEventListener('submit' , e=>{
        e.preventDefault();

        let values = document.querySelectorAll('.value').values();
        console.log(values);
    })
</script> -->

</html>