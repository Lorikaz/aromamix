<?php
 session_start();
?>

<!DOCTYPE html>
	<title>Inscription</title>
	<?php include("/parts/head.php") ?>
</head>
	<?php include("/parts/entete.php") ?>
	</head>
	<?php 
  	$fnameErr =$lnameErr = $mailErr = $confmailErr =$mdpErr =$confmdpErr = $existEmailErr = $typesErr="";


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
	<!-- MAIN CONTAINER : all page is contained -->
	<div class="container-fluid">



		<div class="row">
			<div class="col-lg-6 col-lg-offset-3 col-sm-8 col-sm-offset-2 col-xs-12" id="subscription">
				<h3>Créer mon compte</h3>
				  <div class="panel">
				    <form class="form-horizontal" method="POST" action="create_account.php">
				    	<?php if (($fnameErr != "") || ($lnameErr != "")){
				    		// if user doesn't fill the first name input or the last name input, the block will shows in red (has-warning)
				    		?>
				    		<div class="form-group has-warning"> 
				    	
							    <label for="firstname" class="col-sm-3 control-label">Prénom*</label>
							    <div class="col-sm-4">
							      <input type="text" class="form-control" name="firstname" id="firstname" placeholder="Prénom">
							      <?php if($fnameErr != ""){ 
			    				//if first name isn't fulfilled
							      echo "<span class='help-block'>".$fnameErr."</span>";
							     }
							      ?>
							    </div>

					    			
				    			<label for="lastname" class="col-sm-1 control-label">Nom*</label>
					    		<div class="col-sm-4"><!-- last name -->
					      			<input type="text" class="form-control" name="lastname" id="lastname" placeholder="Nom" >
					      			<?php if ($lnameErr != ""){
				    				// if last name input is empty
				    					echo "<span class='help-block'>".$lnameErr."</span>";
				    				}
				    					?>
					    		</div>
				    		
				      
					    <?php } else{
					    	// case where both lastname and first name inputs are filled
					    	?>
					    	<div class="form-group"> <!-- first name -->
					   			 <label for="firstname" class="col-sm-3 control-label">Prenom*</label>
					   			 <div class="col-sm-4">
					    		  <input type="text" class="form-control" name="firstname" id="firstname" placeholder="Prenom" value="<?php if(isset($_POST['firstname'])){echo $_POST['firstname'];} ?>"/>
					      
					   		</div>
					    	<label for="lastname" class="col-sm-1 control-label">Nom*</label>
					    	<div class="col-sm-4"><!-- last name -->
					      		<input type="text" class="form-control" name="lastname" id="lastname" placeholder="Nom" value="<?php if(isset($_POST['lastname'])){echo $_POST['lastname'];} ?>"/>
					    	</div>
					    	<?php } ?>
					  </div>


					  <!-- email address -->
					  <?php if($mailErr != ""){
					  	// if there's no '@' or '.' in the email adress

					  	?>
					  	<div class="form-group has-warning"> 

					    	<label for="email" class="col-sm-3 control-label">Adresse e-mail*</label>
						    <div class="col-sm-9">
						      	<input type="email" class="form-control" name="email" id="email" placeholder="Email"
						      <?php
						      	// if the user has begin fulfill the account.php page to subscribe, it will get its infos in this advanced subscription form
						      	if(isset($_POST['email'])){
						      		echo "value='".$_POST['email']."'";
						      	}
						      ?>
						      >
						      <span class="help-block"> <?php echo $mailErr;?> </span>
						    </div>
						</div>
					  	<?php

					  } else {
					  	// if email is corresponding to the pattern
					  ?>
					  <div class="form-group"> 
					    <label for="email" class="col-sm-3 control-label">Adresse e-mail*</label>
					    <div class="col-sm-9">
					      <input type="email" class="form-control" name="email" id="email" placeholder="Email"
					      <?php
					      	// if the user has begin fulfill the account.php page to subscribe, it will get its infos in this advanced subscription form
					      	if(isset($_POST['email'])){
					      		echo "value='".$_POST['email']."'";
					      	}
					      ?>
					      >
					    </div>
					   </div>
					    <?php } ?>
					  

					  <!-- email address confirmation -->
					  <?php if(($existEmailErr != "") || ($confmailErr != "")){ ?>
					  <div class="form-group has-error">
					  <?php } else{ ?>
					  <div class="form-group">
					  	<?php } ?> 
					    <label for="email3" class="col-sm-3 control-label"></label>
					    
					    <div class="col-sm-9">
					      <input type="email" class="form-control" name="email1" id="email1" placeholder="Confirmer votre adresse e-mail"
					      <?php
					      	// if the user has begin fulfill the inputs to subscribe and have an error in another input, it will get its infos back
					      	if(isset($_POST['email1'])){
					      		echo "value='".$_POST['email1']."'";
					      	}
					      ?>
					      >
					      <span class = "help-block"><?php echo $existEmailErr;?></span>
					      <span class="help-block"><?php echo $confmailErr;?></span>
					    </div>
					  </div>


					  <!-- password -->
					  <?php if(($mdpErr != "") || ($confmdpErr !="")){ ?>
					  <div class="form-group has-error"> 
					  <?php } else { ?>
					  <div class="form-group"> 
					  <?php } ?>
					    <label for="password" class="col-sm-3 control-label">Mot de passe*</label>
					    <div class="col-sm-9">
					      <input type="password" class="form-control" name="password" id="password" placeholder="Mot de passe">
					      <span class="help-block"> <?php echo $mdpErr;?></span>
					    </div>
					  </div>

					  <!-- password confirmation -->
					  <div class="form-group"> 
					    <label for="confPassword" class="col-sm-3 control-label"></label>
					    <div class="col-sm-9">
					      <input type="password" class="form-control" name="confPassword" id="confPassword" placeholder="Confirmer le mot de passe">
					      <span class="help-block"> <?php echo $confmdpErr;?></span>
					    </div>
					  </div>


					  <!-- subscription button -->
					  <div class="form-group"> 
					    <div class="col-sm-12">
					    	<p>* Champs obligatoires</p>
					      <div class="alert alert-info" role="alert">En cliquant sur "Enregistrer", j'accepte les conditions générales de vente et d'utilisation du site aromamix.com</div>
					      <button type="submit" class="btn btn-default" name="sub-btn">Enregistrer</button>
					    </div>
					  </div> <!-- /. end of subscription button -->

					</form> <!-- /. end of subcription form -->

				  </div>
			</div>
		</div>

		<!-- advertisement or movies -->
		<div class="row advertisement">
		</div>

	</div>
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
	include("/parts/pied.php")
	?>



	</body>
</html>