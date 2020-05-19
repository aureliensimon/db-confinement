<?php

session_start();
require_once('bdd/database.php');
require_once('createdata.php');
require_once('generation.php');




if (strcmp($_POST['nb_ligne'],"")==0||$_SESSION['nom_modele']==NULL||  strcmp($_POST['nom_fichier'],"")==0 || strcmp($_POST['nom_table_sql'],"")==0){
    if( strcmp($_POST['nb_ligne'],"")==0){
      $_SESSION['erreur']=displayerreur ("il manque un nombre de ligne");
      header("location:".  $_SERVER['HTTP_REFERER']);
    }
    if( $_SESSION['nom_modele']==NULL){
      header("location:".  $_SERVER['HTTP_REFERER']);
    }
    if( strcmp($_POST['nom_table_sql'],"")==0){
      $_SESSION['erreur']=displayerreur ("il manque un nom de table");
      header("location:".  $_SERVER['HTTP_REFERER']);
    }
    if( strcmp($_POST['nom_fichier'],"")==0){
      $_SESSION['erreur']=displayerreur ("il manque un nom de fichier");
      header("location:".  $_SERVER['HTTP_REFERER']);
    }
    
}else{




    $nomTable = htmlspecialchars($_POST['nom_table_sql']);
    $nombreLignes = htmlspecialchars($_POST['nb_ligne']);
    $modele = $_SESSION['nom_modele'];
    $tab = t(dbConnect(), $modele);

    $file = fopen($_SERVER['DOCUMENT_ROOT'] . '/db-confinement/userfile/'.$modele.'.sql','wb');

    fwrite($file, "CREATE TABLE `" . $nomTable . "` (\n");

    foreach ($tab as &$e) {
      if ($e['longueur']) {
        fwrite($file, "\t`" . $e['nom_champ'] . "` " . $e['type_champ'] . "(" . $e['longueur'] . ")" . " DEFAULT NULL");
      } else {
        fwrite($file, "\t`" . $e['nom_champ'] . "` " . $e['type_champ'] . " DEFAULT NULL");
      }
      if ($e != array_slice($tab, -1)[0]) fwrite($file, ",\n");
    }
    fwrite($file, "\n) ENGINE=InnoDB DEFAULT CHARSET=latin1;\n\n");

    fwrite($file, "INSERT INTO `" . $nomTable . "` (");
    foreach($tab as &$e) {
      fwrite($file, "`" . $e['nom_champ'] . "`");
      if ($e != array_slice($tab, -1)[0]) fwrite($file, ", ");
    }
    fwrite($file, ") VALUES\n");

    $lineRandomData = array();
    
    for($ligne = 0; $ligne < $nombreLignes; $ligne++) {
      foreach($tab as &$e) {
        $lineRandomData[$e['nom_champ']] = array(getRandomData($e), $e['type_champ']);
      }

      $typeSansQuotes = array ('TINYINT', 'INT', 'BOOLEAN', 'DOUBLE', 'FLOAT');
      fwrite($file, "(");
      $keys = array_keys($lineRandomData);
      for ($i = 0; $i < sizeof($lineRandomData); $i++) {
        if (in_array($lineRandomData[$keys[$i]][1], $typeSansQuotes)) {
          fwrite($file, $lineRandomData[$keys[$i]][0]);
        } else {
          fwrite($file, "'" . $lineRandomData[$keys[$i]][0] . "'");
        }
        if ($i != sizeof($lineRandomData) - 1) fwrite($file, ", ");
      }

      if ($ligne == $nombreLignes - 1) {
        fwrite($file, ");");
      } else {
        fwrite($file, "),\n");
      }
    }

    fclose($file);
    downloadFile($modele,"sql");
    exit(); 
}

?>