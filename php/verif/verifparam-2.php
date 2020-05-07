<?php
    session_start();
    require_once('../bdd/database.php');
    if(strcmp($_POST['nom_champ'],'')==0 || $_POST['min']>=$_POST['max']){
        header("location:".  $_SERVER['HTTP_REFERER']); // revient sur la première page 
    }
    switch ($_SESSION['mon_beau_type']) {
        case 'INT':
            insert_champ_int_and_tiny(dbconnect(),$_SESSION['nom_modele'],$_POST['nom_champ'],$_POST['max'],$_POST['min'],$_SESSION['mon_beau_type']);
            break;
        case 'TINYINT':
            if($_POST['max']>127 || $_POST['min']<(-128)){
                header("location:".  $_SERVER['HTTP_REFERER']); 
            }
            insert_champ_int_and_tiny(dbconnect(),$_SESSION['nom_modele'],$_POST['nom_champ'],$_POST['max'],$_POST['min'],$_SESSION['mon_beau_type']);
            break;
        case 'BOOLEAN':
            insert_char_bool_time(dbconnect(),$_SESSION['nom_modele'],$_POST['nom_champ'],$_SESSION['mon_beau_type']);
            break;
        case 'CHAR':
            insert_char_bool_time(dbconnect(),$_SESSION['nom_modele'],$_POST['nom_champ'],$_SESSION['mon_beau_type']);
            break;
        case 'DATE':
            insert_champ_date(dbconnect(),$_SESSION['nom_modele'],$_POST['nom_champ'],$_POST['max'],$_POST['min'],$_SESSION['mon_beau_type']);
            break;
        case 'DATETIME':
            insert_champ_date(dbconnect(),$_SESSION['nom_modele'],$_POST['nom_champ'],$_POST['max'],$_POST['min'],$_SESSION['mon_beau_type']);
            break;
        case 'DOUBLEFLOAT':
            insert_champ_int_and_tiny(dbconnect(),$_SESSION['nom_modele'],$_POST['nom_champ'],$_POST['max'],$_POST['min'],$_SESSION['mon_beau_type']);
            break;
        case 'TIME':
            insert_char_bool_time(dbconnect(),$_SESSION['nom_modele'],$_POST['nom_champ'],$_SESSION['mon_beau_type']);
            break;
        case 'VARCHAR':
             insert_varchar(dbconnect(),$_SESSION['nom_modele'],$_POST['nom_champ'],$_POST['longueur'],$_SESSION['mon_beau_type']);

            break;
            
    }
    header("location:../pageweb/choix.type.php");

?>