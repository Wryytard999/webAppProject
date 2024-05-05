<?php
include("../php web/connection.php");
include("../php web/functions.php");
include("../php web/appels.php");
include("../php web/cheker.php");
include("../php web/listes.php");

$id_filliere = null;
$old_id_respo = null;
if(isset($_GET['ID_FILLIERE'])){
    $id_filliere = $_GET['ID_FILLIERE'];

    $query = "SELECT r.ID_PROFESSEUR,r.ID_RESPONSABLE
              FROM filliere AS f, responsable AS r
              WHERE f.ID_RESPONSABLE = r.ID_RESPONSABLE
              AND f.ID_FILLIERE = '$id_filliere'";
      $result = mysqli_query(CONNECTION,$query);
      while($row = mysqli_fetch_assoc($result))
      {
          $old_id_respo = $row['ID_RESPONSABLE'];
      }
}
    if(isset($_POST['submit']))
    {
     
 

        if(isset($_POST['Nom']) && isset($_POST['respo']) && isset($_POST['niv']))
        {
          $id_filliere = htmlspecialchars($_POST['ID_FILL']);
          $nom = htmlspecialchars($_POST['Nom']);
          $niv = htmlspecialchars($_POST['niv']);
          $Chef_FIl = htmlspecialchars($_POST['respo']);
        
          $result = profToChef(CONNECTION,$Chef_FIl);
          if($result) {
            $id_respo = idProfToIdRespo(CONNECTION,$Chef_FIl,'chef de filliere');
            $requet = "UPDATE filliere
                      SET LBL_FILLIERE = ?,
                          NBR_NIVEAU = ?,
                          ID_RESPONSABLE = ?
                      WHERE ID_FILLIERE = ?";

          $stmt = mysqli_prepare(CONNECTION, $requet);
          mysqli_stmt_bind_param($stmt, "ssii", $nom, $niv, $id_respo	, $id_filliere);
          $result = mysqli_stmt_execute($stmt);
          if($result)
              {
                $query = "DELETE from responsable 
                          WHERE ID_RESPONSABLE = '$old_id_respo' 
                          AND LBL_RESPO ='chef de filliere'";
                mysqli_query(CONNECTION,$query);
                printf("<div class='success-message'>
                          <p> La Filliere est modifier par succes </p>
                      </div>"
              );
              header('Location: Filiere.php');
              }
          
          if(cheker_fill(CONNECTION,$Chef_FIl,$nom))
          {
            printf("<div class='error-message'>
                      <p> La Filliere existe déjà </p>
                    </div>"
                    );
                    header('Location: Filiere.php');
          }
        }
        else{
          printf("<div class='error'>
                      <p> Erreur  </p>
                    </div>");
                    header('Location: Filiere.php');

        }
      }
      elseif(isset($_POST['supprimer']))
      {
        if(isset($_POST['delete_id_fill']))
        {
            $id_filliere = $_POST['delete_id_fill'];
            $query = "DELETE FROM filliere WHERE ID_FILLIERE ='$id_filliere'";
            $result = mysqli_query(CONNECTION,$query);
            if($result)
            {
              printf("<div class='success-message'>
                          <p> La Filliere est supprimer par succes </p>
                      </div>"
                      );
                      header('Location: Filiere.php');
                      exit();
            }
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
            <a href="Filiere.php" class="selected"><h3>Filieres</h3></a>
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
            <div><h1 class="bigTitle">Filiere:</h1></div>
        </div>
        <div class="dataContainersContainer">
                <div class="formContainer">
                  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <div class="inputContainer">
                        <label for="Nom">Nom:</label>
                        <input type="text" name="Nom" class="Nom" id="Nom">
                    </div>
                    <div class="inputContainer">
                        <label for="respo">Chef de filiere:</label>
                        <select id="respo" name="respo" class="dropDown">  
                      </select>
                    </div>
                    <div class="inputContainer">
                        <label for="niv">Niveau:</label>
                        <select id="niv" name="niv" class="dropDown">
                      </select>
                    </div>
                    <div class="inputContainer">
                      <input type="hidden" name="ID_FILL" value="<?php printf("%d",$id_filliere) ?>">
                      </div>
                    <div class="filler"></div>
                    <div class="buttonContainer">
                        <input type="submit" name="submit" value="Sauvegarder" class="brownButton">
                        <div>
                              <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                              <input type='hidden' name='delete_id_fill' value='<?php  printf('%d',$id_filliere) ?>'> <!-- makhdamach hd suprimer-->
                              <input class='whiteButton' type="submit" name="supprimer" value="Supprimer" class="whiteButton">
                              </form>
                        </div>
                        <div><button class="brownButton">Creer rapport</button></div>""
                    </div>
                  </form>
                </div>
         </div>


        <h3 class="miniTitle">Jurys:</h3>
        <div class="table">
          <div class="tableHead">
            <p class="data">Type</p>
            <p class="data">Responsable</p>
            <p class="data">Niveau</p>
          </div>
          <div class="tableContainer">
          <?php
          $query = "SELECT j.TYPE_DE_JURY , n.LBL_NIVEAUX  , j.ID_JURY, p.NOM , p.PRENOM
                    FROM jury AS j , niveau AS n , filliere AS f, professeur AS p, responsable AS r
                    WHERE j.ID_NIVEAU = n.ID_NIVEAU
                    AND   n.ID_FILLIERE = f.ID_FILLIERE 
                    AND   j.ID_RESPONSABLE = r.ID_RESPONSABLE
                    AND   r.ID_PROFESSEUR = p.ID_PROFESSEUR
                    AND f.ID_FILLIERE = '$id_filliere'
                    ORDER BY ID_JURY";
          $result = mysqli_query(CONNECTION,$query);
          while($row = mysqli_fetch_assoc($result))
          {
            printf("
                    <a href='affichageJury.php?ID_JURY=%s'>
                      <div class='tableRow'>
                        <p class='data'>%s</p>
                        <p class='data'>%s %s</p>
                        <p class='data'>%s</p>
                      </div>
                    </a>
                  "
                ,$row['ID_JURY'],$row['TYPE_DE_JURY'],$row['PRENOM'],$row['NOM'],$row['LBL_NIVEAUX']);             
          }
          ?>

          </div>
        </div>
        <h3 class="miniTitle">Visites:</h3>
        <div id="Ftable">
          <div class="tableHead">
            <p class="data">Destination</p>
            <p class="data">Responsable</p>
            <p class="data">Niveau</p>
            <p class="data">Date depart</p>
          </div>
          <div class="tableContainer">
          <?php
              
                    $query = "SELECT v.LIEU ,n.LBL_NIVEAUX, v.DATE_DEBUT, v.ID_VISITE, p.NOM, p.PRENOM
                              FROM visite AS v , niveau AS n ,responsable AS r,professeur AS p
                              WHERE v.ID_NIVEAU = n.ID_NIVEAU 
                              AND v.ID_RESPONSABLE = r.ID_RESPONSABLE
                              AND r.ID_PROFESSEUR = p.ID_PROFESSEUR
                              AND n.ID_FILLIERE = '$id_filliere'
                              ORDER BY ID_VISITE";
                    $result = mysqli_query(CONNECTION,$query);
                    while($row = mysqli_fetch_assoc($result))
                    {
                        printf("<a href='affichageVis.php?ID_VISITE=%s'>
                                  <div class='tableRow'>
                                    <p class='data'>%s</p>
                                    <p class='data'>%s %s</p>
                                    <p class='data'>%s</p>
                                    <p class='data'>%s</p>
                                  </div>
                                 </a>
                                ",$row['ID_VISITE'],$row['LIEU'],$row['PRENOM'],$row['NOM'],$row['LBL_NIVEAUX'],$row['DATE_DEBUT']);
          }
        
                ?>
          </div>
        </div>
        <h3 class="miniTitle">Encadrements:</h3>
        <div class="table">
          <div class="tableHead">
            <p class="data">Etudiant</p>
            <p class="data">Encadrant</p>
            <p class="data">Niveau</p>
          </div>
          <div class="tableContainer">
          <?php
                
                $query = "SELECT e.ID_ENCADREMENT,e.ETUDIANT , n.LBL_NIVEAUX ,p.PRENOM ,p.NOM
                          FROM encadrement AS e , niveau AS n ,professeur AS p
                          WHERE e.ID_NIVEAU = n.ID_NIVEAU
                          AND   e.ID_PROFESSEUR = p.ID_PROFESSEUR
                          AND n.ID_FILLIERE = '$id_filliere'
                          ORDER BY ID_ENCADREMENT";
                $result = mysqli_query(CONNECTION,$query);
                while($row = mysqli_fetch_assoc($result))
                {
                  printf("
                          <a href='affichageEnca.php?ID_ENCADREMENT=%s'>
                            <div class='tableRow'>
                              <p class='data'>%s</p>
                              <p class='data'>%s %s</p>
                              <p class='data'>%s</p>
                            </div>
                          </a>
                        "
                      ,$row['ID_ENCADREMENT'],$row['ETUDIANT'],$row['PRENOM'],$row['NOM'],$row['LBL_NIVEAUX']);             
                }

            ?>
          </div>
        </div>
      </div>
    </div>

 </body>
</html>
<?php

printf("
        <script>

        // Function to populate dropdown with options
        function populateDropdown(selectId, options) {
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
        
    ");

    // Define arrays outside the loop
    printf("var niveaux = [['2', '2'], ['3', '3']];");
    printf("var responsables = [];");

    $query = "SELECT p.ID_PROFESSEUR , p.NOM , p.PRENOM
              FROM PROFESSEUR As p,responsable AS r ,filliere AS f
              WHERE p.ID_PROFESSEUR = r.ID_PROFESSEUR
              AND   r.ID_RESPONSABLE = f.ID_RESPONSABLE
              AND f.ID_FILLIERE = '$id_filliere'";
    $result = mysqli_query(CONNECTION,$query);
    while($row = mysqli_fetch_assoc($result))
    { 
        printf("
            responsables.push(['%d','%s %s']);
        ",$row['ID_PROFESSEUR'],$row['PRENOM'],$row['NOM']);
    }

    $query = "SELECT p.ID_PROFESSEUR, p.NOM, p.PRENOM
              FROM PROFESSEUR AS p
              LEFT JOIN responsable AS r ON p.ID_PROFESSEUR = r.ID_PROFESSEUR
              WHERE r.LBL_RESPO != 'chef de filliere' OR LBL_RESPO IS NULL";
    $result = mysqli_query(CONNECTION,$query);
    while($row = mysqli_fetch_assoc($result))
    { 
        printf("
            responsables.push(['%d', '%s %s']);
        ",$row['ID_PROFESSEUR'],$row['PRENOM'],$row['NOM']);
    }

    $data1 = appel_filier(CONNECTION,$id_filliere);
    while($row=mysqli_fetch_assoc($data1))
    {
        printf("
            // Example data (you can replace this with data loaded from a source like an API)
            var loadedData = {
                Nom: '%s'
            };

            // Populate dropdowns
            populateDropdown('niv', niveaux);
            populateDropdown('respo', responsables);

            // Set the input field value with the loaded data
            document.getElementById('Nom').value = loadedData.Nom;
        </script>
    ",$row['LBL_FILLIERE']);
    }

?>

