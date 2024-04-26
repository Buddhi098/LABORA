<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Import Medical Test Category Details</title>
    <link rel="stylesheet" href="<?php echo APPROOT . '/public/css/mlt/test_form.css' ?>">
    </style>
</head>

<body>
    <?php require_once 'components/nevbar.php' ?>
    <div class="container_1">
        <div class="container_2">
            <h1>Import Medical Test Category Details</h1>
            <p>Use this form to import new medical test category details into the system.</p>
            <form id="test_form">
                <div class="form-group">
                    <label for="test-category-name"><i class="fas fa-file-alt"></i> Test Category Name</label>
                    <input type="text" id="test-category-name" name="test-category-name" required
                        pattern="[a-zA-Z0-9\s]+" title="Please enter alphanumeric characters only">
                </div>
                <div class="form-group">
                    <label for="description"><i class="fas fa-align-left"></i> Description</label>
                    <textarea id="description" name="description" required pattern="[a-zA-Z0-9\s]+"
                        title="Please enter alphanumeric characters only"></textarea>
                </div>
                <div class="form-group">
                    <label for="preparation"><i class="fas fa-flask"></i> Preparation</label>
                    <div class="preparation-container">
                        <div class="preparation-item">
                            <input type="text" id="preparation-1" name="preparation[]" required>
                        </div>
                        <div class="preparation-item">
                            <input type="text" id="preparation-2" name="preparation[]" required>
                        </div>
                        <div class="preparation-item">
                            <input type="text" id="preparation-3" name="preparation[]" required>
                        </div>
                        <div class="preparation-item">
                            <input type="text" id="preparation-4" name="preparation[]" required>
                        </div>
                        <div class="preparation-item">
                            <input type="text" id="preparation-5" name="preparation[]" required>
                        </div>
                        <div class="preparation-item">
                            <input type="text" id="preparation-6" name="preparation[]" required>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="time-duration"><i class="fas fa-clock"></i> Time Duration (minutes)</label>
                    <input type="number" id="time-duration" name="time-duration" required max="120" min="1"
                        title="Please enter a valid time duration in minutes (greater than 0)">
                </div>
                <div class="form-group">
                    <label for="price"><i class="fas fa-dollar-sign"></i> Price</label>
                    <input type="number" id="price" name="price" min="30" required>
                </div>
                <button type="submit" id="import"><i class="fas fa-upload"></i> Import</button>
            </form>
        </div>
    </div>



    <!-- pop success & error messages -->

    <div class="error-message-container" id="ErrorMessage">
        <div class="icon">
            <lord-icon src="https://cdn.lordicon.com/akqsdstj.json" trigger="in" delay="15" state="in-reveal">
            </lord-icon>
        </div>
        <p id="error_msg">Error! Your action was failed.</p>
        <span class="close-button" onclick="hideSuccessMessage()">×</span>
    </div>


    <script>
        const form = document.getElementById('test_form');

        form.addEventListener('submit', function (event) {
            event.preventDefault();

            const formData = new FormData(form);
            console.log('Form data:', formData);
            const baseLink = window.location.origin;
            const link = `${baseLink}/labora/MLT/test_form`;

            fetch(link, {
                method: 'POST',
                body: formData
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {

                    console.log('Data successfully sent to the backend:', data);

                    if (data.success) {
                        const next_page = `${baseLink}/labora/MLT/getFormTemplateGenerator`;
                        window.location.href = next_page;
                    } else {
                        showErrorMessage();
                    }
                })
                .catch(error => {
                    console.error('There was a problem with the fetch operation:', error);
                });
        });

    </script>

    <script src="script.js"></script>
</body>

</html>