<?php
include_once("commun/inc.php");
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['nom_user'])) {
    die("Vous devez être connecté pour supprimer votre compte.");
}
include_once("commun/header.php");
?>


<section class="formulaire">
    <h1>Supprimer votre Compte</h1>
    <p>Êtes-vous sûr de vouloir supprimer votre compte ? </p>
    <form method="post" action="traitementsuppr.php">
        <input type="submit" name=confirm value="Supprimer mon compte">
    </form>
    <br>

</section>
</body>
</html>