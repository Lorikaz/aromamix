<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>
    <title>Aromamix - Livre d'Or</title>
    <?php include("/parts/head.php") ?>
</head>

<body>
    <?php include("/parts/entete.php") ?>

    <form method="post" action="livreor.php">
        <p>Vous aimez notre produit ? Laissez nous un commentaire !</p>
        <p>
        <!-- Récupère le pseudo dans SESSION-->
            Connecté en tant que : <?php echo $_SESSION['login'] ?><br />
            Message :<br />
            <textarea name="message" rows="8" cols="35"></textarea><br />
            <input type="submit" value="Envoyer" />
        </p>
        </form>

        <p class="contenu">
            <?php
            //Connexion à la BDD
            $bdd = new PDO('mysql:host=localhost;dbname=aromamix', "root", "");

            ?>
        </p>

        <?php include("/parts/pied.php") ?>
</body>

</html>