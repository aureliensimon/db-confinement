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







    if(strcmp($_POST['nom_champ'],'')==0 ||!isset($_POST['nom_champ'])){
        header("location:".  $_SERVER['HTTP_REFERER']); // revient sur la page précedente
    }else{
        switch ($_SESSION['mon_beau_type']) {
            case 'INT';
                all_possible_insert('insert_champ_int_and_tiny',dbconnect(),$_SESSION['nom_modele'],$_POST['nom_champ'],$_POST['max'],$_POST['min'],$_SESSION['mon_beau_type'],$_FILES['fichier']['name']);
                break;
            case 'TINYINT':
                if($_POST['max']>127 || $_POST['min']<(-128)){
                    header("location:".  $_SERVER['HTTP_REFERER']); 
                }
                all_possible_insert('insert_champ_int_and_tiny',dbconnect(),$_SESSION['nom_modele'],$_POST['nom_champ'],$_POST['max'],$_POST['min'],$_SESSION['mon_beau_type'],$_FILES['fichier']['name']);
                break;
            case 'BOOLEAN':
                insert_char_bool_time(dbconnect(),$_SESSION['nom_modele'],$_POST['nom_champ'],$_SESSION['mon_beau_type'],NULL);
                break;
            case 'CHAR':
                if(isset($_FILES['fichier']['name'])){
                    insert_char_bool_time(dbconnect(),$_SESSION['nom_modele'],$_POST['nom_champ'],$_SESSION['mon_beau_type'],$_FILES['fichier']['name']);
                }else{
                    insert_char_bool_time(dbconnect(),$_SESSION['nom_modele'],$_POST['nom_champ'],$_SESSION['mon_beau_type'],NULL);
                }
                break;
            case 'DATE':
                all_possible_insert('insert_champ_date',dbconnect(),$_SESSION['nom_modele'],$_POST['nom_champ'],$_POST['max'],$_POST['min'],$_SESSION['mon_beau_type'],$_FILES['fichier']['name']);
                break;
            case 'DATETIME':
                all_possible_insert('insert_champ_date',dbconnect(),$_SESSION['nom_modele'],$_POST['nom_champ'],$_POST['max'],$_POST['min'],$_SESSION['mon_beau_type'],$_FILES['fichier']['name']);
                break;
            case 'DOUBLEFLOAT':
                all_possible_insert('insert_champ_int_and_tiny',dbconnect(),$_SESSION['nom_modele'],$_POST['nom_champ'],$_POST['max'],$_POST['min'],$_SESSION['mon_beau_type'],$_FILES['fichier']['name']);
                break;
            case 'TIME':
                if(isset($_FILES['fichier']['name'])){
                    insert_char_bool_time(dbconnect(),$_SESSION['nom_modele'],$_POST['nom_champ'],$_SESSION['mon_beau_type'],$_FILES['fichier']['name']);
                }else{
                    insert_char_bool_time(dbconnect(),$_SESSION['nom_modele'],$_POST['nom_champ'],$_SESSION['mon_beau_type'],NULL);
                }
                break;
            case 'VARCHAR':
                if(strcmp($_POST['longueur'],'')==0){
                    insert_varchar(dbconnect(),$_SESSION['nom_modele'],$_POST['nom_champ'],NULL,$_SESSION['mon_beau_type']);
                }else{
                    insert_varchar(dbconnect(),$_SESSION['nom_modele'],$_POST['nom_champ'],$_POST['longueur'],$_SESSION['mon_beau_type']);
                }
                if(isset($_FILES['fichier']['name'])){
                    if(strcmp($_POST['longueur'],'')==0){
                        insert_varchar(dbconnect(),$_SESSION['nom_modele'],$_POST['nom_champ'],NULL,$_SESSION['mon_beau_type'],$_FILES['fichier']['name']);
                    }else{
                        insert_varchar(dbconnect(),$_SESSION['nom_modele'],$_POST['nom_champ'],$_POST['longueur'],$_SESSION['mon_beau_type'],$_FILES['fichier']['name']);
                    }
                }else{
                    if(strcmp($_POST['longueur'],'')==0){
                        insert_varchar(dbconnect(),$_SESSION['nom_modele'],$_POST['nom_champ'],NULL,$_SESSION['mon_beau_type'],NULL);
                    }else{
                        insert_varchar(dbconnect(),$_SESSION['nom_modele'],$_POST['nom_champ'],$_POST['longueur'],$_SESSION['mon_beau_type'],NULL);
                    }
                }
                break;
                
        }
        //header("location:../pageweb/choix.type.php");
    }

?>