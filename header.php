<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link rel="icon" type="image/png" href="<?php if (isset($point)) {
                                                echo '.';
                                            } ?>./assets/icon.png" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
    <link rel="stylesheet" href="<?php if (isset($point)) {
                                        echo '.';
                                    } ?>./css/style.css">
</head>

<body>

    <header>
        <div class="social-link">
            <a href=""><i class="fab fa-facebook-f"></i></a>
            <a href=""><i class="fab fa-twitter"></i></a>
            <a href=""><i class="fab fa-instagram"></i></a>
        </div>

        <a href="<?php if (isset($point)) {
                        echo '.';
                    } ?>./">
            <img src="<?php if (isset($point)) {
                            echo '.';
                        } ?>./assets/icon-blog.png" alt="icon The Blog">
        </a>

        <div class="compte">
            <?php

            if (empty($_SESSION)) {
                echo '
                    <a href="./connexion/"><div class="btn btn-basic">S\'inscrire</div></a> 
                    <a href="./connexion/"><div class="btn btn-color">Connexion</div></a> '; // changer le link pour inscription
            } else {
                echo '
                    <a href="./mon-compte/" class="connected">
                        <div class="pseudo">' . htmlspecialchars(strtoupper($_SESSION['pseudo'])) . '</div>
                        <span id="account" class="material-icons">
                            account_circle
                        </span>
                    </a>';
            }

            ?>
            <div class="info animated fadeIn">
                <ul>
                    <li><a href="./mon-compte/">Mon compte</a></li>
                    <li><a href="deconnection.php">Se déconnecter</a></li>
                </ul>
                <div class="info-fleche"></div>
            </div>

        </div>

    </header>