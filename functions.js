//overlay on/off
function on() {
  document.getElementById("overlay").style.display = "block";
}

function off() {
  document.getElementById("overlay").style.display = "none";
}

/* opret nu opgave */

let modal = document.getElementById("myModal");
let btn = document.getElementById("opretBTN");
let span = document.getElementsByClassName("close")[0];

btn.onclick = function() {
modal.style.display = "block";
}

span.onclick = function() {
  modal.style.display = "none";
}

window.onclick = function(event) {
  if (event.target == modal) {  
    modal.style.display = "none";
  }
}