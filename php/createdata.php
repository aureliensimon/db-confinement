<?php

function useboolean (){
    return random_int(0,1);
}

function usechar(){
    $alphabet="ABCDEFGHIJQLMNOPQRSTUVWXYZ";
    $aleatoire=random_int(0,25);
    return $alphabet[$aleatoire];
}


function genererDate($min,$max){
    $start=strtotime($min);
    $end=strtotime($max);
    $timestamp = mt_rand($start, $end);
    $randomDate = date("Y-m-d", $timestamp);
    return $randomDate;
}

echo usedateminetmax(NULL,"1980-05-17");

function usedatetime(){
    $format = 'Y-m-d';
    $date = DateTime::createFromFormat("Y-m-d", usedate());
    return $date->format('Y-m-d H:i:s');
} 

//echo usedatetime();








?>