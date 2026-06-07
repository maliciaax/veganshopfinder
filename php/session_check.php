<?php
    //à mettre en haut de chaque page souhaitée
    // Il vérifie que la session est valide et pas expirée (10 min)

    if (!isset($_SESSION['id'])){
        return; 
    }  // pas connecté, pas besoin de vérifier

    $DUREE_SESSION = 10 * 60; //10 min en secondes

    if (isset($_SESSION['derniere_activite'])) {
        if (time() - $_SESSION['derniere_activite'] > $DUREE_SESSION) {
            //session expirée
            session_unset();
            session_destroy();
            header('Location: /peguy/appliVegan/connexionUtilisateur-Form.php?erreur=expire');
            exit();
        }
    }
    // reset la duréee de session à chaque action
    $_SESSION['derniere_activite'] = time();
?>
