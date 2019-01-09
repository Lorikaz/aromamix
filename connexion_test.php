<?php
	session_start();

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
<!DOCTYPE html>

<html>
<head>
	<title>Aromamix - Accueil</title>
    <?php include("/parts/head.php") ?>
</head>
<body>
    <?php include("/parts/entete.php") 
?>

    <form method="post" action="connexion_test.php">
    	<fieldset>
    		<legend>Connexion</legend>
    		<label for="email">Email : </label>
    		<input type="text" name="email" id="email"/>
    		<label for="password">Mot de passe : </label>
    		<input type="password" name="password" id="password"/>
    	</fieldset>
    	<input type="submit" name="connexion">
    </form>

    <?php



    	if(empty($_POST['email'])||empty($_POST['password'])){
    		?>
    		<p>Une erreur s'est produite pendant votre identification. Vous devez remplir tous les champs du formulaire</p>'
    		<p>Cliquez <a href="connexion_test.php"> ici </a>pour revenir</p>
    <?php
    	}else
    	//On vérifie l'email
    	{
        	$query="SELECT lastname,firstname,email,password FROM users WHERE email = '".$_POST['email']."'";
    		echo $query;
    		$result=$bdd->prepare($query);
    		//$query->bindValue(':email',$_POST['email'], PDO::PARAM_STR);
    		$result->execute();
    		$data=$result->fetch(PDO::FETCH_ASSOC);
    		//var_dump($data);
    		if ($data['password']==$_POST['password']){
    			//On autorise l'accès
    			$_SESSION['lastname']=$data['lastname'];
    			$_SESSION['firstname']=$data['firstname'];
    			$_SESSION['email']=$data['email'];

    			?><p> Bienvenue <?php echo $data['firstname']?>, vous êtes maintenant connecté !</p>
    			<p>Cliquez <a href="index.php">ici</a>pour revenir à la page d'accueil  ?><?php 		
    		}else{
    			?>
    			<p>Une erreur s\'est produite !!!</p>
    		<?php	
    		}
    }


    ?>
</body>
</html>