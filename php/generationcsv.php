<?php

session_start();
require_once('bdd/database.php');
require_once('createdata.php');
require_once('generation.php');


$nombreLignes = $_POST['max'];
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
  downloadFile($modele,"csv");
  exit(); 

?>