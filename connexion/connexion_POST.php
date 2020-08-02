<?php

try {
    $bdd = new PDO('mysql:host=localhost;dbname=espace_membres;charset=utf8', 'root', '');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}


$pseudo = "";
$password = "";
$auto = "";


if (!empty($_POST)) {
    // Récupération des valeurs saisies
    foreach ($_POST as $key => $value) {
        $$key = htmlentities($value);
    }


    //  Récupération de l'utilisateur et de son pass hashé
    $req = $bdd->prepare('SELECT id, pass FROM membres WHERE pseudo = :pseudo');
    $req->execute(array('pseudo' => $pseudo));
    $resultat = $req->fetch();

    // Comparaison du pass envoyé via le formulaire avec la base
    $isPasswordCorrect = password_verify($password, $resultat['pass']);


    if (!$resultat) {
        header('location: ./?incorrect');
        $erreur = 'Mauvais identifiant ou mot de passe !';
    } else {
        if ($isPasswordCorrect) {

            session_start();
            $_SESSION['id'] = $resultat['id'];
            $_SESSION['pseudo'] = $pseudo;

            // if (!empty($auto)){
            //     setcookie('pseudo', $pseudo, time() + 365*24*3600, null, null, false, true);
            //     setcookie('password', password_hash($password, PASSWORD_DEFAULT), time() + 365*24*3600, null, null, false, true);
            // }

            header('location: ../index.php');
        } else {
            header('location: ./?incorrect');
        }
    }
    $req->closeCursor();
}

//else
