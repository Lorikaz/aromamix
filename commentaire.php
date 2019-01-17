<!DOCTYPE html>
<html>
<head>
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
    <meta charset="utf-8" />
	<title>Aromamix - Commentaire</title>
    <?php include("./parts/head.php") ?>
</head>
<body>
    <?php include("./parts/entete.php") ?>
	<h1>Que pensez-vous de notre magie ?</h1>
	<p>Dites nous tout!</p>

    <div class="new">
        <form action="commentaire.php" method="post">
            <fieldset>
                <legend>Nouveau commentaire</legend>
                <label for="pseudo">Pseudo : </label>
                <input type="text" name="pseudo" id="pseudo"/>
                <label for="contenu">Votre commentaire : </label>
                <input type="text" name="contenu" id="contenu"/>
            </fieldset>
            <input type="submit" name="connexion">
        </form>
    </div>
<?php
    if(!empty($_POST['pseudo']) AND !empty($_POST['contenu'])){
        $req=("INSERT INTO commentaire(pseudo,contenu)VALUES('".$_POST['pseudo']."','".$_POST['contenu']."')");
        $statement = $bdd->prepare($req);
        $statement->execute();
    }
    ?>
    <h2>Commentaire</h2>
    <?php
    $req=('SELECT id,pseudo,contenu FROM commentaire');
    foreach ($bdd->query($req) as $row) {
        $id = $row[0];
        $pseudo = $row[1];
        $contenu = $row[2];
        ?>
        <p><strong><?php echo $pseudo ;?></strong><p>
        <p><?php echo $contenu ;?><p>
    <?php
      header('location: commentaire.php');    
    exit;
    }
    include("./parts/pied.php") ?>
</body>
</html>