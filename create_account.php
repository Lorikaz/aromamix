<?php
 session_start();
?>

<!DOCTYPE html>
<head>
	<title>Inscription</title>
	<?php include("./parts/head.php") ?>
</head>
	<?php $fnameErr =$lnameErr = $mailErr = $confmailErr =$mdpErr =$confmdpErr = $existEmailErr = $typesErr="";
	/*	//And if everything is valid, then the account is added to the database
		if ($champOk){
			$userid = addUser($lastname,$firstname,$email,$gets_emails,$password);
			addUserGenres($userid,$_POST['types']);
			//header('Location: account.php');
		}*/

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

	//Uniquement si l'utilisateur n'entre pas les bons champs	
	$fnameErr =$lnameErr = $mailErr = $confmailErr =$mdpErr =$confmdpErr = $existEmailErr=$typesErr="";
	$champOk = true;
	$toutajouté = false;
	//Gestion des erreurs dans le formulaire
	if($_SERVER["REQUEST_METHOD"] == 'POST'){
		if(empty($_POST['lastname'])){
			$lnameErr = "* Entrez un nom."; 
			$champOk=false;
		}
		if(empty($_POST['firstname'])){
			$fnameErr = "* Entrez un prénom.";
			$champOk=false;
		}
		if(empty($_POST['password']) || strlen($_POST['password'])<8){
			$mdpErr = "* Le mot de passe doit contenir au moins 8 caractères.";
			$champOk=false;
		} 
		
		if(isset($_POST['password']) and isset($_POST['confPassword'])){
			if(strcmp($_POST["password"],$_POST["confPassword"])!==0){
				$confmdpErr = "* Les mots de passes ne sont pas identiques.";
				$champOk=false;
			}
		}
		
		if(isset($_POST['email'])){
			if (!strstr($_POST['email'],"@") or (!strstr($_POST['email'],"."))){
				$mailErr = "* Email invalide (ne contient pas de @ ou de .)";
				$champOk=false;
			}
			if(isset($_POST['email']) and isset($_POST['email1'])){
				if(strcmp($_POST["email"],$_POST["email1"])!==0){
					$confmailErr = "* Les adresses email ne sont pas identiques.";
					$champOk=false;
				}
			}
			/*if ($champOk){
				if (checkemail($_POST['email'])==false){
					$existEmailErr = "* L'email est déjà pris !";
					$champOk=false;
				}
			}*/
		}
		if (isset($_POST['gets_emails'])){ 
			$gets_emails =1;
		}else{
			$gets_emails =0;
		}
		if ($champOk){
			$lastname = $_POST['lastname'];
			$firstname = $_POST['firstname'];
			$password = $_POST['password'];
			$email = $_POST['email'];
			if(!empty($_POST['lastname']) AND !empty($_POST['firstname']) AND !empty($_POST['password']) AND !empty($_POST['email'])){
				$req='INSERT INTO `users`(`lastname`, `firstname`, `email`, `password`)VALUES("'.$lastname.'", "'.$_firstname.'", "'.$_email.'","'.$_POST['password'].'");';
				//echo $req;
				$statement = $bdd->prepare($req);
				$statement->execute();
				header('location: index.php'); 
			}
		}
	}
 ?>

<body>
	<div class="page inscription">
		<?php include("./parts/entete.php") ?>

		<!-- MAIN CONTAINER : all page is contained -->
		<section class="main-content">
			<h1>Inscription</h1>
			<form class="inscription" method="POST" action="create_account.php">
				<div class="form">
					<div class="part1">
						<p>L'inscription vous permet de faire partie de notre communauté, recevoir notre newsletter et nous laisser vos avis !</p>

				    	<?php if (($fnameErr != "") || ($lnameErr != "")){
				    	// if user doesn't fill the first name input or the last name input, the block will shows in red (has-warning)
				    	?>
				    		<div class="name form-txt has-warning">
				    			<input type="text" class="form-txt" name="lastname" id="lastname" placeholder="Nom*" >
					      			<?php if ($lnameErr != ""){
				    					// if last name input is empty
				    					echo "<span class='help-block'>".$lnameErr."</span>";
				    				} ?>

							    <input type="text" class="form-txt" name="firstname" id="firstname" placeholder="Prénom*">
							    	<?php if($fnameErr != ""){ 
			    						//if first name isn't fulfilled
							    		echo "<span class='help-block'>".$fnameErr."</span>";
							    	} ?>
				    		
						<?php } else {
							// case where both lastname and first name inputs are filled
						?>
					    	<div class="name form-txt"> <!-- first name -->
						    	<input type="text" class="form-txt" name="lastname" id="lastname" placeholder="Nom*" value="<?php if(isset($_POST['lastname'])){echo $_POST['lastname'];} ?>"/>

					   			<input type="text" class="form-txt" name="firstname" id="firstname" placeholder="Prénom*" value="<?php if(isset($_POST['firstname'])){echo $_POST['firstname'];} ?>"/>
					    	<?php } ?>
							</div>
					</div>

					<div class="part2">
						<!-- email address -->
						<?php if($mailErr != ""){
							// if there's no '@' or '.' in the email adress
						 ?>
							<div class="email form-txt has-warning"> 
								<input type="email" class="form-txt" name="email" id="email" placeholder="Email*"
									<?php
										// if the user has begin fulfill the account.php page to subscribe, it will get its infos in this advanced subscription form
										if(isset($_POST['email'])){
											echo "value='".$_POST['email']."'";
										}
									 ?>>
							    	<span class="help-block"> <?php echo $mailErr;?> </span>
							</div>

						<?php } else {
							// if email is corresponding to the pattern
						 ?>
							<div class="email form-txt"> 
								<input type="email" class="form-txt" name="email" id="email" placeholder="Email*"
								    <?php
										// if the user has begin fulfill the account.php page to subscribe, it will get its infos in this advanced subscription form
										if(isset($_POST['email'])){
											echo "value='".$_POST['email']."'";
										}
									 ?>>
							</div>
						<?php } ?>

						<!-- email address confirmation -->
						<?php if(($existEmailErr != "") || ($confmailErr != "")){ ?>
							<div class="confemail form-txt has-error">
						<?php } else{ ?>
							<div class="confemail form-txt">
								<?php } ?> 
								<input type="email" class="form-txt" name="email1" id="email1" placeholder="Confirmer e-mail*"
								<?php
									// if the user has begin fulfill the inputs to subscribe and have an error in another input, it will get its infos back
									if(isset($_POST['email1'])){
										echo "value='".$_POST['email1']."'";
									}
								?>>
								<span class="help-block"><?php echo $existEmailErr;?></span>
								<span class="help-block"><?php echo $confmailErr;?></span>
							</div>


						<!-- password -->
						<?php if(($mdpErr != "") || ($confmdpErr !="")){ ?>
							<div class="password form-txt has-error"> 
								<?php } else { ?>
								<div class="password form-txt"> 
									<?php } ?>
									<input type="password" class="form-txt" name="password" id="password" placeholder="Mot de passe*">
									<span class="help-block"> <?php echo $mdpErr;?></span>
							</div>

						<!-- password confirmation -->
						<div class="confpassword form-txt"> 
							<input type="password" class="form-txt" name="confPassword" id="confPassword" placeholder="Confirmer mot de passe*">
							<span class="help-block"> <?php echo $confmdpErr;?></span>
						</div>
					</div>
				</div>

				<!-- subscription button -->
				<div class="submit"> 
					<p>* Champs obligatoires</p>
					<div class="alert">En cliquant sur "S'inscrire", j'accepte les conditions générales de vente et d'utilisation du site aromamix.com</div>
					<div class="links">
						<a href="connexion_test.php">Se connecter</a>
						<button type="submit" class="btn" name="sub-btn">S'inscrire</button>
					</div>
				</div> <!-- /. end of subscription button -->
			</form> <!-- /. end of subcription form -->

			<!-- advertisement or movies -->
			<div class="row advertisement"></div>
		</section>
		<?php

		  
					/*$req->execute(array(
						'lastname'=>$lastname,
						'mdp'=>$mdp,
						'email'=>$email
					));*/


			/*
				function requete_bdd($connection, $req){
					/* will return all data from the database as json data
						
						------- ARGUMENTS
						$req is a string
						$connection is the database
								*/

					//$query = $connection->prepare($req);
					//return $query;
					/* returned variable is an pdo object */
				//}

		} catch(PDOException $e) {
		    echo $e->getMessage();
		  }
		include("./parts/pied.php"); ?>
	</div>
</body>

</html>