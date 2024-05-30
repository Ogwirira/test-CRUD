
<?php session_start();
 include_once("commun/header.php");?>
    <main class="main_validation">
        <h1 class="validation">Bienvenue <?php echo $_SESSION['nom_user'] ?>Vous êtes bien inscrit </h1>
        <a class="lien_validation" href="Acceuil.php">Retour à l'acceuil</a>
    </main>
