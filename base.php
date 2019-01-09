<?php
  // URL of the host
  $dbhost = "localhost"; 
  
  // Name of the database
  $dbname = "aromamix";
  
  // User name
  $dbuser = "root";
  
  // Password (not used here)
  $dbpass = "";
 
  try {
    $connection = new PDO('mysql:host='.$dbhost.';dbname='.$dbname, $dbuser, $dbpass);
  } catch(PDOException $e) {
    echo $e->getMessage();
  }




  /* checks if user is connected */
  session_start();

  /* ==============================

  session variables -
  email : contains user email
  pass : contains user password 
  fisrtname, lastname

  ============================== */


  /* checks if user exists */
  if (!empty($_SESSION['identifiant']) && !empty($_SESSION['mdp'])) {
    // this boolean variable will tell if the user is connected or just a visitor
    $connect = true;
	//rajouter condition pour afficher toute les données sessions de l'utilisateur ; id, firstname
  }else{
    $connect = false;
  }
?>