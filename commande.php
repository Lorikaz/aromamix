<!DOCTYPE html>
<html>
<head>
	<title>Commander</title>
	<?php include("/parts/head.php") ?>
</head>
<body>
	<?php include("/parts/entete.php") ?>
	<div class="container">
		<h1>Commander des smoothies</h1>
		<fieldset>
			<legend>Formulaire de commande</legend>
			<form>
				<label for="nom">Nom</label>
					<input type="text" name="nom"></br>
				<label for="prenom">Prénom</label>
					<input type="text" name="prenom"></br>
				<label for="mail">Adresse mail</label>
					<input type="email" name="mail"></br>
				<label for="rue">Rue</label>
					<input type="text" name="rue"></br>
				<label for="zipcode">Code postal</label>
					<input type="text" name="zipcode"></br>
				<label for="ville">Ville</label>
					<input type="text" name="ville"></br>
				<fieldset>
					<legend>Choix des smoothies</legend>
				</fieldset></br>
				<input type="submit" name="valider" value="Valider">
			</form>
		</fieldset>
	</div>
	<?php include("/parts/pied.php") ?>
</body>
</html>