<?php
    session_start();
    require_once('../bdd/database.php');
    if(strcmp($_POST['nom_champ'],'')==0 ||!isset($_POST['nom_champ'])){
        header("location:".  $_SERVER['HTTP_REFERER']); // revient sur la page précedente
    }else{
        switch ($_SESSION['mon_beau_type']) {
            case 'INT':
                if(strcmp($_POST['min'],'')==0 && strcmp($_POST['max'],'')==0){
                    echo "1\n";
                    echo insert_champ_int_and_tiny(dbconnect(),$_SESSION['nom_modele'],$_POST['nom_champ'],NULL,NULL,$_SESSION['mon_beau_type']);
                }
                else if(strcmp($_POST['min'],'')==0 || strcmp($_POST['max'],'')==0){
                        if(strcmp($_POST['min'],'')==0){
                            echo insert_champ_int_and_tiny(dbconnect(),$_SESSION['nom_modele'],$_POST['nom_champ'],$_POST['max'],NULL,$_SESSION['mon_beau_type']);
                        }else if(strcmp($_POST['max'],'')==0){
                            echo insert_champ_int_and_tiny(dbconnect(),$_SESSION['nom_modele'],$_POST['nom_champ'],NULL,$_POST['min'],$_SESSION['mon_beau_type']);
                    }
                }else{
                    echo "4\n";
                    echo insert_champ_int_and_tiny(dbconnect(),$_SESSION['nom_modele'],$_POST['nom_champ'],$_POST['max'],$_POST['min'],$_SESSION['mon_beau_type']);
                }
                break;
            case 'TINYINT':
                if($_POST['max']>127 || $_POST['min']<(-128)){
                    header("location:".  $_SERVER['HTTP_REFERER']); 
                }
                if(strcmp($_POST['min'],'')==0 && strcmp($_POST['max'],'')==0){
                    echo "1\n";
                    echo insert_champ_int_and_tiny(dbconnect(),$_SESSION['nom_modele'],$_POST['nom_champ'],NULL,NULL,$_SESSION['mon_beau_type']);
                }
                else if(strcmp($_POST['min'],'')==0 || strcmp($_POST['max'],'')==0){
                        if(strcmp($_POST['min'],'')==0){
                            echo insert_champ_int_and_tiny(dbconnect(),$_SESSION['nom_modele'],$_POST['nom_champ'],$_POST['max'],NULL,$_SESSION['mon_beau_type']);
                        }else if(strcmp($_POST['max'],'')==0){
                            echo insert_champ_int_and_tiny(dbconnect(),$_SESSION['nom_modele'],$_POST['nom_champ'],NULL,$_POST['min'],$_SESSION['mon_beau_type']);
                    }
                }else{
                    echo "4\n";
                    echo insert_champ_int_and_tiny(dbconnect(),$_SESSION['nom_modele'],$_POST['nom_champ'],$_POST['max'],$_POST['min'],$_SESSION['mon_beau_type']);
                }
                break;
            case 'BOOLEAN':
                insert_char_bool_time(dbconnect(),$_SESSION['nom_modele'],$_POST['nom_champ'],$_SESSION['mon_beau_type']);
                break;
            case 'CHAR':
                insert_char_bool_time(dbconnect(),$_SESSION['nom_modele'],$_POST['nom_champ'],$_SESSION['mon_beau_type']);
                break;
            case 'DATE':
                if(strcmp($_POST['min'],'')==0 && strcmp($_POST['max'],'')==0){
                    echo insert_champ_date(dbconnect(),$_SESSION['nom_modele'],$_POST['nom_champ'],NULL,NULL,$_SESSION['mon_beau_type']);
                }
                else if(strcmp($_POST['min'],'')==0 || strcmp($_POST['max'],'')==0){
                        if(strcmp($_POST['min'],'')==0){
                            echo insert_champ_date(dbconnect(),$_SESSION['nom_modele'],$_POST['nom_champ'],$_POST['max'],NULL,$_SESSION['mon_beau_type']);
                        }else if(strcmp($_POST['max'],'')==0){
                            echo insert_champ_date(dbconnect(),$_SESSION['nom_modele'],$_POST['nom_champ'],NULL,$_POST['min'],$_SESSION['mon_beau_type']);
                    }
                }else{
                    echo insert_champ_date(dbconnect(),$_SESSION['nom_modele'],$_POST['nom_champ'],$_POST['max'],$_POST['min'],$_SESSION['mon_beau_type']);
                }
                break;
            case 'DATETIME':
                if(strcmp($_POST['min'],'')==0 && strcmp($_POST['max'],'')==0){
                    echo insert_champ_date(dbconnect(),$_SESSION['nom_modele'],$_POST['nom_champ'],NULL,NULL,$_SESSION['mon_beau_type']);
                }
                else if(strcmp($_POST['min'],'')==0 || strcmp($_POST['max'],'')==0){
                        if(strcmp($_POST['min'],'')==0){
                            echo insert_champ_date(dbconnect(),$_SESSION['nom_modele'],$_POST['nom_champ'],$_POST['max'],NULL,$_SESSION['mon_beau_type']);
                        }else if(strcmp($_POST['max'],'')==0){
                            echo insert_champ_date(dbconnect(),$_SESSION['nom_modele'],$_POST['nom_champ'],NULL,$_POST['min'],$_SESSION['mon_beau_type']);
                    }
                }else{
                    echo insert_champ_date(dbconnect(),$_SESSION['nom_modele'],$_POST['nom_champ'],$_POST['max'],$_POST['min'],$_SESSION['mon_beau_type']);
                }
                break;
            case 'DOUBLEFLOAT':
                if(strcmp($_POST['min'],'')==0 && strcmp($_POST['max'],'')==0){
                    echo "1\n";
                    echo insert_champ_int_and_tiny(dbconnect(),$_SESSION['nom_modele'],$_POST['nom_champ'],NULL,NULL,$_SESSION['mon_beau_type']);
                }
                else if(strcmp($_POST['min'],'')==0 || strcmp($_POST['max'],'')==0){
                        if(strcmp($_POST['min'],'')==0){
                            echo insert_champ_int_and_tiny(dbconnect(),$_SESSION['nom_modele'],$_POST['nom_champ'],$_POST['max'],NULL,$_SESSION['mon_beau_type']);
                        }else if(strcmp($_POST['max'],'')==0){
                            echo insert_champ_int_and_tiny(dbconnect(),$_SESSION['nom_modele'],$_POST['nom_champ'],NULL,$_POST['min'],$_SESSION['mon_beau_type']);
                    }
                }else{
                    echo "4\n";
                    echo insert_champ_int_and_tiny(dbconnect(),$_SESSION['nom_modele'],$_POST['nom_champ'],$_POST['max'],$_POST['min'],$_SESSION['mon_beau_type']);
                }
                break;
            case 'TIME':
                insert_char_bool_time(dbconnect(),$_SESSION['nom_modele'],$_POST['nom_champ'],$_SESSION['mon_beau_type']);
                break;
            case 'VARCHAR':
                if(strcmp($_POST['longueur'],'')==0){
                    insert_varchar(dbconnect(),$_SESSION['nom_modele'],$_POST['nom_champ'],NULL,$_SESSION['mon_beau_type']);
                }else{
                    insert_varchar(dbconnect(),$_SESSION['nom_modele'],$_POST['nom_champ'],$_POST['longueur'],$_SESSION['mon_beau_type']);
                }
                break;
                
        }
        header("location:../pageweb/choix.type.php");
    }

?>