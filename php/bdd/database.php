<?php

require_once('connexionbdd.php');

function dbConnect()
  {
    try
    {
      $db = new PDO('mysql:host='.DB_SERVER.';dbname='.DB_NAME.';charset=utf8',
        DB_USER, DB_PASSWORD);
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
    }
    catch (PDOException $exception)
    {
      error_log('Connection error: '.$exception->getMessage());
      return false;
    }
    return $db;
    }


function selecttruetype($db)
    {
        try
        {
        $request = 'SELECT *  FROM type_champ';
        $statement = $db->prepare($request);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $type) {
            if($type['actif']){
                echo "<option value=\"".$type['type_champ']."\">".$type['type_champ']."</option>";
            }
        }
        }
        catch (PDOException $exception)
        {
        error_log('Request error: '.$exception->getMessage());
        return false;
        }
    }

    function displaytruetype($db)
    {
        try
        {
        $request = 'SELECT *  FROM type_champ';
        $statement = $db->prepare($request);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $type) {
            if($type['actif']){
              echo "<p class=\"type_box\">".$type['type_champ']."</p>";
            }
        }
        }
        catch (PDOException $exception)
        {
        error_log('Request error: '.$exception->getMessage());
        return false;
        }
    }

    function selectalltype($db)
    {
        try
        {
        $request = 'SELECT *  FROM type_champ';
        $statement = $db->prepare($request);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $type) {
              echo "<option value=\"".$type['type_champ']."\">".$type['type_champ']."</option>";   
        }
        }
        catch (PDOException $exception)
        {
        error_log('Request error: '.$exception->getMessage());
        return false;
        }
    }

function insert_nom_modele($db,$nom_modele)

    
    {
      $timestamp = date('Y-m-d');
        try
        {
        $request = 'INSERT INTO modele (libelle,date_creation) VALUES (:nommodele,:timestamp)';
        $statement = $db->prepare($request);
        /*$statement->bindParam(':nommodele', $nom_modele, PDO::PARAM_STR);
        $statement->bindParam(':timestamp', $timestamp, PDO::PARAM_STR);*/
        $statement->execute(array(
          'nommodele'=>$nom_modele,
          'timestamp'=>$timestamp
        ));
        }
        catch (PDOException $exception)
        {
        error_log('Request error: '.$exception->getMessage());
        return $exception;
        }
    }


    function insert_champ_date($db,$nom_modele,$nom_champ,$max,$min,$type,$fichier)

    
    {
        try
        {
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
        }
        catch (PDOException $exception)
        {
        error_log('Request error: '.$exception->getMessage());
        return $exception;
        }
    }

    function insert_champ_int_and_tiny($db,$nom_modele,$nom_champ,$max,$min,$type,$fichier)

    
    {
        try
        {
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
        }
        catch (PDOException $exception)
        {
        error_log('Request error: '.$exception->getMessage());
        return $exception;
        }
    }


    function insert_char_bool_time($db,$nom_modele,$nom_champ,$type,$fichier)

    
    {
        try
        {
        $request = 'INSERT INTO champ (nom_champ,type_champ,libelle,fichier) VALUES (:nomchamp,:typechamp,:nommodele,:fichier)';
        $statement = $db->prepare($request);
        $statement->execute(array(
          'nomchamp'=>$nom_champ,
          'typechamp'=>$type,
          'nommodele'=>$nom_modele,
          'fichier'=>$fichier

          
        ));
        }
        catch (PDOException $exception)
        {
        error_log('Request error: '.$exception->getMessage());
        return $exception;
        }
    }


    function insert_varchar($db,$nom_modele,$nom_champ,$longueur,$type,$fichier)

    
    {
        try
        {
        $request = 'INSERT INTO champ (nom_champ,longueur,type_champ,libelle,fichier) VALUES (:nomchamp,:longueur,:typechamp,:nommodele,:fichier)';
        $statement = $db->prepare($request);
        $statement->execute(array(
          'nomchamp'=>$nom_champ,
          'longueur'=>$longueur,
          'typechamp'=>$type,
          'nommodele'=>$nom_modele,
          'fichier'=>$fichier
          
        ));
        }
        catch (PDOException $exception)
        {
        error_log('Request error: '.$exception->getMessage());
        return $exception;
        }
    }




    function true_to_false($db,$type)

    
    {
        try
        {
        $request = 'UPDATE type_champ SET actif=0 WHERE type_champ=:type';
        $statement = $db->prepare($request);
        $statement->execute(array(
          'type'=>$type
        ));
        }
        catch (PDOException $exception)
        {
        error_log('Request error: '.$exception->getMessage());
        return $exception;
        }
    }


    function false_to_true($db,$type)

    
    {
        try
        {
        $request = 'UPDATE type_champ SET actif=1 WHERE type_champ=:type';
        $statement = $db->prepare($request);
        $statement->execute(array(
          'type'=>$type
        ));
        }
        catch (PDOException $exception)
        {
        error_log('Request error: '.$exception->getMessage());
        return $exception;
        }
    }


    function return_type_condition($db,$type)
    {
        try
        {
        $request = 'SELECT actif  FROM type_champ WHERE type_champ=:type';
        $statement = $db->prepare($request);
        $statement->execute(array(
          'type'=>$type
        ));
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
        }
        catch (PDOException $exception)
        {
        error_log('Request error: '.$exception->getMessage());
        return false;
        }
    }


    function dispayminmax($min,$max){
      if(!isset($min)&&!isset($max)){
       echo "<span> vous n'avez pas défini de limite </span>";
      }else if (!isset($min)&&isset($max)){
          echo      "<span>min:</span>";
          echo      "<span> pas de limite </span>";
          echo      "<span>  max:</span>";
          echo      "<span>".$max."</span>";
      }else if(isset($min)&&!isset($max)){
          echo      "<span>min:</span>";
          echo      "<span>".$min." </span>";
          echo      "<span>  max:</span>";
          echo      "<span>pas de limite </span>";
      }else{
          echo      "<span>min:</span>";
          echo      "<span>".$min."</span>";
          echo      "<span>  max:</span>";
          echo      "<span>".$max."</span>";
      }
    }
        
        
        
        
        
        
        
        
        
        
        


    function tableau($db,$nom_modele){
      try
      {
      $request = 'SELECT  * FROM champ WHERE libelle=:nommodele';
      $statement = $db->prepare($request);
      $statement->execute(array(
        'nommodele'=>$nom_modele
      ));
      $result = $statement->fetchAll(PDO::FETCH_ASSOC);
      foreach ($result as $idtype => $arraytype) {          
          echo "<div>";
          echo  "<div class=\"ligne d-flex bd-highlight\" >";
          echo   "<div  class=\"p-2  bd-highlight align-self-center suppr\">X</div>";
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
           echo "</div>";
        
        
      }
      }
      catch (PDOException $exception)
      {
      error_log('Request error: '.$exception->getMessage());
      return false;
      }

    }



    function all_possible_insert ($fonction,$db,$nom_modele,$nom_champ,$max,$min,$type,$fichier){
      if(isset($fichier)){
        if(strcmp($min,'')==0 && strcmp($max,'')==0){
          $return=$fonction($db,$nom_modele,$nom_champ,NULL,NULL,$type,$fichier);
        }
        else if(strcmp($min,'')==0 || strcmp($max,'')==0){
              if(strcmp($min,'')==0){
                $return=$fonction($db,$nom_modele,$nom_champ,$max,NULL,$type,$fichier);
              }else if(strcmp($max,'')==0){
                $return=$fonction($db,$nom_modele,$nom_champ,NULL,$min,$type,$fichier);
              }
        }else{
          $return=$fonction($db,$nom_modele,$nom_champ,$max,$min,$type,$fichier);
        }
        return $return;
      }else{

        if(strcmp($min,'')==0 && strcmp($max,'')==0){
          $return=$fonction($db,$nom_modele,$nom_champ,NULL,NULL,$type,NULL);
        }
        else if(strcmp($min,'')==0 || strcmp($max,'')==0){
              if(strcmp($min,'')==0){
                $return=$fonction($db,$nom_modele,$nom_champ,$max,NULL,$type,NULL);
              }else if(strcmp($max,'')==0){
                $return=$fonction($db,$nom_modele,$nom_champ,NULL,$min,$type,NULL);
              }
        }else{
          $return=$fonction($db,$nom_modele,$nom_champ,$max,$min,$type,NULL);
        }
        return $return;

      }
    }

    





?>