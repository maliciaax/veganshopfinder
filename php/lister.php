<?php
    include("./connexion.php");

    $req = "SELECT 
        GROUP_CONCAT(nomProd SEPARATOR ', ') as listeProd, 
        magasin.idMag, nomMag, adresse, codePostal, numMag, mailMag, ville, 
        altitude, longitude, latitude, imgSrc, stock,
        ROUND(AVG(commentaire.note), 1) as moyenneNote
    FROM produit
    INNER JOIN appartenir ON produit.idProd = appartenir.idProd
    INNER JOIN magasin ON magasin.idMag = appartenir.idMag
    LEFT JOIN commentaire ON commentaire.idMag = magasin.idMag
    GROUP BY magasin.idMag 
    ORDER BY magasin.idMag ASC";

    $result = $conn->query($req);
    $lesMagasins = array();
    foreach ($result as $magasin) {
        array_push($lesMagasins, $magasin);
    }
    echo json_encode($lesMagasins);
?>
