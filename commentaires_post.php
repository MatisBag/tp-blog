<?php

session_start();

if (empty($_GET['billet'])){
        header('Location: index.php');
}


try
{
        $bdd = new PDO('mysql:host=localhost;dbname=espace_membres;charset=utf8', 'root', '');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}

// Insertion du message à l'aide d'une requête préparée
$req = $bdd->prepare('INSERT INTO commentaires (id_billet, auteur, commentaire, date_commentaire) VALUES(?, ?, ?, NOW())');
$req->execute(array($_GET['billet'], $_SESSION['pseudo'], $_POST['message']));

// Redirection du visiteur vers la page du minichat
header('Location: commentaires.php?billet='.$_GET['billet']);

?>