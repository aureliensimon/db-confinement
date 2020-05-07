<?php
    session_start();
    require_once('../bdd/database.php');
    if(strcmp($_POST['nom_champ'],'')==0 || $_POST['min']>=$_POST['max']){
        header("location:".  $_SERVER['HTTP_REFERER']); // revient sur la première page 
    }
    switch ($_SESSION['mon_beau_type']) {
        case 'INT':
            break;
        case 'TINYINT':
            break;
        case 'BOOLEAN':
            break;
        case 'CHAR':
            break;
        case 'DATE':
            $retour=insert_champ_date(dbconnect(),$_SESSION['nom_modele'],$_POST['nom_champ'],$_POST['max'],$_POST['min'],$_SESSION['mon_beau_type']);
            break;
        case 'DATETIME':
            break;
        case 'DOUBLEFLOAT':
            break;
        case 'TIME':
            break;
        case 'VARCHAR':
            break;
            
    }
    header("location:../pageweb/choix.type.php");

?>