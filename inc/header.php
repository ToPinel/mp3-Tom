<?php
if (!empty($_GET['themeSwitch'])){
    /* $_GET['themeSwitch'] = boolval($_GET['themeSwitch']);
    var_dump($_GET['themeSwitch']); */
    $_SESSION['themeSwitch'] = $_GET['themeSwitch'];
}

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VinylShop</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous"></script>
    <script src="./assets/js/jquery.color.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
    <?php if(!empty($_SESSION['themeSwitch']) && $_SESSION['themeSwitch']==="false"){ ?>
        <link rel="stylesheet" id="linkTheme" href="./assets/css/light.min.css">
    <?php } else { ?>
        <link rel="stylesheet" id="linkTheme" href="./assets/css/dark.min.css">
    <?php } ?>
    <link rel="stylesheet" href="./assets/css/style.css">
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                <a class="navbar-brand" href="#">VinylShop</a>
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>

                    <?php if (!empty($_SESSION['role']) && $_SESSION['role'] === "role_admin") { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="formulaire.php">Formulaire</a>
                    </li>
                    <?php } ?>
                    
                    <?php if (!empty($_SESSION['role'])) { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                    <?php } ?>

                    <?php if (empty($_SESSION['role'])) { ?>

                    <li class="nav-item">
                        <a class="nav-link" href="registration.php">Inscription</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>
                    <?php } ?>

                </ul>
                <i class="fas fa-sun text-light mr-2"></i>
                <div class="custom-control custom-switch text-light d-inline">
                    <input type="checkbox" class="custom-control-input" id="themeSwitch" <?php if(isset($_GET['themeSwitch']) && $_GET['themeSwitch']==="true"){echo 'checked="true"';} ?>>
                    <label class="custom-control-label" for="themeSwitch"> <i class="fas fa-moon mr-2"></i></label>
                </div>

                <form class="form-inline my-2 my-lg-0 autoComp">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" id="recherche">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                    <div class="divAutoComp"></div>
                </form>
            </div>
        </nav>
        <?php if (!empty($_SESSION['prenom'])) { ?>
            <div>Bonjour <?= $_SESSION['prenom'] . " " . $_SESSION['nom'] ?></div>
        <?php } else { ?>
            <div>Vous n'êtes pas enregistrés.</div>
        <?php } ?>
        <script src="./assets/js/themeSwitch.js"></script>
        <script src="./assets/js/autocomplete.js"></script>
    </header>
    <main>