<?php
    session_start();
    include('../php/session_check.php');
    if (!isset($_SESSION['id'])) {
        header('Location: ../connexionUtilisateur-Form.php');
        exit();
    }
    include('../php/connexion.php');
    $id = (int)$_SESSION['id'];
    $req = $conn->prepare("SELECT login, nom, prenom, numTel, mail FROM user WHERE id = ?");
    $req->bind_param("i", $id);
    $req->execute();
    $user = $req->get_result()->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="../css/form.css">
    <title>VeganShopFinder | Mon profil</title>
</head>
<body>
    <a href="#contenu-principal" class="skip-link">Aller au contenu principal</a>
    <?php include("menu_user.php"); ?>

    <main class="mainForm" id="contenu-principal">
        <div class="form">
            <span class="titre">Mon profil</span>
            <div class="informations" style="gap:1.2rem">

                <?php
                $champs = [
                    'Login'     => $user['login'],
                    'Nom'       => $user['nom'],
                    'Prénom'    => $user['prenom'],
                    'Téléphone' => $user['numTel'],
                    'E-mail'    => $user['mail'],
                ];
                foreach ($champs as $label => $valeur): ?>
                    <div class="profil-champ">
                        <span class="profil-label"><?= $label ?></span>
                        <span class="profil-valeur"><?= htmlspecialchars($valeur ?? '—') ?></span>
                    </div>
                    <hr class="separateur">
                <?php endforeach; ?>

                <a href="../php/deconnexion.php" class="boutonLogin" style="text-align:center;margin-top:0.5rem">
                    Se déconnecter
                </a>
            </div>
        </div>
    </main>
</body>
</html>
