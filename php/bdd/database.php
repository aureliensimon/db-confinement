<?php

require_once('connexionbdd.php');

  /**
  * Connection à la base de données dont les informations se trouvent dans connexionbdd.php
  * 
  * @return Database
  */ 
  function dbConnect () {
    try {
      $db = new PDO('mysql:host='.DB_SERVER.';dbname='.DB_NAME.';charset=utf8', DB_USER, DB_PASSWORD);
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
    } catch (PDOException $exception) {
      error_log('Connection error: '.$exception->getMessage());
      return false;
    }
    
    return $db;
  }

  /**
  * Créer une liste déroulante comportant tout les types actifs
  *
  * @param Database   base de donnée à laquelle se connecter
  */ 
  function selecttruetype ($db) {
    try {
      $request = 'SELECT *  FROM type_champ';
      $statement = $db->prepare($request);
      $statement->execute();
      $result = $statement->fetchAll(PDO::FETCH_ASSOC);
      foreach ($result as $type) {
        if($type['actif']){
          echo "<option value=\"".$type['type_champ']."\">".$type['type_champ']."</option>";
        }
      }
    } catch (PDOException $exception) {
      error_log('Request error: '.$exception->getMessage());
      return false;
    }
  }

  /**
  * Affiche tout les types actifs
  *
  * @param Database   base de donnée à laquelle se connecter
  */ 
  function displaytruetype ($db) {
    try {
      $request = 'SELECT *  FROM type_champ';
      $statement = $db->prepare($request);
      $statement->execute();
      $result = $statement->fetchAll(PDO::FETCH_ASSOC);
      foreach ($result as $type) {
        if($type['actif']){
          echo "<p class=\"type_box\">".$type['type_champ']."</p>";
        }
      }
    } catch (PDOException $exception) {
      error_log('Request error: '.$exception->getMessage());
      return false;
    }
  }

  /**
  * Créer une liste déroulantes avec tout les types (actifs ou non)
  *
  * @param Database   base de donnée à laquelle se connecter
  */ 
  function selectalltype ($db) {
    try {
      $request = 'SELECT *  FROM type_champ';
      $statement = $db->prepare($request);
      $statement->execute();
      $result = $statement->fetchAll(PDO::FETCH_ASSOC);
      foreach ($result as $type) {
        echo "<option value=\"".$type['type_champ']."\">".$type['type_champ']."</option>";   
      }
    } catch (PDOException $exception) {
      error_log('Request error: '.$exception->getMessage());
      return false;
    }
  }

  /**
  * Insère un nouveau modèle dans la base de donnée
  *
  * @param Database   base de donnée à laquelle se connecter
  * @param nom_modele nom du modèle     
  */ 
  function insert_nom_modele ($db,$nom_modele) {
    $timestamp = date('Y-m-d');
    
    try {
      $request = 'INSERT INTO modele (libelle,date_creation) VALUES (:nommodele,:timestamp)';
      $statement = $db->prepare($request);
      $statement->execute(array(
        'nommodele'=>$nom_modele,
        'timestamp'=>$timestamp
      ));
    } catch (PDOException $exception) {
      error_log('Request error: '.$exception->getMessage());
      return $exception;
    }
  }

  /**
  * Insère un nouveau champ de type Date dans la base de donnée
  *
  * @param Database   base de donnée à laquelle se connecter
  * @param nom_modele nom du modèle
  * @param nom_modele nom du champ
  * @param max        date maximale autorisée pour la génération
  * @param min        date minimale autorisée pour la génération
  * @param type       type du champ
  * @param fichier    nom du fichier où prendre les dates pour la génération 
  */ 
  function insert_champ_date ($db,$nom_modele,$nom_champ,$max,$min,$type,$fichier) {
    try {
      $request = 'INSERT INTO champ (nom_champ,val_min_date,val_max_date,type_champ,libelle,fichier) VALUES (:nomchamp,:valmin,:valmax,:typechamp,:nommodele,:fichier)';
      $statement = $db->prepare($request);
      /*$statement->bindParam(':nommodele', $nom_modele, PDO::PARAM_STR);
      $statement->bindParam(':timestamp', $timestamp, PDO::PARAM_STR);*/
      $statement->execute(array(
        'nomchamp'=>$nom_champ,
        'valmin'=>$min,
        'valmax'=>$max,
        'typechamp'=>$type,
        'nommodele'=>$nom_modele,
        'fichier'=>$fichier
        
      ));
    } catch (PDOException $exception) {
      error_log('Request error: '.$exception->getMessage());
      return $exception;
    }
  }

  /**
  * Insère un nouveau champ de type Int / TinyInt dans la base de donnée
  *
  * @param Database   base de donnée à laquelle se connecter
  * @param nom_modele nom du modèle
  * @param nom_modele nom du champ
  * @param max        nombre maximale autorisée pour la génération
  * @param min        nombre minimale autorisée pour la génération
  * @param type       type du champ
  * @param fichier    nom du fichier où prendre les nombres pour la génération 
  */ 
  function insert_champ_int_and_tiny($db,$nom_modele,$nom_champ,$max,$min,$type,$fichier) {
    try {
      $request = 'INSERT INTO champ (nom_champ,val_min_nb,val_max_nb,type_champ,libelle,fichier) VALUES (:nomchamp,:valmin,:valmax,:typechamp,:nommodele,:fichier)';
      $statement = $db->prepare($request);
      $statement->execute(array(
        'nomchamp'=>$nom_champ,
        'valmin'=>$min,
        'valmax'=>$max,
        'typechamp'=>$type,
        'nommodele'=>$nom_modele,
        'fichier'=>$fichier
        
      ));
    } catch (PDOException $exception) {
      error_log('Request error: '.$exception->getMessage());
      return $exception;
    }
  }

  /**
  * Insère un nouveau champ de type Char / Booléen / Time dans la base de donnée
  *
  * @param Database   base de donnée à laquelle se connecter
  * @param nom_modele nom du modèle
  * @param nom_modele nom du champ
  * @param type       type du champ
  * @param fichier    nom du fichier où prendre les nombres pour la génération 
  */ 
  function insert_char_bool_time($db,$nom_modele,$nom_champ,$type,$fichier) {
    try {
      $request = 'INSERT INTO champ (nom_champ,type_champ,libelle,fichier) VALUES (:nomchamp,:typechamp,:nommodele,:fichier)';
      $statement = $db->prepare($request);
      $statement->execute(array(
        'nomchamp'=>$nom_champ,
        'typechamp'=>$type,
        'nommodele'=>$nom_modele,
        'fichier'=>$fichier 
      ));
    } catch (PDOException $exception) {
      error_log('Request error: '.$exception->getMessage());
      return $exception;
    }
  }

 /**
  * Insère un nouveau champ de type Varchar dans la base de donnée
  *
  * @param Database   base de donnée à laquelle se connecter
  * @param nom_modele nom du modèle
  * @param nom_modele nom du champ
  * @param longueur   longueur maximale du varchar
  * @param type       type du champ
  * @param fichier    nom du fichier où prendre les dates pour la génération
  * @param fichier    nom de la liste où prendre les chaînes de caractères pour la génération 
  */ 
  function insert_varchar($db,$nom_modele,$nom_champ,$longueur,$type,$fichier,$liste) {
    try {
      $request = 'INSERT INTO champ (nom_champ,longueur,type_champ,libelle,fichier,liste_txt) VALUES (:nomchamp,:longueur,:typechamp,:nommodele,:fichier,:liste)';
      $statement = $db->prepare($request);
      $statement->execute(array(
        'nomchamp'=>$nom_champ,
        'longueur'=>$longueur,
        'typechamp'=>$type,
        'nommodele'=>$nom_modele,
        'fichier'=>$fichier,
        'liste'=>$liste
        
      ));
    } catch (PDOException $exception) {
      error_log('Request error: '.$exception->getMessage());
      return $exception;
    }
  }

  /**
  * Mettre à jour un type actif à non actif
  *
  * @param Database   base de donnée à laquelle se connecter
  * @param type       type du champ 
  */ 
  function true_to_false ($db,$type) {
    try {
      $request = 'UPDATE type_champ SET actif=0 WHERE type_champ=:type';
      $statement = $db->prepare($request);
      $statement->execute(array(
        'type'=>$type
      ));
    } catch (PDOException $exception) {
      error_log('Request error: '.$exception->getMessage());
      return $exception;
    }
  }

  /**
  * Mettre à jour un type de non actif à actif
  *
  * @param Database   base de donnée à laquelle se connecter
  * @param type       type du champ 
  */ 
  function false_to_true ($db,$type) {
    try {
      $request = 'UPDATE type_champ SET actif=1 WHERE type_champ=:type';
      $statement = $db->prepare($request);
      $statement->execute(array(
        'type'=>$type
      ));
    } catch (PDOException $exception) {
      error_log('Request error: '.$exception->getMessage());
      return $exception;
    }
  }

  /**
  * Renvois si un type est actif ou non
  *
  * @param Database   base de donnée à laquelle se connecter
  * @param type       type du champ 
  *
  * @return Bool      True si le type est actif ou False sinon
  */ 
  function return_type_condition ($db,$type) {
    try {
      $request = 'SELECT actif  FROM type_champ WHERE type_champ=:type';
      $statement = $db->prepare($request);
      $statement->execute(array(
        'type'=>$type
      ));
      $result = $statement->fetchAll(PDO::FETCH_ASSOC);
      return $result;
    } catch (PDOException $exception) {
      error_log('Request error: '.$exception->getMessage());
      return false;
    }
  }

  /**
  * Retirer un type de la base de donnée
  *
  * @param Database   base de donnée à laquelle se connecter
  * @param id         identifiant du champ
  */ 
  function dropchamp ($db,$id) {
    try {
      $request = 'DELETE FROM champ WHERE id=:id';
      $statement = $db->prepare($request);
      $statement->execute(array(
        'id'=>$id
      ));
    } catch (PDOException $exception) {
      error_log('Request error: '.$exception->getMessage());
      return $exception;
    }
  }

  /**
  * Retirer tout les champs d'un modèle
  *
  * @param Database   base de donnée à laquelle se connecter
  * @param nom_modele nom du modèle
  */ 
  function delete_all_champ_from_libelle ($db,$nom_modele) {
    try {
      $request = 'DELETE FROM champ WHERE libelle=:nom_modele';
      $statement = $db->prepare($request);
      $statement->execute(array(
        'nom_modele'=>$nom_modele
      ));
    } catch (PDOException $exception) {
      error_log('Request error: '.$exception->getMessage());
      return $exception;
    }
  }
  
  /**
  * Retirer un libellé d'un modèle
  *
  * @param Database   base de donnée à laquelle se connecter
  * @param nom_modele nom du modèle
  */ 
  function delete_libelle ($db,$nom_modele) {
    try {
      $request = 'DELETE FROM modele WHERE libelle=:nom_modele';
      $statement = $db->prepare($request);
      $statement->execute(array(
        'nom_modele'=>$nom_modele
      ));
    } catch (PDOException $exception) {
      error_log('Request error: '.$exception->getMessage());
      return $exception;
    }
  }
    /**
  * Afficher le maximum / minimum s'ils existent dans le tableau
  *
  * @param min        valeur minimale
  * @param max        valeur maximale
  */ 
  function dispayminmax($min,$max){
    if(!isset($min)&&!isset($max)){
      echo "<span> vous n'avez pas défini de limite </span>";
    }else if (!isset($min)&&isset($max)){
      echo      "<span>min: </span>";
      echo      "<span> pas de limite </span>";
      echo      "<span>  max: </span>";
      echo      "<span>".$max."</span>";
    }else if(isset($min)&&!isset($max)){
      echo      "<span>min: </span>";
      echo      "<span>".$min." </span>";
      echo      "<span>  max: </span>";
      echo      "<span>pas de limite </span>";
    }else{
      echo      "<span>min: </span>";
      echo      "<span>".$min."</span>";
      echo      "<span>  max: </span>";
      echo      "<span>".$max."</span>";
    }
  }

  /**
  * Créer le tableau
  *
  * @param Database   base de donnée à laquelle se connecter
  * @param nom_modele nom du modele
  */ 
  function tableau($db,$nom_modele){
    try {
      $request = 'SELECT  * FROM champ WHERE libelle=:nommodele';
      $statement = $db->prepare($request);
      $statement->execute(array(
        'nommodele'=>$nom_modele
      ));
      $result = $statement->fetchAll(PDO::FETCH_ASSOC);
      foreach ($result as $idtype => $arraytype) {          
        echo   "<div>";
        echo   "<div class=\"ligne d-flex bd-highlight\" >";
        echo   "<form class =\"p-2  bd-highlight align-self-center suppr\" method=\"POST\" action=\"../verif/dropchamp.php\">";
        echo   "<input type=\"hidden\"  name=\"id\" value=\"".$arraytype['id']."\">";
        echo   "<button type=\"submit\">SUPPRIMER</button> ";
        echo   "</form>";
        echo   "<div  class=\"p-2  bd-highlight align-self-center nom\">".$arraytype['nom_champ']."</div>";
        echo   "<div  class=\"p-2  bd-highlight align-self-center type\">".$arraytype['type_champ']."</div>";
        if(isset($arraytype['longueur'])){
          echo   "<div  class=\"p-2  bd-highlight align-self-center taille\">".$arraytype['longueur']."</div>";
        }else{
          echo   "<div  class=\"p-2  bd-highlight align-self-center taille\">NULL</div>";
        }
        echo   "<div  class=\"p-2  bd-highlight align-self-center parametres\">";

        switch($arraytype['type_champ']){
          case 'INT':
            dispayminmax($arraytype['val_min_nb'],$arraytype['val_max_nb']);
            break;
          case 'TINYINT':
            dispayminmax($arraytype['val_min_nb'],$arraytype['val_max_nb']);
            break;
          case 'DOUBLE FLOAT':
            dispayminmax($arraytype['val_min_nb'],$arraytype['val_max_nb']);
            break;
          case 'DATE':
            dispayminmax($arraytype['val_min_date'],$arraytype['val_max_date']);
            break;
          case 'DATETIME':
            dispayminmax($arraytype['val_min_date'],$arraytype['val_max_date']);
            break;
          default:
            echo "<span> pas de paramètres</span>";
            break;
        }
        
        echo "</div>";
        if($arraytype['fichier'] == NULL && $arraytype['liste_txt']==NULL){
          echo   "<div  class=\"p-2  bd-highlight align-self-center fichier\">NULL</div>";
        }else if ($arraytype['liste_txt']!=NULL){
          echo   "<div  class=\"p-2  bd-highlight align-self-center fichier\">".$arraytype['liste_txt']."</div>";
        }else{
          echo   "<div  class=\"p-2  bd-highlight align-self-center fichier\">".$arraytype['fichier']."</div>";
        }
        
        echo "</div>";
      }
    } catch (PDOException $exception) {
      error_log('Request error: '.$exception->getMessage());
      return false;
    }
  }

  /**
  * Affiche message d'erreur
  *
  * @param  message     nom du message d'erreur
  *
  * @return HTML        div comportant le message d'erreur
  */ 
  function displayerreur ($message){
    return "<div id=\"erreur\"> <span>".$message."</span> </div>";
  }

  /**
  * Mettre à jour le nom du fichier et de la table
  *
  * @param  db          nom de la database
  * @param  libelle     nom du libille
  * @param  nomFichier  nom du fichier
  * @param  nomTalbe    nom de la table
  */ 
  function updateFileTableName($db, $libelle, $nomFichier, $nomTable) {
    try {
      $request = 'UPDATE modele SET nom_fichier=:nomFichier, nom_table=:nomTable WHERE libelle=:libelle';
      $statement = $db->prepare($request);
      $statement->execute(array(
        'libelle'=>$libelle,
        'nomFichier'=>$nomFichier,
        'nomTable'=>$nomTable
      ));
    } catch (PDOException $exception) {
      error_log('Request error: '.$exception->getMessage());
      return $exception;
    }
  }

  /**
  * Vérification si un modèle existe dans la base de donnée
  *
  * @param Database   base de donnée à laquelle se connecter
  * @param nom_modele nom du modele
  *
  * @return Bool      Vrai si existe, Faux sinon
  */
  function true_if_modele_exist($db,$nom_modele){
    try {
      $request = 'SELECT *  FROM modele WHERE libelle=:nom_modele';
      $statement = $db->prepare($request);
      $statement->execute(array(
        'nom_modele'=>$nom_modele
      ));
      $result = $statement->fetchAll(PDO::FETCH_ASSOC);
      if($result==array()){
        return 0;
      }else{
        return 1;
      }
    } catch (PDOException $exception) {
      error_log('Request error: '.$exception->getMessage());
      return false;
    }
  }

  /**
  * Vérification si un champ existe dans un modèle
  *
  * @param Database   base de donnée à laquelle se connecter
  * @param nom_modele nom du modele
  * @param nom_champ  nom du champ
  *
  * @return Bool      Vrai si existe, Faux sinon
  */
  function true_if_champ_exist($db,$nom_modele,$nom_champ){
    try {
      $request = 'SELECT *  FROM champ WHERE libelle=:nom_modele AND nom_champ=:nom_champ';
      $statement = $db->prepare($request);
      $statement->execute(array(
        'nom_modele'=>$nom_modele,
        'nom_champ'=>$nom_champ
      ));
      $result = $statement->fetchAll(PDO::FETCH_ASSOC);
      if($result==array()){
        return 0;
      }else{
        return 1;
      }
    } catch (PDOException $exception) {
      error_log('Request error: '.$exception->getMessage());
      return false;
    }
  }

  /**
  * Affiche tout les modèles présents dans la base de donnée
  *
  * @param Database   base de donnée à laquelle se connecter
  */
  function all_modele ($db){
    try {
      $request = 'SELECT *  FROM modele' ;
      $statement = $db->prepare($request);
      $statement->execute();
      $result = $statement->fetchAll(PDO::FETCH_ASSOC);
      
      foreach ($result as $valeur ) {
        echo "<div class=\"modele row align-items-center\">";
        echo    "<div class=\"col nom\">";
        echo        "<span>".$valeur['libelle']."</span>";
        echo    "</div>";
        echo    "<div class=\"col col-lg-2 \">";
        echo       "<form action=\"../verif/verif1-2.php\" method=\"post\">";
        echo            "<input type=\"hidden\" name=\"nom_modele\" value=\"".$valeur['libelle']."\">";
        echo            "<button  class=\"btn btn-success btn-lg  modif \" type=\"submit\"> MODIFIER</button>";
        echo      "</form>";
        echo    "</div>";
        echo    "<div class=\"col col-lg-2 \">";
        echo       "<form action=\"../verif/deleteall.php\" method=\"post\">";
        echo            "<input type=\"hidden\" name=\"nom_modele\" value=\"".$valeur['libelle']."\">";
        echo            "<button  class=\"btn btn-danger btn-lg delete\" type=\"submit\"> SUPPRIMER</button>";
        echo      "</form>";
        echo    "</div>";
        echo   "</div>";
        echo    "<div class=\"ligne\"></div>";
      }
    } catch (PDOException $exception) {
      error_log('Request error: '.$exception->getMessage());
      return false;
    }
  }

  /**
  * Change le nom du modèle
  *
  * @param Database   base de donnée à laquelle se connecter
  * @param new_name   nouveau nom du modèle
  * @param old_name   actuel nom du modèle
  */
  function changement_nom_modele ($db,$new_name,$old_name) {
    try {
      $request = 'UPDATE modele , champ SET libelle=:new_name WHERE libelle=:old_name';
      $statement = $db->prepare($request);
      $statement->execute(array(
        'new_name'=>$new_name,
        'old_name'=>$old_name
        
      ));
    } catch (PDOException $exception) {
      error_log('Request error: '.$exception->getMessage());
      return $exception;
    }
  }

  /**
  * Change le nom du nom du champ
  *
  * @param Database   base de donnée à laquelle se connecter
  * @param new_name   nouveau nom du libellé
  * @param old_name   actuel nom du libellé
  */
  function changement_libelle_table_champ ($db,$new_name,$old_name) {
    try {
      $request = 'UPDATE champ SET libelle=:new_name WHERE libelle=:old_name';
      $statement = $db->prepare($request);
      $statement->execute(array(
        'new_name'=>$new_name,
        'old_name'=>$old_name
        
      ));
    } catch (PDOException $exception) {
      error_log('Request error: '.$exception->getMessage());
      return $exception;
    }
  }
?>