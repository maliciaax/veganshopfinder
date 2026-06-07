<?php
    include("./connexion.php");

    $login  = $_POST["login"];
    $nom    = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $tel    = $_POST["tel"];
    $email  = $_POST["email"];
    $mdp    = $_POST["mdp"];

    if (empty($login) || empty($nom) || empty($prenom) || empty($tel) || empty($email) || empty($mdp)) {
        header('Location: ../creerCompteUtilisateur-Form.php?erreur=champs');
        exit();
    }

    //vérifier que c bien un mail
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header('Location: ../creerCompteUtilisateur-Form.php?erreur=email');
        exit();
    }

    //vérifier le bon format du téléphone
    if (!preg_match('/^0[0-9]{9}$/', $tel)) {
        header('Location: ../creerCompteUtilisateur-Form.php?erreur=tel');
        exit();
    }

    $mdp = password_hash($_POST["mdp"], PASSWORD_BCRYPT);//hasher le mdp

    $req = $conn->prepare("INSERT INTO user (login, mdp, nom, prenom, numTel, mail) VALUES (?, ?, ?, ?, ?, ?)");
    $req->bind_param("ssssss", $login, $mdp, $nom, $prenom, $tel, $email); //s = string
    $result = $req->execute();

    if ($result) {
        $lastId = $conn->insert_id;//récuperer l'id du dernier user ajouté

        $req2 = $conn->prepare("INSERT INTO client (id) VALUES (?)");
        $req2->bind_param("i", $lastId);//i = integer
        $req2->execute();

        header('Location: ../creerCompteUtilisateur-Form.php');
        exit();
    } else {
        header('Location: ../creerCompteUtilisateur-Form.php?erreur=1');
        exit();
    }
?>