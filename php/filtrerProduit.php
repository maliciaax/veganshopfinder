<?php
    include("./connexion.php");

    $filtre = $_GET["filtre"];

    $filtre = mysqli_real_escape_string($conn, $_GET["filtre"]);

    $req="SELECT GROUP_CONCAT(nomProd SEPARATOR ', ') as listeProd, idMag, nomMag, adresse, codePostal, numMag, mailMag, ville, altitude, longitude, latitude, imgSrc, stock FROM produit
        INNER JOIN appartenir ON produit.idProd = appartenir.idProd
        INNER JOIN magasin ON magasin.idMag = appartenir.idMag WHERE nomProd LIKE '%".$filtre."%' GROUP BY magasin.idMag ORDER BY magasin.idMag ASC";
 
    $result = $conn->query($req);

    $lesMagasins=array();

    foreach($result as $magasin){
        array_push($lesMagasins, $magasin);
    }

    echo json_encode($lesMagasins);

?>