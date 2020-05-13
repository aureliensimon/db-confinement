<?php

session_start();

require_once('../bdd/database.php');
if($_POST['mon_beau_type']==0 ){
  header("location:../pageweb/choix.type.php");
}
$_SESSION['mon_beau_type']=htmlspecialchars($_POST['mon_beau_type']);



switch ($_SESSION['mon_beau_type']) {
    case 'INT':
        header("location:../formparam/int_tinyint_double-float.php");
        break;
    case 'TINYINT':
        header("location:../formparam/int_tinyint_double-float.php");
        break;
    case 'BOOLEAN':
        header("location:../formparam/time_bool_char.php");
        break;
    case 'CHAR':
        header("location:../formparam/time_bool_char.php");
        break;
    case 'DATE':
        header("location:../formparam/date_datetime.php");
        break;
    case 'DATETIME':
        header("location:../formparam/date_datetime.php");
        break;
    case 'DOUBLE FLOAT':
        header("location:../formparam/int_tinyint_double-float.php");
        break;
    case 'TIME':
        header("location:../formparam/time_bool_char.php");
        break;
    case 'VARCHAR':
        header("location:../formparam/varchar.php");
        break;
        
}




?>