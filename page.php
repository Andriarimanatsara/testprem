<?php
	include('Connexion.php');
    //var_dump($_SESSION['admin']);
    
    if(isset($_SESSION['admin'])){
        $listeMenuVue=vueListe($_SESSION['admin']);
    }
    else{
        $session=0;
        $listeMenuVue=vueListe($session);
    }

    $mysqlClient=connex();
    $decriProfil=listeProfil($mysqlClient);
    $listeNameProfile=listeNameProfil($mysqlClient);
    $countArticle=0;

    $descri="";
    foreach($decriProfil as $descriP)
    {
        $decri=$descriP['description'];
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/bootstrap/css/responsive.css">
    <title>Document</title>
</head>
<body style="background-color:dark; overflow:hidden;">
    <section class="categories-slider-area bg__white" style=" background-image:url(assets/img/star-sky.jpg); background-position: center; height: 1000px; width: 100%;color: white;">
        <header class="header black-bg">
            <div class="top-menu">
                <nav class="navbar">
                    <ul class="nav nav-pills">
                        <?php foreach($listeNameProfile as $listeProfil){?>    
                            <li class="nav-item">
                                <a class="nav-link" href="acceuil.php?destination=<?php echo($listeProfil['id']); ?>"><?php echo($listeProfil['nameProfile']); ?>
                                    <?php
                                        $listeCount=countArticle($mysqlClient,$listeProfil['id']); 
                                        foreach($listeCount as $listeC)
                                        { 
                                            $countArticle=$listeC['nonlue'];
                                        }
                                         
                                        if(isset($_SESSION[$decri])==false)
                                        {
                                            if($countArticle>0){
                                                echo('<a style="color:red">'.$countArticle.'</a>');
                                            }
                                        }
                                        if(isset($_SESSION[$decri]) and $_SESSION[$decri]==0)
                                        {
                                            if($countArticle>0){
                                                echo('<a style="color:red">'.$countArticle.'</a>');
                                            }
                                        }
                                    ?>
                                </a>
                            </li>
                        <?php } ?>
                        <!--li class="nav-item">
                            <a class="nav-link" href="acceuil.php?destination=1">Rubrique2</a>
                        </li-->
                        <li class="nav-item">
                            <a class="nav-link" href="#">Rubrique3</a>
                        </li>
                    </ul>
                    <?php if($_SESSION['admin']==0){ ?>    
                        <form class="form-inline" action="login.php">
                            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Admin</button>
                        </form>
                    <?php } ?>
                    <?php if($_SESSION['admin']!=0){ ?>    
                        <form class="form-inline" action="ajout.php" method="GET">    
                            <button type="submit" class="btn btn-outline-primary my-2 my-sm-0" name="insert" value="2" style="margin-left:-20%">Insertion</button>
                        </form>

                        <form class="form-inline" action="deconnecte.php">
                            <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Se Deconnecter</button>
                        </form>
                    <?php } ?>
                </nav>
            </div>
            
        </header>

        <div class="container">
            <div class="row">
                <!-- Start Left Feature -->
                <div class="col-md-9 col-lg-12 col-sm-8 col-xs-12 float-left-style">
                    <!-- Start Slider Area -->
                    <div class="slider__container slider--one" style="margin-top: 80px;margin-left: -50px; min-height: 100%;text-align: center;background-color: rgba(0,0,0,0.6);padding: 50px; color:white;">
                        <h2 style="color:white;">Menu</h2>
                            <hr>
                            <?php foreach($listeMenuVue as $liste){ ?>
                                <form style="border:solid 2px white;width:40%;float:left;min-height: 10%;padding: 10px;margin-left: 10%;">
                                    <h2><?php echo $liste['nom']; ?></h2>
                                    <a href="<?php echo $liste['lien']; ?>">Liens</a>
                                    <?php if($_SESSION['admin']!=0){ ?>
                                        <p><b><a style="color:green;" href="ajout.php?idM=<?php echo $liste['id']; ?>">Modifier</a></b>
                                            <b><a style="color:red;" href="traitSupp.php?idS=<?php echo $liste['id']; ?>">Supprimer</a></b></p>
                                    <?php } ?>
                                </form>
                            <?php } ?>
                            
                    </div>
                </div>
            </div>
        </div>
    </section>    
</body>
</html>