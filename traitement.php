<?php
include_once("commun/inc.php");
session_start();
// Initialisation des variables
$pseudo = isset($_POST["pseudo"]) ? $_POST["pseudo"] : "";
$email = isset($_POST["email"]) ? $_POST["email"] : "";
$password = isset($_POST["password"]) ? $_POST["password"] : "";


$erreurs = [];
// Vérification du pseudo
if (!preg_match("/^[A-Za-z0-9\x{00c0}-\x{00ff}]{5,250}$/u", $pseudo)) {
    $erreurs["pseudo"] = "Le format du pseudo est invalide";
}
// Vérification de l'email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $erreurs["email"] = "L'email n'est pas valide";
}
// Vérification du mot de passe
if (!preg_match("/^[A-Za-z0-9_$]{8,}$/", $password)) {
    $erreurs["password"] = "Le format du mot de passe n'est pas valide";
}

// Protection XSS
$pseudo = htmlspecialchars($pseudo);
$email = htmlspecialchars($email);

if (count($erreurs) > 0) {
    $_SESSION["donnees"]["pseudo"] = $pseudo;
    $_SESSION["donnees"]["email"] = $email;
    $_SESSION["donnees"]["password"] = $password;
    $_SESSION["erreurs"] = $erreurs;
    echo "Désolé, les champs ne sont pas corrects";
    echo "<a href='S'inscrire.php'>Vers la page formulaire</a>";
    exit();
}

// Parcourir le tableau et valider les entrées
$tableauDonnes = [];
foreach ($_POST as $key => $val) {
    $tableauDonnes[":" . $key] = !empty($val) ? htmlspecialchars($val) : null;
}

// Cryptage du mot de passe
$tableauDonnes[":password"] = password_hash($password, PASSWORD_BCRYPT);

try {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8", $db_user, $db_password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    // Vérification si l'email existe
    $sql = "SELECT COUNT(*) as nb FROM utilisateur WHERE email_user=?";
    $qry = $pdo->prepare($sql);
    $qry->execute([$tableauDonnes[":email"]]);
    $row = $qry->fetch();

    if ($row["nb"] > 0) {
        echo "L'email existe déjà dans la base de données";
        echo "<a href='S'inscrire.php'>Vers la page d'inscription</a>";
    } else {
        $sql = "INSERT INTO utilisateur (nom_user, email_user, mdp_user) VALUES (:pseudo, :email, :password)";
        $qry = $pdo->prepare($sql);
        $qry->execute($tableauDonnes);
        unset($pdo);
        // echo "Vous êtes bien inscrit";
        // echo "<a href='Acceuil.php'>Vers la page d'accueil</a>";
        header("location:page_valide.php");
    }

} catch (PDOException $err) {
    $_SESSION["compte-erreur-sql"] = $err->getMessage();
    header("location:erreur.php");
    exit();
}
?>
