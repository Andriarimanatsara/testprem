<?php
    session_start();

    function connex(){
        try{
            $mysqlClient = new PDO('mysql:host=localhost;dbname=Stageprem;charset=utf8', 'root','root');
        }
        catch(Exception $e){
                die('Erreur : '.$e->getMessage());
        }
        return $mysqlClient;
    }
    function listeMenu($mysqlClient){
        $sqlQuery = 'SELECT * FROM Menu';
        $recipesStatement = $mysqlClient->prepare($sqlQuery);
        $recipesStatement->execute();
        $recipes = $recipesStatement->fetchAll();
        return $recipes;
    }
    function listeProfil($mysqlClient){/*////*/
        $sqlQuery = 'SELECT description FROM Admin';
        $recipesStatement = $mysqlClient->prepare($sqlQuery);
        $recipesStatement->execute();
        $recipes = $recipesStatement->fetchAll();
        return $recipes;
    }
    function listeNameProfil($mysqlClient){/*////*/
        $sqlQuery = 'SELECT * FROM Profil';
        $recipesStatement = $mysqlClient->prepare($sqlQuery);
        $recipesStatement->execute();
        $recipes = $recipesStatement->fetchAll();
        return $recipes;
    }/*////*/
    function listeArticle($mysqlClient){/*////*/
        $sqlQuery = 'SELECT Actualite.id,titre,article,fichier,Profil.id as idProfile,nameProfile FROM Actualite join Profil on Actualite.destination=Profil.id  order by Actualite.id desc';
        $recipesStatement = $mysqlClient->prepare($sqlQuery);
        $recipesStatement->execute();
        $recipes = $recipesStatement->fetchAll();
        return $recipes;
    }
    function countArticle($mysqlClient,$destination){/*////*/
        $sqlQuery = 'SELECT count(*) as nonlue FROM Actualite where destination='.$destination.' and statut=0';
        $recipesStatement = $mysqlClient->prepare($sqlQuery);
        $recipesStatement->execute();
        $recipes = $recipesStatement->fetchAll();
        return $recipes;
    }
    function updateStatut($mysqlClient,$destination){/*////*/
        $sqlQuery = 'UPDATE Actualite SET statut=1 where destination='.$destination.' and statut=0';
        $recipesStatement = $mysqlClient->prepare($sqlQuery);
        $recipesStatement->execute();
    }
    function msplit($rep){
        $valiny="";
        $tab=array(); 
        //$rep=$liste[$i]['fichier'];
        $tab=explode('.png',str_replace(array('.png','.jpg'),'.png',$rep));
        $tab2=explode(".mp4",$rep);
        if(count($tab)>1)
        {
            $valiny='<img src="'.$rep.'" width="320" height="240">';
        }
        if(count($tab2)>1)
        {
            $valiny='<video width="320" height="240" controls><source src="'.$rep.'" type=video/mp4></video>';
        }
        return $valiny;
    }/*////*/
    function toDoLogin($mysqlClient,$login,$pasword,$description)/*////*/
    { 

        $sqlQuery = "SELECT * FROM Admin where description='".$description."'";    /*////*/
        $recipesStatement = $mysqlClient->prepare($sqlQuery);
        $recipesStatement->execute();
        $recipes = $recipesStatement->fetchAll();
        $valiny=0;
        $session="";/*////*/
        for($i=0;$i<count($recipes);$i++)
        {
            if($recipes[$i]['login']==$login && $recipes[$i]['pasword']==sha1($pasword))
            {
                $session=$recipes[$i]['description'];   /*////*/
                $_SESSION[$session]=$recipes[$i]['id']; /*////*/
                if($description=="admin")               /*////*/
                {
                    header("Location:page.php");
                }
                else{                                   /*////*/
                    header("Location:acceuil.php?destination=1");
                }
            }
            else{
                header("Location:login.php");
            }
        }
    }
    function listeMenuWhere($mysqlClient){
        $sqlQuery = 'SELECT * FROM Menu where admin=0';
        $recipesStatement = $mysqlClient->prepare($sqlQuery);
        $recipesStatement->execute();
        $recipes = $recipesStatement->fetchAll();
        return $recipes;
    }
    function vueListe($session)
    {

        $mysqlClient=connex();
        if($session==0)    //user
        {
            $_SESSION['admin']=0;
            $session=$_SESSION['admin'];
            $rep=listeMenuWhere($mysqlClient);
        }
        if($session>0)    //admin
        {
            $rep=listeMenu($mysqlClient);
        }
        
        return $rep;
    }
    function listeWhereId($mysqlClient,$idGet){
        $sqlQuery = 'SELECT * FROM Menu where id='.$idGet;
        $recipesStatement = $mysqlClient->prepare($sqlQuery);
        $recipesStatement->execute();
        $recipes = $recipesStatement->fetchAll();
        return $recipes;
    }
    function modifier($mysqlClient,$nom,$lien,$admin,$idMenu)
    {
        $mysqlClient=connex();
        $sql="";
        if($nom!="" and $lien!="" and $admin!="")
        {
            $sql = "UPDATE Menu SET nom='".$nom."',lien='".$lien."',admin=".$admin." Where id=".$idMenu.")";
        }
        $recipesStatement = $mysqlClient->prepare($sql);
        $recipesStatement->execute();
        header("Location:page.php");
    }
    function supprimer($mysqlClient,$idMenu)
    {
        $mysqlClient=connex();
        $sql = "DELETE FROM Menu WHERE id=".$idMenu;
        $recipesStatement = $mysqlClient->prepare($sql);
        $recipesStatement->execute();
        header("Location:page.php");
    }
    function testUpload($file)
    {
        $rep="";
        $dossier="upload";
        $chemin = $dossier."/".basename($file['name']);
        $extension_list = array('jpg','png','gif','jpeg');
        $check= getimagesize($file["tmp_name"]);
        
        if($check==true){
            $arr_file = explode('.', $file['name']);
            if(in_array(strtolower($arr_file[1]),$extension_list)){
                if (!file_exists($dossier)) {
                    mkdir($dossier, 0777, true);
                    if (move_uploaded_file($file["tmp_name"], $chemin)) {
                        $rep=$dossier;
                    } else {
                        $rep="Sorry, there was an error uploading your file.";
                    }
                }else{
                    if (move_uploaded_file($file["tmp_name"], $chemin)) {
                        $rep=$dossier;
                    } else {
                        $rep="Sorry, there was an error uploading your file.";
                    }
                }
            }
            else{
                $rep="Veuillez_choisir_une_image";
            }
        }
        else{
            $rep="Veuillez_choisir_entre_ces_listes_extension: ".implode(" ",$extension_list);
        }
        return $rep;
        //return $ins;
    }
    function testAjouter($mysqlClient,$getinsert,$nom,$lien,$admin,$file)
    {
        $mysqlClient=connex();
        $testUpl="";
        $sql="";
        $extension_list = array('jpg','png','gif','jpeg');
        if($file['name']!='')
        {
            $testUpl=testUpload($file);
            if($testUpl=="upload")
            {
                $sql = "INSERT INTO Menu (nom,lien,admin,$file) values ('".$nom."','".$lien."',".$admin.",'".$testUpl."/".$file['name']."')";
                //header("Location:page.php");
            }
            else if($testUpl=="Sorry, there was an error uploading your file.") 
            {
                $sql="sorry";
                //header("Location:ajout.php?insert=".$getinsert."&rep=".$testUpl);
            }
            else if($testUpl=="Veuillez_choisir_une_image") 
            {
                $sql="image";
                //header("Location:ajout.php?insert=".$getinsert."&rep=".$testUpl);
            }
            else if($testUpl=="Veuillez_choisir_entre_ces_listes_extension: ".implode(" ",$extension_list)) 
            {
                $sql="liste_extension";
                //header("Location:ajout.php?insert=".$getinsert."&rep=".$testUpl);
            }
        }
        if($file['name']=='')
        {
            $sql = "INSERT INTO Menu (nom,lien,admin,file) values ('".$nom."','".$lien."',".$admin.",'".$testUpl."/".$file['name']."')";
        }
        /*$recipesStatement = $mysqlClient->prepare($sql);
        $recipesStatement->execute();*/
        return $sql;
    }
    function testAjouter2($mysqlClient,$titre,$article,$file,$profil)
    {
        $mysqlClient=connex();
        $testUpl="";
        $sql="";
        $extension_list = array('jpg','png','gif','jpeg');
        if($file['name']!='')
        {
            $testUpl=testUpload($file);
            if($testUpl=="upload")
            {
                $sql = "INSERT INTO Actualite(titre,article,fichier,destination)VALUES('".$titre."','".$article."','".$testUpl."/".$file['name']."',".$profil.")";
                header("Location:acceuil.php?destination=".$profil);
            }
            if($testUpl=="Sorry, there was an error uploading your file.") 
            {
                $sql="sorry";
                header("Location:ajout.php?destination=".$profil."&rep=".$testUpl);
            }
            if($testUpl=="Veuillez_choisir_une_image") 
            {
                $sql="image";
                header("Location:ajout.php?destination=".$profil."&rep=".$testUpl);
            }
            if($testUpl=="Veuillez_choisir_entre_ces_listes_extension: ".implode(" ",$extension_list)) 
            {
                $sql="liste_extension";
                header("Location:acceuil.php?destination=".$profil."&rep=".$testUpl);
            }
        }
        if($file['name']=='')
        {
            $sql = "INSERT INTO Actualite(titre,article,fichier,destination)VALUES('".$titre."','".$article."','".$testUpl."/".$file['name']."',".$profil.")";
            header("Location:acceuil.php?destination=".$profil);
        }
        $recipesStatement = $mysqlClient->prepare($sql);
        $recipesStatement->execute();
        //return $sql;
    }
    function testSearch($mysqlClient,$destination,$mot)
    {
        $mysqlClient=connex();
        $sql = "SELECT * FROM Actualite WHERE destination=".$destination." and titre LIKE '%".$mot."%'";
        $recipesStatement = $mysqlClient->prepare($sql);
        $recipesStatement->execute();
        $recipes = $recipesStatement->fetchAll();
        return $recipes;
        //header("Location:acceuil.php?destination=search");
    }


    function deconnecte()
    {
        session_destroy();
        header("Location:page.php");
    }


?>