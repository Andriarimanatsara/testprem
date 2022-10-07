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
                <ul class="nav pull-right top-menu">
                    <?php if($_SESSION['admin']==0){ ?> 
                        <li><a class="logout" href="login.php">Admin</a></li>
                    <?php } ?>
                </ul>
            </div>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <?php if($_SESSION['admin']!=0){ ?>    
                    <form action="ajout.php" method="POST">    
                        <button type="submit" class="btn btn-primary me-md-2" name="insert" value="2" style="margin-left:-20%">Insertion</button>
                    </form>

                    <form action="deconnecte.php">
                        <button class="btn btn-primary me-md-2" type="submit">Se Deconnecter</button>
                    </form>
                <?php } ?>
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