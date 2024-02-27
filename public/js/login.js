function employee(){  
    document.getElementById("employee").style.display = "block";
    document.getElementById("patient").style.display = "none";
    document.getElementById("employee-button").style.background = "gold";
    document.getElementById("employee-button").style.color = "black";

    document.getElementById("patient-button").style.background = "none";
    document.getElementById("patient-button").style.color = "white";
}
function patient(){ 
    document.getElementById("employee").style.display = "none";
    document.getElementById("patient").style.display = "block"; 
    document.getElementById("patient-button").style.background = "gold";
    document.getElementById("patient-button").style.color = "black";

    document.getElementById("employee-button").style.background = "none";
    document.getElementById("employee-button").style.color = "white";
}