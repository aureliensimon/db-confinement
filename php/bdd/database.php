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


    function insert_champ_date($db,$nom_modele,$nom_champ,$max,$min,$type)

    
    {
        try
        {
        $request = 'INSERT INTO champ (nom_champ,val_min_date,val_max_date,type_champ,libelle) VALUES (:nomchamp,:valmin,:valmax,:typechamp,:nommodele)';
        $statement = $db->prepare($request);
        /*$statement->bindParam(':nommodele', $nom_modele, PDO::PARAM_STR);
        $statement->bindParam(':timestamp', $timestamp, PDO::PARAM_STR);*/
        $statement->execute(array(
          'nomchamp'=>$nom_champ,
          'valmin'=>$min,
          'valmax'=>$max,
          'typechamp'=>$type,
          'nommodele'=>$nom_modele
          
        ));
        }
        catch (PDOException $exception)
        {
        error_log('Request error: '.$exception->getMessage());
        return $exception;
        }
    }

    function insert_champ_int_and_tiny($db,$nom_modele,$nom_champ,$max,$min,$type)

    
    {
        try
        {
        $request = 'INSERT INTO champ (nom_champ,val_min_nb,val_max_nb,type_champ,libelle) VALUES (:nomchamp,:valmin,:valmax,:typechamp,:nommodele)';
        $statement = $db->prepare($request);
        $statement->execute(array(
          'nomchamp'=>$nom_champ,
          'valmin'=>$min,
          'valmax'=>$max,
          'typechamp'=>$type,
          'nommodele'=>$nom_modele
          
        ));
        }
        catch (PDOException $exception)
        {
        error_log('Request error: '.$exception->getMessage());
        return $exception;
        }
    }


    function insert_char_bool_time($db,$nom_modele,$nom_champ,$type)

    
    {
        try
        {
        $request = 'INSERT INTO champ (nom_champ,type_champ,libelle) VALUES (:nomchamp,:typechamp,:nommodele)';
        $statement = $db->prepare($request);
        $statement->execute(array(
          'nomchamp'=>$nom_champ,
          'typechamp'=>$type,
          'nommodele'=>$nom_modele
          
        ));
        }
        catch (PDOException $exception)
        {
        error_log('Request error: '.$exception->getMessage());
        return $exception;
        }
    }


    function insert_varchar($db,$nom_modele,$nom_champ,$longueur,$type)

    
    {
        try
        {
        $request = 'INSERT INTO champ (nom_champ,longueur,type_champ,libelle) VALUES (:nomchamp,:longueur,:typechamp,:nommodele)';
        $statement = $db->prepare($request);
        $statement->execute(array(
          'nomchamp'=>$nom_champ,
          'longueur'=>$longueur,
          'typechamp'=>$type,
          'nommodele'=>$nom_modele
          
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





?>