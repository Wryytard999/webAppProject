<?php
include("../php web/connection.php");
include("../php web/functions.php");
include("../php web/appels.php");
include("../php web/cheker.php");
include("../php web/listes.php");

$id_visite = null;
$old_id_respo =null;

// Retrieving visite ID if present in the URL
if(isset($_GET['ID_VISITE'])) {
    $id_visite = $_GET['ID_VISITE'];

    // Query to get the responsible ID for the visite
    $query = "SELECT r.ID_PROFESSEUR,r.ID_RESPONSABLE
              FROM visite AS v, responsable AS r
              WHERE v.ID_RESPONSABLE = r.ID_RESPONSABLE
              AND v.ID_VISITE = '$id_visite'";
    $result = mysqli_query(CONNECTION, $query);
    while($row = mysqli_fetch_assoc($result)) {
        $old_id_respo = $row['ID_RESPONSABLE'];
    }
}
if(isset($_POST['submit'])) {
  if(isset($_POST['Destination']) && isset($_POST['respo']) && isset($_POST['Fil'])) {
      $id_visite = htmlspecialchars($_POST['ID_VISITE']);
      $Des = htmlspecialchars($_POST['Destination']);
      $niv = htmlspecialchars($_POST['Fil']);
      $respo = htmlspecialchars($_POST['respo']);
      $date_start = htmlspecialchars($_POST['dateStart']);
      $date_fin = htmlspecialchars($_POST['dateEnd']);
      $note = htmlspecialchars($_POST['notes']);

      // Convert professor to responsible for the jury
      $result = profToRespo(CONNECTION, $respo, 'visite');
      if($result) {
          $id_respo = idProfToIdRespo(CONNECTION, $respo, 'visite');
          $requet = "UPDATE visite
                      SET  LIEU = ?,
                          ID_NIVEAU= ?,
                          ID_RESPONSABLE= ?,
                          DATE_DEBUT = ?,
                          DATE_FIN = ?,
                          NOTE = ?
                    WHERE ID_VISITE = ?";

          $stmt = mysqli_prepare(CONNECTION, $requet);
          mysqli_stmt_bind_param($stmt, "siisssi", $Des, $niv, $id_respo, $date_start, $date_fin, $note, $id_visite);
          $result = mysqli_stmt_execute($stmt);
          if($result) {
              // Display success message
              printf("<div class='success-message'>
                          <p> La visite est modifier par succes </p>
                      </div>");

              header('refresh');
          }
      }
  } else {
      // Display error message for missing fields
      printf("<div class='error'>
                  <p> Erreur  </p>
              </div>");
      header('refresh');
  }
}
elseif(isset($_POST['supprimer'])) {
  // Handling form submission for deleting a jury
  if(isset($_POST['delete_visite'])) {
      $id_jury = $_POST['delete_visite'];
      $query = "DELETE FROM visite WHERE ID_VISITE = '$id_visite'";
      $result = mysqli_query(CONNECTION, $query);
      if($result) {
          // Display success message
          printf("<div class='success-message'>
                      <p> La visite est supprimer par succes </p>
                  </div>");
          
          // Redirect to jury.php after 3 seconds
          header('refresh: 3; url=visites.php');

        }
  }
}



?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../style web/modifierProf.css" />
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
            <a href="visites.php" class="selected"><h3>Visites</h3></a>
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
            <div><h1 class="bigTitle">Visite :</h1></div>
        </div>
        <div class="dataContainersContainer">
                <div class="formContainer">
                  <form action="" method="post">
                    <div class="inputContainer">
                      <label for="Destination">Destination:</label>
                      <input type="text" name="Destination" id="Destination" placeholder="Destination">
                    </div>
                    <div class="inputContainer">
                        <label for="Fil">Niveau:</label>
                        <select id="Fil" name="Fil" class="dropDown">
                        </select>
                    </div>
                    <div class="inputContainer">
                        <label for="respo">Responsable:</label>
                        <select id="respo" name="respo" class="dropDown">
                        </select>
                    </div>
                    <div class="inputContainer">
                        <label for="dateStart">Date depart:</label>
                        <input type="date" name="dateStart" class="date" id="dateStart">
                    </div>
                    <div class="NotesContainer">
                        <label for="notes">Notes:</label>
                        <textarea id="Notes" name="notes" placeholder="notes" rows="4" cols="50"></textarea>
                    </div>
                    <div class="inputContainer">
                        <label for="dateEnd">Date retour:</label>
                        <input type="date" name="dateEnd" class="date" id="dateEnd">
                    </div>
                    <div class="filler"></div>
                    <div class="buttonContainer">
                        <input type="hidden" name="ID_VISITE" value="<?php printf("%d",$id_visite) ?>">
                        <input type="submit" name="submit" value="Sauvegarder" class="brownButton">
                        <div>
                          <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                              <input type="hidden" name="delete_visite" value="<?php  printf("%d",$id_visite) ?>">
                              <input class='whiteButton' type="submit" name="supprimer" value="Supprimer" class="whiteButton">
                            </form>
                          </div>
                        <div><button class="brownButton" id="creerRapport">Creer rapport</button></div>
                    </div>
                  </form>
                </div>
          </div>
        <h3 class="miniTitle">Participants:</h3>
        <div class="table">
          <div class="tableHead">
                <p class="data">Nom complet:</p>
                <p class="data">Email universitaire</p>
          </div>
          <div class="tableContainer">
           
            <?php
            $query = "SELECT pr.ID_PROFESSEUR , pr.PRENOM , pr.NOM,pr.EMAIL_EDU 
                      FROM assister AS a ,professeur AS pr
                      WHERE a.ID_PROFESSEUR = pr.ID_PROFESSEUR AND a.ID_VISITE = '$id_visite'";
            $result = mysqli_query(CONNECTION,$query);
            while($row = mysqli_fetch_assoc($result))
            {
              printf("<a href='affichageProf.php?ID_PROFESSEUR=%s'>
              <div class='tableRow'>
                <p class='data'>%s %s</p>
                <p class='data'>%s</p>
              </div>
            </a>"
          ,$row['ID_PROFESSEUR'],$row['PRENOM'],$row['NOM'],$row['EMAIL_EDU']);
            }
            ?>
          </div>
        </div>
      </div>
    </div>
 </body>
 <script src="../creerRapport.js"></script>
</html>
<?php

try {
    printf("<script>

        // Function to populate dropdown with options
        function populateDropdown1(selectId, options) {
            var selectElement = document.getElementById(selectId);
            
            // Clear existing options
            selectElement.innerHTML = '';

            // Add new options
            options.forEach(function(option) {
                var optionElement = document.createElement('option');
                optionElement.value = option[0]; // Value
                optionElement.textContent = option[1]; // Label
                selectElement.appendChild(optionElement);
            });
        }

        // Function to populate dropdown with options
        function populateDropdown(selectId, options) {
            var selectElement = document.getElementById(selectId);
            selectElement.innerHTML = ''; // Clear existing options
            options.forEach(function(option) {
                var optionElement = document.createElement('option');
                optionElement.value = option[0]; // Value
                optionElement.textContent = option[1]; // Label
                selectElement.appendChild(optionElement);
            });
        }
    ");

    // Loading data for loadData() function
    $reslt = appel_visite(CONNECTION, $id_visite);
    while ($row = mysqli_fetch_assoc($reslt)) {
        printf("
        function loadData() {
            // Example data (you can replace this with data loaded from a source like an API)
            var loadedData = {
                Destination: '%s',
                Notes: '%s'
            };
        
            // Set the input field values with the loaded data
            document.getElementById('Destination').value = loadedData.Destination;
            document.getElementById('Notes').value = loadedData.Notes;
        }

        function setInitialDate() {
            var currentDate = '%s';
            var formattedDate = currentDate; // Format: YYYY-MM-DD
            document.getElementById('dateStart').value = formattedDate;
        }

        function setReturnDate() {
            var currentDate = '%s';
            var formattedDate = currentDate; // Format: YYYY-MM-DD
            document.getElementById('dateEnd').value = formattedDate;
        }
        ", $row['LIEU'], $row['NOTE'], $row['DATE_DEBUT'], $row['DATE_FIN']);
    }

    // Function to load data into dropdowns when the page is loaded
    printf("
        window.onload = function() {
            var niveaux = [];");

    // Retrieving levels associated with the jury
    $query = "SELECT v.ID_NIVEAU, n.LBL_NIVEAUX 
            FROM visite AS v, niveau AS n 
            WHERE v.ID_NIVEAU = n.ID_NIVEAU
            AND v.ID_VISITE = '$id_visite'";
    $result = mysqli_query(CONNECTION, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        printf("
            niveaux.push(['%d','%s']);
            ", $row['ID_NIVEAU'], $row['LBL_NIVEAUX']);
    }

    // Retrieving other levels not associated with the jury
    $query = "SELECT n.ID_NIVEAU, n.LBL_NIVEAUX
            FROM niveau AS n
            WHERE n.ID_NIVEAU NOT IN (SELECT ID_NIVEAU FROM visite WHERE ID_VISITE = '$id_visite')";
    $result = mysqli_query(CONNECTION, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        printf("
            niveaux.push(['%d','%s']);
            ", $row['ID_NIVEAU'], $row['LBL_NIVEAUX']);
    }

    printf("var responsables = [];");

    // Retrieving responsible associated with the jury
    $query = "SELECT p.ID_PROFESSEUR, p.NOM, p.PRENOM
            FROM PROFESSEUR As p, responsable AS r ,visite AS v
            WHERE p.ID_PROFESSEUR = r.ID_PROFESSEUR
            AND r.ID_RESPONSABLE = v.ID_RESPONSABLE
            AND v.ID_VISITE = '$id_visite'";
    $result = mysqli_query(CONNECTION, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        printf("
            responsables.push(['%d','%s %s']);
            ", $row['ID_PROFESSEUR'], $row['PRENOM'], $row['NOM']);
    }

    // Retrieving other responsible not associated with the jury
    $query = "SELECT p.ID_PROFESSEUR, p.NOM, p.PRENOM
            FROM PROFESSEUR AS p
            WHERE p.ID_PROFESSEUR NOT IN (
            SELECT r.ID_PROFESSEUR
            FROM responsable AS r
            INNER JOIN visite AS v ON r.ID_RESPONSABLE = v.ID_RESPONSABLE
            WHERE v.ID_VISITE = '$id_visite'
    )";
    $result = mysqli_query(CONNECTION, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        printf("
            responsables.push(['%d', '%s %s']);
            ", $row['ID_PROFESSEUR'], $row['PRENOM'], $row['NOM']);
    }

    printf("
        // Populate 'Niveau' dropdown
        populateDropdown1('Fil', niveaux);

        // Populate 'Encadrant' dropdown
        populateDropdown1('respo', responsables);

        setInitialDate();
        setReturnDate();
        loadData();
    };
</script>");
} catch (Exception $e) {
    echo "Erreur: ", $e->getMessage();
}

?>
