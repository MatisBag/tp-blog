<?php

    $title = 'The Blog';
    include('header.php');
    
?>

    <main>

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