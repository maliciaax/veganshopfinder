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

// La suppression en cascade est gérée par le trigger MySQL.
// Il suffit de supprimer l'entrée dans `user`.
$stmt = $conn->prepare("DELETE FROM user WHERE id = ? AND role = 'client'");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    // Déconnexion propre après suppression
    session_unset();
    session_destroy();
    header('Location: ../connexionUtilisateur-Form.php?msg=compte_supprime');
} else {
    header('Location: ../user/profilUser.php?erreur=suppression');
}
exit();
