<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/form.css">
    <title>VeganShopFinder | Connexion</title>
</head>
<body>
    <a href="#contenu-principal" class="skip-link">Aller au contenu principal</a>
    <?php include("menu_public.php"); ?>

    <?php
    $msgs = [
        'identifiants' => 'Login ou mot de passe incorrect.',
        'champs'       => 'Tous les champs sont obligatoires.',
        'expire'       => 'Votre session a expiré (10 min). Reconnectez-vous.',
    ];
    if (isset($_GET['erreur']) && isset($msgs[$_GET['erreur']])): ?>
        <p class="msg-erreur" role="alert"><?= $msgs[$_GET['erreur']] ?></p>
    <?php endif; ?>

    <main class="mainForm" id="contenu-principal">
        <div class="form">
            <span class="titre">Connexion</span>
            <form method="post" action="php/connexionUtilisateur.php" novalidate>
                <div class="informations">
                    <input type="text"     name="login" placeholder="Login"         required aria-required="true" autocomplete="username">
                    <input type="password" name="mdp"   placeholder="Mot de passe"  required aria-required="true" autocomplete="current-password">
                    <button class="boutonLogin" type="submit">Se connecter</button>
                </div>
            </form>
            <p class="message">Pas encore de compte ? <a href="creerCompteUtilisateur-Form.php">Créez-en un</a></p>
        </div>
    </main>
</body>
</html>
