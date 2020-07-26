<?php
session_start();


if (empty($_GET['billet'])) {
    header('location:index.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Commentaires</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="./style.css">
</head>

<body>

    <header>
        <div class="header">
            <a href="./">
                <img src="./assets/icon-blog.png" alt="icon du Blog">
            </a>

            <div>
                <?php

                if (empty($_SESSION)) {
                    echo '
                    <a href="./connexion/"><div class="btn btn-basic">Se connecter</div></a> 
                    <a href="./inscription/"><div class="btn btn-color">S\'inscrire</div></a> ';
                } else {
                    echo '<a href="./mon-compte/"> <div class="pseudo">' . htmlspecialchars(strtoupper($_SESSION['pseudo'])) . '</div></a>
                <span class="material-icons">
                    account_circle
                </span>';
                }

                ?>

            </div>
        </div>

    </header>


    <main>

        <h1>Mon super blog !</h1>

        <a href="index.php">Retour à la liste des billets</a>

        <?php
        try {
            $bdd = new PDO('mysql:host=localhost;dbname=espace_membres;charset=utf8', 'root', '');
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }

        $bdd->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);

        $req = $bdd->prepare('SELECT id, titre, contenu, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation_fr FROM billets WHERE id = :id_billet ');
        $req->execute(array('id_billet' => $_GET['billet']));
        $donnees = $req->fetch();


        if (empty($donnees)) {
            echo "<p class='strong red grand'>cette page n'existe plus</p>";
        } else {


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
                </p>
            </div>


            <h2>Commentaires</h2>

            <?php

            if (empty($_SESSION)) {
                echo '<p><a href="../index.php">Créer un compte</a> pour écrire un commentaire</p>';
            } else {

            ?>

                <form action="commentaires_post.php?billet=<?php echo $_GET['billet'] ?>" method="post">
                    <p>
                        <label for="message">Message</label> : <input type="text" name="message" id="message" /><br><br>

                        <input type="submit" value="Envoyer" />
                    </p>
                </form>

            <?php

            }

            $req->closeCursor();

            $_GET['page'] = isset($_GET['page']) ? $_GET['page'] : 1;

            $getpage = is_numeric($_GET['page']) ? $_GET['page'] : 1;

            echo $getpage ;

            $req = $bdd->prepare('SELECT auteur, commentaire, DATE_FORMAT(date_commentaire, \'%d/%m/%Y à %Hh%imin%ss\') AS date_commentaire_fr FROM commentaires WHERE id_billet = :id_billet ORDER BY date_commentaire DESC LIMIT :limitebasse, :limitehaute');
            $req->execute(array(
                'id_billet' => $_GET['billet'],
                'limitebasse' => (($getpage - 1) * 5),
                'limitehaute' => ($getpage * 5)
            ));



            while ($donnees = $req->fetch()) {
            ?>
                <p><strong><?php echo htmlspecialchars($donnees['auteur']); ?></strong> le <?php echo $donnees['date_commentaire_fr']; ?></p>

                <p><?php echo nl2br(htmlspecialchars($donnees['commentaire'])); ?></p>


        <?php
            }
            $req->closeCursor();

            $req = $bdd->prepare('SELECT COUNT(*) AS nb_commentaires FROM commentaires WHERE id_billet = :id_billet');
            $req->execute(array('id_billet' => $_GET['billet']));
            $donnees = $req->fetch();

            if ($donnees['nb_commentaires'] > 5) {
                $page = 0;
                for ($i = 0; $i < $donnees['nb_commentaires']; $i = $i + 5) {
                    $page++;
                    echo ('<a href="commentaires.php?billet=' . $_GET['billet'] . '&page=' . $page . '">' . $page . '</a>');
                }
            }


            $req->closeCursor();
        }
        ?>

    </main>

</body>

</html>