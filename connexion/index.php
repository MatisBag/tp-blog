<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connection</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body class="connexion">

    <section id="formulaire">

        <header>
            <div class="social-link">
                <a href=""><i class="fab fa-facebook-f"></i></a>
                <a href=""><i class="fab fa-twitter"></i></a>
                <a href=""><i class="fab fa-instagram"></i></a>
            </div>

            <a href="../index.php">
                <img src="../assets/icon-blog2.png" alt="icon The Blog">
            </a>
        </header>


        <h2>Connexion</h2>

        <form method="POST" action="connexion_POST.php">

            <?php
            if (isset($_GET['incorrect'])) {
                echo '<p class="red">Mauvais identifiant ou mot de passe !</p>';
            } elseif (isset($_GET['required'])) {
                echo '<p class="red">Merci de bien remplir vos informations</p>';
            } elseif (isset($_GET['mail'])) {
                echo '<p class="red">Mail incorrect</p>';
            } elseif (isset($_GET['pseudo'])) {
                echo '<p class="red">Pseudo déjà utilisé</p>';
            } elseif (isset($_GET['different-password'])) {
                echo '<p class="red">Mot de passe différent</p>';
            }

            ?>

            <input type="text" name="pseudo" id="pseudo" placeholder="Pseudo">

            <input type="password" name="password" id="password" placeholder="Mot de passe">


            <div>
                <input type="checkbox" name="auto" id="auto">
                <label for="auto">Se souvenir de moi</label>
            </div>


            <input type="submit" class="btn btn-color" value="Se connecter">

        </form>

        <div class="login">
            <span>Pas de compte ?</span><br>
            Créer en un ici
        </div>

    </section>



    <section id="article-info">
        <h2>Articles récents</h2>
    </section>


    <script src="../js/script-connexion.js"></script>

</body>

</html>