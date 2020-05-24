<?php 
session_start();
require_once('../bdd/database.php');
$_SESSION['erreur']=NULL;

// Vérification si le nom est vide ou s'il est le même que l'ancien
if(strcmp($_POST['new_name'],'')==0 || strcmp($_POST['new_name'],$_SESSION['nom_modele'])==0){
    $_SESSION['erreur']=displayerreur("aucun nouveau nom saisi ou le modele porte déjà ce même nom");
    header("location:".  $_SERVER['HTTP_REFERER']);
}else{
    // Le nom est valide, on lui retire les char spéciaux et on effectue la modification dans la base de données
    $new_name=htmlspecialchars($_POST['new_name']);
    echo insert_nom_modele(dbconnect(),$new_name);
    echo changement_libelle_table_champ(dbconnect(),$new_name,$_SESSION['nom_modele']);
    delete_libelle(dbConnect(),$_SESSION['nom_modele']);

    
    $_SESSION['nom_modele']=$new_name;
    
    header("location:../pageweb/choix.type.php");

}




?>