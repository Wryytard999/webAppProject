<?php
include("../php web/connection.php");
include("../php web/functions.php");
if($_SERVER['REQUEST_METHOD'] == 'POST')
{   
    if(isset($_POST['submit']))
    {
        if(!empty($_POST['Etudiant']) && !empty($_POST['Fil']) 
        && !empty($_POST['Niveau']) && !empty($_POST['respo']))
        {
          $etudiant = $_POST['Etudiant'];
          $fillier = $_POST['Fil'];
          $niveau = $_POST['Niveau'];
          $id_respo = $_POST['respo'];
          if(!cheker_encadrement(CONNECTION,$id_respo,$etudiant))
          {
            $responsabilite = "INSERT INTO responsable (ID_PROFESSEUR)
                                VALUES ('$id_respo')";
            // passer le prof comme un respo avant de le mettre comme chef de filliere
            mysqli_query(CONNECTION, $responsabilite);

              $id_respo = prof_to_id_respo(CONNECTION,$id_respo);
              $requet="INSERT INTO encadrement (ID_RESPONSABLE,ID_FILLIERE,ID_NIVEAU,ETUDIANT) 
              values ('$id_respo','$fillier','$nom','$niveau','$etudiant')";
              $result = mysqli_query(CONNECTION, $requet);
              
                if($result)
                {
                  echo '<div class="success-message">';
                  echo '<p>Le Prof ' . htmlspecialchars($nom, ENT_QUOTES) ." ".htmlspecialchars($prenom, ENT_QUOTES) . ' a été enregistrée avec succès</p>';
                  echo '</div>'; 
                  header('refresh');
                }
          }
          else
          {
            
            echo '<div class="error-message">';
            echo '<p>Le Prof ' . htmlspecialchars($nom, ENT_QUOTES) ." ".htmlspecialchars($prenom, ENT_QUOTES) . ' existe déjà </p>';
            echo '</div>';
            header('refresh');
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
    <link rel="stylesheet" href="../style web/encadrement.css" />
    <title>Document</title>
    <script src="../LoadSidebar.js"></script>
  </head>
  <body>
    <div class="containAll">
      <div id="sidebarContainer"></div>
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
            printf("<a href='affichageEnca.php'>
                      <div class='tableRow'>
                        <p class='data'>%s %s</p>
                        <p class='data'>%s</p>
                        <p class='data'>%s</p>
                        <p class='data'>%s</p>
                      </div>
                    </a>",
            );
          }
          ?>

          </div>
        </div>
        <div><h1 class="bigTitle">Ajouter un encadrement:</h1></div>
        <div class="formContainer">
          <form action="" method="post">
            <div class="inputContainer">
                <label for="Destination">Etudiant</label>
                <input type="text" name="Etudiant" id="Destination" placeholder="Etudiant">
            </div>
            <div class="inputContainer">
                <label for="Fil">Filiere:</label>
                <select id="Fil" name="Fil" class="dropDown">
                  <option value="Genie Informatique">Genie Informatique</option>
                  <option value="Genie Industriel">Genie Industriel</option>
                  <option value="Finance et Ingenieurie decisionnelle">Finance et Ingenieurie decisionnelle</option>
                </select>
            </div>
            <div class="inputContainer">
                <label for="Niveau">Niveau:</label>
                <select id="Niveau" name="Niveau" class="dropDown">
                <?php
                  $data = niveau_liste(CONNECTION,$_POST['FIL']);
                  while($row = mysqli_fetch_assoc($data))
                  {
                    printf(
                      "<option value='%d'> %s </option>",
                      $row['ID_NIVEAUX'],$row['LBL_NIVEAUX']
                    );
                  }
                  ?>
                </select>
            </div>
            <div class="inputContainer">
                <label for="respo">Encadrant:</label>
                <select id="respo" name="respo" class="dropDown">
                <?php //liste des prof
                  $data = prof_list(CONNECTION);
                  while ($row = mysqli_fetch_assoc($data)) {
                    printf(
                      "<option value='%d'>%s %s</option>",
                      htmlspecialchars($row['ID_PROFESSEUR'], ENT_QUOTES),
                      htmlspecialchars($row['PRENOM'], ENT_QUOTES),
                      htmlspecialchars($row['NOM'], ENT_QUOTES)
                  );  
                    //echo "<option value='{$row['ID_PROFESSEUR']}'>{$row['PRENOM']} {$row['NOM']}</option>";
                  }
                 ?>
                </select>
            </div>
            <div class="buttonContainer">
              <input type="submit" name='submit' value="Ajouter" class="brownButton">
            </div>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>
