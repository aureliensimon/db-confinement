<?php

require_once('../bdd/database.php');
dropchamp(dbconnect(),$_POST['id']);
header("location:../pageweb/choix.type.php");
?>