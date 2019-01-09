<!DOCTYPE html>
<html>

<head>
	<title>Commande - Aromamix</title>
	<?php include("/parts/head.php") ?>
</head>

<body>
	<?php include("/parts/entete.php") ?>

	<h1>Commander des smoothies</h1>
	<form>
		<div class="form-group">
			<label for="nom">Nom</label>
			<input type="text" class="form-control" id="nom">
		</div>
		<div class="form-group">
			<label for="prenom">Prénom</label>
			<input type="text" class="form-control" id="prenom">
		</div>
		<div class="form-group">
			<label for="mail">Adresse mail</label>
			<input type="email" class="form-control" id="mail">
		</div>
		<div class="form-group">
			<label for="rue">Rue</label>
			<input type="text" class="form-control" id="rue">
		</div>
		<div class="form-group">
			<label for="zipcode">Code postal</label>
			<input type="text" class="form-control" id="zipcode">
		</div>
		<div class="form-group">
			<label for="ville">Ville</label>
			<input type="text" class="form-control" id="ville">
		</div>
		<button type="submit" class="btn btn-potion">Commander</button>
	</form>

	<?php include("/parts/pied.php") ?>
	</div>
</body>

</html>