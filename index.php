<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
    <link rel="stylesheet" href="./style.css">
</head>

<body>

    <header>
        <div class="header">
            <a href="./">
                <img src="./assets/icon-blog.png" alt="icon du Blog">
            </a>

            <div class="compte">
                <?php

                if (empty($_SESSION)) {
                    echo '
                    <a href="./connexion/"><div class="btn btn-basic">Se connecter</div></a> 
                    <a href="./inscription/"><div class="btn btn-color">S\'inscrire</div></a> ';
                } else {
                    echo '<a href="./mon-compte/"> <div class="pseudo">' . htmlspecialchars(strtoupper($_SESSION['pseudo'])) . '</div></a>
                <span id="account" class="material-icons">
                    account_circle
                </span>
                <div class="info animated fadeIn">
                    <p><a href="./mon-compte/">Mon compte</a></p>
                    <p><a href="deconnection.php">Se déconnecter</a></p>
                    
                    <div class="info-fleche"></div>
                </div>';
                }

                ?>

            </div>
        </div>

    </header>



    <main>

        <h1>Mon super blog !</h1>

        <p>Derniers billets du blog :</p>

        <?php
        try {
            $bdd = new PDO('mysql:host=localhost;dbname=espace_membres;charset=utf8', 'root', '');
        } catch (Exception $e) // Permet de ne pas afficher le mdp si l'ID / mdp est incorrect
        {
            die('Erreur : ' . $e->getMessage());
        }

        $req = $bdd->query('SELECT id, titre, contenu, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation_fr FROM billets ORDER BY date_creation DESC LIMIT 0, 5');

        while ($donnees = $req->fetch()) {
        ?>

            <div class="news">
                <h3>
                    <?php echo htmlspecialchars($donnees['titre']); ?>
                    <em>le <?php echo $donnees['date_creation_fr']; ?></em>
                </h3>

                <p>
                    <?php
                    echo nl2br(htmlspecialchars($donnees['contenu'])); // nl2br = Insère un retour à la ligne HTML à chaque nouvelle ligne
                    ?>
                    <br />
                    <em><a href="commentaires.php?billet=<?php echo $donnees['id']; ?>">Commentaires</a></em>
                </p>
            </div>

        <?php
        }

        $req->closeCursor();

        ?>



        <a href="deconnection.php">se déconnecter</a>

    </main>

    <script src="./js/script.js"></script>

</body>

</html>