<?php

$title = 'Mon compte';
$point = 'yh';
include('../header.php');

if (empty($_SESSION)) {
    header('location: ../connexion/');
}

?>

<main>

    <section id="compte">

        <h2>Mon compte</h2>

        <div class="info-compte">

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

            <form action="" method="POST">


                <?php
                if (isset($_GET['required'])) {
                    echo '<p class="red">Merci de bien remplir les champs obligatoires</p>';
                } elseif (isset($_GET['mail'])) {
                    echo '<p class="red">Mail incorrect</p>';
                } elseif (isset($_GET['pseudo'])) {
                    echo '<p class="red">Pseudo déjà utilisé</p>';
                } elseif (isset($_GET['different-password'])) {
                    echo '<p class="red">Mot de passe différent</p>';
                } elseif (isset($_GET['succes'])) {
                    echo '<p class="green">Informations enregistrées</p>';
                }
                ?>

                <p>
                    <label for="pseudo">Pseudo : <span class="red">*</span></label>
                    <input type="text" name="pseudo" id="pseudo" value="<?php echo htmlspecialchars($donnees['pseudo']); ?>" readonly>
                </p>

                <p>
                    <label for="email">Mail : <span class="red">*</span></label>
                    <input type="email" name="email" id="mail" value="<?php echo htmlspecialchars($donnees['email']); ?>" readonly>
                </p>

                <p>
                    <label for="date_inscription">Date d'inscription : </label>
                    <input type="text" name="date_inscription" id="date_inscription" value="<?php echo htmlspecialchars($donnees['date_inscription']); ?>" readonly>
                </p>

            </form>



            <?php

            $req->closeCursor();

            ?>

            <div class="buttons">
                <div id="modifier">Modifier</div>
                <a href="../deconnection.php">Se déconnecter</a>
            </div>

        </div>


    </section>


</main>

<script src="../js/script-compte.js"></script>



</body>

</html>