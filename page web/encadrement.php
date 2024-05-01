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
        if(isset($_POST['Etudiant']) && isset($_POST['Fil']) && isset($_POST["Niveau"]) && isset($_POST['respo']))
        {
          $etudiant = $_POST['Etudiant'];
          $fillier = $_POST['Fil'];
          $niveau = $_POST['Niveau'];
          $id_prof = $_POST['respo'];
          $date = $_POST['date'];

          if(!cheker_encadrement(CONNECTION,$id_prof,$etudiant,$niveau))
          {
              $requet="INSERT INTO `encadrement` (`ID_PROFESSEUR`, `ID_NIVEAU`, `ETUDIANT`, `DATE`) 
                         values ('$id_prof','$niveau','$etudiant','$date')";
              $result = mysqli_query(CONNECTION, $requet);
              
              if($result)
              {
                printf("<div class='success-message'>
                          <p> Encadrement enregistré avec succès</p>
                       </div>");
                header('refresh');
              }
          }
          else
          {
            printf("<div class='error-message'>
                      <p> Encadrement existe déjà </p>
                    </div>");
            header('refresh');
          }
        }
        else
      { 
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
    <link rel="stylesheet" href="../style web/encadrement.css" />
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
            <a href="encadrement.php" class="selected"><h3>Encadrement</h3></a>
          </div>
        </div>
        <a href="Main.html"><button class="whiteButton">END</button></a>
      </div>
    </div>
      <div class="mainPage">
        <div><h1 class="bigTitle">Encadrement:</h1></div>
        <div class="table">
          <div class="tableHead">
            <p class="data">Encadrant</p>
            <p class="data">Etudiant</p>
            <p class="data">Niveau</p>
            <p class="data">Filiere</p>
          </div>
          <div class="tableContainer">
            
          <?php
          $data = appel_encadrement(CONNECTION);
          while($row = mysqli_fetch_assoc($data))
          {
            printf("    <a href='affichageEnca.php'>
                          <div class='tableRow'>");
            $prof = idProfToProf(CONNECTION,$row['ID_PROFESSEUR']);
            while($profData = mysqli_fetch_assoc($prof))
            {
              printf("      <p class='data'>%s %s</p>",
              $profData['PRENOM'],$profData['NOM']);
            }              
            printf("        <p class='data'>%s</p>",
            $row["ETUDIANT"]);
            $niv = idNivToNiv(CONNECTION,$row["ID_NIVEAU"]);
            while($nivData = mysqli_fetch_assoc($niv))
            {
              printf("      <p class='data'>%s</p>",
              $nivData['LBL_NIVEAUX']);
            }
            $fil = idNivToFill(CONNECTION,$row['ID_NIVEAU']);
            while($filData = mysqli_fetch_assoc($fil))
            {
              printf("      <p class='data'>%s</p>
                          </div>
                        </a>",
              $filData['LBL_FILLIERE']);
            }
          }
          ?>

          </div>
        </div>
        <div><h1 class="bigTitle">Ajouter un encadrement:</h1></div>
        <div class="formContainer">
          <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
            <div class="inputContainer">
                <label for="Destination">Etudiant</label>
                <input type="text" name="Etudiant" id="Destination" placeholder="Etudiant">
            </div>
            <div class="inputContainer">
                <label for="Fil">Filiere:</label>
                <select id="Fil" name="Fil" class="dropDown">
                <?php
                  $data = filliere_liste(CONNECTION);
                  while($row = mysqli_fetch_assoc($data))
                  {
                    printf(
                      "<option value='%d'>%s</option>",
                      $row['ID_FILLIERE'],$row['LBL_FILLIERE']
                    );
                  }
                 ?>
                </select>
            </div>
            <div class="inputContainer">
                <label for="Niveau">Niveau:</label>
                <select id="Niveau" name="Niveau" class="dropDown">
                <?php
                  $data = niveau_liste(CONNECTION);
                  while($row = mysqli_fetch_assoc($data))
                  {
                    printf("<option value='%d'> %s </option>",
                      $row['ID_NIVEAU'],$row['LBL_NIVEAUX']
                    );
                  }
                  ?>
                </select>
            </div>
            <div class="inputContainer">
                <label for="respo">Encadrant:</label>
                <select id="respo" name="respo" class="dropDown">
                <?php
                  $data = prof_list(CONNECTION);
                  while ($row = mysqli_fetch_assoc($data)) {
                    printf(
                      "<option value='%d'>%s %s</option>",
                      htmlspecialchars($row['ID_PROFESSEUR'], ENT_QUOTES),
                      htmlspecialchars($row['PRENOM'], ENT_QUOTES),
                      htmlspecialchars($row['NOM'], ENT_QUOTES)
                  );  
                  }
                 ?>
                </select>
                
            </div>
            <div class="inputContainer">
                <label for="dateStart">Date:</label>
                <input type="date" name="date" class="date" id="dateStart">
            </div>
            <div class="inputContainer"></div>
            <div class="buttonContainer">
              <input type="submit" name='submit' value="Ajouter" class="brownButton">
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
