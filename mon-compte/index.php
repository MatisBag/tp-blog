<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon compte</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="../style.css">
</head>

<body>

    <header>
        <div class="header">
            <a href="../">
                <img src="../assets/icon-blog.png" alt="icon du Blog">
            </a>

            <div>
                <?php

                if (empty($_SESSION)) {
                    header('location: ../connexion/');
                } else {
                    echo '<a href="./"> <div class="pseudo">' . htmlspecialchars(strtoupper($_SESSION['pseudo'])) . '</div></a>
                <span class="material-icons">
                    account_circle
                </span>';
                }

                ?>

            </div>
        </div>

    </header>



    <main>

        <h1>Votre compte</h1>

        <?php
        try {
            $bdd = new PDO('mysql:host=localhost;dbname=espace_membres;charset=utf8', 'root', '');
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }

        $req = $bdd->prepare('SELECT pseudo, email, date_inscription FROM membres WHERE id = :id_membre');
        $req->execute(array('id_membre' => $_SESSION['id']));
        $donnees = $req->fetch();
        ?>

        <p>
            Pseudo : <?php echo htmlspecialchars($donnees['pseudo']); ?>
        </p>

        <p>
            Mail : <?php echo htmlspecialchars($donnees['email']); ?>
        </p>

        <p>
            Date d'inscription : <?php echo htmlspecialchars($donnees['date_inscription']); ?>
        </p>

        <?php

        $req->closeCursor();

        ?>



        <a href="../deconnection.php">se déconnecter</a>

    </main>



</body>

</html>