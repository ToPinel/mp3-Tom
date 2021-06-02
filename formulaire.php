<?php
session_start();
require_once("./inc/fonctions.php");
// protection contre un direct via l'url de la page
protectUrl("role_admin");
include("./inc/header.php");
?>

    <!-- form>(input*5+select>(option)) -->
    <div id="formmp3">
        <h1>Uploadez vos mp3</h1>
        <div id="success"></div>
        <form class="formulaire" action="./validator.php" method="post" enctype="multipart/form-data" name="uploadMP3">
            <label for="mp3">MP3</label>
            <input type="file" name="mp3" id="mp3">
            <label for="coverImg">Cover</label>
            <input type="file" name="coverImg" id="coverImg">
            <input type="text" name="title" placeholder="Titre" id="title">
            <input type="text" name="artiste" placeholder="Artiste" id="artiste">
            <input type="text" name="genre" placeholder="Genre" id="genre">
            <select name="annee" id="annee">
                <option value="" disabled selected>Choisissez l'année</option>
                <?php
                $i = 1930;
                while($i >= 1930 && $i <= 2021) {
                    echo "<option value=$i>$i</option>";
                    $i++;
                }
                ?>
            </select>
            <textarea name="description" placeholder="Description" id="description"></textarea>
            <input type="submit" value="Envoyer" name="submit">
        </form>
    </div>
    <script src="./assets/js/formulaireSend.js"></script>
<?php
include("./inc/footer.php");