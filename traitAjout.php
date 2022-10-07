<?php
	include('Connexion.php');

    $mysqlClient=connex();
    $menu=$_POST["nom"];
    $lien=$_POST["lien"];
    $cheCkBox=$_POST['Check'];
    $insert=ajouter($mysqlClient,$menu,$lien,$cheCkBox);
    header("Location:page.php");
    
?>