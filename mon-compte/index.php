<?php

    $title = 'Mon compte';
    $point = 'yh';
    include('../header.php');

    if (empty($_SESSION)) {
        header('location: ../connexion/');
    }

?>


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