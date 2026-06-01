<?php
    session_start();
    include('php/session_check.php');
    if (!isset($_SESSION['id']) || $_SESSION['role'] !== 'gerant') {
        header('Location: connexionUtilisateur-Form.php'); exit();
    }
    include('php/connexion.php');

    $idGerant = (int)$_SESSION['id'];
    $reqMag = $conn->prepare("SELECT idMag, nomMag FROM magasin WHERE id = ?");
    $reqMag->bind_param("i", $idGerant);
    $reqMag->execute();
    $mesMagasins = $reqMag->get_result()->fetch_all(MYSQLI_ASSOC);

    $resProd = $conn->query("SELECT idProd, nomProd FROM produit ORDER BY nomProd");
    $produits = $resProd->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/form.css">
    <title>VeganShopFinder | Ajouter un produit</title>
</head>
<body>
    <a href="#contenu-principal" class="skip-link">Aller au contenu principal</a>
    <?php include("gerant/menu_gerant.php"); ?>

    <?php if (isset($_GET['succes'])): ?>
        <p class="msg-succes" role="status">Produit ajouté avec succès !</p>
    <?php elseif (isset($_GET['erreur'])): ?>
        <p class="msg-erreur" role="alert">Une erreur est survenue, réessayez.</p>
    <?php endif; ?>

    <main class="mainForm" id="contenu-principal">
        <div class="form" style="max-width:420px">
            <span class="titre">Ajouter un produit</span>

            <?php if (empty($mesMagasins)): ?>
                <p class="message" style="margin-top:1rem;color:#ffaaaa">
                    Vous n'avez pas encore de magasin.
                    <a href="ajouterMagForm.php">Ajoutez-en un d'abord.</a>
                </p>
            <?php else: ?>
            <form method="post" action="php/ajouterProd.php" novalidate>
                <div class="informations">

                    <div>
                        <label for="idMag" style="color:#c8e6b0;display:block;margin-bottom:0.4rem;font-size:0.85rem">Mon magasin</label>
                        <select name="idMag" id="idMag" required aria-required="true">
                            <option value="">-- Choisir un magasin --</option>
                            <?php foreach ($mesMagasins as $mag): ?>
                                <option value="<?= $mag['idMag'] ?>"><?= htmlspecialchars($mag['nomMag']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div>
                        <label for="idProd" style="color:#c8e6b0;display:block;margin-bottom:0.4rem;font-size:0.85rem">Produit</label>
                        <select name="idProd" id="idProd" required aria-required="true">
                            <option value="">-- Choisir un produit --</option>
                            <?php foreach ($produits as $prod): ?>
                                <option value="<?= $prod['idProd'] ?>"><?= htmlspecialchars($prod['nomProd']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <input type="number" name="stock" placeholder="Quantité en stock" min="0" required aria-required="true">
                    <button class="boutonLogin" type="submit">Ajouter le produit</button>
                </div>
            </form>
            <?php endif; ?>
        </div>
    </main>
</body>
</html>
