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







function genererDate($min,$max){
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
    $heureetdate=genererDate($min,$max)." ".useheure();
    
   $date = DateTime::createFromFormat($format, $heureetdate);
    return $date->format('Y-m-d H:i:s');
} 












?>