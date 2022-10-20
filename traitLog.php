<?php
	include('Connexion.php');

    $mysqlClient=connex();
    $login=$_POST["nom"];
    $password=$_POST["mdp"];
    $profil=$_POST["profil"];
    //echo $profil;
    $seConnecter=toDoLogin($mysqlClient,$login,$password,$profil);
    
?>