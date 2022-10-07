<?php
	include('Connexion.php');

    $mysqlClient=connex();
    $idMenu=$_GET['idS'];
    $suppr=supprimer($mysqlClient,$idMenu);
    
?>