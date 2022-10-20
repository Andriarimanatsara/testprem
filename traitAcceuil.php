<?php
    include('Connexion.php');
    $mysqlClient=connex();
    
    $titre=$_POST['titre'];
    $article=$_POST['article'];
    $file=$_FILES['photo'];
    $profil=$_POST['profil'];

    //echo($profil);
    $insert=testAjouter2($mysqlClient,$titre,$article,$file,$profil);
    //echo($insert);

?>