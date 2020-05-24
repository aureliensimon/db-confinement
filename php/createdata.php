<?php

/**
  * Génère un nombre aléatoire (1 ou 0)
  *
  * @return Bool    Valeur aléatoire
*/
function useboolean (){
    return random_int(0,1);
}

/**
  * Génère un caractère aléatoire
  *
  * @return Char    Charactère aléatoire
*/
function usechar(){
    $alphabet="ABCDEFGHIJQLMNOPQRSTUVWXYZ";
    $aleatoire=random_int(0,25);
    return $alphabet[$aleatoire];
}

/**
  * Génère une heure aléatoire
  *
  * @return Date    heure aléatoire
*/
function useheure(){
    $timestamp = mt_rand(1, time());
    $randomDate = date("H:i:s", $timestamp);
    return $randomDate;
}

/**
  * Génère une date aléatoire
  *
  * @param min      date minimale
  * @param max      date maximale
  *
  * @return Date    date aléatoire
*/
function useDate($min,$max){
    $start=strtotime($min);
    $end=strtotime($max);
    if ($start==NULL){
        $start=0;
    }
    if ($end==NULL){
        $end=time();
    }    
    $timestamp = mt_rand($start, $end);
    $randomDate = date("Y-m-d", $timestamp);
    return $randomDate;
    
}

/**
  * Génère une date et une heure aléatoire
  *
  * @param min      date minimale
  * @param max      date maximale
  *
  * @return Date    date et heure aléatoire
*/
function usedatetime($min,$max){
    $format = 'Y-m-d H:i:s';
    $heureetdate=useDate($min,$max)." ".useheure();
    
   $date = DateTime::createFromFormat($format, $heureetdate);
    return $date->format('Y-m-d H:i:s');
} 

/**
  * Génère un nombre à virgule aléatoire
  *
  * @param min      nombre minimale
  * @param max      nombre maximale
  *
  * @return Double  nombre aléatoire
*/
function usedouble($min,$max){
    if(!isset($min)){
        $min=PHP_INT_MIN;
    }
    if (!isset($max)){
        $max=PHP_INT_MAX;
    }
    $result=random_int(PHP_INT_MIN,PHP_INT_MAX)/random_int(PHP_INT_MIN,PHP_INT_MAX);
    if($min>$result || $result >$max){
        $result=usedouble($min,$max);
    }
    return $result;

}

/**
  * Génère un nombre aléatoire
  *
  * @param min      nombre minimale
  * @param max      nombre maximale
  *
  * @return Int     nombre aléatoire
*/
function useint($min,$max){
    if(!isset($min)){
        $min=PHP_INT_MIN;
    }
    if (!isset($max)){
        $max=PHP_INT_MAX;
    }
    return random_int($min,$max);
}

/**
  * Génère un petit nombre aléatoire
  *
  * @param min      nombre minimale
  * @param max      nombre maximale
  *
  * @return TinyInt nombre aléatoire
*/
function usetiny($min,$max){
    if(!isset($min) || $min<-128){
        $min=-128;
    }
    if (!isset($max)|| $max>127){
        $max=127;
    }
    return random_int($min,$max);
}

/**
  * Génère une chaîne de caractère aléatoire
  *
  * @param longueur nombre de caractères maximal
  *
  * @return String  chaîne de caractère aléatoire
*/
function usevarchar($longueur){
    $randomtext="";
    if ($longueur > 100|| !$longueur) {
        $taille=useint(1, 100);
    } else {
        $taille=useint(1,$longueur);
    }
    for ($i=0; $i < $taille; $i++) { 
        $randomtext=$randomtext.usechar();
    }
    return $randomtext;
}

/**
  * Génère des valeurs aléatoires depuis un fichier
  *
  * @param min      chemin du fichier
  *
  * @return String  valeur aléatoire
*/
function usefile ($fichier){
    $fichier=file($fichier);
    $taillefichier= sizeof($fichier);
    if($taillefichier==0){
        return "le fichier est vide";
    }
    $aleatoire=useint(0,$taillefichier-1);
    
    return trim($fichier[$aleatoire]);
}

?>