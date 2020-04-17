<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DB Confinement</title>

    <!-- CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/menu.css">

    <!-- FONTS -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,200;0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet"> 

    <!-- SCRIPTS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body>
    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">DB CONFINEMENT<span>.</span></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="index.php">Générer des données</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="php/gestion_types.php">Gestion modèles</a>
            </li>
          </ul>
        </div>
      </nav>

    <div class="d-flex bd-highlight" >
      <span class="p-2 w-25 bd-highlight" id="title-menu">Générer des données</span>
      <div id="new-item-generator" class="p-2 w-75 bd-highlight">
        <div id="choix_type">
          <span class="field-name">Nouveau type</span>
          <br>
          <select class="small-input">
            <option value="select-type">select-type--</option>
            <?php
              $file_with_types=file("txt/activetypes.txt");
              foreach ($file_with_types as $type) {
                if(strcmp($type,"\n")!==0){
                  echo "<option>".$type."</option>";
                }
              }
            ?>
          </select>
        </div>
        <?php include 'html/form-date.html';?>
        <?php include 'html/form-number.html';?>
        <?php include 'html/form-text.html';?>
      </div>
    </div>

    <div class="d-flex bd-highlight" >
    <!-- LEFT MENU -->
      <div id="left-menu" class="p-2   bd-highlight">

        <div class="menu-field">
          <span class="field-name">Nom du modèle</span>
          <br>
          <input class="field-input">
        </div>
        <div class="menu-field">
          <span class="field-name">Nom du fichier de sortie</span>
          <br>
          <div id="field-double-input">
            <input id="double-name">
            <select id="double-extension">
              <option>.sql</option>
              <option>.csv</option>
            </select>
          </div>
        </div>
        <div class="menu-field">
          <span class="field-name">Nombre de lignes</span>
          <br>
          <input class="field-input">
        </div>

        <div class="buttons">
          <button class="menu-button" id="button-save">SAUVEGARDER</button>
          <br>
          <button class="menu-button" id="button-dl">TELECHARGER</button>
        </div>
      </div>


      <!--RIGHT MENU-->
      <div id="right-menu" class="p-2  bd-highlight">
      <div id="tableau"></div>
          <div id="tableau-head" class="d-flex bd-highlight">
            <div  class="p-2  bd-highlight align-self-center suppr">SUPPR</div>
            <div  class="p-2  bd-highlight align-self-center nom">NOM</div>
            <div  class="p-2  bd-highlight align-self-center type">TYPE</div>
            <div  class="p-2  bd-highlight align-self-center taille">TAILLE</div>
            <div  class="p-2  bd-highlight align-self-center parametres">PARAMÈTRES</div>
          </div>
          <div id="tableau-lignes">
            <div class="ligne d-flex bd-highlight" class="d-flex bd-highlight">
              <div  class="p-2  bd-highlight align-self-center suppr">X</div>
              <div  class="p-2  bd-highlight align-self-center nom">Age</div>
              <div  class="p-2  bd-highlight align-self-center type">Entier</div>
              <div  class="p-2  bd-highlight align-self-center taille">indéfini</div>
              <div  class="p-2  bd-highlight align-self-center parametres">
                <span>min:</span>
                <span>50</span>
                <span>max:</span>
                <span>100</span>
              </div>
            </div>
        </div>
        
      </div>
    </div>

</body>
</html>