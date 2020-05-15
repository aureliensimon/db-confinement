<?php

session_start();
require_once('../bdd/database.php');
if($_SESSION['nom_modele']==NULL){
  header("location:../../index2.php");
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DB Confinement</title>

    <!-- CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/main.css">
    <link rel="stylesheet" href="../../css/navbar.css">
    <link rel="stylesheet" href="../../css/menu.css">
    <link rel="stylesheet" href="../../css/index2.css">
    <link rel="stylesheet" href="../../css/choix.type.css">

    <!-- FONTS -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,200;0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet"> 

    <!-- SCRIPTS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body>
    <?php echo $_SESSION['erreur']; ?>
    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">DB CONFINEMENT<span>.</span></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="../../index2.php">Générer des données</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="gestion_types.php">Gestion modèles</a>
            </li>
          </ul>
        </div>
      </nav>

    <div id="choix_type">
        <form method="POST" action="../verif/verif2-param.php">
        <div class="menu-field">
                <span class="field-name">Choix du type à ajouter</span>
                <br>

                <select class="field-input" name="mon_beau_type" >
                    <option value="0"> select type-- </option>
                        <?php selecttruetype(dbConnect()); ?>

                </select>
                <div>
                  <button type=submit  class="menu-button" id="button-ajouter"> AJOUTER</button>
                </div>
        </form>
    </div>

    <div id="tableau">
          <div id="tableau-head" class="d-flex bd-highlight">
            <div  class="p-2  bd-highlight align-self-center suppr">SUPPR</div>
            <div  class="p-2  bd-highlight align-self-center nom">NOM</div>
            <div  class="p-2  bd-highlight align-self-center type">TYPE</div>
            <div  class="p-2  bd-highlight align-self-center taille">TAILLE</div>
            <div  class="p-2  bd-highlight align-self-center parametres">PARAMÈTRES</div>
            <div  class="p-2  bd-highlight align-self-center fichier">FICHIER</div>
          </div>
          <div id="tableau-lignes">
             <?php tableau(dbConnect(),$_SESSION['nom_modele']);?>
          </div>
    </div>

    <div id="formfichier" class="d-flex bd-highlight">
      <div id="csv" class="p-2  bd-highlight align-self-center"> 
      <form action=""   method="POST">
            <div class="menu-field">
            <span class="field-name">Nom du fichier:</span>
            <br>
            <input type="text" class="field-input" name="nom_champ">
            </div>
            <div class="menu-field">
            <span class="field-name">Nombre de ligne:</span>
            <br>
            <input  type="text" class="field-input" name="max">
            </div>
            <div class="buttons">
            <button type="submit" class="menu-button" id="button-save">GENERER UN FICHIER .CSV</button>
            </div>
        </form>
      </div>
      <div id="sql" class="p-2  bd-highlight align-self-center"> 
      <form action="../generation.php"  method="POST">
            <div class="menu-field">
            <span class="field-name">Nom du fichier:</span>
            <br>
            <input type="text" class="field-input" name="nom_champ">
            </div>
            <div class="menu-field">
            <span class="field-name">Nom de la table:</span>
            <br>
            <input type="text" class="field-input" name="nom_table_sql">
            </div>
            <div class="menu-field">
            <span class="field-name">Nombre de ligne:</span>
            <br>
            <input  type="text" class="field-input" name="max">
            </div>
            <div class="buttons">
            <button type="submit" class="menu-button" id="button-save">GENERER UN FICHIER .SQL</button>
            </div>
        </form>
      </div>
    </div>

</body>
</html>