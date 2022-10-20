<?php
    include('Connexion.php');
    //include('traitSearch.php');

    $mysqlClient=connex();
    //var_dump($_SESSION['admin2']);
    $listeNameProfil=listeNameProfil($mysqlClient);
    $listeArticle=listeArticle($mysqlClient);
    if(isset($_SESSION['admin2'])){
        $vue=$_SESSION['admin2'];
    }
    else{
        $vue=0;
        $updateStatut=updateStatut($mysqlClient,$_GET['destination']);
    }

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
<html>
    <head>
        <title>Document</title>
        <meta charset="UTF-12"> 
		<link rel="stylesheet" type="text/css" href="assets/css/styletpm2.css">
		<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    	<link rel="stylesheet" href="assets/bootstrap/css/responsive.css">
	</head>
	<body>
		<div id="page">
            <nav class="navbar navbar-dark bg-dark">
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
                        <a class="nav-link" href="#">Rubrique3</a>
                    </li-->
                    <?php if($vue==0){ ?>    
                        <form class="form-inline" action="login.php">
                            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Admin2</button>
                        </form>
                    <?php } ?>
                </ul>
                <?php if($vue==0){ ?>
                    <form class="d-flex" action="acceuil.php?destination=search" method="POST">
                        <input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                <?php } ?>
                <?php if($vue!=0){ ?>    
                    <form class="form-inline" action="deconnecte.php">
                        <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Se Deconnecter</button>
                    </form>
                <?php } ?>
            </nav>    
            <div id="content">
                <?php if($vue!=0){ ?>
                    <div id="content1">
                        <h3 class="titre">Poster quelques choses </h3>
                        <form action="traitAcceuil.php" method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Titre Article</label>
                                <input type="text" name="titre" class="form-control" placeholder="Titre" required>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Article</label>
                                <textarea class="form-control"  name="article" id="exampleFormControlTextarea1" rows="3" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Fichier</label>
                                <input class="form-control" type="file" name="photo" id="formFile">
                                <?php if(isset($_GET['rep'])){?>
                                    <div class="alert alert-danger" role="alert">
                                        <?= $_GET['rep']?>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="input-group mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Destination</label>
                                <select class="form-select" name="profil" id="inputGroupSelect01">
                                    <?php foreach ($listeNameProfil as $liste) { ?>
                                        <option value="<?php echo($liste['id']); ?>"><?php echo($liste['nameProfile']); ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <button class="btn btn-primary me-md-2" type="submit">Inserer</button>
                        </form>
                    </div>
                <?php } ?>
                </br>
                <?php for ($i=0; $i <count($listeArticle) ; $i++) {
                    if($_GET['destination']==$listeArticle[$i]['idProfile']){ ?>
                    <div id="content1">
                        <?php $balise=msplit($listeArticle[$i]['fichier']); ?>
                        <h3 class="titre">Publication <?php echo($listeArticle[$i]['titre']);?></h3>
                        <p><?php echo($listeArticle[$i]['article']);?></p>
                        <p><?php echo($balise);?></p>  
                    </div>
                    </br>
                <?php } }
                        $destination=$_GET['destination']; 
                        if(isset($_POST['search'])){
                        $mot=$_POST['search'];
                        $listeSearch=testSearch($mysqlClient,$destination,$mot);
                        for ($i=0; $i <count($listeSearch) ; $i++) {    
                    ?>
                    <div id="content1">
                        <?php $balise=msplit($listeSearch[$i]['fichier']); ?>
                        <h3 class="titre">Publication <?php echo($listeSearch[$i]['titre']);?></h3>
                        <p><?php echo($listeSearch[$i]['article']);?></p>
                        <p><?php echo($balise);?></p> 
                    </div>
                    </br>
                <?php } } ?>    
            </div>
		</div>
	</body>
</html>