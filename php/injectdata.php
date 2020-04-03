<?php
//random_int($intmin,$intmax); fonction dans php permettant de renvoyer un entier aléatoire un un min et un max


function random_date(){  // date aléatoire
    $year= mt_rand(1000, date("Y"));
    //Generate a random month.
    $month= mt_rand(1, 12);
    //Generate a random day.
    $day= mt_rand(1, 28);
    //Using the Y-M-D format.
    $randomDate = $year . "-" . $month . "-" . $day;
    return $randomDate;
}

function random_date_interval($Datemin,$Datemax){ // date aléatoire dans l'intervalle mais 10 ans en arrière pour l'instant
    $randomDate=random_date();
    if($Datemin>$randomDate || $Datemax<$randomDate){
        return random_date_interval($Datemin,$Datemax);
    }
    return $randomDate;
}


?>


