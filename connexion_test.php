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
  } ?>
<!DOCTYPE html>

<html>
<head>
	<title>Aromamix - Accueil</title>
    <?php include("./parts/head.php") ?>
</head>
<body>
    <div class="page connexion">
        <?php include("./parts/entete.php") ?>

        <section class="main-content">
            <form class="connexion" method="post" action="connexion_test.php">
        		<legend>
                    <h1>Se connecter</h1>      
                </legend>
        		<input class="text" type="text" name="email" id="email" placeholder="Adresse e-mail" />
        		<input class="text" type="password" name="password" id="password" placeholder="Mot de passe" />
                <div class="links">
                    <a href="">Mot de passe oublié ?</a>
                    <a href="create_account.php">S'inscrire</a>
                </div>
            	<input class="btn" type="submit" name="connexion" value="Connexion">
            </form>

            <?php
            	if(empty($_POST['email'])||empty($_POST['password'])){
             ?>
            		<p>Une erreur s'est produite pendant votre identification. Vous devez remplir tous les champs du formulaire</p>
            		<p>Cliquez <a href="connexion_test.php"> ici </a>pour revenir</p>
            <?php
            	}else
            	//On vérifie l'email
            	{
                	$query="SELECT lastname,firstname,email,password FROM users WHERE email = '".$_POST['email']."'";
            		//echo $query;
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
            			<p>Cliquez <a href="index.php">ici</a> pour revenir à la page d'accueil</p>

                    <?php 		
            		}else{
            			?>
            			<p>Une erreur s'est produite.</p>
            		<?php	
            		}
            } ?>
        </section>

        <?php include("./parts/pied.php") ?>
    </div>
</body>
</html>