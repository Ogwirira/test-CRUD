<?php
include_once("commun/inc.php");
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['nom_user'])) {
    die("Vous devez être connecté pour supprimer votre compte.");
}

if (isset($_POST['confirm'])) {
    try {
        $nom_user = $_SESSION['nom_user'];

        $pdo = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8", $db_user, $db_password);
        // Options de PDO
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        // Supprimer l'utilisateur
        $sql = "DELETE FROM utilisateur WHERE nom_user = :nom_user";
        $qry = $pdo->prepare($sql);
        $qry->execute([':nom_user' => $nom_user]);

        // Vérifier si la suppression a été effectuée
        if ($qry->rowCount() > 0) {
            // Déconnecter l'utilisateur et détruire la session
            session_unset();
            session_destroy();
            echo '<script type="text/javascript">
            alert("Compte supprimé avec succès");
            window.location.href="Se_connecter.php";
            </script>';        } else {
            echo '<script type="text/javascript">
            alert("Erreur lors de la suppression");
            window.location.href="Se_connecter.php";
            </script>';        }
    } catch (PDOException $err) {
        // Gestion des erreurs
        $_SESSION["compte-erreur-sql"] = $err->getMessage();
        header("location:pageerreur.php");
        exit();
    }
} else {
    echo "Action de suppression non confirmée.";
}
?>
