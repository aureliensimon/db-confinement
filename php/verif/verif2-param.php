<?php

session_start();

require_once('../bdd/database.php');
if($_POST['mon_beau_type']==0 ){
  header("location:../pageweb/choix.type.php");
}
$_SESSION['mon_beau_type']=htmlspecialchars($_POST['mon_beau_type']);



switch ($_SESSION['mon_beau_type']) {
    case 'INT':
        header("location:../../html/int_tinyint_double-float.html");
        break;
    case 'TINYINT':
        header("location:../../html/int_tinyint_double-float.html");
        break;
    case 'BOOLEAN':
        header("location:../../html/time_bool_char.html");
        break;
    case 'CHAR':
        header("location:../../html/time_bool_char.html");
        break;
    case 'DATE':
        header("location:../../html/date_datetime.html");
        break;
    case 'DATETIME':
        header("location:../../html/date_datetime.html");
        break;
    case 'DOUBLE FLOAT':
        header("location:../../html/int_tinyint_double-float.html");
        break;
    case 'TIME':
        header("location:../../html/time_bool_char.html");
        break;
    case 'VARCHAR':
        header("location:../../html/varchar.html");
        break;
        
}




?>