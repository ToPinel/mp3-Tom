<?php
session_start();
require_once("./inc/fonctions.php");
include("./inc/header.php");
require_once("./inc/pdo.php"); //ne sert à rien déjà appelé dans fonctions.php
// je teste l'existance de données post
$erreur = [];
if (!empty($_POST)) {
    // autre methode pour traiter mes entrées
    /* for($i=0;$i<count($_POST);$i++){
         $_POST[$i] = verifInput("nom", "Vous n'avez pas rempli le champ nom.");
   } */
    $_POST['nom'] = verifInput("nom", "Vous n'avez pas rempli le champ nom.");
    $_POST['prenom'] = verifInput("prenom", "Vous n'avez pas rempli le champ prenom.");
    $_POST['login'] = verifInput("login", "Vous n'avez pas rempli le champ login.");
    $_POST['pwd'] = verifInput("pwd", "Vous n'avez pas rempli le champ pwd.");
    $_POST['pwd2'] = verifInput("pwd2", "Vous n'avez pas rempli le champ pwd2.");
    if ($_POST['pwd'] !== $_POST['pwd2']) {
        $erreur["pwd2"] = "Les 2 passwords ne sont pas identiques";
    }
    $_POST['email'] = verifInput("email", "Vous n'avez pas rempli le champ email.");
    // filter_var cf php.net ????
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $erreur["email"] = "L'adresse email n'est pas valide'";
    }
    $_POST['addr1'] = verifInput("addr1", "Vous n'avez pas rempli le champ addr1.");
    $_POST['addr2'] = trim(strip_tags($_POST["addr2"]));
    $_POST['cp'] = verifNum("cp", "le champ code postal est incorrect", 5);
    $_POST['tel'] = verifNum("tel", "le champ telephone est incorrect", 10);
    $_POST['ville'] = verifInput("ville", "Vous n'avez pas rempli le champ ville.");
    if (selectUserBy("login", $_POST['login'], PDO::PARAM_STR)) {
        $erreur['login'] = "Ce login existe déjà";
    } 
    if (selectUserBy("email", $_POST['email'], PDO::PARAM_STR)) {
        $erreur['email'] = "Cet email est déjà enregitré!";
    }
    var_dump($erreur);
    if (count($erreur) === 0) {

        //$hashPwd = password_hash($_POST['pwd'], PASSWORD_BCRYPT);
        $_POST['pwd'] = password_hash($_POST['pwd'], PASSWORD_ARGON2ID);
        insertUser($_POST);
        // mon utilisateur est bien enregistré
        // je rentre ses informations dans la $_SESSION
        $_SESSION['nom'] = $_POST['nom'];
        $_SESSION['prenom'] = $_POST['prenom'];
        $_SESSION['role'] = "role_user";
    }
}
?>
<div id="formUser">
    <h1>Enregistrez-vous!</h1>
    <form class="formulaire" action="registration.php" method="post">
        <input type="text" name="nom" id="nom" placeholder="Nom"
        <?php
        if(!empty($_POST['nom']) && strlen($_POST['nom'])>0){
            echo "value='".$_POST['nom']."'";
            } ?>
        >
        <?php
            if (array_key_exists('nom', $erreur)) {
                echo "<div class='inputError'>".$erreur['nom']."</div>";
            }
            ?>
        <input type="text" name="prenom" id="prenom" placeholder="Prénom">
        <div class="inputError"></div>
        <input type="text" name="login" id="login" placeholder="Login">
        <div class="inputError"></div>
        <!-- 
            Bonus show hide password jQuery :(
            https://codepen.io/Sohail05/pen/yOpeBm 
        -->
        <input type="text" name="pwd" id="pwd" placeholder="Mot de Pass">
        <div class="inputError"></div>
        <input type="text" name="pwd2" id="pwd2" placeholder="Confirmer le mot de pass">
        <div class="inputError"></div>
        <input type="email" name="email" id="email" placeholder="Email">
        <div class="inputError"></div>
        <input type="text" name="tel" id="tel" placeholder="Téléphone">
        <div class="inputError"></div>
        <input type="text" name="addr1" id="addr1" placeholder="Adresse">
        <div class="inputError"></div>
        <input type="text" name="addr2" id="addr2" placeholder="Complément d'adresse">
        <div class="inputError"></div>
        <input type="text" name="cp" id="cp" placeholder="Code Postal">
        <div class="inputError"></div>
        <input type="text" name="ville" id="ville" placeholder="Ville">
        <div class="inputError"></div>
        <input type="checkbox" name="rgpd" id="rgpd">
        <input type="submit" value="Envoyer">
    </form>
</div>
<?php
include("./inc/footer.php");
?>