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
    function toDoLogin($mysqlClient,$login,$pasword)
    { 

        $sqlQuery = 'SELECT * FROM Admin';
        $recipesStatement = $mysqlClient->prepare($sqlQuery);
        $recipesStatement->execute();
        $recipes = $recipesStatement->fetchAll();
        $valiny=0;
        for($i=0;$i<count($recipes);$i++)
        {
            if($recipes[$i]['login']==$login && $recipes[$i]['pasword']==sha1($pasword))
            {
                
                $_SESSION['admin']=$recipes[$i]['id'];
                header("Location:page.php");
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
    function ajouter($mysqlClient,$nom,$lien,$admin)
    {
        $mysqlClient=connex();
        $sql = "INSERT INTO Menu (nom,lien,admin) values ('".$nom."','".$lien."',".$admin.")";
        $recipesStatement = $mysqlClient->prepare($sql);
        $recipesStatement->execute();
    }
    function modifier($mysqlClient,$nom,$lien,$admin,$idMenu)
    {
        $mysqlClient=connex();
        $sql = "UPDATE Menu SET nom='".$nom."',lien='".$lien."',admin=".$admin." Where id=".$idMenu.")";
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
    function deconnecte()
    {
        session_destroy();
        header("Location:page.php");
    }


?>