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
        

        $_SESSION['admin']=0;

        $mysqlClient=connex();
        if($session==0)    //comparaison string
        {
            //$rep="urL";
            $rep=listeMenuWhere($mysqlClient);
        }
        if($session>0)    //comparaison string
        {
            //$rep="urlVar";
            $rep=listeMenu($mysqlClient);
        }
        
        return $rep;
    }

    function ajouter($mysqlClient,$nom,$lien,$admin)
    {
        $mysqlClient=connex();
        $data = ( array(
                        'nom' => $nom,
                        'lien' => $lien,
                        'admin' => $admin
                    )
        );
        $sql = "INSERT INTO Ajouter(daty,idCategorie,titre,resume,contenu,url) values (:daty,:idCategorie,:titre,:resume,:contenu,:url)";
        $recipesStatement = $mysqlClient->prepare($sql);
        $recipesStatement->execute($data);
    }


?>