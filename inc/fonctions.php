<?php
require_once("./inc/pdo.php");
////////////////////////////// function de requetes MySQL //////////////////////////////////////
function selectAllVinyles($order)
{
    global $pdo;
    //$order servira à laisser le choix du classsement pour mes utilisateurs
    $rq = "SELECT * FROM vinyles ORDER BY $order";
    $query = $pdo->prepare($rq);
    //$query->bindValue(':order',`$order`,PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetchAll();
    return $result;
}
function selectVinylesForPaginator($order,$index,$limite){
    global $pdo;
    //$order servira à laisser le choix du classsement pour mes utilisateurs
    $rq = "SELECT * FROM vinyles ORDER BY $order LIMIT $index,$limite";
    $query = $pdo->prepare($rq);
    //$query->bindValue(':order',`$order`,PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetchAll();
    
    $rq2 = "SELECT * FROM vinyles ORDER BY $order";
    $query2 = $pdo->prepare($rq2);
    //$query->bindValue(':order',`$order`,PDO::PARAM_STR);
    $query2->execute();
    $nbPage = ceil(count($query2->fetchAll())/4);
    return [$result,$nbPage];
}
function selectVinyleById($id)
{
    global $pdo;
    $rq = "SELECT * FROM vinyles WHERE id=:id";
    $query = $pdo->prepare($rq);
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->execute();
    $result = $query->fetch();
    return $result;
}
function insertUser($tbUser)
{
    global $pdo;
    $rq = "INSERT INTO user(nom,prenom,login,pwd,role,email,addr1,addr2,cp,ville,tel)
            VALUES
            (:nom,:prenom,:login,:pwd,'role_user',:email,:addr1,:addr2,:cp,:ville,:tel)";
    $query = $pdo->prepare($rq);
    $query->bindValue(':nom', $tbUser['nom'], PDO::PARAM_STR);
    $query->bindValue(':prenom', $tbUser['prenom'], PDO::PARAM_STR);
    $query->bindValue(':login', $tbUser['login'], PDO::PARAM_STR);
    $query->bindValue(':pwd', $tbUser['pwd'], PDO::PARAM_STR);
    $query->bindValue(':email', $tbUser['email'], PDO::PARAM_STR);
    $query->bindValue(':addr1', $tbUser['addr1'], PDO::PARAM_STR);
    $query->bindValue(':addr2', $tbUser['addr2'], PDO::PARAM_STR);
    $query->bindValue(':ville', $tbUser['ville'], PDO::PARAM_STR);
    $query->bindValue(':cp', $tbUser['cp'], PDO::PARAM_INT);
    $query->bindValue(':tel', $tbUser['tel'], PDO::PARAM_INT);
    $query->execute();
}
function selectUserBy($field, $value, $type)
{
    global $pdo;
    $rq = "SELECT * FROM user WHERE " . $field . "=:" . $field;
    $query = $pdo->prepare($rq);
    $query->bindValue(':' . $field, $value, $type);
    $query->execute();
    $result = $query->fetch();
    return $result;
}
function selectUserForLogin($login, $pwd)
{
    global $pdo;
    var_dump($login, $pwd);
    $rq = "SELECT * FROM user WHERE login = :login";
    $query = $pdo->prepare($rq);
    $query->bindValue(':login', $login, PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetch();
    if ($result) {
        if (password_verify($pwd, $result['pwd'])) {
            return $result;
        } else {
            $result = [];
            echo "pwd incorrect";
        }
    } else {
        $result = [];
        echo "login incorrect";
    }
}

//////////////////////////////// function courrantes /////////////////////////////

function protectUrl($role)
{
    switch ($role) {
        case 'role_admin':
            if (!empty($_SESSION['role'])) {
                if ($_SESSION['role'] !== $role) {
                    header("Location:index.php");
                    die;
                }
            } else {
                header("Location:index.php");
                die;
            }
            break;
        case 'role_user':
            if (empty($_SESSION['role'])) {
                header("Location:index.php");
                die;
            }
            break;
        default:
            # code...
            break;
    }
}

function verifInput($input, $txtErreur)
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
}
function verifNum($input, $txtErreur, $nb)
{
    // pour pouvoir utiliser mon tableau d'erreur à l'interieur de ma fonction
    // je le déclare en global
    global $erreur;
    // mon patern ne comprendra que des chiffres de 0 à 9 et $nb caractères
    $patern = "#[0-9]{" . $nb . "}#";
    if (preg_match($patern, $_POST[$input])) {
        // je m'assure que la valeur renvoyée sera bien int pour ma requete avec intval
        return intval($_POST[$input]); // ici 0235000000 devient 235000000
    } else {
        // j'ajoute une nouvelle erreur à mon tableau en cas de champ vide
        $erreur[$input] = $txtErreur;
    }
}
