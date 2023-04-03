<?php
// Initialisation de l id de session 
session_id('myid');

// Initialiser la session
session_start();
  
// Détruire la session.
session_destroy();
  
// Redirection vers la page de connexion
header("Location: login.php");