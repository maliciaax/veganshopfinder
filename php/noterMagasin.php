<?php
    session_start();
    include("./connexion.php");

    if (!isset($_SESSION['id'])) {
        header('Location: ../connexionUtilisateur-Form.php');
        exit();
    }

    $idMag   = (int)$_POST['idMag'];
    $titre   = $_POST['titre'];
    $contenu = $_POST['contenu'];
    $note    = (int)$_POST['note'];
    $idUser  = (int)$_SESSION['id'];

    if (empty($titre) || empty($contenu) || !$note) {
        header('Location: ../noter.php?idMag=' . $idMag . '&erreur=champs');
        exit();
    }

    $req = $conn->prepare("INSERT INTO commentaire (titre, contenu, note, dateCom, idMag, id) VALUES (?, ?, ?, NOW(), ?, ?)");
    $req->bind_param("ssiis", $titre, $contenu, $note, $idMag, $idUser);
    $result = $req->execute();

    if ($result) {
        header('Location: ../magasin.php?succes=1');
    } else {
        header('Location: ../noter.php?idMag=' . $idMag . '&erreur=bdd');
    }
    exit();
?>
