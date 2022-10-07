<?php
	include('Connexion.php');

    $mysqlClient=connex();
    $menu=$_POST["nom"];
    $lien=$_POST["lien"];
    $cheCkBox=$_POST['Check'];
    $idMenu=$_GET['idM'];
    $modif=modifier($mysqlClient,$menu,$lien,$cheCkBox,$idMenu);
    
?>