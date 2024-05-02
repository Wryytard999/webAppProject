<?php
include("../php web/connection.php");
include("../php web/functions.php");
include("../php web/appels.php");
include("../php web/cheker.php");
include("../php web/listes.php");







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
                  <form action="" method="post">
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
                        <textarea id="Notes" name="notes" placeholder="notes" rows="4" cols="50"></textarea>
                    </div>
                    <div class="inputContainer">
                        <label for="dateEnd">Date Fin:</label>
                        <input type="date" name="dateEnd" class="date" id="dateEnd">
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
        <h3 class="miniTitle">Participants:</h3>
        <div class="table">
          <div class="tableHead">
                <p class="data">Nom complet:</p>
                <p class="data">Email universitaire</p>
          </div>
          <div class="tableContainer">
            <a href="">
              <div class="tableRow">
                <p class="data">Wadia</p>
                <p class="data">sgdfuhsbg@uiz.ac.ma</p>
              </div>
            </a>
            <a href="">
              <div class="tableRow">
                <p class="data">Wadia</p>
                <p class="data">sgdfuhsbg@uiz.ac.ma</p>
              </div>
            </a>
            <a href="">
                <div class="tableRow">
                  <p class="data">Wadia</p>
                  <p class="data">sgdfuhsbg@uiz.ac.ma</p>
                </div>
              </a>
            <a href="">
              <div class="tableRow">
                <p class="data">Wadia</p>
                <p class="data">sgdfuhsbg@uiz.ac.ma</p>
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
                Notes: "Officia qui fugiat elit labore cillum. Labore pariatur aute eiusmod do ut eiusmod exercitation. Mollit fugiat duis tempor in culpa ad irure mollit aliqua sit pariatur nulla laboris pariatur. Duis excepteur mollit pariatur consequat adipisicing quis occaecat eiusmod. Non dolore pariatur minim eiusmod do. In quis consectetur magna eu sit laborum do ut nulla ea nisi reprehenderit. Anim fugiat qui adipisicing cupidatat cupidatat ut et laboris culpa qui commodo fugiat."
            };
    
            // Set the input field values with the loaded data
            document.getElementById("Notes").value = loadedData.Notes;
        }

        function setInitialDate() {
        var currentDate = new Date();
        var formattedDate = currentDate.toISOString().slice(0, 10); // Format: YYYY-MM-DD
        document.getElementById('dateStart').value = formattedDate;
        }
        function setReturnDate() {
        var currentDate = new Date();
        var formattedDate = currentDate.toISOString().slice(0, 10); // Format: YYYY-MM-DD
        document.getElementById('dateEnd').value = formattedDate;
        }

          // Function to load data into dropdowns when the page is loaded
          window.onload = function() {
              // Data for 'Niveau' dropdown
              var niveaux = [
                  { value: 'Genie informaique 1', label: 'Genie informaique 1' },
                  { value: 'Genie mecanique 2', label: 'Genie mecanique 2' },
                  { value: 'Genie industriel 1', label: 'Genie industriel 1' }
              ];

              var types = [
                  { value: 'recrutement', label: 'recrutement' },
                  { value: 'soutenance', label: 'soutenance' },
                  { value: 'concours passerelles', label: 'concours passerelles' },
                  { value: 'concours transfert', label: 'concours transfert' }
              ];

              // Data for 'Encadrant' dropdown
              var responsables = [
                  { value: 'wadia el bahri', label: 'Wadia El Bahri' },
                  { value: 'another responsable', label: 'Another responsable' },
                  { value: 'yet another responsable', label: 'Yet Another responsable' }
              ];

              // Populate 'Niveau' dropdown
              populateDropdown('Fil', niveaux);

              populateDropdown('type', types);

              // Populate 'Encadrant' dropdown
              populateDropdown('respo', responsables);

              setInitialDate();
              setReturnDate();

              loadData();
          };
    </script>
  </body>
</html>
