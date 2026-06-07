<?php
    session_start();
    include('session_check.php');
    //déconnexion si ce n'est pas un gérant (connaitre l'url)
    if (!isset($_SESSION['id']) || $_SESSION['role'] !== 'gerant') {
        header('Location: ../connexionUtilisateur-Form.php'); 
        exit();
    }
    include('./connexion.php');

    $idMag  = (int)($_POST["idMag"] ?? 0);
    $idProd = (int)($_POST["idProd"] ?? 0);
    $stock  = (int)($_POST["stock"] ?? 0);

    if (!$idMag || !$idProd) {
        header('Location: ../ajouterProdForm.php?erreur=champs'); exit();
    }

    $req = $conn->prepare("INSERT INTO appartenir (idMag, idProd, stock) VALUES (?,?,?)");
    $req->bind_param("iii", $idMag, $idProd, $stock);

    if ($req->execute()) {
        header('Location: ../ajouterProdForm.php?succes=1');
    } else {
        header('Location: ../ajouterProdForm.php?erreur=1');
    }
    exit();
?>
