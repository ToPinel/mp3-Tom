<?php
session_start();


require_once("./inc/fonctions.php");
include("./inc/header.php");
$order = "title";
if (!empty($_GET['order'])) {
    $order = $_GET['order'];
}
$limite = 4;
$index = 0;
if(!empty($_GET['page'])){
    $index = $_GET['page']*4;
}
$tbVinyle = selectVinylesForPaginator($order,$index,$limite);
$vinyles = $tbVinyle[0];
$nbPage = $tbVinyle[1];
//$vinyles = selectAllVinyles($order);
?>

<div id="slider"></div>
<div id="subMenu">
    <label for="order">Trier les vinyles</label>
    <select name="order" id="order">
        <option value="title" <?php if ($order === "title") echo "selected"; ?>>Titre</option>
        <option value="artiste" <?php if ($order === "artiste") echo "selected"; ?>>Artistes</option>
        <option value="genre" <?php if ($order === "genre") echo "selected"; ?>>Genres</option>
    </select>
</div>
<section id="articles">
    <?php
    for ($i = 0; $i < count($vinyles); $i++) {
    ?>
        <div class="card mb-3" style="width: 18rem;">
            <img class="card-img-top" src="./assets/cover/<?= $vinyles[$i]['cover_img'] ?>" alt="<?= $vinyles[$i]['title'] . " - " . $vinyles[$i]['artiste'] ?>">
            <div class="card-body">
                <h5 class="card-title"><?= $vinyles[$i]['title'] ?></h5>
                <p class="card-text"><?= $vinyles[$i]['artiste'] ?></p>
                <p class="card-text"><?= $vinyles[$i]['genre'] ?></p>
                <?php if (!empty($_SESSION['role'])) { ?>
                    <a href="single.php?id=<?= $vinyles[$i]['id'] ?>" class="btn btn-primary">Plus d'infos...</a>
                <?php } else { ?>
                    <a href="registration.php" class="btn btn-primary">Inscrivez-vous!</a>
                <?php } ?>
            </div>
        </div>
    <?php
    }
    ?>
<nav aria-label="Page navigation" style="width:100vw;display:flex;justify-content:center;">
        <ul class="pagination">
            <!-- <li class="page-item"><a class="page-link" href="#">Previous</a></li> -->
            <?php for($i = 0 ; $i<$nbPage;$i++){ ?>
                <li class="page-item"><a class="page-link" href="?page=<?= $i ?>"><?= $i+1 ?></a></li>
            <?php } ?>
            <!-- <li class="page-item"><a class="page-link" href="#">Next</a></li> -->
        </ul>
</nav>    
</section>


<?php
include("./inc/footer.php");
?>
<script src='./assets/js/carouselMultiEffets.js'></script>
<script src="./assets/js/order.js"></script>