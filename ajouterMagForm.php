<?php
session_start();
    include('php/session_check.php');
    if (!isset($_SESSION['id']) || $_SESSION['role'] !== 'gerant') {
        header('Location: connexionUtilisateur-Form.php'); exit();
    }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/form.css">
    <title>VeganShopFinder | Ajouter un magasin</title>
</head>
<body>
    <a href="#contenu-principal" class="skip-link">Aller au contenu principal</a>
    <?php include("gerant/menu_gerant.php"); ?>

    <?php if (isset($_GET['succes'])): ?>
        <p class="msg-succes" role="status">Magasin ajouté avec succès !</p>
    <?php elseif (isset($_GET['erreur'])): ?>
        <p class="msg-erreur" role="alert">Une erreur est survenue, réessayez.</p>
    <?php endif; ?>

    <main class="mainForm" id="contenu-principal">
        <div class="form" style="max-width:480px">
            <span class="titre">Ajouter mon magasin</span>
            <form method="post" action="php/ajouterMag.php" novalidate>
                <div class="informations">
                    <input type="text"  name="nomMag"    placeholder="Nom du magasin"           required aria-required="true">
                    <input type="text"  name="ville"     placeholder="Ville"                    required aria-required="true">
                    <input type="text"  name="adresse"   placeholder="Adresse"                  required aria-required="true">
                    <input type="text"  name="codePostal" placeholder="Code postal (5 chiffres)" required aria-required="true" pattern="[0-9]{5}">
                    <input type="tel"   name="numMag"    placeholder="Téléphone (0612…)"         required aria-required="true" pattern="^0[0-9]{9}$">
                    <input type="email" name="mailMag"   placeholder="E-mail du magasin"         required aria-required="true">
                    <input type="text"  name="latitude"  placeholder="Latitude  (ex: 43.29)"    required aria-required="true">
                    <input type="text"  name="longitude" placeholder="Longitude (ex: 5.38)"     required aria-required="true">
                    <input type="text"  name="imgSrc"    placeholder="Nom image (ex: mag.jpg)"  required aria-required="true">
                    <button class="boutonLogin" type="submit">Ajouter le magasin</button>
                </div>
            </form>
        </div>
    </main>
</body>
</html>
