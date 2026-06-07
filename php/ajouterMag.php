<?php
    session_start();
    include('session_check.php');
    //déconnexion si ce n'est pas un gérant (connaitre l'url)
    if (!isset($_SESSION['id']) || $_SESSION['role'] !== 'gerant') {
        header('Location: ../connexionUtilisateur-Form.php');
        exit();
    }
    include('./connexion.php');

    $nomMag    = trim($_POST["nomMag"] ?? ''); //trim = suppriemr les espaces
    $ville     = trim($_POST["ville"] ?? '');
    $adresse   = trim($_POST["adresse"] ?? '');
    $codePostal= trim($_POST["codePostal"] ?? '');
    $numMag    = trim($_POST["numMag"] ?? '');
    $mailMag   = trim($_POST["mailMag"] ?? '');
    $latitude  = trim($_POST["latitude"] ?? '');
    $longitude = trim($_POST["longitude"] ?? '');
    $imgSrc    = trim($_POST["imgSrc"] ?? '');
    $idGerant  = (int)$_SESSION['id'];

    if (empty($nomMag)||empty($ville)||empty($adresse)||empty($codePostal)||empty($numMag)||empty($mailMag)) {
        header('Location: ../ajouterMagForm.php?erreur=champs'); exit();
    }

    $req = $conn->prepare("INSERT INTO magasin (nomMag, ville, adresse, codePostal, numMag, mailMag, latitude, longitude, id, imgSrc) VALUES (?,?,?,?,?,?,?,?,?,?)");
    $req->bind_param("ssssssddis", $nomMag, $ville, $adresse, $codePostal, $numMag, $mailMag, $latitude, $longitude, $idGerant, $imgSrc);

    if ($req->execute()) {
        header('Location: ../ajouterMagForm.php?succes=1');
    } else {
        header('Location: ../ajouterMagForm.php?erreur=1');
    }
    exit();
?>
