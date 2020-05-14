<?php
  /*
  CREATE TABLE `champ` (
    `id` int(11) NOT NULL,
    `nom_champ` varchar(50) NOT NULL,
    `longueur` double DEFAULT NULL,
    `val_min_nb` double DEFAULT NULL,
    `val_max_nb` double DEFAULT NULL,
    `val_min_date` date DEFAULT NULL,
    `val_max_date` date DEFAULT NULL,
    `liste_txt` varchar(1024) DEFAULT NULL,
    `fichier` varchar(1024) DEFAULT NULL,
    `libelle` varchar(50) NOT NULL,
    `type_champ` varchar(1024) NOT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

  --
  -- Contenu de la table `champ`
  --

  INSERT INTO `champ` (`id`, `nom_champ`, `longueur`, `val_min_nb`, `val_max_nb`, `val_min_date`, `val_max_date`, `liste_txt`, `fichier`, `libelle`, `type_champ`) VALUES
  (1, 'merci', NULL, NULL, NULL, '2020-05-13', '2020-05-31', NULL, NULL, 'test', 'DATETIME'),
  (2, 'azert', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'test', 'INT'),
  (3, 'testtableau', NULL, NULL, NULL, '2020-05-13', NULL, NULL, NULL, 'test', 'DATE'),
  (4, 'wxcv', NULL, NULL, 240, NULL, NULL, NULL, NULL, 'test', 'TINYINT');
  */
  require_once('bdd/database.php');
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
  foreach($tab as &$e) {
    fwrite($file, "`" . $e['nom_champ'] . "`, ");
  }
  fwrite($file, ") VALUES\n");

  print_r(array_keys($tab[0]));
  foreach($tab as &$e) {
    switch ($e['type_champ']) {
      case 'DATE':
          genererDate($e['val_min_date'], $e['val_max_date'], $e['fichier']);
          break;
    }
  }

  fclose($file);
?>