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
	<title>Commander</title>
	<?php include("/parts/head.php") ?>
</head>
<body>
	<?php include("/parts/entete.php") ?>
	<div class="container">
		<h1>Nos produits</h1>

	</div>
	<?php include("/parts/pied.php") ?>
</body>
</html>