<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/fiche.css">
    <link rel="icon" href="img/logo1.png" type="image/x-icon">
    <title>VeganShopFinder | Fiche magasin</title>
</head>
<body>
    <a href="#contenu-principal" class="skip-link">Aller au contenu principal</a>
    <?php
        if (isset($_SESSION['role'])) {
            if ($_SESSION['role'] == "client") include("user/menu_user.php");
            elseif ($_SESSION['role'] == "gerant") include("gerant/menu_gerant.php");
        } else {
            include("menu_public.php");
        }
        $idMag = isset($_GET['idMag']) ? (int)$_GET['idMag'] : 0;
    ?>

    <main class="fiche-main" id="contenu-principal">
        <div id="fiche-contenu">
            <p style="color:#aaa;text-align:center;padding:2rem">Chargement...</p>
        </div>
    </main>

    <script>
        const estConnecte = <?= isset($_SESSION['id']) ? 'true' : 'false' ?>;
        const role = "<?= $_SESSION['role'] ?? '' ?>";
        const idMag = <?= $idMag ?>;
    </script>
    <script src="js/fiche.js"></script>
</body>
</html>
