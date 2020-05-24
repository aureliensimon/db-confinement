<?php
  if(!isset($_SESSION)) { 
      session_start(); 
  } 
  require_once('bdd/database.php');
  require_once('createdata.php');
  require_once('generation.php');
  $_SESSION['erreur']=NULL;

  // Vérification que tout les champs ont bien été rentrés correctement
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

    $file = fopen($_SERVER['DOCUMENT_ROOT'] . '/db-confinement/userfile/'.$modele.'.sql','w+');

    // Extraction des données depuis les inputs
    $nomTable = htmlspecialchars($_POST['nom_table_sql']);
    $nombreLignes = htmlspecialchars($_POST['nb_ligne']);
    $modele = $_SESSION['nom_modele'];
    $tab = t(dbConnect(), $modele);

    $file = fopen($_SERVER['DOCUMENT_ROOT'] . '/db-confinement/userfile/'.$modele.'.sql','wb');

    fwrite($file, "CREATE TABLE `" . $nomTable . "` (\n");

    // Pour chaque champ du modèle
    foreach ($tab as &$e) {
      if ($e['longueur']) {
        // Si une longueur max est spécifier il faut la mettre entre paranthèses
        fwrite($file, "\t`" . $e['nom_champ'] . "` " . $e['type_champ'] . "(" . $e['longueur'] . ")" . " DEFAULT NULL");
      } else {
        fwrite($file, "\t`" . $e['nom_champ'] . "` " . $e['type_champ'] . " DEFAULT NULL");
      }
      // Si ce n'est pas le dernier élément, rajouter un retour chariot
      if ($e != array_slice($tab, -1)[0]) fwrite($file, ",\n");
    }
    fwrite($file, "\n) ENGINE=InnoDB DEFAULT CHARSET=latin1;\n\n");

    fwrite($file, "INSERT INTO `" . $nomTable . "` (");
    foreach($tab as &$e) {
      fwrite($file, "`" . $e['nom_champ'] . "`");
      // Si ce n'est pas le dernier élément, rajouter une virgule
      if ($e != array_slice($tab, -1)[0]) fwrite($file, ", ");
    }
    fwrite($file, ") VALUES\n");

    $lineRandomData = array();
    
    // Génération selon le nombre de lignes que l'utilisateur à rentré
    for($ligne = 0; $ligne < $nombreLignes; $ligne++) {
      foreach($tab as &$e) {
        $lineRandomData[$e['nom_champ']] = array(getRandomData($e), $e['type_champ']);
      }
      // les types suivants n'ont pas besoin de quotes autour de leur valeurs
      $typeSansQuotes = array ('TINYINT', 'INT', 'BOOLEAN', 'DOUBLE', 'FLOAT');
      fwrite($file, "(");
      $keys = array_keys($lineRandomData);
      for ($i = 0; $i < sizeof($lineRandomData); $i++) {
        // Si le type de l'élément n'a pas besoin de quote
        if (in_array($lineRandomData[$keys[$i]][1], $typeSansQuotes)) {
          // L'ajouter dans le fichier sans quotes
          fwrite($file, $lineRandomData[$keys[$i]][0]);
        } else {
          // L'ajouter dans le fichier avec quotes
          fwrite($file, "'" . $lineRandomData[$keys[$i]][0] . "'");
        }
        // Si ce n'est pas le dernier élément, rajouter une virgule
        if ($i != sizeof($lineRandomData) - 1) fwrite($file, ", ");
      }

      // Si c'est la dernière ligne
      if ($ligne == $nombreLignes - 1) {
        fwrite($file, ");");
      } else {
        fwrite($file, "),\n");
      }
    }

    fclose($file);
    updateFileTableName(dbConnect(), $modele, $_POST['nom_fichier'], $nomTable);
    downloadFile($modele,"sql");
    exit();
  }
?>