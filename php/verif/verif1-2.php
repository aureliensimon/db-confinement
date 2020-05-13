<?php

session_start();
require_once('../bdd/database.php');
$_SESSION['erreur']=NULL;
if(isset($_POST['nom_modele']) && strcmp($_POST['nom_modele'],'')!=0 ){
    $_SESSION['nom_modele']=htmlspecialchars($_POST['nom_modele']);
    $resultinsert=insert_nom_modele(dbconnect(),$_SESSION['nom_modele']);
    echo $resultinsert;
    header("location:../pageweb/choix.type.php");
}else{  
  $_SESSION['erreur']=displayerreur ("il manque un nom de modèle");
  header("location:".  $_SERVER['HTTP_REFERER']); // revient sur la première page 
}

?>