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
      if(isset($_POST['respo'])  &&  isset($_POST['type']) 
            && isset($_POST['Fil']) && isset($_POST["Niveau"])
            &&  isset($_POST['dateStart']))
        {
          $id_respo = htmlspecialchars($_POST['respo']);
          $type = htmlspecialchars($_POST['type']);
          $fil = htmlspecialchars($_POST['Fil']);
          $niv = htmlspecialchars($_POST['Niveau']);
          $id_part = $_POST['participant'];
          $date_start = htmlspecialchars($_POST['dateStart']);
          $date_end = htmlspecialchars($_POST['dateFin']);

          $responsabilite = profToRespo(CONNECTION,$id_respo,'jury');// passer le prof comme un respo d'un jury avant de le mettre comme chef de filliere
          $id_respo = idProfToIdRespo(CONNECTION,$id_respo);
            
          $requet="INSERT INTO jury (ID_NIVEAU,ID_RESPONSABLE,DATE_DEBUT,DATE_FIN,TYPE_DE_JURY) 
                    values ('$niv','$id_respo','$date_start','$date_end','$type')";
          $result = mysqli_query(CONNECTION, $requet);
              
          $id_jury = id_jury(CONNECTION,$id_respo,$date_start,$type,$niv);

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
              printf("<div class='success-message'>
                        <p> Le Jury  commancera de %s à %s </p>
                      </div>"
                      ,htmlspecialchars($date_start, ENT_QUOTES),htmlspecialchars($date_end, ENT_QUOTES));
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
                  printf("      <a href='affichageJury.php'>
                                  <div class='tableRow'>");
                  
                  $prof_data = id_respo_to_NOM(CONNECTION,$row["ID_RESPONSABLE"]);
                  while($prof = mysqli_fetch_assoc($prof_data))
                      {
                  printf("          <p class='data'> %s %s </p>"
                    ,$prof["PRENOM"],$prof["NOM"]);
                      }
                  $fill_data = idNivToFill(CONNECTION,$row['ID_NIVEAU']);
                  while($fill = mysqli_fetch_assoc($fill_data))
                  {
                    printf("       <p class='data'>%s</p>",$fill['LBL_FILLIERE']);
                  }
                  printf("         <p class='data'>%s</p>",$row['TYPE_DE_JURY']);
                  $Niv_data = idNivToNiv(CONNECTION,$row['ID_NIVEAU']);
                  while($Niv = mysqli_fetch_assoc($Niv_data))
                  {
                  printf("         <p class='data'>%s</p>
                                </div>
                               </a>"  
                            ,$Niv['LBL_NIVEAUX']);
                  }       //  affichage du tableau d'apres BD
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
                  $data = niveau_liste(CONNECTION);
                  while($row = mysqli_fetch_assoc($data))
                  {
                    printf(
                      "<option value='%d'> %s </option>",
                      $row['ID_NIVEAU'],$row['LBL_NIVEAUX']
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
