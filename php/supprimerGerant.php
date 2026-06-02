<?php
session_start();
include('../php/session_check.php');

if (!isset($_SESSION['id']) || $_SESSION['role'] !== 'gerant') {
    header('Location: ../connexionUtilisateur-Form.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../gerant/profilGerant.php');
    exit();
}

include('../php/connexion.php');
$id = (int)$_SESSION['id'];

// La suppression en cascade est gérée par le trigger MySQL.
// Supprimer l'user déclenche : suppression magasin(s) → stocks → commentaires → gerant
$stmt = $conn->prepare("DELETE FROM user WHERE id = ? AND role = 'gerant'");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    session_unset();
    session_destroy();
    header('Location: ../connexionUtilisateur-Form.php?msg=compte_supprime');
} else {
    header('Location: ../gerant/profilGerant.php?erreur=suppression');
}
exit();
