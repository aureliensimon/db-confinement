<?php
    session_start();
    require_once('../bdd/database.php');
   
    $_SESSION['erreur']=NULL;

    //stockage ou non du fichier
    if(isset($_FILES['fichier']['name']) AND $_FILES['fichier']['error'] == 0){
        if($_FILES['monfichier']['size'] <= 1000000){
            $infosfichier = pathinfo($_FILES['fichier']['name']);
            $extension_upload = $infosfichier['extension'];
            if (strcmp($extension_upload,"txt")){
                $dossier = '../../userfile/';
                $fichier = basename($_FILES['fichier']['name']);
                if(move_uploaded_file($_FILES['fichier']['tmp_name'], $dossier . $fichier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
                {
                    $fichier=$_FILES['fichier']['name'];
                }
                else 
                {
                    $fichier=NULL;
                }
            }
        }
    }

    // Vérification et mise à zéro des extremums s'ils ne sont pas définis

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


    if(strcmp($_POST['liste'],'0')==0){
        $liste=NULL;
    }else{
        $liste=$_POST['liste'];
    }
    
    // Vérification que tout les champs ont été remplis
    if(strcmp($_POST['nom_champ'],'')==0 ||!isset($_POST['nom_champ']) || true_if_champ_exist(dbconnect(),$_SESSION['nom_modele'],$_POST['nom_champ'])){
        $_SESSION['erreur']=displayerreur ("il manque un nom de champ ou un champ porte déjà le même nom");
        header("location:".  $_SERVER['HTTP_REFERER']); // revient sur la page précedente
    }else{
        switch ($_SESSION['mon_beau_type']) {
            case 'INT';
               echo insert_champ_int_and_tiny(dbconnect(),$_SESSION['nom_modele'],$_POST['nom_champ'],$max,$min,$_SESSION['mon_beau_type'],$fichier);
                break;
            case 'TINYINT':
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
            case 'DOUBLE':
                insert_champ_int_and_tiny(dbconnect(),$_SESSION['nom_modele'],$_POST['nom_champ'],$max,$min,$_SESSION['mon_beau_type'],$fichier);
                break;
            case 'TIME':
                insert_char_bool_time(dbconnect(),$_SESSION['nom_modele'],$_POST['nom_champ'],$_SESSION['mon_beau_type'],$fichier);
                break;
            case 'VARCHAR':
                echo insert_varchar(dbconnect(),$_SESSION['nom_modele'],$_POST['nom_champ'],$longueur,$_SESSION['mon_beau_type'],$fichier,$liste);
                break;
                
        }
        header("location:../pageweb/choix.type.php");
    }

?>