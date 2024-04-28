<?php

include("../php web/connection.php");
include("../php web/functions.php");
include("../php web/appels.php");
include("../php web/cheker.php");
include("../php web/listes.php");

if($_SERVER['REQUEST_METHOD'] == 'POST')
{   
    if(isset($_POST['submit']))
    {
        if(isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['codeAPOGEE']))
        {
          $nom = htmlspecialchars($_POST['nom']);
          $prenom = htmlspecialchars($_POST['prenom']);
          $email_uni = htmlspecialchars($_POST['emailUni']);
          $email_sec = htmlspecialchars($_POST['emailSec']);
          $code_APOGEE = htmlspecialchars($_POST['codeAPOGEE']);
          $tel = htmlspecialchars($_POST['tel']);

          if(!cheker_prof(CONNECTION,$code_APOGEE))
          {
              $requet="INSERT INTO professeur (CODE_APOGE,PRENOM,NOM,CONTACT,EMAIL_EDU,EMAIL_PERS) 
                        values ('$code_APOGEE','$prenom','$nom','$tel','$email_uni','$email_sec')";
              $result = mysqli_query(CONNECTION, $requet);
              
              if($result)
              {
                printf("<div class='success-message'>
                          <p> Le Prof  %s %s  est ajoute par succes </p>
                      </div>"
                      ,htmlspecialchars($nom, ENT_QUOTES),htmlspecialchars($prenom, ENT_QUOTES));
                header('refresh');
              }
          }
          else
          {
            printf("<div class='error-message'>
                      <p> Le Prof  %s %s  existe déjà </p>
                    </div>"
                    ,htmlspecialchars($nom, ENT_QUOTES),htmlspecialchars($prenom, ENT_QUOTES));
            header('refresh');
          }
        }
        else{
          printf("<div class='error'>
                      <p> Erreur  </p>
                    </div>");
            header('refresh');

        }
      }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../style web/Professeurs.css" />
    <title>Document</title>
    <script defer src="../LoadSidebar.js"></script>
    
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
            <div><h1 class="bigTitle">Professeurs insérées:</h1></div>
                <div class="table">
                  <div class="tableHead">
                    <p class="data">Nom complet</p>
                    <p class="data">Email universitaire</p>
                  </div>
                  <div class="tableContainer">
                      <?php
                          $data =appel_prof(CONNECTION);
                          while ($row = mysqli_fetch_assoc($data)) //  affichage du tableau d'apres BD
                          {
                            printf("<a href='affichageProf.php'>
                                      <div class='tableRow'>
                                        <p class='data'>%s %s</p>
                                        <p class='data'>%s</p>
                                      </div>
                                    </a>"
                                    ,$row["NOM"],$row["PRENOM"],$row["EMAIL_EDU"]);
                          }
                          
                        ?>
                  </div>
                </div>
                <div><h1 class="bigTitle">Ajouter un professeur:</h1></div>
                <div class="formContainer">
                  <form action="" method="post">
                    <div class="inputContainer">
                      <label for="nom">Nom:</label>
                      <input type="text" id="nom" name="nom" placeholder="Nom">
                    </div>
                    <div class="inputContainer">
                      <label for="prenom">Prenom:</label>
                      <input type="text" id="prenom" name="prenom" placeholder="Prenom">
                    </div>
                    <div class="inputContainer">
                      <label for="emailUni">Email universitaire:</label>
                      <input type="email" id="emailUni" name="emailUni" placeholder="exemple@uiz.ac.ma">
                    </div>
                    <div class="inputContainer">
                      <label for="emailSec">Email secondaire:</label>
                      <input type="email" id="emailSec" name="emailSec" placeholder="exemple@gmail.com">
                    </div>
                    <div class="inputContainer">
                      <label for="adr">CODE APOGEE:</label>
                      <input type="text" id="adr" name="codeAPOGEE" placeholder="Code professeur" required>
                    </div>
                      <div class="inputContainer">
                        <label for="tel">Telephone:</label>
                        <input type="tel" id="tel" name="tel" placeholder="0699999999">
                      </div>
                      <div class="buttonContainer">
                        <input type="submit" name="submit" value="Ajouter" class="brownButton">
                      </div>
                  </form>
                </div>
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