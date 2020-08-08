<?php

session_start();

if (empty($_SESSION)) {
    header('location: ../connexion/');
}

try
{
    $bdd = new PDO('mysql:host=localhost;dbname=espace_membres;charset=utf8', 'root', '');
}
catch(Exception $e)
{
    die('Erreur : '.$e->getMessage());
}


// Vérification de la validité des informations

$pseudo = "";
$email = "";
$password = "";
$password2 = "";

if (!empty($_POST))
{
	// Récupération des valeurs saisies
	foreach ($_POST as $key => $value)
	{
		$$key = htmlentities($value);
    }

    $req = $bdd->query('SELECT COUNT(*) AS existe_pseudo, pseudo FROM membres WHERE pseudo="'.$pseudo.'"');
    $donnees = $req->fetch();

    if (($pseudo == "") or ($email == ""))
    {
        header ('location: ./?required');
    }
        
    elseif (!filter_var($email,FILTER_VALIDATE_EMAIL))
    {
        header ('location: ./?mail');
    }

    elseif (($pseudo != $donnees['pseudo']) && $donnees['existe_pseudo'] != '0'){
        header('location: ./?pseudo');
    }

    elseif ($password != $password2)
    {
        header ('location: ./?different-password');
    }
    elseif (($password == "") || ($password2 = "")){

    // Insertion
    $req = $bdd->prepare('UPDATE membres SET pseudo = :pseudo, email = :email WHERE id = :id');
    $req->execute(array(
        'pseudo' => $pseudo,
        'email' => $email,
        'id' => $_SESSION['id'])
    );
    
    header ('location: ./?succes'); // with ? = réussi

    }

    else {
    // Hachage du mot de passe
    $pass_hache = password_hash($password, PASSWORD_DEFAULT);

    // Insertion
    $req = $bdd->prepare('UPDATE membres SET pseudo = :pseudo, email = :email, pass = :pass WHERE id = :id');
    $req->execute(array(
        'pseudo' => $pseudo,
        'email' => $email,
        'pass' => $pass_hache,
        'id' => $_SESSION['id'])
    );
    
    header ('location: ./?succes'); // with ? = réussi

    }

}
//else
