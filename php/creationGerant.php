<?php
include("./connexion.php");

$login  = trim($_POST["login"] ?? '');
$nom    = trim($_POST["nom"] ?? '');
$prenom = trim($_POST["prenom"] ?? '');
$tel    = trim($_POST["tel"] ?? '');
$email  = trim($_POST["email"] ?? '');
$mdp    = $_POST["mdp"] ?? '';
$code   = trim($_POST["codeInvitation"] ?? '');
$role   = 'gerant';

if (empty($login)||empty($nom)||empty($prenom)||empty($tel)||empty($email)||empty($mdp)||empty($code)) {
    header('Location: ../creerCompteUtilisateur-Form.php?erreur=champs'); exit();
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header('Location: ../creerCompteUtilisateur-Form.php?erreur=email'); exit();
}
if (!preg_match('/^0[0-9]{9}$/', $tel)) {
    header('Location: ../creerCompteUtilisateur-Form.php?erreur=tel'); exit();
}

// Vérifier code invitation
$reqCode = $conn->prepare("SELECT id FROM codes_invitation WHERE code = ? AND utilise = 0");
$reqCode->bind_param("s", $code);
$reqCode->execute();
if ($reqCode->get_result()->num_rows === 0) {
    header('Location: ../creerCompteUtilisateur-Form.php?erreur=code'); exit();
}

$mdpHash = password_hash($mdp, PASSWORD_BCRYPT);
$req = $conn->prepare("INSERT INTO user (login, mdp, nom, prenom, numTel, mail, role) VALUES (?,?,?,?,?,?,?)");
$req->bind_param("sssssss", $login, $mdpHash, $nom, $prenom, $tel, $email, $role);

if ($req->execute()) {
    $lastId = $conn->insert_id;
    $req2 = $conn->prepare("INSERT INTO gerant (id) VALUES (?)");
    $req2->bind_param("i", $lastId);
    $req2->execute();
    $req3 = $conn->prepare("UPDATE codes_invitation SET utilise=1, idUser=? WHERE code=?");
    $req3->bind_param("is", $lastId, $code);
    $req3->execute();
    header('Location: ../creerCompteUtilisateur-Form.php?succes=1'); exit();
} else {
    header('Location: ../creerCompteUtilisateur-Form.php?erreur=bdd'); exit();
}
?>
