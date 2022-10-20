<?php
	include('Connexion.php');

    $mysqlClient=connex();
    $getinsert=$_POST['insert'];
    $menu=$_POST["nom"];
    $lien=$_POST["lien"];
    $cheCkBox=$_POST['Check'];
    $file=$_FILES['photo'];
    /*echo $file['name'];
    var_dump($file['name']);*/
    $insert=testAjouter($mysqlClient,$getinsert,$menu,$lien,$cheCkBox,$file);
    echo($insert);
    /*if($file['name']=='')
    {
        $insert=ajouter($mysqlClient,$menu,$lien,$cheCkBox,$file['name']);
        echo($insert);
    }
    else{
        $insertUp=upload($mysqlClient,$getinsert,$menu,$lien,$cheCkBox,$file);  
        echo($insertUp);
    }*/
    //$insert=ajouter($mysqlClient,$menu,$lien,$cheCkBox,$file['name']);
    //$insertUp=upload($mysqlClient,$getinsert,$menu,$lien,$cheCkBox,$file);
    
?>