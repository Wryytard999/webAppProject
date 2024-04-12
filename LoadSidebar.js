function loadSidebar() {
  var xhr = new XMLHttpRequest();
  xhr.open("GET", "sidebar.html", true);
  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4 && xhr.status === 200) {
      document.getElementById("sidebarContainer").innerHTML = xhr.responseText;
    }
  };
  xhr.send();
}
window.onload = loadSidebar;

function hide() {
  var successMessage = document.querySelector(".success-message");
  if (successMessage) {
    setTimeout(function() {
      successMessage.style.display = "none";
    }, 3000);
  }

  var errorMessage = document.querySelector(".error-message");
  if (errorMessage) {
    setTimeout(function() {
      errorMessage.style.display = "none";
    }, 3000);
  }
}

hide(); // Call the function to hide messages
