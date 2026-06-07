<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/map.css">
    <link rel="icon" href="img/logo1.png" type="image/x-icon">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <title>VeganShopFinder | Accueil</title>
</head>
<body>
    <?php
        if (isset($_SESSION['role'])) {
            if ($_SESSION['role'] == "client") include("user/menu_user.php");
            elseif ($_SESSION['role'] == "gerant") include("gerant/menu_gerant.php");
        } else {
            include("menu_public.php");
        }
        $idMagasin = isset($_GET['idMagasin']) ? (int)$_GET['idMagasin'] : 0;
    ?>

    <div id="map"></div>

    

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script>const idMagasinChoisi = <?= $idMagasin ?>;</script>
    <script src="js/map.js"></script>
</body>
</html>