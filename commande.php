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
  }
  

?>

<!DOCTYPE html>
<html>

<head>
	<title>Commande - Aromamix</title>
	<?php include("/parts/head.php") ?>
</head>

<body>
	<?php include("/parts/entete.php") ?>

  <form action="commande.php" method="post">
    <input type="checkbox" value="pierre_flamel" name="potion1"/>Pierre de Flamel
    <input type="checkbox" value="sanglote" name="potion2"/>Sanglote
    <input type="checkbox" value="creabilis" name="potion3" ="potion"/>Créabilis
    <input type="checkbox" value="animalis" name="potion4" ="potion"/>Animalis
    <input type="checkbox" value="merliner" name="potion5" ="potion"/>Merliner
    <input type="checkbox" value="felix" name="potion6" ="potion"/>Félix Felicis
    <input type="submit" value="Valider" name="ajout"/>
</form>


  <?php
  if ($connect===false){
    echo ("Vous devez vous connectez pour passer la commande !");
  }else{
    $requete ="SELECT * FROM commande WHERE user='".$_SESSION['email']."'";
    $retourcommande = $bdd->prepare($requete);
    $retourcommande->execute();
  ?>
  <div class="panier">
    <div class="titre">
      <h2>Votre panier</h2>
    </div>
    <div class="corps-panier ">
      <?php
      $total = 0;
      foreach ($retourcommande as $row){
      ?><div class="fiche-produit-panier flex"><?php
        $id = $row[0];
        $potion = $row[1];
        $quantite = $row[2];
        $prix = $row[4];
        $prix=$prix*$quantite;
      ?>
      <div class="potion">
        <h3><?php echo $potion; ?></h3>
        <p><?php echo $prix; ?> €</p>
      </div>
      <div class="bordure"></div>
      <div class="quantite flex"> 
         <h3>Quantité : </h3>
        <p><?php echo $quantite; ?></p>
      </div>
    </div><?php
    }
    ?>
  </div>
</div>     

<?php
/*
  //$_SESSION["produit"]=$_POST["potion"];
  if(isset($_POST["ajout"])){
    echo "Toto";
    if ($_POST["potion1"]){
      echo "Titi";
      ?>
      <div>Pierre de Flamel</div>
      <div>295</div>
      <div>Pièces d'or</div>
      <i class="fas fa-trash-alt"></i>
      <i class="fas fa-plus"></i>
      <i class="fas fa-minus"></i>
      <?php
    }
    if ($_POST["potion2"]){
      echo "Titi";
      ?>
      <div>Sanglote</div>
      <div>145</div>
      <div>Pièces d'or</div>
      <i class="fas fa-trash-alt"></i>
      <i class="fas fa-plus"></i>
      <i class="fas fa-minus"></i>
      <?php
    }
    if ($_POST["potion3"]){
      echo "Titi";
      ?>
      <div>Créabilis</div>
      <div>135</div>
      <div>Pièces d'or</div>
      <i class="fas fa-trash-alt"></i>
      <i class="fas fa-plus"></i>
      <i class="fas fa-minus"></i>
      <?php
    }
    if ($_POST["potion4"]){
      echo "Titi";
      ?>
      <div>Animalis</div>
      <div>265</div>
      <div>Pièces d'or</div>
      <i class="fas fa-trash-alt"></i>
      <i class="fas fa-plus"></i>
      <i class="fas fa-minus"></i>
      <?php
    }
    if ($_POST["potion5"]){
      echo "Titi";
      ?>
      <div>Merliner</div>
      <div>195</div>
      <div>Pièces d'or</div>
      <i class="fas fa-trash-alt"></i>
      <i class="fas fa-plus"></i>
      <i class="fas fa-minus"></i>
      <?php
    }
    if ($_POST["potion6"]){
      echo "Titi";
      ?>
      <div>Félix Felicis</div>
      <div>245</div>
      <div>Pièces d'or</div>
      <i class="fas fa-trash-alt"></i>
      <i class="fas fa-plus"></i>
      <i class="fas fa-minus"></i>
      <?php
    }
  }

*/
?>


  <form action="commande.php" method="post">
    <input type="text" name="nom" placeholder="Nom & Prénom ..."/>
    <input type="text" name="email" placeholder="Adresse email ..."/>
    <input type="text" name="phone" placeholder="Numéro de téléphone ..."/>
    <input type="text" name="adresse" placeholder="Adresse postale ..."/>
    <input type="submit" value="Valider" />
  </form>



	<?php
}

  include("/parts/pied.php") ?>
</body>

</html>
