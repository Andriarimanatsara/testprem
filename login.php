<?php
	include('Connexion.php');
    $mysqlClient=connex();
    $listeProfil=listeProfil($mysqlClient);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>login</title>
    <link rel="stylesheet" href="assets/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/assets/css/Login-Form-Clean.css">
    <link rel="stylesheet" href="assets/assets/css/Login-Form-Dark.css">
    <link rel="stylesheet" href="assets/assets/css/styles.css">
</head>

<body style="color: var(--bs-blue);background: var(--bs-light);">
    <section class="login-clean" style="background: rgb(133,189,241);height: 1000px;border-right-style: none;">
        <form action="traitLog.php" method="post" style="transform: translateY(90px);height: 388px;box-shadow: 1px 1px 9px var(--bs-blue);">
            <div class="input-group mb-3">
                <label class="input-group-text" for="inputGroupSelect01">Options</label>
                <select class="form-select" name="profil" id="inputGroupSelect01">
                    <?php foreach ($listeProfil as $liste) { ?>
                        <option value="<?php echo($liste['description']); ?>"><?php echo($liste['description']); ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="mb-3" style="transform: translateY(20px);box-shadow: 1px 1px 0px var(--bs-blue);">
                <input class="form-control" type="text" name="nom" placeholder="Nom" style="transform: translateY(0px);" required>
            </div>
            <div class="mb-3" style="transform: translateY(70px);box-shadow: 0px 0px var(--bs-blue);">
                <input class="form-control" type="password" name="mdp" placeholder="Mot de passe" style="transform: translateY(0px);border-left-style: none;" required>
            </div>
            <div class="mb-3" style="transform: translateY(100px);">
                <button class="btn btn-primary d-block w-100" type="submit" style="transform: translateY(0px);background: var(--bs-blue);">Se Connecter</button>
            </div>
        </form>
    </section>
    <script src="assets/assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>