<?php session_start(); ?>


<!DOCTYPE html>
<html>
<head>
	<title>Inscription</title>
	<?php include("/parts/head.php") ?>
</head>
<body>
	<?php include("/parts/entete.php") ?>
	<div class="container">
		<h1>Inscrivez-vous !</h1>
		<fieldset>
			<legend>Formulaire de commande</legend>
			<form method="post" action="inscription.php">
				<label for="nom">Nom</label>
					<input type="text" name="nom"/></br>
				<label for="prenom">Prénom</label>
					<input type="text" name="prenom"/></br>
				<label for="mail">Adresse e-mail</label>
					<input type="email" name="mail"/></br>
				<label for="password">Mot de passe</label>
					<input type="password" name="password"/></br>
				<label for="confirmation">Confirmez mot de passe</label>
					<input type="password" name="confirmation"/>
				<input type="submit" name="valider" value="Valider"/>
			</form>
		</fieldset>


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

    			//Hashage du mot de passe
			$pass_hache = password_hash($_POST['password'], PASSWORD_DEFAULT);

			//Insertion

			$chaine = "INSERT INTO users(lastname,firstname,email,password)VALUES(nom,prenom,mail,mdp)')";
			$req=$bdd-> prepare('INSERT INTO users(lastname,firstname,email,password)VALUES(nom,prenom,mail,mdp)');
			$req->execute(array(
				'lastname'=>$lastname,
				'mdp'=>$mdp,
				'email'=>$mail
			));
  } catch(PDOException $e) {
    echo $e->getMessage();
  }
?>


<?php
/*
//  Récupération de l'utilisateur et de son pass hashé
$req = $bdd->prepare('SELECT id, pass FROM membres WHERE pseudo = :pseudo');
$req->execute(array(
    'pseudo' => $pseudo));
$resultat = $req->fetch();

// Comparaison du pass envoyé via le formulaire avec la base
$isPasswordCorrect = password_verify($_POST['pass'], $resultat['pass']);

if (!$resultat)
{
    echo 'Mauvais identifiant ou mot de passe !';
}
else
{
    if ($isPasswordCorrect) {
        session_start();
        $_SESSION['id'] = $resultat['id'];
        $_SESSION['pseudo'] = $pseudo;
        echo 'Vous êtes connecté !';
    }
    else {
        echo 'Mauvais identifiant ou mot de passe !';
    }
}
*/
?>
	</div>
	<?php include("/parts/pied.php") ?>
</body>
</html>
