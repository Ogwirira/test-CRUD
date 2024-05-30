<?php
 include_once("commun/inc.php");
 session_start();

$pseudo = (isset($_POST["pseudo"]) && !empty($_POST["pseudo"])) ? htmlspecialchars($_POST["pseudo"])  : "null";
$nouvpseudo = (isset($_POST["nouvpseudo"]) && !empty($_POST["nouvpseudo"])) ? htmlspecialchars($_POST["nouvpseudo"])  : "null";


if( $pseudo ){

    try {
        $pdo = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8", $db_user, $db_password);
        // Options de PDO
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        $sql_verification = "SELECT nom_user as nb FROM utilisateur WHERE  nom_user = '$pseudo'";
        $result = $pdo->query($sql_verification);
        $rows = $result->fetch();

        if ($rows["nb"] > 0) {
            // Mettre à jour le pseudo
            $sql_update = "UPDATE utilisateur SET nom_user = '$nouvpseudo' WHERE nom_user = '$pseudo' ";
            if ($pdo->query($sql_update) === TRUE) {
                echo '<script type="text/javascript">
                alert("Pseudo mis a jour avec succès");
                window.location.href="Se_connecter.php";
                </script>';
            } else {
                echo '<script type="text/javascript">
                alert("Pseudo mis a jour avec succès");
                window.location.href="Se_connecter.php";
                </script>';
            }
        } else {
            echo '<script type="text/javascript">
            alert("Ancien pseudo ne correspond pas");
            window.location.href="Se_connecter.php";
            </script>';    
        }
        
    }catch (PDOException $err) {
        // Gestion des erreurs
        $_SESSION["compte-erreur-sql"] = $err->getMessage();
        header("location:pageerreur.php");
        exit();




}

} else{
    echo"le pseudo n'est pas valides";
}
?>