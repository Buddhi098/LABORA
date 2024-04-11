
var modal = document.getElementById("deleteModal");


var span = document.getElementsByClassName("close")[0];


var yesBtn = document.getElementById("yesBtn");
var noBtn = document.getElementById("noBtn");


span.onclick = function() {
  modal.style.display = "none";
}

function openModal(id){
  console.log(id)
  document.getElementById('hidden_id').value = id;
  modal.style.display = "block";
}

// this use on view

// yesBtn.onclick = function() {
//   console.log("Item deleted");
//   modal.style.display = "none";
// }

noBtn.onclick = function() {
  modal.style.display = "none";
}

window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}