<?php
  if(!isset($_SESSION)) { 
    session_start(); 
  } 
  require_once('bdd/database.php');
  require_once('createdata.php');
  
  function t ($db,$nom_modele) {
    try {
      $request = 'SELECT  * FROM champ WHERE libelle=:nommodele';
      $statement = $db->prepare($request);
      $statement->execute(array(
        'nommodele'=>$nom_modele
      ));
      $result = $statement->fetchAll(PDO::FETCH_ASSOC);
      return $result;
    } catch (PDOException $exception) {
      error_log('Request error: '.$exception->getMessage());
      return false;
    }
  }

  function getRandomData ($e) {
    $randomData;
    if ($e['liste_txt']) {
      $randomData = usefile($_SERVER['DOCUMENT_ROOT'] . '/db-confinement/data/list/' .$e['liste_txt']);
    } else if ($e['fichier'] ) {
      $randomData = usefile($_SERVER['DOCUMENT_ROOT'] . '/db-confinement/userfile/' .$e['fichier']);
    } else {
      switch ($e['type_champ'] ) {
        case 'DATE':
          $randomData = useDate($e['val_min_date'], $e['val_max_date']);
          break;
        case 'BOOLEAN':
          $randomData = useboolean();
          break;
        case 'CHAR':
          $randomData = usechar();
          break;
        case 'DATETIME':
          $randomData = usedatetime($e['val_min_date'], $e['val_max_date']);
          break;
        case 'INT':
          $randomData = useint($e['val_min_nb'], $e['val_max_nb']);
          break;
        case 'TINYINT':
          $randomData = usetiny($e['val_min_nb'], $e['val_max_nb']);
          break;
        case 'DOUBLE':
          $randomData = usedouble($e['val_min_nb'], $e['val_max_nb']);
          break;
        case 'VARCHAR':
          $randomData = usevarchar($e['longueur']);
          break;
        default:
          $randomData = 'mauvais type';
      }
    }
    return $randomData;
  }

  function downloadFile ($modele,$extension) {
    $file = "../userfile/" . $modele .".". $extension; 

    header("Content-Description: File Transfer"); 
    header("Content-Type: application/octet-stream"); 
    header("Content-Disposition: attachment; filename=\"". htmlspecialchars($_POST['nom_fichier']) .".". $extension ."\""); 
  
    readfile ($file);
  }
/*
  $nomTable = $_POST['nom_table_sql'];
  $nombreLignes = $_POST['max'];
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
  */
?>