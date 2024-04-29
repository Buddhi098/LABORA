<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Builder</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="<?php echo APPROOT . '/public/css/mlt/template_form.css' ?>">
</head>

<body>
    <?php require_once 'components/nevbar.php' ?>
    <div class="container_1">
        <div class="container_3">
            <div class="form-container">
                <h1>Create Form Template</h1>
                <p>Customized Medical Report Form Creation</p>
                <div class="form-group">
                    <label for="form-name">Form Name</label>
                    <input type="text" id="form-name" placeholder="Enter form name">
                </div>
                <div class="form-fields">
                    <div class="field-group">
                        <div class="form-group">
                            <label for="field-label-0">Field Label</label>
                            <input type="text" id="field-label-0" placeholder="Enter field label">
                        </div>
                        <div class="form-group">
                            <label for="field-type-0">Field Type</label>
                            <select id="field-type-0">
                                <option value="text">Text</option>
                                <option value="number">Number</option>
                            </select>
                        </div>
                        <button class="remove-field">
                            <i class="fas fa-minus-circle"></i>
                        </button>
                    </div>
                </div>
                <button class="add-field" id='add_field_btn'>
                    <i class="fas fa-plus-circle"></i> Add Field
                </button>
                <div class="actions">
                    <button class="save-form" id="save_form">
                        <i class="fas fa-save"></i> Save Form
                    </button>
                </div>
            </div>
        </div>
    </div>


    <script>
        // JavaScript code to enhance the form builder functionality

        // Function to create a new field group
        function createFieldGroup() {
            const fieldGroup = document.createElement('div');
            fieldGroup.classList.add('field-group');

            const fieldLabelGroup = document.createElement('div');
            fieldLabelGroup.classList.add('form-group');

            const fieldLabel = document.createElement('label');
            fieldLabel.setAttribute('for', `field-label-${document.querySelectorAll('.field-group').length}`);
            fieldLabel.textContent = 'Field Label';

            const fieldLabelInput = document.createElement('input');
            fieldLabelInput.type = 'text';
            fieldLabelInput.id = `field-label-${document.querySelectorAll('.field-group').length}`;
            fieldLabelInput.placeholder = 'Enter field label';

            fieldLabelGroup.appendChild(fieldLabel);
            fieldLabelGroup.appendChild(fieldLabelInput);

            const fieldTypeGroup = document.createElement('div');
            fieldTypeGroup.classList.add('form-group');

            const fieldTypeLabel = document.createElement('label');
            fieldTypeLabel.setAttribute('for', `field-type-${document.querySelectorAll('.field-group').length}`);
            fieldTypeLabel.textContent = 'Field Type';

            const fieldTypeSelect = document.createElement('select');
            fieldTypeSelect.id = `field-type-${document.querySelectorAll('.field-group').length}`;

            const fieldTypeOptions = ['Text', 'Number'];
            fieldTypeOptions.forEach(option => {
                const optionElement = document.createElement('option');
                optionElement.value = option.toLowerCase();
                optionElement.textContent = option;
                fieldTypeSelect.appendChild(optionElement);
            });

            fieldTypeGroup.appendChild(fieldTypeLabel);
            fieldTypeGroup.appendChild(fieldTypeSelect);

            const removeButton = document.createElement('button');
            removeButton.classList.add('remove-field');
            removeButton.innerHTML = '<i class="fas fa-minus-circle"></i>';
            removeButton.addEventListener('click', removeFieldGroup);

            fieldGroup.appendChild(fieldLabelGroup);
            fieldGroup.appendChild(fieldTypeGroup);
            fieldGroup.appendChild(removeButton);

            return fieldGroup;
        }

        // Function to remove a field group
        function removeFieldGroup(event) {
            const fieldGroup = event.target.closest('.field-group');
            fieldGroup.remove();
        }

        // Add event listener to the "Add Field" button
        let field_count = 1;
        document.querySelector('.add-field').addEventListener('click', () => {
            field_count++;
            if(field_count > 16){
                alert('You can only add 16 fields');
                document.querySelector('.add_field_btn').disabled = true;
                document.querySelector('.add_field_btn').classList.add('button_disabled');
                return;
            }
            const fieldGroup = createFieldGroup();
            document.querySelector('.form-fields').appendChild(fieldGroup);
        });

        // Add event listener to the "Save Form" button
        
        document.querySelector('.save-form').addEventListener('click', () => {

            const formName = document.getElementById('form-name').value;
            const formFields = [];

            document.querySelectorAll('.field-group').forEach(group => {
                const fieldLabel = group.querySelector('input[type="text"]').value;
                const fieldType = group.querySelector('select').value;
                formFields.push({ label: fieldLabel, type: fieldType });
            });

            const baseLink = window.location.origin;
            const link = `${baseLink}/labora/MLT/setFormTemplate`
            const formData = new FormData();
            formData.append('form-name', formName);
            formData.append('form-fields', JSON.stringify(formFields));

            fetch(link, {
                method: 'POST',
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        console.log('success')
                    } else {
                        console.log('error')
                    }
                    const link = `${baseLink}/labora/MLT/medicalTests`;
                    window.location.href = link;
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        });
    </script>
</body>

</html>