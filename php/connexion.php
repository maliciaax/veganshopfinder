<?php
    header("Access-Control-Allow-Origin: *");

    $user = "root";
    $mdp = "";
    $host = "localhost";
    $bdd = "veganshopfinder";

    $conn = new mysqli($host,$user,$mdp,$bdd);

?>