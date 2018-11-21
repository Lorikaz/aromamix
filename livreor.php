<?php session_start(); ?>
<html>
<head>
    <meta charset="utf-8" />
    <title>Génétige</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
    <link href="https://fonts.googleapis.com/css?family=Indie+Flower" rel="stylesheet">
</head>
<body>
    <div class="menu flex">
        <div class="logo"><a href="Accueil.php">Génétige</a></div>
        <div class="element-menu"><a href="plantes.php"> Nos plantes</a></div>
        <div class="element-menu"><a href="#">Le processus</a></div>
        <div class="element-menu"><a href="#">Qui sommes-nous</a></div>
        <div class="element-menu"><a href="livreor.php">Livre d'or</a></div>
    </div>
<?php
////// Si l'utilisateur est connecté

if(isset($_SESSION['acces']) && $_SESSION['acces']=="oui"){
    ?>
    <html>
        <head>
            <title>Livre d'or</title>
        </head>

        <body>

            <!-- Génération du formulaire de message -->

            <form method="post" action="livreor.php">
                <p>Vous aimez notre produit ? Laissez nous un commentaire !</p>
                <p>
                    <!-- Récupère le pseudo dans SESSION-->
                    Connecté en tant que : <?php echo $_SESSION['login'] ?><br />
                    Message :<br />
                    <textarea name="message" rows="8" cols="35"></textarea><br />
                    <input type="submit" value="Envoyer" />
                </p>
            </form>

            <p class="pages">

                <?php

                ////// Connexion base de données 

                $bdd = new PDO('mysql:host=localhost;dbname=lmn', "root", "");

                ////// Récupération et enregistrement du message dans la base de données 

                if (isset($_POST['message']))
                {
                    $pseudo = $_SESSION['login']; 
                    $message =$_POST['message']; 
                    $message = nl2br($message); 
                    $requeteajoutcom =  "INSERT INTO `livreor`(`user`, `message`) VALUES ('$pseudo','$message')";
                    $resultat = $bdd->query($requeteajoutcom); 
                }

                ///// Suppression d'un commentaire

                if (isset($_GET['action']) && $_GET['action'] == 'delete') { 
                        $id = $_GET['id'];
                        $requetesuppression = "DELETE FROM `livreor` WHERE `id` = ".$id;
                        $resultatsuppresion = $bdd->exec($requetesuppression);
                   
                    }

                ////// Génération des pages par rapport au nombre de message

                    $nombreDeMessagesParPage = 5;
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

                        if ($_SESSION['login']==$pseudo OR $_SESSION['droits']== "2")  { ?>
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
        </html>
    <?php
}
   
   //// Si l'utilisateur n'est pas connecté
 
else{

    ////// Connexion base de données 
    $bdd = new PDO('mysql:host=localhost;dbname=lmn', "root", "");

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
    for ($i = 1 ; $i <= $nb_page ; $i++)
    {
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
    $retourpremiermessage->execute();


    ////// On stocke les données de la requete et on affiche les messages

    if ($retourpremiermessage) {
        foreach ($retourpremiermessage as $row) {
             $pseudo = $row[1];
             $message = $row[2];
             ?>
             <div class="pseudo">
                <h1><?php
                echo $pseudo;
                ?>

            </div>

            <div class="message">
             <p><?php
             echo $message;
             ?>
         </p>
         <?php
        }
    }
         ?>

    <!-- Lien de connexion -->  

    <a href="Connexion2.php">Connectez-vous pour laissez un message ! </a>
    <?php
}



