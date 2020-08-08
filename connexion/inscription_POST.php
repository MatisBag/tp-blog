<?php 

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
$password = "";
$password2 = "";
$mail = "";

if (!empty($_POST))
{
	// Récupération des valeurs saisies
	foreach ($_POST as $key => $value)
	{
		$$key = htmlentities($value);
    }

    $req = $bdd->query('SELECT COUNT(*) AS existe_pseudo, pseudo FROM membres WHERE pseudo="'.$pseudo.'"');
    $donnees = $req->fetch();

    if (($pseudo == "") or ($password == "") or ($password2 == "") or ($mail == ""))
    {
        header ('location: ./?required');
    }
        
    elseif (!filter_var($mail,FILTER_VALIDATE_EMAIL))
    {
        header ('location: ./?mail');
    }

    elseif (($donnees['existe_pseudo'] != '0'))
    {
        header ('location: ./?pseudo');
    }

    elseif ($password != $password2)
    {
        header ('location: ./?different-password');
    }

    else {
    // Hachage du mot de passe
    $pass_hache = password_hash($password, PASSWORD_DEFAULT);

    // Insertion
    $req = $bdd->prepare('INSERT INTO membres(pseudo, pass, email, date_inscription) VALUES(:pseudo, :pass, :email, CURDATE())');
    $req->execute(array(
        'pseudo' => $pseudo,
        'pass' => $pass_hache,
        'email' => $mail)
    );
    
    header ('location: ./?succes');

    }

}
else {
    header('location: ./?required');
}