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
