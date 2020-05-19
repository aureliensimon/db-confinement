<?php

function useboolean (){
    return random_int(0,1);
}

function usechar(){
    $alphabet="ABCDEFGHIJQLMNOPQRSTUVWXYZ";
    $aleatoire=random_int(0,25);
    return $alphabet[$aleatoire];
}

function useheure(){
    $timestamp = mt_rand(1, time());
    $randomDate = date("H:i:s", $timestamp);
    return $randomDate;
}

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

function usedatetime($min,$max){
    $format = 'Y-m-d H:i:s';
    $heureetdate=usrDate($min,$max)." ".useheure();
    
   $date = DateTime::createFromFormat($format, $heureetdate);
    return $date->format('Y-m-d H:i:s');
} 


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


function useint($min,$max){
    if(!isset($min)){
        $min=PHP_INT_MIN;
    }
    if (!isset($max)){
        $max=PHP_INT_MAX;
    }
    return random_int($min,$max);
}


function usetiny($min,$max){
    if(!isset($min) || $min<-128){
        $min=-128;
    }
    if (!isset($max)|| $max>127){
        $max=127;
    }
    return random_int($min,$max);
}


function usevarchar($longueur){
    $randomtext="";
    if ($longueur > 100) {
        $taille=useint(1, 100);
    } else {
        $taille=useint(1,$longueur);
    }
    for ($i=0; $i < $taille; $i++) { 
        $randomtext=$randomtext.usechar();
    }
    return $randomtext;
}

function usefile ($fichier){
    $fichier=file($_SERVER['DOCUMENT_ROOT'] . '/db-confinement/userfile/' . $fichier);
    $taillefichier= sizeof($fichier);
    $aleatoire=useint(0,$taillefichier-1);
    
    return $fichier[$aleatoire];
}


?>