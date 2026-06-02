<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/form.css">
    <title>VeganShopFinder | Créer un compte</title>
</head>
<body>
    <a href="#contenu-principal" class="skip-link">Aller au contenu principal</a>
    <?php include("menu_public.php"); ?>

    <?php
    $msgs = [
        'email'  => 'Adresse e-mail invalide.',
        'tel'    => 'Numéro invalide (ex : 0612345678).',
        'champs' => 'Tous les champs sont obligatoires.',
        'code'   => 'Code gérant invalide ou déjà utilisé.',
        'bdd'    => 'Erreur lors de la création du compte.',
    ];
    if (isset($_GET['erreur']) && isset($msgs[$_GET['erreur']])): ?>
        <p class="msg-erreur" role="alert"><?= $msgs[$_GET['erreur']] ?></p>
    <?php endif; ?>
    <?php if (isset($_GET['succes'])): ?>
        <p class="msg-succes" role="status">Compte créé avec succès ! <a href="connexionUtilisateur-Form.php">Connectez-vous</a></p>
    <?php endif; ?>

    <main class="mainForm" id="contenu-principal" style="flex-direction:column;gap:2.5rem;align-items:center">

        <!-- Client -->
        <section aria-labelledby="titre-client" style="width:100%;max-width:420px">
            <div class="form">
                <span class="titre" id="titre-client">Créer un compte client</span>
                <form method="post" action="php/creationUtilisateur.php" novalidate>
                    <div class="informations">
                        <input type="text" name="login" placeholder="Login" required aria-required="true">
                        <input type="text" name="nom" placeholder="Nom"  required aria-required="true">
                        <input type="text" name="prenom" placeholder="Prénom" required aria-required="true">
                        <input type="tel" name="tel" placeholder="Téléphone" required aria-required="true"
                               pattern="^0[0-9]{9}$" aria-describedby="aide-tel">
                        <span id="aide-tel" class="message">Format : 0612345678</span>
                        <input type="email"    name="email"  placeholder="E-mail" required aria-required="true">
                        <input type="password" name="mdp"    placeholder="Mot de passe (8+ car.)" required aria-required="true" minlength="8">
                        <button class="boutonLogin" type="submit">S'inscrire</button>
                    </div>
                </form>
                <p class="message">Déjà un compte ? <a href="connexionUtilisateur-Form.php">Connectez-vous</a></p>
            </div>
        </section>

        <!-- Gérant -->
        <section aria-labelledby="titre-gerant" style="width:100%;max-width:420px">
            <div class="form">
                <span class="titre" id="titre-gerant">Vous gérez un magasin ?</span>
                <p class="message" style="margin-top:0.5rem">
                    Un <strong>code d'invitation</strong> vous est transmis par notre équipe après vérification.
                    Contactez-nous à <a href="mailto:contact@veganshopfinder.fr">contact@veganshopfinder.fr</a>.
                </p>
                <form method="post" action="php/creationGerant.php" novalidate>
                    <div class="informations">
                        <input type="text" name="login" placeholder="Login" required aria-required="true">
                        <input type="text" name="nom" placeholder="Nom" required aria-required="true">
                        <input type="text" name="prenom" placeholder="Prénom" required aria-required="true">
                        <input type="tel" name="tel" placeholder="Téléphone"  required aria-required="true" pattern="^0[0-9]{9}$">
                        <input type="email" name="email" placeholder="E-mail" required aria-required="true">
                        <input type="password" name="mdp" placeholder="Mot de passe (8+ car.)" required aria-required="true" minlength="8">
                        <input type="text" name="codeInvitation" placeholder="Code d'invitation"vrequired aria-required="true" aria-describedby="aide-code">
                        <span id="aide-code" class="message">Code reçu par e-mail après validation de votre dossier.</span>
                        <button class="boutonLogin" type="submit">Créer mon compte gérant</button>
                    </div>
                </form>
            </div>
        </section>

    </main>
</body>
</html>
