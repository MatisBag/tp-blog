<?php

try
{
    $bdd = new PDO('mysql:host=localhost;dbname=espace_membres;charset=utf8', 'root', '');
}
catch(Exception $e)
{
    die('Erreur : '.$e->getMessage());
}


$pseudo = "";
$password = "";
$auto = "";


if (!empty($_POST))
{
	// Récupération des valeurs saisies
	foreach ($_POST as $key => $value)
	{
		$$key = htmlentities($value);
    }

    
    //  Récupération de l'utilisateur et de son pass hashé
    $req = $bdd->prepare('SELECT id, pass FROM membres WHERE pseudo = :pseudo');
    $req->execute(array('pseudo' => $pseudo));
    $resultat = $req->fetch();

    // Comparaison du pass envoyé via le formulaire avec la base
    $isPasswordCorrect = password_verify($password , $resultat['pass']);
    

    if (!$resultat)
    {
        $erreur = 'Mauvais identifiant ou mot de passe !';
    }
    else
    {
        if ($isPasswordCorrect) {
            
            session_start();
            $_SESSION['id'] = $resultat['id'];
            $_SESSION['pseudo'] = $pseudo;

            // if (!empty($auto)){
            //     setcookie('pseudo', $pseudo, time() + 365*24*3600, null, null, false, true);
            //     setcookie('password', password_hash($password, PASSWORD_DEFAULT), time() + 365*24*3600, null, null, false, true);
            // }

            header('location: ../index.php');

        }
        else {
            $erreur = 'Mauvais identifiant ou mot de passe !';
        }
    }
    $req->closeCursor();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connection</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body class="center">

    <h1>Connection</h1>

    <form method="POST" action="index.php">

        <?php

        if(isset($erreur)){
            echo '<p class="red">'.$erreur.'</p>' ;
        }

        ?>

        <div>
            <label for="pseudo">Pseudo</label>
            <input type="text" name="pseudo" id="pseudo" value="<?php echo $pseudo; ?>">
        </div>

        <div>
            <label for="password">Mot de passe</label>
            <input type="password" name="password" id="password">
        </div>

        <div>
            <label for="auto">Se souvenir de moi</label>
            <input type="checkbox" name="auto" id="auto" value="auto" <?php if($auto){echo'checked';} ?> >
        </div>


        <input type="submit" value="se connecter">

        <a href="../index.php">s'inscrire</a>
    </form>


</body>

</html>