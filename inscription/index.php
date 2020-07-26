<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body class="center">

    <h1>Inscription</h1>

    <form method="POST" action="inscription_POST.php">

        <?php

        if(isset($_GET['required'])){
            echo '<p class="red">Merci de remplir tous les champs.</p>';
        }

        if(isset($_GET['mail'])){
            echo '<p class="red">L\'adresse mail n\'est pas correcte.</p>';
        }

        if(isset($_GET['pseudo'])){
            echo '<p class="red">Pseudo déjà utilisé.</p>';
        }

        if(isset($_GET['different-password'])){
            echo '<p class="red">Mot de passe différent</p>';
        }
        
        ?>

        <div>
            <label for="pseudo"> Pseudo </label>
            <input type="text" name="pseudo" id="pseudo">
        </div>

        <div>
            <label for="password"> Mot de passe </label>
            <input type="password" name="password" id="password">
        </div>

        <div>
            <label for="password2"> Retapez mot de passe </label>
            <input type="password" name="password2" id="password2">
        </div>

        <div>
            <label for="mail"> Email </label>
            <input type="email" name="mail" id="mail">
        </div>

        <input type="submit" value="S'inscrire">

        <a href="./se-connecter/">se connecter</a>

    </form>

</body>

</html>