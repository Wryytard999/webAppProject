<?php
include("../php web/connection.php");
include("../php web/functions.php");
include("../php web/appels.php");
include("../php web/cheker.php");
include("../php web/listes.php");
if(isset($_GET['ID_PROFESSEUR']))
{
  $id_prof = $_GET['ID_PROFESSEUR'];

}






?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../style web/affichageProf.css" />
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
            <div><h1 class="bigTitle">Professeur</h1></div>
            <div class="buttons">
                <div><button class="brownButton">Modifier</button></div>
                <div><button class="whiteButton">Supprimer</button></div>
            </div>
        </div>
        <div class="dataContainersContainer">
        <?php
          $data = appel_prof(CONNECTION, $id_prof);
          while($row = mysqli_fetch_assoc($data))
          {
            printf(" <div class='dataContainer'>
            <h4 class='miniTitle'>Nom complet:</h4>
            <h4 class='personalData'>%s %s</h4>
        </div>
        <div class='dataContainer'>
            <h4 class='miniTitle'>Email universitaire:</h4>
            <h4 class='personalData'>%s</h4>
        </div>
        <div class='dataContainer'>
            <h4 class='miniTitle'>Email secondaire:</h4>
            <h4 class='personalData'>%s</h4>
        </div>
        <div class='dataContainer'>
            <h4 class='miniTitle'>Telephone:</h4>
            <h4 class='personalData'>%s</h4>
        </div>
        <div class='dataContainer'>
            <h4 class='miniTitle'>Code Apogee:</h4>
            <h4 class='personalData'>%s</h4>
        </div>", $row['PRENOM'] , $row['NOM']
              ,$row['EMAIL_EDU'],$row['EMAIL_PERS']
              ,$row['CONTACT'], $row['CODE_APOGE'] );
          }
        
        ?>   
        
        <!--
             <div class="dataContainer">
                <h4 class="miniTitle">Nom complet:</h4>
                <h4 class="personalData">Wadia EL Bahri</h4>
            </div>
            <div class="dataContainer">
                <h4 class="miniTitle">Email universitaire:</h4>
                <h4 class="personalData">wadia.elbahri@edu.uiz.ac.ma</h4>
            </div>
            <div class="dataContainer">
                <h4 class="miniTitle">Email secondaire:</h4>
                <h4 class="personalData">elbahriwadi999@gmail.com</h4>
            </div>
            <div class="dataContainer">
                <h4 class="miniTitle">Telephone:</h4>
                <h4 class="personalData">0691903716</h4>
            </div>
            <div class="dataContainer">
                <h4 class="miniTitle">Adresse:</h4>
                <h4 class="personalData">ENSA Agadir</h4>
            </div>
        
      -->
      </div>
        <h3 class="miniTitle">Jurys:</h3>
        <div class="table">
          <div class="tableHead">
            <p class="data">Type</p>
            <p class="data">Filiere</p>
            <p class="data">Niveau</p>
          </div>
          <?php
          $id_respo = idProfToIdRespo(CONNECTION,$id_prof);
          $query = "SELECT j.TYPE_DE_JURY , n.LBL_NIVEAUX ,f.LBL_FILLIERE , j.ID_JURY
                    FROM jury AS j , niveau AS n , filliere AS f
                    WHERE j.ID_NIVEAU = n.ID_NIVEAU
                    AND   n.ID_FILLIERE = f.ID_FILLIERE 
                    AND j.ID_RESPONSABLE = '$id_respo'
                    ORDER BY ID_JURY";
          $result = mysqli_query(CONNECTION,$query);
          while($row = mysqli_fetch_assoc($result))
          {
            printf("<div class='tableContainer'>
                    <a href='affichageJury.php?ID_JURY=%s'>
                      <div class='tableRow'>
                        <p class='data'>%s</p>
                        <p class='data'>%s</p>
                        <p class='data'>%s</p>
                      </div>
                    </a>
                  </div>"
                ,$row['ID_JURY'],$row['TYPE_DE_JURY'],$row['LBL_FILLIERE'],$row['LBL_NIVEAUX']);
                        
          }
          ?>
          </div>
          <!--
          <div class="tableContainer">
            <a href="">
              <div class="tableRow">
                <p class="data">recrutement</p>
                <p class="data">Genie Informatique</p>
                <p class="data">Genie Informatique 2</p>
              </div>
            </a>
        -->
            
          
        <h3 class="miniTitle">Visites:</h3>
        <div class="table">
          <div class="tableHead">
            <p class="data">Destination</p>
            <p class="data">Niveau</p>
            <p class="data">Date depart</p>
          </div>
          <div class="tableContainer">
            <a href="">
              <div class="tableRow">
                <p class="data">Taroudant</p>
                <p class="data">Genie Informatique 1</p>
                <p class="data">04/09/2024</p>
              </div>
            </a>
            <a href="">
              <div class="tableRow">
                <p class="data">Taroudant</p>
                <p class="data">Genie Informatique 1</p>
                <p class="data">04/09/2024</p>
              </div>
            </a>
            <a href="">
              <div class="tableRow">
                <p class="data">Taroudant</p>
                <p class="data">Genie Informatique 1</p>
                <p class="data">04/09/2024</p>
              </div>
            </a>
            <a href="">
                <div class="tableRow">
                  <p class="data">Taroudant</p>
                  <p class="data">Genie Informatique 1</p>
                  <p class="data">04/09/2024</p>
                </div>
              </a>
          </div>
        </div>
        <h3 class="miniTitle">Encadrements:</h3>
        <div class="table">
          <div class="tableHead">
            <p class="data">Etudiant</p>
            <p class="data">Filiere</p>
            <p class="data">Niveau</p>
          </div>
          <div class="tableContainer">
            <a href="">
              <div class="tableRow">
                <p class="data">Younes EL bandki</p>
                <p class="data">Genie Informatique</p>
                <p class="data">Genie Informatique 2</p>
              </div>
            </a>
            <a href="">
                <div class="tableRow">
                  <p class="data">Younes EL bandki</p>
                  <p class="data">Genie Informatique</p>
                  <p class="data">Genie Informatique 2</p>
                </div>
              </a>
            <a href="">
              <div class="tableRow">
                <p class="data">Younes EL bandki</p>
                <p class="data">Genie Informatique</p>
                <p class="data">Genie Informatique 2</p>
              </div>
            </a>
            <a href="">
              <div class="tableRow">
                <p class="data">Younes EL bandki</p>
                <p class="data">Genie Informatique</p>
                <p class="data">Genie Informatique 2</p>
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
