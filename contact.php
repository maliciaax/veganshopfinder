<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/form.css">
    <title>VeganShopFinder | Accueil</title>
</head>
<body>
    <a href="#contenu-principal" class="skip-link">Aller au contenu principal</a>
    <?php
        if (isset($_SESSION['role'])) {
            if ($_SESSION['role'] == "client") include("user/menu_user.php");
            elseif ($_SESSION['role'] == "gerant") include("gerant/menu_gerant.php");
            elseif ($_SESSION['role'] == "admin") include("admin/menu_admin.php");
        } else {
            include("menu_public.php");
        }
    ?>

    <main class="mainForm" id="contenu-principal">
        <div class="form">
            <span class="titre">Nous contacter</span>
            <div class="informations" style="gap:1.2rem">
                <div class="profil-champ">
                    <span class="profil-label">Adresse mail</span>
                    <span class="profil-valeur">contact@veganshopfinder.fr</span>
                </div>
                <hr class="separateur">
                <div class="profil-champ">
                    <span class="profil-label">Numéro de Téléphone</span>
                    <span class="profil-valeur">06 66 53 66 95</span>
                </div>
                <hr class="separateur">
            </div>
        </div>
    </main>

</body>
</html>