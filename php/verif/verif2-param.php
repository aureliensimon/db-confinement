<?php

session_start();

require_once('../bdd/database.php');
if($_POST['mon_beau_type']==0 ){
  header("location:../pageweb/choix.type.php");
}
$_SESSION['mon_beau_type']=htmlspecialchars($_POST['mon_beau_type']);



switch ($_SESSION['mon_beau_type']) {
    case 'INT':
        header("location:../../html/int.html");
        break;
    case 'TINYINT':
        header("location:../../html/tinyint.html");
        break;
    case 'BOOLEAN':
        header("location:../../html/boolean.html");
        break;
    case 'CHAR':
        header("location:../../html/char.html");
        break;
    case 'DATE':
        header("location:../../html/date.html");
        break;
    case 'DATETIME':
        header("location:../../html/datetime.html");
        break;
    case 'DOUBLEFLOAT':
        header("location:../../html/doublefloat.html");
        break;
    case 'TIME':
        header("location:../../html/time.html");
        break;
    case 'VARCHAR':
        header("location:../../html/varchar.html");
        break;
        
}




?>