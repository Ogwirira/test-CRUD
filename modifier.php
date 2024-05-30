<?php include_once("commun/header.php");?>

    <h1>Modifier Son Pseudo</h1>
        <section class="formulaire">
            <form class="form_log" action="traitementmodif.php" method="post">
                <div >                
                    <label class="label" for="pseudo">Ancien Pseudo</label>
                    <input type="text" name="pseudo" class="input" pattern="[A-Za-z0-9\x{00c0}-\x{00ff}]{5,20}" required>
                </div>
                <div >                
                    <label class="label" for="nouvpseudo">Nouveau Pseudo</label>
                    <input type="text" name="nouvpseudo" class="input" pattern="[A-Za-z0-9\x{00c0}-\x{00ff}]{5,20}" required>
                </div>
                <input type="submit" value="confirmer">
            </form>

        </section>
</body>
</html>