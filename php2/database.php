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

function insert_nom_modele($db,$nom_modele)

    
    {
      $timestamp = date("Y-m-d H:i:s");
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


?>