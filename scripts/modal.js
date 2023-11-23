// Get the modal and buttons
var modal = document.getElementById("fileUploadModal");
var openModalBtn = document.getElementById("openModalBtn");
var closeModalBtn = document.getElementById("closeModalBtn");
var fileInput = document.getElementById("fileInput");

// When the user clicks the "Open File Dialog" button, open the modal
openModalBtn.addEventListener("click", function() {
  modal.style.display = "block";
});

// When the user clicks the "x" button or outside the modal, close the modal
closeModalBtn.addEventListener("click", function() {
  modal.style.display = "none";
});

window.addEventListener("click", function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
});

// When a file is selected, update a label to show the selected file name
fileInput.addEventListener("change", function() {
  var fileNameLabel = document.getElementById("fileNameLabel");
  fileNameLabel.textContent = fileInput.value.split('\\').pop(); // Display only the file name
});
