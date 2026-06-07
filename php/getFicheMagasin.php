<?php
    include("./connexion.php");

    $idMag = isset($_GET['idMag']) ? (int)$_GET['idMag'] : 0;
    if (!$idMag) { echo json_encode(null); exit(); }

    //infos magasins
    $req = $conn->prepare("
        SELECT magasin.*, 
            GROUP_CONCAT(nomProd SEPARATOR ', ') as listeProd,
            ROUND(AVG(commentaire.note), 1) as moyenneNote
        FROM magasin
        LEFT JOIN appartenir ON magasin.idMag = appartenir.idMag
        LEFT JOIN produit ON appartenir.idProd = produit.idProd
        LEFT JOIN commentaire ON commentaire.idMag = magasin.idMag
        WHERE magasin.idMag = ?
        GROUP BY magasin.idMag
    "); //round ->arrondit au suppérieur  avg -> a l'inferrieur
    $req->bind_param("i", $idMag);
    $req->execute();
    $magasin = $req->get_result()->fetch_assoc();

    // Commentaires
    $reqComm = $conn->prepare("
        SELECT commentaire.titre, commentaire.contenu, commentaire.note, commentaire.dateCom,
            user.nom, user.prenom
        FROM commentaire
        JOIN user ON commentaire.id = user.id
        WHERE commentaire.idMag = ?
        ORDER BY commentaire.dateCom DESC
    ");
    $reqComm->bind_param("i", $idMag);
    $reqComm->execute();
    $commentaires = $reqComm->get_result()->fetch_all(MYSQLI_ASSOC);

    $magasin['commentaires'] = $commentaires;
    echo json_encode($magasin);
?>
