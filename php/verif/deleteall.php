<?php

session_start();
require_once('../bdd/database.php');

delete_all_champ_from_libelle(dbConnect(),$_POST['nom_modele']);
delete_libelle(dbConnect(),$_POST['nom_modele']);
header("location:".  $_SERVER['HTTP_REFERER']);


?>
