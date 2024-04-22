function openModal() {
  var modal = document.getElementById("customModal");
  modal.style.display = "flex";
}

function closeModal() {
  var modal = document.getElementById("customModal");
  modal.style.display = "none";
}

// Close the modal if the user clicks outside of it
window.onclick = function (event) {
  var modal = document.getElementById("customModal");
  if (event.target === modal) {
    modal.style.display = "none";
  }
};
