<?php 
session_start();
echo $_SESSION['erreur'];

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
    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">DB CONFINEMENT<span>.</span></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="../index2.php">Générer des données</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../php/pageweb/gestion_types.php">Gestion modèles</a>
            </li>
          </ul>
        </div>
      </nav>

      <div  class="ajout_param">
        <form action="../verif/verifparam-2.php"  enctype="multipart/form-data" method="POST">
            <div class="menu-field">
            <span class="field-name">Nom du champs</span>
            <br>
            <input type="text" class="field-input" name="nom_champ">
            </div>
            <div class="menu-field">
            <span class="field-name">longueur (max:100)</span>
            <br>
            <input type="text" class="field-input" name="longueur">
            </div>
            <div class="menu-field">
              <span class="field-name">Insérez votre propre liste de valeur:</span>
              <br>
              <input  type="file" class="field-input" name="fichier">
            </div>
            <div class="menu-field">
              <span class="field-name">Choisissez une liste de mot:</span>
              <br>
              <select class="field-input" name="liste">
                <option value="0">Select liste --</option>
                <option value="villes.txt">Villes</option>
                <option value="noms.txt">Noms</option>
                <option value="verbes.txt">Verbes</option>
                <option value="adjectifs.txt">Adjectifs</option>
              </select>
            </div>
            

            <div class="buttons">
            <button type="submit" class="menu-button" id="button-save">AJOUTER</button>
            </div>
        </form>
      </div>
    
</body>
</html>