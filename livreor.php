<?php
    session_start();

  //URL of the host
  $dbhost = "mysql-aromamix.alwaysdata.net";

  // Name of the database
  $dbname = "aromamix_aromamix";

  // User name
  $dbuser = "aromamix";

  // Password (not used here)
  $dbpass = "aromamix";
  try {
    $bdd = new PDO('mysql:host='.$dbhost.';dbname='.$dbname, $dbuser, $dbpass);
  } catch(PDOException $e) {
    echo $e->getMessage();
  }
    /* checks if user exists */
  if (!empty($_SESSION['email'])) {
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
    <title>Aromamix - Livre d'Or</title>
    <?php include("/parts/head.php") ?>
</head>

<body class="livreor">
	<?php include("/parts/entete.php"); ?>

    <!-- Génération du formulaire de message -->

    <form method="post" action="livreor.php">
        <!-- Récupère le pseudo dans SESSION-->
        Connecté en tant que : <?php echo $_SESSION['email'] ?>
        <h1>Livre d'or</h1>
        <textarea name="message" rows="8" cols="35" placeholder="Laissez nous votre avis ..."></textarea><br/>
        <input type="submit" value="Publier" />
    </form>

    <p class="pages">

    <?php if($connect===true){

    ////// Connexion base de données

    $bdd = new PDO('mysql:host=localhost;dbname=aromamix', "root", "");

    ////// Récupération et enregistrement du message dans la base de données

    if (isset($_POST['message'])){
        $pseudo = $_SESSION['email'];
        $message =$_POST['message'];
        $message = nl2br($message);
        $ajoutcom =  "INSERT INTO `livreor`(`user`, `message`) VALUES ('$pseudo','$message')";
        $resultat = $bdd->query($ajoutcom);
    }

    ///// Suppression d'un commentaire

    if (isset($_GET['action']) && $_GET['action'] == 'delete') {
            $id = $_GET['id'];
            $requetesuppression = "DELETE FROM `livreor` WHERE `id` = ".$id;
            $resultatsuppresion = $bdd->exec($requetesuppression);
    }
    

    ////// Génération des pages par rapport au nombre de message

        $nombreDeMessagesParPage = 3;
        $comptermessage ="SELECT COUNT(message) AS total FROM livreor";
        $result = $bdd->query($comptermessage) ;
        $nb_message = $result->fetch(PDO::FETCH_ASSOC);
        $messagetotal = $nb_message['total'];
        $retour = $bdd->prepare('SELECT * FROM livreor');
        $retour->execute();
        $nb_page=ceil($messagetotal/$nombreDeMessagesParPage);

    /////// Puis on fait une boucle pour écrire les liens vers chacune des pages

        echo 'Page : ';
        for ($i = 1 ; $i <= $nb_page ; $i++){
            echo '<a href="livreor.php?page=' . $i . '">' . $i . '</a> ';
        }
        ?>
    </p>

    <?php

    ///////// On se place sur la bonne page

    if (isset($_GET['page']))
    {
        $page = $_GET['page'];
    }
    else{// La variable n'existe pas, c'est la première fois qu'on charge la page

    $page = 1; // On se met sur la page 1 (par défaut)
    }

    ////// On recupere les données en mettant les messages dans l'ordre du plus récent au plus ancien

    $premierMessage = ($page - 1) * $nombreDeMessagesParPage;
    $requete ="SELECT * FROM livreor ORDER BY id DESC LIMIT " . $premierMessage . ",". $nombreDeMessagesParPage.";";
    $retourpremiermessage = $bdd->prepare($requete);
    $retourpremiermessage->execute();

    ////// On stocke les données de la requete et on affiche les messages

    if ($retourpremiermessage) {
        foreach ($retourpremiermessage as $row) {
         $id = $row[0];
         $pseudo = $row[1];
         $message = $row[2];

            //// Si l'utilisateur est auteur du message il peut le supprimer

            if ($_SESSION['email']==$pseudo)  { ?>
                <div class="pseudo">
                    <h1>
                        <?php
                        echo $pseudo;
                        ?>
                    </h1>
                </div>
                <div class="message">
                    <?php
                    echo $message;
                    ?>
                </div>

                <!-- Lien de suppression en fonction de l'ID du message -->

                <div id="<?php echo $id ?>">
                    <?php echo "<a href=livreor.php?action=delete&id=" .$id .">Supprimer le commentaire</a>";?>
                </div>
            <?php
            }
            else{
            ?>

                <div class="pseudo">
                    <h1>
                    <?php
                    echo $pseudo;
                    ?>
                    </h1>
                </div>
                <div class="message">
                    <?php
                    echo $message;
            }
        }
    }
    ?>

</body>

   //// Si l'utilisateur n'est pas connecté

    else{

        ////// Connexion base de données
        $bdd = new PDO('mysql:host=localhost;dbname=aromamix', "root", "");

        ////// Génération des pages par rapport au nombre de message

        $nombreDeMessagesParPage = 5;
        $comptermessage ="SELECT COUNT(message) AS total FROM livreor";
        $result = $bdd->query($comptermessage) ;
        $nb_message = $result->fetch(PDO::FETCH_ASSOC);
        $messagetotal = $nb_message['total'];
        $retour = $bdd->prepare('SELECT * FROM livreor');
        $retour->execute();
        $nb_page=ceil($messagetotal/$nombreDeMessagesParPage);

        ///// Puis on fait une boucle pour écrire les liens vers chacune des pages

        echo 'Page : ';
        for ($i = 1 ; $i <= $nb_page ; $i++){
            echo '<a href="livreor.php?page=' . $i . '">' . $i . '</a> ';
        }
        ?>
        </p>

        <?php

        ///// On se place sur la bonne page

        if (isset($_GET['page']))
        {
            $page = $_GET['page'];
        }
        else // La variable n'existe pas, c'est la première fois qu'on charge la page
        {
            $page = 1; // On se met sur la page 1 (par défaut)
        }

        $premierMessage = ($page - 1) * $nombreDeMessagesParPage;

        ////// On recupere les données en mettant les messages dans l'ordre du plus récent au plus ancien

        $requete ="SELECT * FROM livreor ORDER BY id DESC LIMIT " . $premierMessage . ",". $nombreDeMessagesParPage.";";
        $retourpremiermessage = $bdd->prepare($requete);
        $retourpremiermessage->execute(); ?>


        <div class="commentaires">
            <?php ////// On stocke les données de la requete et on affiche les messages
            if ($retourpremiermessage) {
                foreach ($retourpremiermessage as $row) {
                    $pseudo = $row[1];
                    $message = $row[2];
                    ?>
                    <div class="commentaire">
                        <h1 class="pseudo">
                            <?php echo $pseudo; ?>
                        </h1>

                        <p class="message">
                            <?php echo $message; ?>
                        </p>
                    </div>
                    <?php }
                }
            } ?>
        </div>

    <?php include("/parts/pied.php"); ?>

</body>

</html>
