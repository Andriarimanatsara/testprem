<?php
	include('Connexion.php');

    $mysqlClient=connex();
    $login=$_POST["nom"];
    $password=$_POST["mdp"];
    $seConnecter=toDoLogin($mysqlClient,$login,$password);
    //echo $seConnecter;
    
?>