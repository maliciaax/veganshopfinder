<?php
    session_start();
    include('../php/session_check.php');
    if (!isset($_SESSION['id']) || $_SESSION['role'] !== 'gerant') {
        header('Location: ../connexionUtilisateur-Form.php');
        exit();
    }
    include('../php/connexion.php');
    $id = (int)$_SESSION['id'];

    // Infos du gérant
    $req = $conn->prepare("SELECT login, nom, prenom, numTel, mail FROM user WHERE id = ?");
    $req->bind_param("i", $id);
    $req->execute();
    $gerant = $req->get_result()->fetch_assoc();

    // Magasin(s) géré(s) par ce gérant
    $reqMag = $conn->prepare("SELECT idMag, nomMag, ville, adresse, codePostal FROM magasin WHERE id = ?");
    $reqMag->bind_param("i", $id);
    $reqMag->execute();
    $magasins = $reqMag->get_result()->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="../css/form.css">
    <link rel="icon" href="img/logo1.png" type="image/x-icon">
    <title>VeganShopFinder | Mon profil gérant</title>
    <style>
        .btn-danger {
            display: block;
            width: 100%;
            margin-top: 0.5rem;
            padding: 0.65rem 1rem;
            background-color: #c0392b;
            color: #fff;
            border: none;
            border-radius: 0.5rem;
            font-size: 0.95rem;
            font-family: 'Montserrat', sans-serif;
            font-weight: 600;
            cursor: pointer;
            text-align: center;
            transition: background-color 0.2s;
        }
        .btn-danger:hover { background-color: #a93226; }

        .magasin-card {
            background: rgba(255,255,255,0.06);
            border-radius: 0.5rem;
            padding: 0.85rem 1rem;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
            color: #ddd;
        }
        .magasin-card strong { color: #86b86a; display: block; margin-bottom: 0.2rem; }

        .section-label {
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: #aaa;
            margin-top: 1rem;
            margin-bottom: 0.4rem;
        }

        /* Modal */
        .modal-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.65);
            z-index: 1000;
            align-items: center;
            justify-content: center;
        }
        .modal-overlay.active { display: flex; }
        .modal-box {
            background: rgb(46,46,46);
            color: #f0f0f0;
            border-radius: 0.75rem;
            padding: 2rem;
            max-width: 400px;
            width: 90%;
            box-shadow: 0 8px 32px rgba(0,0,0,0.5);
        }
        .modal-box h2 { margin: 0 0 0.75rem; font-size: 1.2rem; color: #e74c3c; }
        .modal-box p  { font-size: 0.92rem; color: #ccc; margin: 0 0 1.5rem; line-height: 1.5; }
        .modal-box ul { font-size: 0.88rem; color: #e07b72; margin: 0 0 1.2rem 1.2rem; line-height: 1.8; }
        .modal-actions { display: flex; gap: 0.75rem; }
        .modal-actions .btn-cancel {
            flex: 1; padding: 0.6rem; border-radius: 0.5rem;
            background: #555; color: #fff; border: none;
            font-size: 0.9rem; cursor: pointer; font-family: 'Montserrat', sans-serif;
            transition: background 0.2s;
        }
        .modal-actions .btn-cancel:hover { background: #444; }
        .modal-actions .btn-confirm {
            flex: 1; padding: 0.6rem; border-radius: 0.5rem;
            background: #c0392b; color: #fff; border: none;
            font-size: 0.9rem; font-weight: 700; cursor: pointer; font-family: 'Montserrat', sans-serif;
            transition: background 0.2s;
        }
        .modal-actions .btn-confirm:hover { background: #a93226; }
        .aucun-mag { color: #aaa; font-size: 0.9rem; font-style: italic; }
    </style>
</head>
<body>
    <a href="#contenu-principal" class="skip-link">Aller au contenu principal</a>
    <?php include("menu_gerant.php"); ?>

    <main class="mainForm" id="contenu-principal">
        <div class="form" style="max-width:460px">
            <span class="titre">Mon profil gérant</span>
            <div class="informations" style="gap:1.2rem">

                <?php
                $champs = [
                    'Login'     => $gerant['login'],
                    'Nom'       => $gerant['nom'],
                    'Prénom'    => $gerant['prenom'],
                    'Téléphone' => $gerant['numTel'],
                    'E-mail'    => $gerant['mail'],
                ];
                foreach ($champs as $label => $valeur): ?>
                    <div class="profil-champ">
                        <span class="profil-label"><?= $label ?></span>
                        <span class="profil-valeur"><?= htmlspecialchars($valeur ?? '—') ?></span>
                    </div>
                    <hr class="separateur">
                <?php endforeach; ?>

                <!-- Magasins gérés -->
                <div class="section-label">🏪 Mes magasins</div>
                <?php if (empty($magasins)): ?>
                    <p class="aucun-mag">Aucun magasin associé à ce compte.</p>
                <?php else: ?>
                    <?php foreach ($magasins as $mag): ?>
                        <div class="magasin-card">
                            <strong><?= htmlspecialchars($mag['nomMag']) ?></strong>
                            <?= htmlspecialchars($mag['adresse']) ?>, <?= htmlspecialchars($mag['codePostal']) ?> <?= htmlspecialchars($mag['ville']) ?>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>

                <a href="../php/deconnexion.php" class="boutonLogin" style="text-align:center;margin-top:0.5rem">
                    Se déconnecter
                </a>

                <button class="btn-danger" onclick="document.getElementById('modalSupprimer').classList.add('active')">
                    🗑️ Supprimer mon compte
                </button>
            </div>
        </div>
    </main>

    <!-- Modal de confirmation -->
    <div id="modalSupprimer" class="modal-overlay" role="dialog" aria-modal="true" aria-labelledby="modal-titre-gerant">
        <div class="modal-box">
            <h2 id="modal-titre-gerant">⚠️ Supprimer mon compte gérant</h2>
            <p>Cette action est <strong>irréversible</strong>. La suppression entraînera :</p>
            <ul>
                <?php foreach ($magasins as $mag): ?>
                    <li>Magasin « <?= htmlspecialchars($mag['nomMag']) ?> » supprimé</li>
                <?php endforeach; ?>
                <li>Tous les stocks de vos magasins supprimés</li>
                <li>Tous les commentaires liés à vos magasins supprimés</li>
                <li>Votre compte gérant supprimé</li>
            </ul>
            <div class="modal-actions">
                <button class="btn-cancel" onclick="document.getElementById('modalSupprimer').classList.remove('active')">
                    Annuler
                </button>
                <form action="../php/supprimerGerant.php" method="POST" style="flex:1;margin:0">
                    <button type="submit" class="btn-confirm" style="width:100%">
                        Oui, tout supprimer
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('modalSupprimer').addEventListener('click', function(e) {
            if (e.target === this) this.classList.remove('active');
        });
    </script>
</body>
</html>
