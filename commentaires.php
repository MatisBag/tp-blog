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
    $title = 'The blog - Page non trouvé';
} else {
    $title = 'The blog - ' . htmlspecialchars($donnees['titre']);
}

include('header.php');

?>
<main>
    <article>

        <?php

        if (empty($donnees)) {
            echo "<p class='strong red grand'>cette page n'existe plus</p>";
        } else {

        ?>

        <h1><?php echo htmlspecialchars($donnees['titre']); ?></h1>
        <hr>

        <figure>
            <img src="./assets/<?php echo htmlspecialchars($donnees['id']); ?>.png"
                alt="wallpaper <?php echo htmlspecialchars($donnees['titre']); ?>">

            <figcaption><em>le <?php echo $donnees['date_creation_fr']; ?></em></figcaption>
        </figure>


        <?php
            // Paragraphes 
            function divisionPara($paragraphe)
            { // Diviser le paragraphe en 2 parties
                $longueur = strlen(htmlspecialchars($paragraphe));
                $milieu = round($longueur / 2);
                $espace = strpos(substr(htmlspecialchars($paragraphe), $milieu), "\n");

                return round($milieu + $espace);
            }
            ?>

        <p class="paraMobile">
            <?php echo '<span>' . substr(htmlspecialchars($donnees['contenu']), 0, 1) . '</span>' . nl2br(substr(htmlspecialchars($donnees['contenu']), 1)); ?>
        </p>

        <div class="paragraphes">
            <p><?php echo '<span>' . substr(htmlspecialchars($donnees['contenu']), 0, 1) . '</span>' . nl2br(substr(htmlspecialchars($donnees['contenu']), 1, divisionPara($donnees['contenu']))) . '<br>'; ?>
            </p>
            <p><?php echo nl2br(substr(htmlspecialchars($donnees['contenu']), divisionPara($donnees['contenu']) + 1)); ?>
            </p>
        </div>


        <section id="commentaires">

            <h3>Commentaires</h3>

            <?php

                if (empty($_SESSION)) {
                    echo '
                    <div class="flex center">
                        <a href="./connexion/"><div class="btn btn-basic">S\'inscrire</div></a> 
                        <a href="./connexion/"><div class="btn btn-color">Connexion</div></a>
                    </div>';
                } else {

                ?>

            <form action="commentaires_post.php?billet=<?php echo $_GET['billet'] ?>" method="post">
                <label for="message">Message :</label>

                <textarea name="message" id="message" rows='1' placeholder="Très bon article !"></textarea>

                <input type="submit" value="Envoyer" />
            </form>

            <?php

                }

                $req->closeCursor();

                $_GET['page'] = isset($_GET['page']) ? $_GET['page'] : 1;

                $getpage = is_numeric($_GET['page']) ? $_GET['page'] : 1;


                $req = $bdd->prepare('SELECT auteur, commentaire, DATE_FORMAT(date_commentaire, \'%d/%m/%Y à %Hh%imin%ss\') AS date_commentaire_fr FROM commentaires WHERE id_billet = :id_billet ORDER BY date_commentaire DESC LIMIT :limitebasse, :limitehaute');
                $req->execute(array(
                    'id_billet' => $_GET['billet'],
                    'limitebasse' => (($getpage - 1) * 5),
                    'limitehaute' => ($getpage * 5)
                ));



                while ($donnees = $req->fetch()) {
                ?>

            <div class="commentaire">
                <p><strong><?php echo htmlspecialchars($donnees['auteur']); ?></strong> le
                    <?php echo htmlspecialchars($donnees['date_commentaire_fr']); ?></p>

                <p><?php echo nl2br(htmlspecialchars($donnees['commentaire'])); ?></p>
            </div>

            <?php
                }
                $req->closeCursor();

                $req = $bdd->prepare('SELECT COUNT(*) AS nb_commentaires FROM commentaires WHERE id_billet = :id_billet');
                $req->execute(array('id_billet' => $_GET['billet']));
                $donnees = $req->fetch();

                if ($donnees['nb_commentaires'] > 5) {
                    echo ' <span class="absolute">Page :</span><div class="flex center">';
                    $page = 0;
                    for ($i = 0; $i < $donnees['nb_commentaires']; $i = $i + 5) {
                        $page++;
                        echo ('<a href="commentaires.php?billet=' . $_GET['billet'] . '&page=' . $page . '">' . $page . '</a>-');
                    }
                    echo '</div>';
                }


                $req->closeCursor();
            }
            ?>


        </section>


    </article>

</main>

<script src="./js/script.js"></script>

<script src="./js/script-article.js"></script>

</body>

</html>