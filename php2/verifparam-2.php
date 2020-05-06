<?php
    session_start();
    require_once('database.php');
    if(strcmp($_POST['nom_champ'],'')==0 || $_POST['min']>=$_POST['max']){
        header("location:".  $_SERVER['HTTP_REFERER']); // revient sur la première page 
    }
    switch ($_SESSION['mon_beau_type']) {
        case 'INT':
            header("location:int.html");
            break;
        case 'TINYINT':
            header("location:tinyint.html");
            break;
        case 'BOOLEAN':
            header("location:boolean.html");
            break;
        case 'CHAR':
            header("location:char.html");
            break;
        case 'DATE':
            $retour=insert_champ_date(dbconnect(),$_SESSION['nom_modele'],$_POST['nom_champ'],$_POST['max'],$_POST['min'],$_SESSION['mon_beau_type']);
            echo $retour;
            break;
        case 'DATETIME':
            header("location:datetime.html");
            break;
        case 'DOUBLEFLOAT':
            header("location:doublefloat.html");
            break;
        case 'TIME':
            header("location:time.html");
            break;
        case 'VARCHAR':
            header("location:varchar.html");
            break;
            
    }

?>