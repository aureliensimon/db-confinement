<?php

session_start();
require_once('database.php');
if(isset($_POST['nom_modele']) && strcmp($_POST['nom_modele'],'')!=0 ){
    $_SESSION['nom_modele']=htmlspecialchars($_POST['nom_modele']);
    $resultinsert=insert_nom_modele(dbconnect(),$_SESSION['nom_modele']);
    echo $resultinsert;
    header("location:choix.type.php");
}else{  
  header("location:".  $_SERVER['HTTP_REFERER']); // revient sur la première page 
}

?>