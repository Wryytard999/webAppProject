<?php
include("../php web/connection.php");
include("../php web/functions.php");
include("../php web/appels.php");
include("../php web/cheker.php");
include("../php web/listes.php");

$id_jury = null;
$old_id_respo =null;

// Retrieving jury ID if present in the URL
if(isset($_GET['ID_JURY'])) {
    $id_jury = $_GET['ID_JURY'];

    // Query to get the responsible ID for the jury
    $query = "SELECT r.ID_PROFESSEUR,r.ID_RESPONSABLE
              FROM jury AS j, responsable AS r
              WHERE j.ID_RESPONSABLE = r.ID_RESPONSABLE
              AND j.ID_JURY = '$id_jury'";
    $result = mysqli_query(CONNECTION, $query);
    while($row = mysqli_fetch_assoc($result)) {
        $old_id_respo = $row['ID_RESPONSABLE'];
    }
}

// Handling form submission for updating jury details
if(isset($_POST['submit'])) {
    if(isset($_POST['type']) && isset($_POST['respo']) && isset($_POST['Fil'])) {
        $id_jury = htmlspecialchars($_POST['ID_JURY']);
        $type = htmlspecialchars($_POST['type']);
        $niv = htmlspecialchars($_POST['Fil']);
        $respo = htmlspecialchars($_POST['respo']);
        $date_start = htmlspecialchars($_POST['dateStart']);
        $date_fin = htmlspecialchars($_POST['dateEnd']);
        $note = htmlspecialchars($_POST['notes']);

        // Convert professor to responsible for the jury
        $result = profToRespo(CONNECTION, $respo, 'jury');
        if($result) {
            $id_respo = idProfToIdRespo(CONNECTION, $respo, 'jury');
            $requet = "UPDATE jury
                      SET  TYPE_DE_JURY = ?,
                            ID_NIVEAU= ?,
                            ID_RESPONSABLE= ?,
                            DATE_DEBUT = ?,
                            DATE_FIN = ?,
                            NOTE = ?
                      WHERE ID_JURY = ?";

            $stmt = mysqli_prepare(CONNECTION, $requet);
            mysqli_stmt_bind_param($stmt, "siisssi", $type, $niv, $id_respo, $date_start, $date_fin, $note, $id_jury);
            $result = mysqli_stmt_execute($stmt);
            if($result) {
                // Display success message
                printf("<div class='success-message'>
                            <p> La jury est modifier par succes </p>
                        </div>");

                header('refresh');
            }
      
            // Check if the jury already exists
            if(cheker_jury(CONNECTION, $date_start, $respo, $type)) {
                printf("<div class='error-message'>
                            <p> La Jury existe déjà </p>
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
} elseif(isset($_POST['supprimer'])) {
  // Handling form submission for deleting a jury
  if(isset($_POST['delete_jury'])) {
      $id_jury = $_POST['delete_jury'];
      $query = "DELETE FROM jury WHERE ID_JURY = '$id_jury'";
      $result = mysqli_query(CONNECTION, $query);
      if($result) {
          // Display success message
          printf("<div class='success-message'>
                      <p> La jury est supprimer par succes </p>
                  </div>");
          
          // Redirect to jury.php after 3 seconds
          header('refresh: 3; url=jury.php');

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
            <a href="jury.php" class="selected"><h3>Jury</h3></a>
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
        </div>
        <div class="dataContainersContainer">
                <div class="formContainer">
                  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <div class="inputContainer">
                        <label for="type">Type:</label>
                        <select id="type" name="type" class="dropDown">
                        </select>
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
                        <textarea id="Notes" name="notes" placeholder="note"></textarea>
                    </div>
                    <div class="inputContainer">
                        <label for="dateEnd">Date Fin:</label>
                        <input type="date" name="dateEnd" class="date" id="dateEnd">
                    </div>
                    <div class="filler"></div>
                    <div class="buttonContainer">
                    <input type="hidden" name="ID_JURY" value="<?php printf("%d",$id_jury) ?>">
                        <input type="submit" name="submit" value="Sauvegarder" class="brownButton">
                        <div>
                          <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                              <input type="hidden" name="delete_jury" value="<?php  printf("%d",$id_jury) ?>">
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
                      FROM participer AS pa ,professeur AS pr
                      WHERE pa.ID_PROFESSEUR = pr.ID_PROFESSEUR AND pa.ID_JURY = '$id_jury'";
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
    // JavaScript pour la fonction de remplissage du dropdown
    printf("<script>
              function populateDropdown1(selectId, options) {
                  var selectElement = document.getElementById(selectId);
                  selectElement.innerHTML = ''; // Clear existing options
                  options.forEach(function(option) {
                      var optionElement = document.createElement('option');
                      optionElement.value = option.value;
                      optionElement.textContent = option.label;
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

    // Chargement des données pour la fonction loadData()
    $result = apepel_jury(CONNECTION, $id_jury);
    while ($row = mysqli_fetch_assoc($result)) {
        printf("
              function loadData() {
                  var loadedData = {
                      Notes: '%s'
                  };
                  document.getElementById('Notes').value = loadedData.Notes;
              }
             function setInitialDate() {
                 var currentDate = '%s';
                 var formattedDate = currentDate;
                 document.getElementById('dateStart').value = formattedDate;
             }
             function setReturnDate() {
                 var currentDate = '%s';
                 var formattedDate = currentDate;
                 document.getElementById('dateEnd').value = formattedDate;
             }
             ", $row['NOTE'], $row['DATE_DEBUT'], $row['DATE_FIN']);
    }

    // Chargement des dropdowns lors du chargement de la page
    printf("
             window.onload = function() {
                 var niveaux = [];");

    // Récupération des niveaux associés au jury
    $query = "SELECT j.ID_NIVEAU , n.LBL_NIVEAUX 
              FROM jury AS j , niveau AS n WHERE j.ID_NIVEAU = n.ID_NIVEAU
              AND ID_JURY = '$id_jury'";
    $result = mysqli_query(CONNECTION, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        printf("
                 niveaux.push(['%d','%s']);
                 ", $row['ID_NIVEAU'], $row['LBL_NIVEAUX']);
    }

    // Récupération des autres niveaux non associés au jury
    $query = "SELECT n.ID_NIVEAU, n.LBL_NIVEAUX
              FROM niveau AS n
              WHERE n.ID_NIVEAU NOT IN (SELECT ID_NIVEAU FROM jury WHERE ID_JURY = '$id_jury')";
    $result = mysqli_query(CONNECTION, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        printf("
                 niveaux.push(['%d','%s']);
                 ", $row['ID_NIVEAU'], $row['LBL_NIVEAUX']);
    }

    // Autres dropdowns
    printf("
                 var types = [
                     { value: 'recrutement', label: 'recrutement' },
                     { value: 'soutenance', label: 'soutenance' },
                     { value: 'concours passerelles', label: 'concours passerelles' },
                     { value: 'concours transfert', label: 'concours transfert' }
                 ];

                 var responsables = [];");

    // Récupération des responsables associés au jury
    $query = "SELECT p.ID_PROFESSEUR, p.NOM, p.PRENOM
              FROM PROFESSEUR As p, responsable AS r ,jury AS j
              WHERE p.ID_PROFESSEUR = r.ID_PROFESSEUR
              AND   r.ID_RESPONSABLE = j.ID_RESPONSABLE
              AND j.ID_JURY = '$id_jury'";
    $result = mysqli_query(CONNECTION, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        printf("
                 responsables.push(['%d','%s %s']);
               ", $row['ID_PROFESSEUR'], $row['PRENOM'], $row['NOM']);
    }

    // Récupération des autres responsables non associés au jury
    $query = "SELECT p.ID_PROFESSEUR, p.NOM, p.PRENOM
              FROM PROFESSEUR AS p
              WHERE p.ID_PROFESSEUR NOT IN (
                  SELECT r.ID_PROFESSEUR
                  FROM responsable AS r
                  INNER JOIN jury AS j ON r.ID_RESPONSABLE = j.ID_RESPONSABLE
                  WHERE j.ID_JURY = '$id_jury'
              )";
    $result = mysqli_query(CONNECTION, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        printf("
                 responsables.push(['%d', '%s %s']);
               ", $row['ID_PROFESSEUR'], $row['PRENOM'], $row['NOM']);
    }

    // Fin du script JavaScript
    printf("
                 populateDropdown('Fil', niveaux);
                 populateDropdown1('type', types);
                 populateDropdown('respo', responsables);
                 setInitialDate();
                 setReturnDate();
                 loadData();
             };
           </script>");

} catch (Exception $e) {
    echo "Erreur: ", $e->getMessage();
}
?>

