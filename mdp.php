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
  <title>Aromamix - Mot de passe</title>
    <?php include("/parts/head.php") ?>
</head>
<body>
    <?php include("/parts/entete.php") ?>

    <h1>Mot de passe oublié ?</h1>

    <form method="post" action="mdp.php">
      <fieldset>
        <legend>Entrez vos coordonnées !</legend>
        <label for="email">Email : </label>
        <input type="text" name="email" id="email"/>
        <label for="question">Quel est le nom de jeune fille de votre mère ?</label>
        <input type="text" name="question" id="question"/>
      </fieldset>
      <input type="submit" name="valider" value="Valider">
    </form>

    <?php

  if(!empty($_POST['email'])&&!empty($_POST['question'])){
    $recup="SELECT password FROM users WHERE email = '".$_POST['email']."' AND question = '".$_POST['question']."' ";
    foreach ($bdd->query($recup) as $key) {
      $mdp = $key[0];
      echo ("Votre mot de passe est le suivant : ".$mdp);
    }
   /* $statement = $bdd->prepare($recup);
    $statement->execute();
    //$mdp=$bdd->query($recup);
    var_dump($statement);
    //$data = mysql_fetch_array($statement);
    //echo ("Votre mot de passe est le suivant : ".$mdp);*/
  } ?>

    <?php include("/parts/pied.php") ?>
</body>
</html>