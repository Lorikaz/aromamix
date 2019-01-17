<?php
require 'base.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Mon compte Aromamix</title>
    <?php include("./parts/head.php") ?>
</head>
<body>
    <?php include("./parts/entete.php") ?>
	<h1>Mon compte</h1>
	<!-- MAIN CONTAINER : all page is contained -->
	<div class="container-fluid">

		<!-- advertisement -->
		<div class="row advertisement">
		</div>

		<!-- if user is connected -->
		<?php if($connect){ 
			$sql = "SELECT firstname FROM users WHERE email = '".$_SESSION['identifiant']."'";
			$req = $bdd -> query($sql);
			$data = $req -> fetch();
			$_SESSION['firstname'] = $data['firstname']; //test de connexion
		?>

		<div class="row">
			<div class="useraccount col-sm-6 col-sm-offset-3 col-xs-12">
				<h3 id="username">Bonjour <strong><?php echo $_SESSION['firstname'];?></strong></h3>
			    <ul class="nav nav-tabs nav-justified" id="mytabs">
			        <li class="active"><a href="#useracc"><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> Mon compte</a></li>
			        <li><a href="#userpreferences"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Mes préférences</a></li>
			    </ul>
			</div>
		</div>
		<div class="row">
		    <div class="tab-content useraccount col-sm-6 col-sm-offset-3 col-xs-12">
		        <div id="useracc" class="tab-pane fade in active text-justify">
		            <h4>Mes informations</h4>
		            <!-- user infos -->
	            	<div class="media">
	            		<!-- avatar -->
						<div class="media-left">
					    	<img src="image/user.png" alt="Avatar profil"/>
					    </div>
					  	<div class="media-body">
					    	<p>Identité : <?php echo $_SESSION['firstname'] . " "; 
					    	$sql = "SELECT lastname FROM users WHERE email = '".$_SESSION['identifiant']."'";
							$req = $bdd -> query($sql);
					    	?></p>
					    	<p>Adresse e-mail : <?php echo $_SESSION['identifiant']; ?></p>
					  	</div>
					</div>
		        </div>

		        </div>

		        <!-- new reservation  button-->
		        <div id="newcircuit">
		        	<a href="circuit.php"><button class="btn btn-default col-xs-12" id="reservation">Nouvelle réservation <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span></button></a>
		        </div>
		        <div id="settings" class="row">
			        <!-- deconnection button -->
					<div class="btn deconnected col-xs-6">
						<a href="deconnexion.php"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span> Déconnexion </a>
					</div>

					<!-- allow the user to delete its account -->
					<div id="delete-account">
						<form method="post" action="delete-account.php">
							<button class="col-xs-6 btn" name="deleting_account"><span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span> Supprimer mon compte</button>
						</form>
					</div>
				</div>
			</div>
		</div>


	</div>

		<?php } else{ ?>
		<!-- if user isn't connected -->
		<div class="row" id="panels">
			<!-- 

			Panel for connection 

			-->
			<div class="col-lg-6 col-xs-12" id="connection">
				<h3>Accéder à mon compte</h3>
				  <div class="panel">
				    <form class="form-horizontal" action="connexion.php" method="post">
					  <div class="form-group">
					    <label for="identifier1" class="col-sm-3 control-label">E-mail</label>
					    <div class="col-sm-9">
					      <input type="email" class="form-control" name="identifier1" id="identifier1" placeholder="Email">
					    </div>
					  </div>
					  <div class="form-group">
					    <label for="password1" class="col-sm-3 control-label">Mot de passe</label>
					    <div class="col-sm-9">
					      <input type="password" class="form-control" name="password1" id="password1" placeholder="Mot de passe">
					    </div>
					  </div>
					  <div class="form-group">
					    <div class="col-sm-offset-2 col-sm-10">
					      <button type="submit" class="btn btn-default" name="con-btn">Connexion</button>
					    </div>
					  </div>
					</form>
				  </div>
			</div>

			<!-- Panel for subscription -->
			<div class="col-lg-6 col-xs-12" id="subscription">
				<h3>Pas encore inscrit ?</h3>
				<p> Il suffit de cliquer sur le bouton ci-dessous. </p>
				<a href="create-account.php"><button type="submit" id="inscription" class="btn btn-default" name="sub-btn">S'inscrire</button></a>
			</div>
		</div>

		<?php } ?>
	</div>

    <?php include("./parts/pied.php") ?>
</body>
</html>