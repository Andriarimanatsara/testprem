<?php 
//connect.php;
//$connect = mysqli_connect("localhost", "root", "root", "testing");

function connex(){
    try{
        $mysqlClient = new PDO('mysql:host=localhost;dbname=testing;charset=utf8', 'root','root');
    }
    catch(Exception $e){
            die('Erreur : '.$e->getMessage());
    }
    return $mysqlClient;
}
?>