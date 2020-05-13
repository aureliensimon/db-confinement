<?php
    session_start();
    require_once('../bdd/database.php');

    echo $_FILES['fichier']['name'];

    //stockage ou non du fichier
    if(isset($_FILES['fichier']['name'])){
        $dossier = '../../userfile/';
        $fichier = basename($_FILES['fichier']['name']);
        if(move_uploaded_file($_FILES['fichier']['tmp_name'], $dossier . $fichier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
        {
              echo 'Upload effectué avec succès !';
        }
        else //Sinon (la fonction renvoie FALSE).
        {
              echo 'Echec de l\'upload !';
         }
    }



    if(strcmp($_POST['max'],'')==0){
        $max=NULL;
    }else{
        $max=htmlspecialchars($_POST['max']);
    }

    if(strcmp($_POST['min'],'')==0){
        $min=NULL;
    }else{
        $min=htmlspecialchars($_POST['min']);
    }
    
    if(isset($_FILES['fichier']['name'])){
        $fichier=$_FILES['fichier']['name'];
    }else{
        $fichier=NULL;
    }

    if(strcmp($_POST['longueur'],'')==0){
        $longueur=NULL;
    }else{
        $longueur=htmlspecialchars($_POST['longueur']);
    }

    echo $min.$max.$fichier;








    if(strcmp($_POST['nom_champ'],'')==0 ||!isset($_POST['nom_champ'])){
        header("location:".  $_SERVER['HTTP_REFERER']); // revient sur la page précedente
    }else{
        switch ($_SESSION['mon_beau_type']) {
            case 'INT';
               echo insert_champ_int_and_tiny(dbconnect(),$_SESSION['nom_modele'],$_POST['nom_champ'],$max,$min,$_SESSION['mon_beau_type'],$fichier);
                break;
            case 'TINYINT':
                if($_POST['max']>127 || $_POST['min']<(-128)){
                    header("location:".  $_SERVER['HTTP_REFERER']); 
                }
                insert_champ_int_and_tiny(dbconnect(),$_SESSION['nom_modele'],$_POST['nom_champ'],$max,$min,$_SESSION['mon_beau_type'],$fichier);
                break;
            case 'BOOLEAN':
                insert_char_bool_time(dbconnect(),$_SESSION['nom_modele'],$_POST['nom_champ'],$_SESSION['mon_beau_type'],NULL);
                break;
            case 'CHAR':
                 echo  insert_char_bool_time(dbconnect(),$_SESSION['nom_modele'],$_POST['nom_champ'],$_SESSION['mon_beau_type'],$fichier);
                break;
            case 'DATE':
                insert_champ_date(dbconnect(),$_SESSION['nom_modele'],$_POST['nom_champ'],$max,$min,$_SESSION['mon_beau_type'],$fichier);
                break;
            case 'DATETIME':
                insert_champ_date(dbconnect(),$_SESSION['nom_modele'],$_POST['nom_champ'],$max,$min,$_SESSION['mon_beau_type'],$fichier);
                break;
            case 'DOUBLEFLOAT':
                insert_champ_int_and_tiny(dbconnect(),$_SESSION['nom_modele'],$_POST['nom_champ'],$max,$min,$_SESSION['mon_beau_type'],$fichier);
                break;
            case 'TIME':
                insert_char_bool_time(dbconnect(),$_SESSION['nom_modele'],$_POST['nom_champ'],$_SESSION['mon_beau_type'],$fichier);
                break;
            case 'VARCHAR':
                insert_varchar(dbconnect(),$_SESSION['nom_modele'],$_POST['nom_champ'],$longueur,$_SESSION['mon_beau_type'],$fichier);
                break;
                
        }
        header("location:../pageweb/choix.type.php");
    }

?>