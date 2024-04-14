<?php
include("../php web/connection.php");
include("../php web/functions.php");


if($_SERVER['REQUEST_METHOD'] == 'POST')
{   
    if(isset($_POST['submit']))
    {
      if(!empty($_POST['respo'])  &&  !empty($_POST['type']) 
            && !empty($_POST['Fil'])
            &&  !empty($_POST['dateStart']) )
        {
          $id_respo = $_POST['respo'];
          $type = $_POST['type'];
          $fil = $_POST['Fil'];
          $niv = $_POST['Niveau'];
          $id_part = $_POST['participant'];
          $date_start = $_POST['dateStart'];
          $date_end = $_POST['dateFin'];

              $requet="INSERT INTO jury (ID_FILLIERE,ID_NIVEAU,ID_RESPONSABLE,DATE_DEBUT,DATE_FIN,TYPE_DE_JURY) 
              values ('$fil','','$id_respo','$date_start','$date_end','$type')";
              $result = mysqli_query(CONNECTION, $requet);
                  
              $id_jury = id_jury(CONNECTION,$id_respo,$date_start,$type,$fil);
              if(is_array($id_part) && !empty($id_part))
              {
                foreach($id_part as $value)
              {
                  $query = "INSERT INTO participer (ID_PROFESSEUR,ID_JURY) value ('$value','$id_jury')";
                  mysqli_query(CONNECTION, $query);

              }
              }
              

                if($result)
                {
                  echo '<div class="success-message">';
                  echo '<p>Le Prof ' . htmlspecialchars($nom, ENT_QUOTES) ." ".htmlspecialchars($prenom, ENT_QUOTES) . ' a été enregistrée avec succès</p>';
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
    <link rel="stylesheet" href="../style web/jury.css" />
    <title>Document</title>
    <script src="../LoadSidebar.js"></script>
  </head>
  <body>
    <div class="containAll">
      <div id="sidebarContainer"></div>
      <div class="mainPage">
        <div><h1 class="bigTitle">Jurys:</h1></div>
        <div class="table">
          <div class="tableHead">
            <p class="data">Responsable</p>
            <p class="data">Filiere</p>
            <p class="data">Type</p>
            <p class="data">Niveau</p>
          </div>
          <div class="tableContainer">
          
            <?php 
            $data = apepel_jury(CONNECTION);
            if($data)
            {
                  while($row = mysqli_fetch_assoc($data))
                {
                    printf(
                            "<a href='affichageJury.php'>
                            <div class='tableRow'>
                            <p class='data'>%s %s</p>
                            <p class='data'>%s</p>
                            <p class='data'>%s</p>
                            <p class='data'>%s</p>
                            </div>
                            </a>",
                            $row['PRENOM'],$row['NOM'],
                            $row['LBL_FILLIERE'],$row['TYPE_DE_JURY']
                            ,$row['LBL_NIVEAU']);
                          //  affichage du tableau d'apres BD
                }
            }
            ?>

          </div>
        </div>
        <div><h1 class="bigTitle">Ajouter une jury:</h1></div>
        <div class="formContainer">
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
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
              <label for="type">Type:</label>
              <select id="type" name="type" class="dropDown">
                <option value="recrutement">recrutement</option>
                <option value="soutenance">soutenance</option>
                <option value="concours passerelles">concours passerelles</option>
                <option value="concours transfert">concours transfert</option>
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
                <label for="respo">Responsable:</label>
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
            <div class="inputContainer">
                <label for="participant">Participants:</label>
                <select id="participant" name="participant[]" class="dropDown" multiple>
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
            <div class="inputContainer">
                <label for="dateStart">Date debut:</label>
                <input type="date" name="dateStart" class="date" id="dateStart">
            </div>
            <div class="inputContainer">
                <label for="dateFin">Date fin:</label>
                <input type="date" name="dateFin" class="date" id="dateFin">
            </div>
            <div class="filler"></div>
            <div class="buttonContainer">
              <input type="submit" name="submit" value="Ajouter" class="brownButton">
            </div>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>
