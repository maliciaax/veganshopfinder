<?php
session_start();
    include('../php/session_check.php');

    if (!isset($_SESSION['id'])) {
        header('Location: ../connexionUtilisateur-Form.php');
        exit();
    }

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header('Location: ../user/profilUser.php');
        exit();
    }

    include('../php/connexion.php');
    $id = (int)$_SESSION['id'];

    // supprimer l'utilisateur le trigger plsql est fait sur user (supprime tout)
    $stmt = $conn->prepare("DELETE FROM user WHERE id = ? AND role = 'client'");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // déconnection
        session_unset();
        session_destroy();
        header('Location: ../connexionUtilisateur-Form.php?msg=compte_supprime');
    } else {
        header('Location: ../user/profilUser.php?erreur=suppression');
    }
    exit();
?>