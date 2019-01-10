<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>
	<title>Accueil - Aromamix</title>
    <?php include("/parts/head.php") ?>
</head>

<body class="index">
    <?php include("/parts/entete.php") ?>
	
	<div id="slogan">
		<h2>It's a kind of magic.</h2>
		<img src="./media/logo-lg.png" height="100">
	</div>

	<div class="row" id="presentation">
		<div class="col-md-6">
			<img src="">
		</div>
		<div class="col-md-6">
			<h1>Qui
			</br>sommes-
			</br>nous ?</h1>
			<p>Dans le grand monde de la sorcellerie, chaque maux sont guéris de sortilèges et autres charmes mystiques. Vous qui en rêviez, et qui souhaitez d’un simple coup de baguette vous débarrasser de vos problèmes. La solution est à portée de fioles. Nous vous proposons à vous, êtres non magiques, des potions livrables jusqu’à chez vous.</p>
		</div>
	</div>

	<div class="row" id="team">
		<div class="col-md-4">
			<img src="" height="250">
			<p>Sophie conceptualise les potions et est chargée de trouver la matière première. Notre sorcière la plus expérimentée et créative s’occupe de trouver de nouveau concept de potion pouvant vous intéresser. Toujours plus soucieuse et attentive à vos problèmes, elle saura trouver LA solution pour vous aider au quotidien.</p>
		</div>
		<div class="col-md-4">
			<img src="" height="250">
			<p>Matthias notre mélangeur professionnel. Il vous fait de simple botte de thym une bonne tisane contre la grippe. Qu’importe l’ingrédient, il vous le mystifie pour faire ressortir toute ses qualités magiques.</p>
		</div>
		<div class="col-md-4">
			<img src="" height="250">
			<p>La plus créative de la bande, notre graphiste et empaqueteuse en chef. Elle s’occupe de présentation de notre marque ainsi que de nos potions. C’est de sa baguette que les potions sont mis dans des fioles pour être emporté loin de nous mais près de vous.</p>
		</div>
	</div>

	<div id="potions">
		<div class="row">
			<div class="col-md-6">
				<h1>À chaque tourment sa préparation. Allez vérifier dans notre catalogue varié.</h1>
			</div>
			<div class="col-md-6">
				<img src="">
			</div>
		</div>
		<div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-4">
				<a href="./potions.php">
					<h2>Nos potions</h2>
				</a>
			</div>
			<div class="col-md-4">
				<p>Nos potions ont une efficacité quasi instantanée. Tout comme pour vos médicaments veuillez cependant prendre soin de bien lire la notice d’usage et de ne pas augmenter les doses prescrites.</p>
			</div>
		</div>
	</div>

    <?php include("/parts/pied.php") ?>
</body>

</html>