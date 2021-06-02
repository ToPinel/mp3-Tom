<?php
session_start();
require_once("./inc/fonctions.php");
// protection contre un direct via l'url de la page
protectUrl("role_user");
if (!empty($_GET['id']) && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $vinyle = selectVinyleById($id);
} else {
    header("Location:index.php");
}

include("./inc/header.php");
?>
<section id="single">

    <div class="jumbotron w-50">
        <img src="./assets/cover/<?= $vinyle['cover_img'] ?>" alt="" class="img-fluid">
        <h1 class="display-4"><?= $vinyle['title'] ?></h1>
        <p class="lead"><?= $vinyle['artiste'] ?></p>
        <p class="lead text-muted text-right font-italic"><?= $vinyle['genre'] ?></p>
        <p class="lead"><?= $vinyle['annee'] ?></p>
        <hr class="my-4">
        <p><?= $vinyle['description'] ?></p>
        <p class="lead">
            <a class="btn btn-primary btn-lg" href="#" role="button">Mettre dans le panier</a>
        </p>
    </div>
    <script>
        // tableau d'informations pour chaque fichier audio 
        const tbPlaylist = [{
            mp3: "<?= $vinyle['mp3'] ?>",
            cover: "<?= $vinyle['cover_img'] ?>",
            title: "<?= $vinyle['title'] ?>",
            artiste: "<?= $vinyle['artiste'] ?>",
            genre: "<?= $vinyle['genre'] ?>",
            annee: "<?= $vinyle['annee'] ?>",
            desc: "<?= preg_replace("# {2,}#"," ",preg_replace("#(\r\n|\n\r|\n|\r|\")#"," ",$vinyle['description'])) ?>"
        }];
        console.dir(tbPlaylist);

    </script>

    <?php include("./inc/lecteur.php"); ?>
</section>


<?php
include("./inc/footer.php");
?>
<script src="./assets/js/player.js"></script>