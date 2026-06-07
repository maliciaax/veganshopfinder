<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <link rel="icon" href="img/logo1.png" type="image/x-icon">
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

    <main class="hero" id="contenu-principal" role="main">
        <div class="hero-overlay">
            <h1 class="hero-titre">🌱 Trouvez votre magasin vegan</h1>
            <p class="hero-sous-titre">Produits bios, végétaux et éthiques près de chez vous</p>

            <form class="hero-form" action="magasin.php" method="get" role="search" aria-label="Recherche de magasin par ville">
                <label for="ville" class="sr-only">Choisissez votre ville</label>
                <select name="ville" id="ville" class="hero-select" required>
                    <option value="">-- Choisissez votre ville --</option>
                    <option value="marseille">Marseille</option>
                    <option value="allauch">Allauch</option>
                    <option value="martigue">Martigue</option>
                </select>
                <button type="submit" class="boutonLogin">Rechercher</button>
            </form>
        </div>
    </main>
</body>
</html>
