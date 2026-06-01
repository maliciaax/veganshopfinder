<?php
// Inclure ce fichier en haut de chaque page protégée
// Il vérifie que la session est valide et pas expirée (10 min)

if (!isset($_SESSION['id'])) return; // pas connecté, pas besoin de vérifier

$DUREE_SESSION = 10 * 60; // 10 minutes en secondes

if (isset($_SESSION['derniere_activite'])) {
    if (time() - $_SESSION['derniere_activite'] > $DUREE_SESSION) {
        // Session expirée
        session_unset();
        session_destroy();
        header('Location: /peguy/appliVegan/connexionUtilisateur-Form.php?erreur=expire');
        exit();
    }
}
// Renouveler le timestamp à chaque action
$_SESSION['derniere_activite'] = time();
?>
