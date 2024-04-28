<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../style web/affichagejury.css" />
    <title>Document</title>
    <script src="../LoadSidebar.js"></script>
  </head>
  <body>
    <div class="containAll">
    <div class="sideContainer">
      <div class="navBar">
        <div class="Logo">
          <a href="Main.html"><img src="../assets/logo.svg" alt="Logo" /></a>
        </div>
        <div class="container">
          <div class="title">
            <a href="Professeurs.php"><h3>Professeurs</h3></a>
          </div>
          <div class="title">
            <a href="Filiere.php"><h3>Filieres</h3></a>
          </div>
          <div class="title">
            <a href="jury.php"><h3>Jury</h3></a>
          </div>
          <div class="title">
            <a href="visites.php"><h3>Visites</h3></a>
          </div>
          <div class="title">
            <a href="encadrement.php"><h3>Encadrement</h3></a>
          </div>
        </div>
        <a href="Main.html"><button class="whiteButton">END</button></a>
      </div>
    </div>
      <div class="mainPage">
        <div class="header">
            <div><h1 class="bigTitle">Jury Akessas-recrutement:</h1></div>
            <div class="buttons">
                <div><button class="brownButton">Modifier</button></div>
                <div><button class="whiteButton">Supprimer</button></div>
            </div>
        </div>
        <div class="dataContainersContainer">
            <div class="dataContainer">
                <h4 class="miniTitle">Responsable:</h4>
                <h4 class="personalData">Hamid Akessas</h4>
            </div>
            <div class="dataContainer">
                <h4 class="miniTitle">Type:</h4>
                <h4 class="personalData">recrutement</h4>
            </div>
            <div class="dataContainer">
                <h4 class="miniTitle">Niveau:</h4>
                <h4 class="personalData">Genie Informatique 1</h4>
            </div>
            <div class="dataContainer">
                <h4 class="miniTitle">Date debut:</h4>
                <h4 class="personalData">04/11/2024</h4>
            </div>
            <div class="dataContainer">
                <h4 class="miniTitle">Date fin:</h4>
                <h4 class="personalData">04/27/2024</h4>
            </div>
            <div class="filler"></div>
            <div class="dataContainer">
                <h4 class="miniTitle">Notes:</h4>
                <h4 class="Notes">Laboris aliqua eiusmod enim cupidatat ad dolore aliqua eu minim aliqua. Ullamco veniam ut consectetur adipisicing Lorem consectetur ipsum tempor nostrud mollit amet nostrud exercitation. Ad officia ut ipsum consectetur Lorem nulla. Aute est mollit incididunt quis quis commodo magna dolore aute. Culpa ea reprehenderit sunt eu dolor voluptate. Mollit exercitation magna quis esse consectetur adipisicing sunt magna mollit nostrud.</h4>
            </div>
        </div>
        <h3 class="miniTitle">Participants:</h3>
        <div class="table">
          <div class="tableHead">
                <p class="data">Nom complet:</p>
                <p class="data">Email universitaire</p>
          </div>
          <div class="tableContainer">
            <a href="">
              <div class="tableRow">
                <p class="data">Wadia</p>
                <p class="data">sgdfuhsbg@uiz.ac.ma</p>
              </div>
            </a>
            <a href="">
              <div class="tableRow">
                <p class="data">Wadia</p>
                <p class="data">sgdfuhsbg@uiz.ac.ma</p>
              </div>
            </a>
            <a href="">
                <div class="tableRow">
                  <p class="data">Wadia</p>
                  <p class="data">sgdfuhsbg@uiz.ac.ma</p>
                </div>
              </a>
            <a href="">
              <div class="tableRow">
                <p class="data">Wadia</p>
                <p class="data">sgdfuhsbg@uiz.ac.ma</p>
              </div>
            </a>
          </div>
        </div>
        <div><button class="brownButton">Creer rapport</button></div>
      </div>
    </div>
    <script>
      document.addEventListener("DOMContentLoaded", function() {
  const links = document.querySelectorAll(".container .title a");
  const endButton = document.querySelector(".navBar .whiteButton");

  // Function to handle link click
  function handleLinkClick(link) {
    // Remove the "selected" class from all links
    links.forEach(function(otherLink) {
      otherLink.classList.remove("selected");
    });

    // Add the "selected" class to the clicked link
    link.classList.add("selected");

    // Store the href of the selected link in sessionStorage
    sessionStorage.setItem("selectedLink", link.getAttribute("href"));
  }

  // Check if there's a stored selected link on page load
  const selectedLink = sessionStorage.getItem("selectedLink");

  if (selectedLink) {
    // Apply the "selected" class to the previously selected link
    const previouslySelectedLink = document.querySelector(
      `.container .title a[href='${selectedLink}']`
    );

    if (previouslySelectedLink) {
      previouslySelectedLink.classList.add("selected");
    }
  }

  // Attach click event listener to each link
  links.forEach(function(link) {
    link.addEventListener("click", function(event) {
      event.preventDefault();

      // Handle link click (change class and store selected link)
      handleLinkClick(link);

      // Navigate to the clicked link
      window.location.href = link.getAttribute("href");
    });
  });

  // Attach click event listener to the "HAMDOLLAH" button
  if (endButton) {
    endButton.addEventListener("click", function(event) {
      event.preventDefault();

      // Find the "Professeurs" link and add the "selected" class
      const professeursLink = document.querySelector(".container .title a[href='Professeurs.php']");
      if (professeursLink) {
        handleLinkClick(professeursLink);
      }

      // Navigate to the "Main.html" URL
      window.location.href = "Main.html";
    });
  }
});

    </script>
  </body>
</html>
