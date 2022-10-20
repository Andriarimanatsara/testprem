<?php
	include('Connexion.php');
    $mysqlClient=connex();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>insertion_employe</title>
    <link rel="stylesheet" href="assets/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/assets/css/Contact-Form-Clean.css">
    <link rel="stylesheet" href="assets/assets/css/styles.css">
</head>

<body>
    <?php
        if(isset($_GET["insert"])){
    ?>  
        <section class="contact-clean" style="height: 1000px;">
            <form action="traitAjout.php" method="post" enctype="multipart/form-data">
                <h2 class="text-center">Insérez les données</h2>
                <div class="mb-3"><input class="border rounded shadow-sm form-control" type="text" name="nom" placeholder="Menu" required>
                    <input class="border rounded shadow-sm form-control" type="text" name="lien" placeholder="Lien" style="margin-top: 12px;" required>
                    
                    <input type="hidden" name="insert" value="<?php echo($_GET["insert"]);?>">
                    <!--label for="formFile" class="form-label">Insertion Fichier</label>
                    <input class="form-control" type="file" name="photo" id="formFile" -->
                    <?php /*if(isset($_GET['rep'])){?>
                        <div class="alert alert-danger" role="alert">
                            <?= $_GET['rep']?>
                        </div>
                    <?php }*/ ?>
                    <p style="margin-top: 5%;"> <b> Admin<input class="form-check-input mt-0" type="radio" name="Check" value="1" aria-label="Checkbox for following text input" required></b><b style="float: right;"> Utilisateur<input class="form-check-input mt-0" type="radio" name="Check" value="0" aria-label="Checkbox for following text input" required></b></p>
                    <button type="submit" class="btn btn-primary" >Insertion</button>
                </div>
                    
        </section>
    <?php }else{ 
        $listeWhereId=listeWhereId($mysqlClient,$_GET['idM']);
    ?>
        <section class="contact-clean" style="height: 1000px;">
            <form action="traitModif.php" method="post">
                <h2 class="text-center">Modifier les données</h2>
                <div class="mb-3">
                    <?php foreach($listeWhereId as $liste){?>
                        <input class="border rounded shadow-sm form-control" type="text" name="nom" placeholder="<?php echo($liste["nom"]); ?>" required>
                        <input class="border rounded shadow-sm form-control" type="text" name="lien" placeholder="<?php echo($liste["lien"]); ?>" style="margin-top: 12px;" required>
                        <p style="margin-top: 5%;"> <b> Admin<input class="form-check-input mt-0" type="radio" name="Check" value="1" aria-label="Checkbox for following text input" required></b><b style="float: right;"> Utilisateur<input class="form-check-input mt-0" type="radio" name="Check" value="0" aria-label="Checkbox for following text input" required></b></p>
                        <button type="submit" class="btn btn-primary" name="idMenu" value="<?php echo $_GET['idM']; ?>">Modifier</button>
                    <?php } ?>
                </div>
                    
        </section>
        <?php }?>
    <script src="assets/assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>