<?php

session_start();

echo $_POST['mon_beau_type'];

require_once('database.php');
if($_POST['nom_modele']!==0 ){
  header("location:choix.type.php");
}
$_SESSION['mon_beau_type']=htmlspecialchars($_POST['mon_beau_type']);



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
        header("location:date.html");
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