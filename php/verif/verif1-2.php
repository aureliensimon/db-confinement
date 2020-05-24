<?php

session_start();
require_once('../bdd/database.php');
$_SESSION['erreur']=NULL;

// On affiche si le modèle existe
echo true_if_modele_exist(dbConnect(),$_POST['nom_modele']);

if(isset($_POST['nom_modele']) && strcmp($_POST['nom_modele'],'')!=0 ){
  if (!true_if_modele_exist(dbConnect(),$_POST['nom_modele'])){
      $_SESSION['nom_modele']=htmlspecialchars($_POST['nom_modele']);
      $resultinsert=insert_nom_modele(dbconnect(),$_SESSION['nom_modele']);
      header("location:../pageweb/choix.type.php");
  }else{
    $_SESSION['nom_modele']=htmlspecialchars($_POST['nom_modele']);
    header("location:../pageweb/choix.type.php");
  }
}else{  
  $_SESSION['erreur']=displayerreur ("il manque un nom de modèle");
  header("location:".  $_SERVER['HTTP_REFERER']); // revient sur la première page 
}

?>