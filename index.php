<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Aromamix - Accueil</title>
    <?php include("/parts/head.php") ?>
</head>
<body>
    <?php include("/parts/entete.php") ?>
	<h1>Hello World !</h1>
	<p>Ceci est une page test du site vitrine Aromamix</p>
    <div class="menu flex">
        <div class="logo"><a href="Accueil.php">Accueil</a></div>
        <div class="element-menu"><a href="plantes.php">Nos smoothies de base</a></div>
        <div class="element-menu"><a href="#">Smoothies personnalisés</a></div>
        <div class="element-menu"><a href="livreor.php">Livre d'or</a></div>
        <div class="element-menu"><a href="panier.php"><img src="img/cart.png"></div>
    </div>
    <?php include("/parts/pied.php") ?>
</body>
</html>