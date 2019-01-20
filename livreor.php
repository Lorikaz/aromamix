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



/*    session_start();

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
  }*/
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
    <?php include("./parts/head.php") ?>
</head>

<body>
    <div class="page livreor">
    	<?php include("./parts/entete.php"); ?>

        <section class="main-content">
            <div class="form">
                <!-- Génération du formulaire de message -->
                <form method="post" action="livreor.php">
                    <!-- Récupère le pseudo dans SESSION-->
                    <?php if ($connect==true){?>
                        <h2>Connecté en tant que : <?php echo $_SESSION['firstname'] ?></h2>
                    <?php 
                    }else{?>
                        <h2>Vous devez vous connecter pour laisser un commentaire.
                    <?php 
                    }
                    ?>
                    <h1>Livre d'or</h1>
                    <textarea name="message" placeholder="Laissez nous votre avis ..."></textarea><br/>
                    <input class="ok" type="submit" value="Publier" />
                </form>
            </div>

            <p class="pages">

            <?php if($connect===true){

            // Insertion du message en BDD

            if (isset($_POST['message'])){
                $pseudo = $_SESSION['email'];                
                $message =$_POST['message'];
                $message = nl2br($message);
                $ajoutcom =  "INSERT INTO `livreor`(`user`, `message`) VALUES ('$pseudo','$message')";
                $resultat = $bdd->query($ajoutcom);
            }

            //Supprimer un message dans la BDD

            if (isset($_GET['action']) && $_GET['action'] == 'delete') {
                    $id = $_GET['id'];
                    $requetesuppression = "DELETE FROM `livreor` WHERE `id` = ".$id;
                    $resultatsuppresion = $bdd->exec($requetesuppression);
            }
            

            //Pagination des messages

                $nb_mess_page = 3;
                $comptermessage ="SELECT COUNT(message) AS total FROM livreor";
                $result = $bdd->query($comptermessage) ;
                $nb_message = $result->fetch(PDO::FETCH_ASSOC);
                $messagetotal = $nb_message['total'];
                $retour = $bdd->prepare('SELECT * FROM livreor');
                $retour->execute();
                $nb_page=ceil($messagetotal/$nb_mess_page);

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

            $premierMessage = ($page - 1) * $nb_mess_page;
            $requete ="SELECT * FROM livreor ORDER BY id DESC LIMIT " . $premierMessage . ",". $nb_mess_page.";";
            $premier = $bdd->prepare($requete);
            $premier->execute(); ?>

            <div class="commentaires">
            <?php ////// On stocke les données de la requete et on affiche les messages
            if ($premier) {
                foreach ($premier as $row) {
                 $id = $row[0];
                 $pseudo = $row[1];
                 $message = $row[2];

                    //// Si l'utilisateur est auteur du message il peut le supprimer

                    if ($_SESSION['email']==$pseudo)  { ?>
                        <div class="commentaire">
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
                        </div>
                    <?php
                    }
                    else{
                    ?>

                        <div class="commentaire">
                            <div class="pseudo">
                                <h1>
                                <?php
                                echo $pseudo;
                                ?>
                                </h1>
                            </div>
                            <div class="message">
                                <?php
                                echo $message; ?>
                            </div>
                        </div>
                    <?php }
                }
            }
            ?>
            </div>

        </body>
        </html>
        <?php
        }

           //// Si l'utilisateur n'est pas connecté

            else{


                //Nombre de messages sur chaque pages

                $nb_mess_page = 5;
                $comptermessage ="SELECT COUNT(message) AS total FROM livreor";
                $result = $bdd->query($comptermessage) ;
                $nb_message = $result->fetch(PDO::FETCH_ASSOC);
                $messagetotal = $nb_message['total'];
                $retour = $bdd->prepare('SELECT * FROM livreor');
                $retour->execute();
                $nb_page=ceil($messagetotal/$nb_mess_page);

                //Lien vers les pages

                echo 'Page : ';
                for ($i = 1 ; $i <= $nb_page ; $i++){
                    echo '<a href="livreor.php?page=' . $i . '">' . $i . '</a> ';
                }
                ?>
                </p>

                <?php

                if (isset($_GET['page'])){
                    $page = $_GET['page'];
                }else{
                    $page = 1;
                }

                $premierMessage = ($page - 1) * $nb_mess_page;

                //On met les message dans l'ordre
                $req ="SELECT * FROM livreor ORDER BY id DESC LIMIT " . $premierMessage . ",". $nb_mess_page.";";
                $premier = $bdd->prepare($req);
                $premier->execute(); ?>


                <div class="commentaires">
                    <?php
                    //affichage des messages
                    if ($premier) {
                        foreach ($premier as $row) {
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
        </section>

        <?php include("./parts/pied.php"); ?>
    </div>

</body>

</html>
