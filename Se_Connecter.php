<?php include_once("commun/header.php");?>

    

<main >
        
        <section class="formulaire">
            <h1>Se connecter</h1>
            <form action="traitementco.php" method="post">
                <div >                
                    <label class="label" for="pseudo">Pseudo</label>
                    <input type="text" name="pseudo" class="input" pattern="[A-Za-z0-9\x{00c0}-\x{00ff}]{5,20}" required>
                    <a class="liens_log" href="S'inscrire.php">Pas encore inscrit ?</a>
                </div>
                <div>
                    <label class="label" for="mdp_user">Mot de Passe</label>
                    <input type="password" id="password" name="mdp_user" class="input" pattern="[A-Za-z0-9_$]{8,}" required>
                </div>
            
                <input  type="submit" value="Valider" >
            </form>
            
        </section>

    </main>
</body>
</html>