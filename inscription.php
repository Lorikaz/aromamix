<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
<?php
  //URL of the host
  $dbhost = "localhost"; 
  
  // Name of the database
  $dbname = "aromamix";
  
  // User name
  $dbuser = "root";
  
  // Password (not used here)
  $dbpass = "";
 
  try {
    $bdd = new PDO('mysql:host='.$dbhost.';dbname='.$dbname, $dbuser, $dbpass);
  } catch(PDOException $e) {
    echo $e->getMessage();
  }
?>
	<title>Inscription</title>
	<?php include("/parts/head.php") ?>
</head>
<body>
	<?php include("/parts/entete.php") ?>
	<div class="container">
		<h1>Inscrivez-vous !</h1>
		<fieldset>
			<legend>Formulaire de commande</legend>
			<form>
				<label for="nom">Nom</label>
					<input type="text" name="nom"/></br>
				<label for="prenom">Prénom</label>
					<input type="text" name="prenom"/></br>
				<label for="mail">Adresse e-mail</label>
					<input type="email" name="mail"/></br>
				<label for="mdp">Mot de passe</label>
					<input type="mdp" name="mdp"/></br>
				<label for="confirmation">Confirmez mot de passe</label>
					<input type="confirm" name="confirmation"/>
				<input type="submit" name="valider" value="Valider"/>

			</form>
		</fieldset>

		<?php
			//Hashage du mot de passe
			$pass_hache = password_hash($_POST['password'], PASSWORD_DEFAULT);

			//Insertion 
			$req=$bdd-> prepare('INSERT INTO users(lastname,firstname,email,password)VALUES(nom,prenom,mail,mdp)');
			$req->execute(array(
				'lastname'=>$lastname,
				'mdp'=>$mdp,
				'email'=>$mail
			));
		?>
	</div>
	<?php include("/parts/pied.php") ?>
</body>
</html>
