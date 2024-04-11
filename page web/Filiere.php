<?php
include("../php web/connection.php");
include("../php web/functions.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../style web/Filiere.css" />
    <title>Document</title>
    <script src="../LoadSidebar.js"></script>
  </head>
  <body>
    <div class="containAll">
      <div id="sidebarContainer"></div>
      <div class="mainPage">
        <div><h1 class="bigTitle">Filieres:</h1></div>
        <div class="table">
          <div class="tableHead">
            <p class="data">Nom</p>
            <p class="data">Chef de filiere</p>
          </div>
          <div class="tableContainer">
          <?php
          $data = appel_filier($connection);
                while ($row = mysqli_fetch_assoc ($data)) {
                  echo "<a href='affichageFil.php'>";
                    echo "<div class='tableRow'>";
                      echo "<p class='data'>";
                          echo $row["nom-fillier"];
                      echo "</p>";
                         //  affichage du tableau d'apres BD
                        while($data = mysqli_fetch_assoc(id_nom_prof($connection,$row["chef_de_filier"]))){
                      echo "<p class='data'>";
                          echo $data['Nom'] . ' ' . $data['prenom'];
                      echo "</p>";}

                    echo "</div>";
                  echo "</a>";
                }
                ?>
                      <!--  
                      <a href="">
                        <div class="tableRow">
                          <p class="data">Genie Informatique</p>
                          <p class="data">Hamid Akessasse</p>
                        </div>
                      </a>
                      <a href="">
                        <div class="tableRow">
                          <p class="data">Genie Industriel</p>
                          <p class="data">Wadia el bahri</p>
                        </div>
                      </a>
                      <a href="">
                        <div class="tableRow">
                          <p class="data">Genie Industriel</p>
                          <p class="data">Wadia el bahri</p>
                        </div>
                      </a>
                      <a href="">
                        <div class="tableRow">
                          <p class="data">Genie Industriel</p>
                          <p class="data">Wadia el bahri</p>
                        </div>
                      </a>
                      <a href="">
                        <div class="tableRow">
                          <p class="data">Genie Industriel</p>
                          <p class="data">Wadia el bahri</p>
                        </div>
                      </a>
                      <a href="">
                        <div class="tableRow">
                          <p class="data">Genie Industriel</p>
                          <p class="data">Wadia el bahri</p>
                        </div>
                      </a>
                      <a href="">
                        <div class="tableRow">
                          <p class="data">Genie Industriel</p>
                          <p class="data">Wadia el bahri</p>
                        </div>
                      </a>
                        -->
          </div>
        </div>
        <div><h1 class="bigTitle">Ajouter une filiere:</h1></div>
        <div class="formContainer">
          <form action="" method="post">
            <div class="inputContainer">
              <label for="nom">Nom:</label>
              <input type="text" id="nom" placeholder="Nom">
            </div>
            <div class="inputContainer">
              <label for="chefFil">Chef de filiere:</label>
              <select id="chefFil" class="dropDown">
                <option value="Hamid akessas">Hamid akessas</option>
                <option value="Toumnari">Toumnari</option>
                <option value="Wadia">Wadia</option>
              </select>
            </div>
            <div class="inputContainer">
              <label for="Niv">Nombre des niveaux:</label>
              <select id="Niv" class="dropDown">
                <option value="2">2</option>
                <option value="3">3</option>
              </select>
            </div>
            <div class="filler"></div>
            <div class="buttonContainer">
              <input type="submit" value="Ajouter" class="brownButton">
            </div>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>
