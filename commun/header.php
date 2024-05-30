<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Acceuil CRUD</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <nav  >
        <ul class='navbar'>
        <a href="acceuil.php">Acceuil</a>
            <?php if(!isset($_SESSION["nom_user"])) : ?>
            <li ><a href="Se_Connecter.php"> Se connecter </a></li>
            <li ><a href="S'inscrire.php"> S'inscrire </a></li>
            <?php else : ?>
            <li class="liens"><a href=""> <?php echo $_SESSION['nom_user'] ?></a></li>
            <li><a href="modifier.php">Modifier son Pseudo</a></li>
            <li class="liens"><a href="deconnexion.php"> Se Déconnecter </a></li>
            <li class="liens"><a href="supprimer.php"> Supprimer Votre compte </a></li>
            <?php endif ;?>
    </ul>
    </nav>
</header>