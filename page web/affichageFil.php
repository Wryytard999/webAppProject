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
            <div><h1 class="bigTitle">Filiere Genie Informatique:</h1></div>
        </div>
        <div class="dataContainersContainer">
                <div class="formContainer">
                  <form action="" method="post">
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
                    <div class="filler"></div>
                    <div class="buttonContainer">
                        <input type="submit" name="submit" value="Sauvegarder" class="brownButton">
                        <div><button class="whiteButton">Supprimer</button></div>
                        <div><button class="brownButton">Creer rapport</button></div>
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
            <a href="">
              <div class="tableRow">
                <p class="data">recrutement</p>
                <p class="data">Wadia El bahri</p>
                <p class="data">Genie Informatique 2</p>
              </div>
            </a>
            <a href="">
              <div class="tableRow">
                <p class="data">recrutement</p>
                <p class="data">Wadia El bahri</p>
                <p class="data">Genie Informatique 2</p>
              </div>
            </a>
            <a href="">
                <div class="tableRow">
                  <p class="data">recrutement</p>
                  <p class="data">Wadia El bahri</p>
                  <p class="data">Genie Informatique 2</p>
                </div>
              </a>
            <a href="">
              <div class="tableRow">
                <p class="data">recrutement</p>
                <p class="data">Wadia El bahri</p>
                <p class="data">Genie Informatique 2</p>
              </div>
            </a>
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
            <a href="">
              <div class="tableRow">
                <p class="data">Taroudant</p>
                <p class="data">Wadia El bahri</p>
                <p class="data">Genie Informatique 1</p>
                <p class="data">04/09/2024</p>
              </div>
            </a>
            <a href="">
              <div class="tableRow">
                <p class="data">Taroudant</p>
                <p class="data">Wadia El bahri</p>
                <p class="data">Genie Informatique 1</p>
                <p class="data">04/09/2024</p>
              </div>
            </a>
            <a href="">
              <div class="tableRow">
                <p class="data">Taroudant</p>
                <p class="data">Wadia El bahri</p>
                <p class="data">Genie Informatique 1</p>
                <p class="data">04/09/2024</p>
              </div>
            </a>
            <a href="">
                <div class="tableRow">
                  <p class="data">Taroudant</p>
                  <p class="data">Wadia El bahri</p>
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
            <p class="data">Encadrant</p>
            <p class="data">Niveau</p>
          </div>
          <div class="tableContainer">
            <a href="">
              <div class="tableRow">
                <p class="data">Younes EL bandki</p>
                <p class="data">Wadia El bahri</p>
                <p class="data">Genie Informatique 2</p>
              </div>
            </a>
            <a href="">
                <div class="tableRow">
                  <p class="data">Younes EL bandki</p>
                  <p class="data">Wadia El bahri</p>
                  <p class="data">Genie Informatique 2</p>
                </div>
              </a>
            <a href="">
              <div class="tableRow">
                <p class="data">Younes EL bandki</p>
                <p class="data">Wadia El bahri</p>
                <p class="data">Genie Informatique 2</p>
              </div>
            </a>
            <a href="">
              <div class="tableRow">
                <p class="data">Younes EL bandki</p>
                <p class="data">Wadia El bahri</p>
                <p class="data">Genie Informatique 2</p>
              </div>
            </a>
          </div>
        </div>
      </div>
    </div>
    <script>
         
         // Function to populate dropdown with options
         function populateDropdown(selectId, options) {
             var selectElement = document.getElementById(selectId);
             
             // Clear existing options
             selectElement.innerHTML = '';

             // Add new options
             options.forEach(function(option) {
                 var optionElement = document.createElement('option');
                 optionElement.value = option.value;
                 optionElement.textContent = option.label;
                 selectElement.appendChild(optionElement);
             });
         }

         function loadData() {
           // Example data (you can replace this with data loaded from a source like an API)
           var loadedData = {
               Nom: "Genie Informatique"
           };
   
           // Set the input field values with the loaded data
           document.getElementById("Nom").value = loadedData.Nom;
       }

         // Function to load data into dropdowns when the page is loaded
         window.onload = function() {
             // Data for 'Niveau' dropdown
             var niveaux = [
                 { value: '2', label: '2' },
                 { value: '3', label: '3' }
             ];

             // Data for 'Encadrant' dropdown
             var responsables = [
                 { value: 'wadia el bahri', label: 'Wadia El Bahri' },
                 { value: 'another responsable', label: 'Another responsable' },
                 { value: 'yet another responsable', label: 'Yet Another responsable' }
             ];

             // Populate 'Niveau' dropdown
             populateDropdown('niv', niveaux);

             // Populate 'Encadrant' dropdown
             populateDropdown('respo', responsables);

             loadData();
         };
    </script>
  </body>
</html>
