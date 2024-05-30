<?php include_once("commun/header.php");?>

<main>
<section class="formulaire">
    <h2 class="soustitre">S'inscrire</h2>
    <form action="traitement.php" method="post">
            <div>
                <label for="pseudo">Pseudo</label>
                <input type="text" name="pseudo" pattern="[A-Za-z0-9\x{00c0}-\x{00ff}]{5,250}" required>
                
            </div>
            <div>
                <label for="email">Email</label>
                <input type="email" name="email"required>
            </div>
            <div>
                <label for="password">Mot de Passe</label>
                <input type="password"  name="password" pattern="[A-Za-z0-9_$]{8,}" required>
            </div>

            <input type="submit" value="Valider" >
            <a class="liens_log" href="Se_Connecter.php">Déjà un compte ? Connectez-vous</a>
    </form>
</section>
</main>
</body>
</html>


