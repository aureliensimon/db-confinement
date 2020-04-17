<?php
    if(isset($_POST['choixtype'])){
        $yesornot=1;
        $file_with_type=file("../txt/activetypes.txt");
        $reponsenettoyer=trim($_POST['choixtype']);
        foreach ($file_with_type as $type) {
            $basenettoyer=trim($type);
            if(strcmp($reponsenettoyer,$basenettoyer)==0){
                $yesornot=0;
            }
        }
        if ($yesornot==0){
            file_put_contents("../txt/activetypes.txt", str_replace($_POST['choixtype'], "", file_get_contents("../txt/activetypes.txt")));
        }else{
            file_put_contents("../txt/activetypes.txt",$_POST['choixtype']."\n",FILE_APPEND);
        }
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
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="stylesheet" href="../css/menu.css">
    <link rel="stylesheet" href="../css/gestion_types.css">

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
            <li class="nav-item ">
              <a class="nav-link" href="../index.php">Générer des données</a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="#">Gestion modèles</a>
            </li>
          </ul>
        </div>
    </nav>
    <div class="d-flex bd-highlight" >



        <!-- Liste des types actifs -->


        <div id="active-list" class="p-2 bd-highlight">
        <?php
              $file_with_types=file("../txt/activetypes.txt");
              foreach ($file_with_types as $type) {
                echo "<p class=\"type_box\">".$type."</p>";
              }
              
        ?>

        </div> 



        <!--  intéraction avec la liste  -->


        <div id="ajoutouretrait" class="p-2 bd-highlight">
            <div id="form_type_varchar" class="nig-horizontal">
                <form action="gestion_types.php" method="post">
                    
                    <select name="choixtype" class="small-input">
                        <option value="select-type">select-type--</option>
                        <?php
                            $file_with_types=file("../txt/alltypes.txt");
                            foreach ($file_with_types as $type) {
                                echo "<option>".$type."</option>";
                            }
                        ?>
                    </select>
                    <p>Si le type sélectionné est présent dans la liste ci-joint il en sera supprimé sinon ajouté</p>
                    
                     <button  type="submit" class="small-button" id="button_ajouter">-/+</button>
                   
                </form>
            </div>





        </div>
    </div>
    

</body>
</html>