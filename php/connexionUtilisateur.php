<?php
    session_start();
    include("./connexion.php");

    $loginSaisi = $_POST["login"] ?? '';
    $mdpSaisi = $_POST["mdp"] ?? '';

    if (empty($loginSaisi) || empty($mdpSaisi)) {
        header('Location: ../connexionUtilisateur-Form.php?erreur=champs');
        exit();
    }

    $req = $conn->prepare("SELECT * FROM user WHERE login = ?");
    $req->bind_param("s", $loginSaisi);
    $req->execute();
    $user = $req->get_result()->fetch_assoc();

    if ($user && password_verify($mdpSaisi, $user['mdp'])) {
        $_SESSION['id'] = $user['id'];
        $_SESSION['login'] = $user['login'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['derniere_activite'] = time();

        if ($user['role'] == 'admin') {
            header('Location: ../admin.php');
        } 
        elseif ($user['role'] == 'gerant') {
           header('Location: ../magasin.php'); 
        } 
        else{
           header('Location: ../magasin.php'); 
        } 
        exit();
    } else {
        header('Location: ../connexionUtilisateur-Form.php?erreur=identifiants');
        exit();
    }
?>
