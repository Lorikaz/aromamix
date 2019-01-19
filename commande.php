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
  if (!empty($_SESSION['email'])) {
    // this boolean variable will tell if the user is connected or just a visitor
    $connect = true;
  //rajouter condition pour afficher toute les données sessions de l'utilisateur ; id, firstname
  }else{
    $connect = false;
  } ?>

<!DOCTYPE html>
<html>

<head>
	<title>Commande - Aromamix</title>
	<?php include("/parts/head.php") ?>
</head>

<body>
    <div class="page commande">
    	<?php include("/parts/entete.php") ?>

        <section class="main-content">
            <?php
                $quantite=0;
                $ajout_1=false;
                $ajout_2=false;
                $ajout_3=false;
                $ajout_4=false;
                $ajout_5=false;
                $ajout_6=false;


                if ($connect===false){ ?>
                    <h2 class="error">Vous devez vous connectez pour passer commande !</h2>
                <?php } else {
                    if(isset($_POST["ajout"])){
                        if($ajout_1==false){
                            if($_POST["potion1"]){
                                $nom_potion="Pierre de Flamel";
                                $price=295;
                                $quantite+=1;
                                $user=$_SESSION['email'];
                                $req="INSERT INTO `commande`(`potion`, `prix`, `quantite`, `user`) VALUES ('".$nom_potion."','".$price."','".$quantite."','".$user."')";
                                //echo $req;
                                $insertion = $bdd->prepare($req);
                                $insertion->execute();
                                $ajout_1=true;
                            }
                        }
                        if($ajout_2==false){
                            if($_POST["potion2"]){
                                $nom_potion="Sanglote";
                                $price=145;
                                $quantite+=1;
                                $user=$_SESSION['email'];
                                $req="INSERT INTO `commande`(`potion`, `prix`, `quantite`, `user`) VALUES ('".$nom_potion."','".$price."','".$quantite."','".$user."')";
                                //echo $req;
                                $insertion = $bdd->prepare($req);
                                $insertion->execute();
                                $ajout_2=true;
                            }
                        }
                        if($ajout_3==false){
                            if($_POST["potion3"]){
                                $nom_potion="Créabilis";
                                $price=135;
                                $quantite+=1;
                                $user=$_SESSION['email'];
                                $req="INSERT INTO `commande`(`potion`, `prix`, `quantite`, `user`) VALUES ('".$nom_potion."','".$price."','".$quantite."','".$user."')";
                                //echo $req;
                                $insertion = $bdd->prepare($req);
                                $insertion->execute();
                                $ajout_3=true;
                            }
                        }
                        if($ajout_4==false){
                            if($_POST["potion4"]){
                                $nom_potion="Animalis";
                                $price=265;
                                $quantite+=1;
                                $user=$_SESSION['email'];
                                $req="INSERT INTO `commande`(`potion`, `prix`, `quantite`, `user`) VALUES ('".$nom_potion."','".$price."','".$quantite."','".$user."')";
                                //echo $req;
                                $insertion = $bdd->prepare($req);
                                $insertion->execute();
                                $ajout_4=true;
                            }
                        }
                        if ($ajout_5==false){
                            if($_POST["potion5"]){
                                $nom_potion="Merliner";
                                $price=195;
                                $quantite+=1;
                                $user=$_SESSION['email'];
                                $req="INSERT INTO `commande`(`potion`, `prix`, `quantite`, `user`) VALUES ('".$nom_potion."','".$price."','".$quantite."','".$user."')";
                                //echo $req;
                                $insertion = $bdd->prepare($req);
                                $insertion->execute();
                                $ajout_5=true;
                            }
                        }
                        if($ajout_6==false){
                            if($_POST["potion6"]){
                                $nom_potion="Felix Felicis";
                                $price=245;
                                $quantite+=1;
                                $user=$_SESSION['email'];
                                $req="INSERT INTO `commande`(`potion`, `prix`, `quantite`, `user`) VALUES ('".$nom_potion."','".$price."','".$quantite."','".$user."')";
                                //echo $req;
                                $insertion = $bdd->prepare($req);
                                $insertion->execute();
                                $ajout_6=true;
                            }
                        }
                    }

                $requete ="SELECT * FROM commande WHERE user='".$_SESSION['email']."'";
                $retourcommande = $bdd->prepare($requete);
                $retourcommande->execute();
             ?>
            <div class="choix-produit">
                <img src="media/index2.png">
                <form class="form-choix" action="commande.php" method="post">
                    <div class="choix">
                        <input class="check" type="checkbox" value="pierre_flamel" name="potion1" id="potion1" <?php if($ajout_1==true) {echo "checked=checked";}?>/>
                        <h2 class="titre">Pierre de Flamel</h2>
                        <span class="separator"></span>
                        <div class="prix">
                            <h1>295</h1>
                            <p>pièces d'or</p>
                        </div>
                    </div>
                    <div class="choix">
                        <input class="check" type="checkbox" value="sanglote" name="potion2" id="potion2" <?php if($ajout_2==true) {echo "checked=checked";} ?>/>
                        <h2 class="titre">Sanglote</h2>
                        <span class="separator"></span>
                        <div class="prix">
                            <h1>145</h1>
                            <p>pièces d'or</p>
                        </div>
                    </div>
                    <div class="choix">
                        <input class="check" type="checkbox" value="creabilis" name="potion3" id="potion3" <?php  if($ajout_3==true) {echo "checked=checked";} ?>/>
                        <h2 class="titre">Créabilis</h2>
                        <span class="separator"></span>
                        <div class="prix">
                            <h1>135</h1>
                            <p>pièces d'or</p>
                        </div>
                    </div>
                    <div class="choix">
                        <input class="check" type="checkbox" value="animalis" name="potion4" id="potion4" <?php if($ajout_4==true) {echo "checked=checked";} ?>/>
                        <h2 class="titre">Animalis</h2>
                        <span class="separator"></span>
                        <div class="prix">
                            <h1>265</h1>
                            <p>pièces d'or</p>
                        </div>
                    </div>
                    <div class="choix">
                        <input class="check" type="checkbox" value="merliner" name="potion5" id="potion5" <?php if($ajout_5==true) {echo "checked=checked";} ?>/>
                        <h2 class="titre">Merliner</h2>
                        <span class="separator"></span>
                        <div class="prix">
                            <h1>195</h1>
                            <p>pièces d'or</p>
                        </div>
                    </div>
                    <div class="choix">
                        <input class="check" type="checkbox" value="felix" name="potion6" id="potion6" <?php if($ajout_6==true) {echo "checked=checked";}?>/>
                        <h2 class="titre">Felix Felicis</h2>
                        <span class="separator"></span>
                        <div class="prix">
                            <h1>245</h1>
                            <p>pièces d'or</p>
                        </div>
                    </div>
                    <input class="ok" type="submit" value="Ajouter au panier" name="ajout"/>
                </form>
            </div>

            <div class="panier">
                <?php
                    $total = 0;
                    foreach ($retourcommande as $row){
                 ?>
                <div class="fiche-produit-panier">
                    <?php
                        $id = $row[0];
                        $potion = $row[1];
                        $quantite = $row[3];
                        $prix = $row[2];
                        $prix=$prix*$quantite;
                     ?>
                    <p class="id"><?php echo $id; ?></p>
                    <h1 class="titre"><?php echo $potion; ?></h1>
                    <p class="prix">
                        <h1><?php echo $prix; ?></h1>
                         pièces d'or
                     </p>
                    <div class="quantite"> 
                        <p>Quantité : </p>
                        <p><?php echo $quantite; ?></p>
                    </div>
                    <form action="commande.php" method="post">
                        <input type="submit" value="&#xf2ed" name="delete"/>
                    </form>
                    <?php
                        //echo "<a class=liensuppression href=commande.php?action=delete&id=" .$id .">Supprimer</a>";
                        if(isset($_POST["delete"])){
                        //echo "ACCTION";
                            $requete="DELETE FROM `commande` WHERE id='".$_POST["delete"]."'";
                            echo $requete;
                            $supprime = $bdd->prepare($requete);
                            $supprime->execute();
                            header('location: commande.php');
                        }
                     ?>
                </div>
                <?php } ?>
            </div>

            <div class="user-info">
                <form action="commande.php" method="post">
                    <div class="text">
                        <input type="text" name="nom" placeholder="Nom & Prénom ..."/>
                        <input type="text" name="email" placeholder="Adresse e-mail ..."/>
                        <input type="text" name="phone" placeholder="Numéro de téléphone ..."/>
                        <input type="text" name="adresse" placeholder="Adresse postale ..."/>
                    </div>
                    <input class="ok" type="submit" value="Commander" name="envoi"/>
                </form>
            </div>

            <?php 
                    if(isset($_POST["envoi"])){
                        $to="sdc.costa@outlook.fr";
                        $subject="Nouvelle commande de ".$_POST['lastname']." ".$_POST["firstname"];
                        $message=$_POST['lastname']." ".$_POST["firstname"]." a passé une commande de ".$potion;
                        mail($to,$subject,$message);
                        echo("Votre commande a bien été envoyé à nos magiciens ! Nous vous l'apporteront sur notre balais magique !");
                    }
                }
             ?>

     
        </section>

    	<?php include("/parts/pied.php") ?>
    </div>
</body>

</html>
