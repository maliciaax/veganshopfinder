<?php
    header("Access-Control-Allow-Origin: *");

    /*$user = "root";
    $mdp = "";
    $host = "localhost";
    $bdd = "veganshopfinder";*/

    $user = "user";
    $mdp = "mpd";
    $host = "host";
    $bdd = "bdd";

    $conn = new mysqli($host,$user,$mdp,$bdd);

?>