<?php 
	require 'base.php';

	if(isset($_POST) && !empty($_POST['identifier1']) && !empty($_POST['password1'])) {
	  extract($_POST);
	  // on recupère le mot de passe de la table qui correspond à l'identifiant du visiteur
	  $sql = "SELECT password FROM users WHERE email='".$identifier1."'";
	  $req = $bdd->query($sql);
	  $data = $req ->fetch();

	  if(sha1($password1)!=$data['password']) {
	  	header('connexion.php'); // On renvoie sur la page de connexion pour que le visiteur retente sa connection
		exit;
	  }
	  else {
	    $_SESSION['identifiant'] = $_POST['identifier1'];
	    $_SESSION['mdp'] = $_POST['password1'];
	    global $connection;
		$sql = "SELECT id FROM users WHERE email = '".$_SESSION['identifiant']."'";
		$req = $connection -> query($sql);
		$data = $req -> fetch();
		$_SESSION['id'] = $data['id']; //connection test
	    //On récupère l'identifiant et le mdp dans des variables SUPERGLOBALES
	   
	    header('location: index.php'); 
	    exit;
	    // redirection towards account.php
	  }    
	}
	else {
	  header('location: connexion.php');
	   //Renvoie à la page de connexion si rien n'a été entré 
	}
