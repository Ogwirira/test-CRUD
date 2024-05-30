<?php
 include_once("inc.php");
 session_start();

$pseudo = (isset($_POST["pseudo"]) && !empty($_POST["pseudo"])) ? htmlspecialchars($_POST["pseudo"])  : "null";
$mdp_user = (isset($_POST["mdp_user"]) && !empty($_POST["mdp_user"])) ? htmlspecialchars($_POST["mdp_user"])  : "null";

if( $pseudo && $mdp_user ){

    include_once("commun/inc.php");
    // var_dump("$pseudo");
    // var_dump("$mdp_user");
    try {
        $pdo = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8", $db_user, $db_password);
        // Options de PDO
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        $qry=$pdo->prepare("SELECT * FROM utilisateur WHERE nom_user=?");
        $qry->execute(array($pseudo));
        $data_user=$qry->fetch();
        //verif mot de passe
        if($data_user && password_verify($mdp_user,$data_user["mdp_user"])){
            //definition du nom grace à la session
            $_SESSION["nom_user"]=$data_user["nom_user"];
            header("location:acceuil.php");
        }else {
            echo '<script type="text/javascript">
            alert("Utilisateur introuvable");
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
    echo"le pseudo ou le mot de passe ne sont pas valides";
}
?>