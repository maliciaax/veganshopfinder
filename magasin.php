<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <title>VeganShopFinder | Magasins</title>
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
        $villePreselect = isset($_GET['ville']) ? htmlspecialchars($_GET['ville']) : '';
    ?>

    <div class="filtres-bar" role="search" aria-label="Filtres des magasins">
        <div>
            <label for="selecteurVille" class="sr-only">Filtrer par ville</label>
            <select id="selecteurVille" class="select-ville" aria-label="Filtrer par ville">
                <option value="tous">🏙️ Toutes les villes</option>
                <option value="marseille" <?= $villePreselect=='marseille'?'selected':'' ?>>Marseille</option>
                <option value="allauch"   <?= $villePreselect=='allauch'?'selected':'' ?>>Allauch</option>
                <option value="martigue"  <?= $villePreselect=='martigue'?'selected':'' ?>>Martigue</option>
            </select>
        </div>

        <div id="filtre" role="group" aria-label="Filtrer par produit">
            <button class="boutonLogin" data-filtre="tous">Tous</button>
            <button class="boutonLogin" data-filtre="pst">PST</button>
            <button class="boutonLogin" data-filtre="seitan">Seitan</button>
            <button class="boutonLogin" data-filtre="soja">Soja</button>
            <button class="boutonLogin" data-filtre="legumeBio">Légumes bios</button>
        </div>

        <div>
            <label for="recherche" class="sr-only">Rechercher un magasin</label>
            <input type="search" id="recherche" placeholder="🔍 Rechercher un magasin" aria-label="Rechercher un magasin">
        </div>
    </div>

    <main class="main" id="contenu-principal">
        <div id="magasinsListe" role="list" aria-live="polite" aria-label="Liste des magasins"></div>
    </main>

    <script>
        const estConnecte = <?= (isset($_SESSION['role']) && $_SESSION['role']== "client") ? 'true' : 'false' ?>;
        const villePreselect = "<?= $villePreselect ?>";
    </script>
    <script src="js/index.js"></script>
    <script src="js/map.js"></script>
</body>
</html>
