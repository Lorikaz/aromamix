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
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla sed nulla augue. Suspendisse id arcu id elit laoreet pretium eget vel orci. Nullam vitae libero eu turpis eleifend ultricies vitae aliquet lectus. Sed tempor ante ac odio dapibus porta. Nulla a arcu cursus, dapibus mauris at, pharetra velit. Vivamus a accumsan lectus, sed elementum mauris. Duis non dui massa. Aenean non porttitor tortor, luctus dictum quam.</p>
		</div>
	</div>

	<div class="row" id="team">
		<div class="col-md-4">
			<img src="" height="250">
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla sed nulla augue. Suspendisse id arcu id elit laoreet pretium eget vel orci. Nullam vitae libero eu turpis eleifend ultricies vitae aliquet lectus. Sed tempor ante ac odio dapibus porta. Nulla a arcu cursus, dapibus mauris at, pharetra velit.</p>
		</div>
		<div class="col-md-4">
			<img src="" height="250">
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla sed nulla augue. Suspendisse id arcu id elit laoreet pretium eget vel orci. Nullam vitae libero eu turpis eleifend ultricies vitae aliquet lectus. Sed tempor ante ac odio dapibus porta. Nulla a arcu cursus, dapibus mauris at, pharetra velit.</p>
		</div>
		<div class="col-md-4">
			<img src="" height="250">
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla sed nulla augue. Suspendisse id arcu id elit laoreet pretium eget vel orci. Nullam vitae libero eu turpis eleifend ultricies vitae aliquet lectus. Sed tempor ante ac odio dapibus porta. Nulla a arcu cursus, dapibus mauris at, pharetra velit.</p>
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
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla sed nulla augue. Suspendisse id arcu id elit laoreet pretium eget vel orci.</p>
			</div>
		</div>
	</div>

    <?php include("/parts/pied.php") ?>
</body>

</html>