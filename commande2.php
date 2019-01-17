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

    /* checks if user exists */
    if (!empty($_SESSION['email']) && !empty($_SESSION['passsword'])) {
        // this boolean variable will tell if the user is connected or just a visitor
        $connect = true;
        //rajouter condition pour afficher toute les données sessions de l'utilisateur ; id, firstname
    }else{
        $connect = false;
    }
 ?>

<!DOCTYPE html>
<html>

<head>
	<title>Commande - Aromamix</title>
	<?php include("./parts/head.php") ?>
</head>

<body>
    <div class="page commande">
      	<?php include("./parts/entete.php") ?>

        <section class="main-content"></section>

      	<?php include("./parts/pied.php") ?>
    </div>
</body>

</html>
