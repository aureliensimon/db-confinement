<?php

session_start();
require_once('bdd/database.php');
require_once('createdata.php');
require_once('generation.php');
$_SESSION['erreur']=NULL;

// Vérification que tout les champs ont bien été rentrés correctement
if(strcmp($_POST['nb_ligne'],"")==0 || $_SESSION['nom_modele']==NULL || strcmp($_POST['nom_fichier'],"")==0){
    if( strcmp($_POST['nb_ligne'],"")==0){
        $_SESSION['erreur']=displayerreur ("il manque un nombre de ligne");
        header("location:".  $_SERVER['HTTP_REFERER']);
    }
    if( $_SESSION['nom_modele']==NULL){
        header("location:".  $_SERVER['HTTP_REFERER']);
    }
    if( strcmp($_POST['nom_fichier'],"")==0){
        $_SESSION['erreur']=displayerreur ("il manque un nom de fichier");
        header("location:".  $_SERVER['HTTP_REFERER']);
    }
}else{
    $nombreLignes = htmlspecialchars($_POST['nb_ligne']);
    $modele = $_SESSION['nom_modele'];
    $tab = t(dbConnect(), $modele);

    $file = fopen($_SERVER['DOCUMENT_ROOT'] . '/db-confinement/userfile/'.$modele.'.csv','wb');

    foreach ($tab as $valeur) {
        $ligne=$ligne."\"".$valeur['nom_champ']."\"".',';
        
    }
    $ligne=substr($ligne,0,-1);
    fwrite($file,$ligne."\n");
    $ligne="";


    for ($i=0; $i <$nombreLignes ; $i++) { 
        foreach ($tab as $value) {
            $ligne=$ligne."\"".getRandomData($value)."\"".',';
        }
        $ligne=substr($ligne,0,-1);
        fwrite($file,$ligne."\n");
        $ligne="";
        
    }


    fclose($file);
    updateFileTableName(dbConnect(), $modele, $_POST['nom_fichier'], '');
    downloadFile($modele,"csv");
    exit(); 
}
?>