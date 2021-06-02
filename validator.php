<?php
session_start();
// Pour executer des requetes mysql j'ai besoin dans ce fichier d'appeler ma connexion à la bdd
require_once("./inc/fonctions.php");
protectUrl("role_admin");
require_once("./vendor/autoload.php");
use Gumlet\ImageResize;
//phpinfo(); permet de connaitre les spec du serveur ex:taille maximal des fichiers uploadés
$erreur = [];
// $_FILES permet de stocker les fichiers uploadés (input type="file")
// $_POST permet de stocker toutes les autres formes de données
// envoyées par un formulaire (method="post")
if (!empty($_POST)) {
    // Gestion des données du POST
    // la fonction verifInput va être partagée entre plusieurs formulaires : DRY!!!!
    // je la partage sur fonctions.php
    /* function verifInput($input, $txtErreur)
    {
        // pour pouvoir utiliser mon tableau d'erreur à l'interieur de ma fonction
        // je le déclare en global
        global $erreur;
        // strlen me permet de verifier que ma chaine $input (string)
        // contient bien au moins 1 caractère
        if (strlen($_POST[$input]) > 0) {
            // trim() supprime tous les caractères invisibles de ma chaine
            return trim(strip_tags($_POST[$input]));
        } else {
            // j'ajoute une nouvelle erreur à mon tableau en cas de champ vide
            $erreur[$input] = $txtErreur;
        }
    } */
    $title = verifInput("title", "Le champ titre est vide");
    $artiste = verifInput("artiste", "Le champ artiste est vide");
    $genre = verifInput("genre", "Le champ genre est vide");
    // is_int() me permet de determiner si ma var est bien de type int
    
    if (!empty($_POST["annee"])) {
        $annee = trim(strip_tags($_POST["annee"]));
        //intval() transforme notre variable $annee jusqu'ici en string vers de l'int
        $annee = intval($annee); 
    }
    if (!empty($_POST["description"])) {
        $description = trim(strip_tags($_POST["description"]));
    }
    // Gestion des données files
    if ($_FILES['mp3']['size'] > 0 && $_FILES['mp3']['error'] === 0) {
        if ($_FILES['mp3']['type'] === 'audio/mpeg') {
            $mp3 = $_FILES['mp3']['tmp_name'];
        } else {
            $erreur['mp3'] = "Le fichier mp3 n'est pas au bon format.";
        }
    } else {
        $erreur['mp3'] = "Le champ mp3 est vide";
    }
    if ($_FILES['coverImg']['size'] > 0 && $_FILES['coverImg']['error'] === 0) {
        if ($_FILES['coverImg']['type'] === 'image/jpeg' || $_FILES['coverImg']['type'] === 'image/jpg' || $_FILES['coverImg']['type'] === 'image/gif' || $_FILES['coverImg']['type'] === 'image/png' || $_FILES['coverImg']['type'] === 'image/webp') {
            $coverImg = $_FILES['coverImg']['tmp_name'];
        } else {
            $erreur['coverImg'] =  "Le fichier coverImg n'est pas au bon format.";
        }
    } else {
        $erreur['coverImg'] = "Le champ coverImg est vide";
    }
    // je vérifie que mon tableau d'erreur soit vide 
    if (count($erreur) === 0) {
        $mp3Name = $_FILES['mp3']['name'];
        $coverImgName =  $_FILES['coverImg']['name'];
        // insertion en base
        $rq = "SELECT id FROM vinyles WHERE mp3 = :mp3Name";
        $query = $pdo->prepare($rq);
        $query->bindValue(':mp3Name', $mp3Name, PDO::PARAM_STR);
        $query->execute();
        $result = $query->fetch();
        
        if(!$result){
            $rq = "INSERT INTO vinyles(mp3,cover_img,title,artiste,genre,annee,description)
            VALUES
            (:mp3Name,:coverImg,:title,:artiste,:genre,:annee,:description)";
            $query = $pdo->prepare($rq);
            $query->bindValue(':mp3Name', $mp3Name, PDO::PARAM_STR);
            $query->bindValue(':coverImg', $coverImgName, PDO::PARAM_STR);
            $query->bindValue(':title', $title, PDO::PARAM_STR);
            $query->bindValue(':artiste', $artiste, PDO::PARAM_STR);
            $query->bindValue(':genre', $genre, PDO::PARAM_STR); 
            $query->bindValue(':annee', $annee, PDO::PARAM_INT);
            $query->bindValue(':description', $description, PDO::PARAM_STR);
            $query->execute();
            // j'upload mes fichier
            move_uploaded_file($mp3, "./assets/audio/" . $_FILES['mp3']['name']);
            move_uploaded_file($coverImg, "./assets/cover/" . $_FILES['coverImg']['name']);
            $newImg = new ImageResize("./assets/cover/" . $_FILES['coverImg']['name']);
            $newImg->resizeToWidth(400);
            $newImg->save("./assets/cover/" . $_FILES['coverImg']['name']);
            //message sympathique
            $erreur['success'] = "Votre titre a bien été enregistré !";
            $erreur = json_encode($erreur);
            echo $erreur;
            //header("Location:./formulaire.php");
        } else {
            $erreur['mp3'] = "Ce titre existe déjà";
            // erreur utilisateur
            $erreur = json_encode($erreur);
            echo $erreur;
            //$erreur = serialize($erreur);
            //header("Location:./formulaire.php?er=$erreur");
        }


    } else {
        // erreur utilisateur
        $erreur = json_encode($erreur);
        echo $erreur;
        //$erreur = serialize($erreur);
        //header("Location:./formulaire.php?er=$erreur");
    }
    
}
