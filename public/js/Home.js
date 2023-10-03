// display Test type descirption 
document.addEventListener("DOMContentLoaded", function() {
    // Get the button element by its ID
    var button = document.getElementById("first");
    
    // Trigger a click event on the button
    button.click();
});
function CBC() {
    var outputElement = document.getElementById("dis");
    outputElement.innerHTML = "<span>Description:</span><br><br> A CBC is a blood test that measures various components of your blood, including red blood cells, white blood cells, and platelets. It helps diagnose and monitor a variety of health conditions.<br><br><span>Preparation:</span><br><br>1.Fasting is not required.<br>2.Inform your healthcare provider of any medications you are taking.";
}

function Lipid() {
    var outputElement = document.getElementById("dis");
    outputElement.innerHTML = "<span>Description:</span><br><br>A lipid profile measures cholesterol levels in your blood. It is crucial in assessing your risk of heart disease and other cardiovascular conditions.<br><br><span>Preparation:</span><br><br>1.Fasting for at least 9-12 hours is recommended.<br>2.Avoid alcohol and heavy meals before the test.";
}

function Glucose() {
    var outputElement = document.getElementById("dis");
    outputElement.innerHTML = "<span>Description:</span><br><br>This test measures your blood sugar levels and helps diagnose diabetes and monitor its management.<br><br><span>Preparation:</span><br><br>1.Fasting for at least 8 hours is required.<br>2.Drink plenty of water and avoid caffeine before the test.";
}

function Urinalysis() {
    var outputElement = document.getElementById("dis");
    outputElement.innerHTML = "<span>Description:</span><br><br>DXA scans assess bone density and help identify conditions like osteoporosis, aiding in early intervention.<br><br><span>Preparation:</span><br><br>1.No special preparation is needed.<br>2.Wear comfortable clothing without metal.";
}

function Density() {
    var outputElement = document.getElementById("dis");
    outputElement.innerHTML = "<span>Description:</span><br><br>A lipid profile measures cholesterol levels in your blood. It is crucial in assessing your risk of heart disease and other cardiovascular conditions.<br><br><span>Preparation:</span><br><br>1.Fasting for at least 9-12 hours is recommended.<br>2.Avoid alcohol and heavy meals before the test.";
}

function Mammogram() {
    var outputElement = document.getElementById("dis");
    outputElement.innerHTML = "<span>Description:</span><br><br>A mammogram is an X-ray of the breast tissue used for early detection of breast cancer.<br><br><span>Preparation:</span><br><br>1.Avoid using deodorants, perfumes, or powders on the day of the test.<br>2.Wear comfortable clothing.";
}

function XRay() {
    var outputElement = document.getElementById("dis");
    outputElement.innerHTML = "<span>Description:</span><br><br>X-ray imaging uses low doses of radiation to create detailed pictures of the inside of the body, helping diagnose bone fractures, lung infections, and other conditions.<br><br><span>Preparation:</span><br><br>1.Inform your healthcare provider if you are pregnant<br>2.as radiation exposure should be minimized during pregnancy.";
}

function ECG() {
    var outputElement = document.getElementById("dis");
    outputElement.innerHTML = "<span>Description:</span><br><br>An ECG records the electrical activity of the heart, assisting in the diagnosis of heart conditions like arrhythmias and heart attacks.<br><br><span>Preparation:</span><br><br>1.Wear loose-fitting clothing and avoid applying lotions or creams on the chest area before the test.";
}

function BPM() {
    var outputElement = document.getElementById("dis");
    outputElement.innerHTML = "<span>Description:</span><br><br>This test measures your blood pressure to assess your cardiovascular health and risk of conditions like hypertension.<span><br><br>Preparation:</span><br><br>1.Avoid caffeine, smoking, and strenuous exercise for at least 30 minutes before the test.";
}

function MRI() {
    var outputElement = document.getElementById("dis");
    outputElement.innerHTML = "<span>Description:</span><br><br>MRI uses strong magnets and radio waves to create detailed images of internal organs, helping diagnose various conditions, including brain and joint disorders.<span><br><br>Preparation:</span><br><br>1.Inform the healthcare provider of any metallic implants or devices in your body, as they may interfere with the MRI.";
}

function Pap() {
    var outputElement = document.getElementById("dis");
    outputElement.innerHTML = "<span>Description:</span><br><br>A Pap smear is a cervical cancer screening test that collects cells from the cervix to detect abnormal changes.<span><br><br>Preparation:</span><br><br>1.Avoid douching, sexual intercourse, or using vaginal medications for at least 24 hours before the test.";
}

// copy email addres to clipboard

function copyEmail() {
    var email = "sahanyalabs@gmail.com"
    navigator.clipboard.writeText(email);

    alert("Email address copied to clipboard: "+email);
}