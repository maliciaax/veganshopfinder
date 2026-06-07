<?php
    session_start();
    include('php/session_check.php');
    if (!isset($_SESSION['id'])) {
        header('Location: connexionUtilisateur-Form.php'); exit();
    }
    if (isset($_SESSION['role'])) {
        if ($_SESSION['role'] == "client") include("user/menu_user.php");
        elseif ($_SESSION['role'] == "gerant") include("gerant/menu_gerant.php");
    }
    $idMag = isset($_GET['idMag']) ? (int)$_GET['idMag'] : 0;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/form.css">
    <link rel="icon" href="img/logo1.png" type="image/x-icon">
    <title>VeganShopFinder | Noter un magasin</title>
    <style>
        .etoilesForm { display:flex; flex-direction:row-reverse; justify-content:center; gap:0.3rem; font-size:2.5rem; margin:0.5rem 0; }
        .etoilesForm input { display:none; }
        .etoilesForm label { cursor:pointer; color:#555; transition:color 0.1s; }
        .etoilesForm input:checked ~ label,
        .etoilesForm label:hover,
        .etoilesForm label:hover ~ label { color: #f4c430; }
    </style>
</head>
<body>
    <a href="#contenu-principal" class="skip-link">Aller au contenu principal</a>

    <?php if (isset($_GET['erreur'])): ?>
        <p class="msg-erreur" role="alert">Tous les champs sont obligatoires.</p>
    <?php endif; ?>

    <main class="mainForm" id="contenu-principal">
        <div class="form">
            <span class="titre">⭐ Noter ce magasin</span>
            <form method="post" action="php/noterMagasin.php" novalidate>
                <input type="hidden" name="idMag" value="<?= $idMag ?>">
                <div class="informations">
                    <input type="text" name="titre" placeholder="Titre de votre avis" required aria-required="true">
                    <textarea name="contenu" placeholder="Votre commentaire…" rows="4" required aria-required="true"></textarea>

                    <fieldset style="border:none;padding:0;margin:0">
                        <legend style="color:#c8e6b0;font-size:0.85rem;margin-bottom:0.4rem">Votre note</legend>
                        <div class="etoilesForm" role="radiogroup" aria-label="Note de 1 à 5 étoiles">
                            <?php for($i=5;$i>=1;$i--): ?>
                                <input type="radio" name="note" id="star<?=$i?>" value="<?=$i?>" <?=$i==5?'required':''?>>
                                <label for="star<?=$i?>" aria-label="<?=$i?> étoile<?=$i>1?'s':''?>">★</label>
                            <?php endfor; ?>
                        </div>
                    </fieldset>

                    <button class="boutonLogin" type="submit">Envoyer mon avis</button>
                </div>
            </form>
        </div>
    </main>
</body>
</html>
