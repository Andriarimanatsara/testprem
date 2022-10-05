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
    <section class="contact-clean" style="height: 1000px;">
        <form action="traitAjout.php" method="post">
            <h2 class="text-center">Insérez les données</h2>
            <div class="mb-3"><input class="border rounded shadow-sm form-control" type="text" name="nom" placeholder="Menu">
                <input class="border rounded shadow-sm form-control" type="text" name="lien" placeholder="Lien" style="margin-top: 12px;">
                <p style="margin-top: 5%;"> <b> Admin<input class="form-check-input mt-0" type="checkbox" name="admin" value="admin" aria-label="Checkbox for following text input"></b><b style="float: right;"> Utilisateur<input class="form-check-input mt-0" type="checkbox" name="user" value="user" aria-label="Checkbox for following text input" ></b></p>
                <button type="submit" class="btn btn-primary" >Insertion</button>
            </div>
                
    </section>
    <script src="assets/assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>