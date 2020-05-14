<?php
  require_once('bdd/database.php');
  require_once('createdata.php');
  session_start();

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

  $nomTable = 'table';

  $file = fopen($_SERVER['DOCUMENT_ROOT'] . '/db-confinement/userfile/output.txt','wb');

  fwrite($file, "CREATE TABLE `" . $nomTable . "` (\n");
  
  $tab = t(dbConnect(), 'asc');

  foreach ($tab as &$e) {
    if ($e['longueur']) {
      fwrite($file, "\t`" . $e['nom_champ'] . "` " . $e['type_champ'] . "(" . $e['longueur'] . ")" . " DEFAULT NULL" . "\n");
    } else {
      fwrite($file, "\t`" . $e['nom_champ'] . "` " . $e['type_champ'] . " DEFAULT NULL" . "\n");
    }
  }
  fwrite($file, ") ENGINE=InnoDB DEFAULT CHARSET=latin1;\n\n");

  fwrite($file, "INSERT INTO `" . $nomTable . "` (");
  $lineRandomData = array();
  foreach($tab as &$e) {
    array_push($lineRandomData, $e['nom_champ']);
    fwrite($file, "`" . $e['nom_champ'] . "`, ");
  }
  fwrite($file, ") VALUES\n");

  foreach($tab as &$e) {
    $randomData;
    switch ($e['type_champ']) {
      case 'DATE':
        $randomData = genererDate($e['val_min_date'], $e['val_max_date']);
        break;
      default:
        $randomData = 'a';
    }
    $lineRandomData[$e['nom_champ']] = $randomData;  
  }

  // AFFICHE AUSSI 3 ENTETE INUTILES
  print_r(array_keys($lineRandomData));
  foreach(array_keys($lineRandomData) as &$k) {
    print_r($lineRandomData[$k] . "\n");
  }

  fclose($file);
?>