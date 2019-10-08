<?php session_start();?>
<!DOCTYPE html>
<?php include('./includes/headermenu.php'); ?>
<div class="product flex">
    <div class="descriptif">
        <h1>Raquette Liftboost</h1>
        <h2>FITLIFT EDITION</h2>
        <p>Découvrez dès maintenant la raquette connectée nouvelle génération “LIFTBOOST”.
            Grâce aux nouvelles technologies blablabla, redécouvrez le tennis sous un nouvel angle.
            Déjà utilisée par “Kei Nishikori” et “David Goffin”, accordez nous la confiance qu’ils nous accordent déjà.<br><br>
            <span>Analysez. Corrigez. Progressez.</span>
        </p>
        <a href="commande.php" class="button">EN SAVOIR PLUS</a>
    </div>



    <div class="raquette">
        <img src="./images/raquette-main.png" class="raquette-img">
        <p class="number">01</p>
    </div>
</div>
<div class="apps">
    <h3 class="appli">Application LiftBoost gratuite</h3>
    <div class="boutonsapp">
        <img src="./images/apple.webp" class="dl">
        <img src="./images/google.webp" class="dl">
    </div>
</div>
<div class="stats">

    <div class="leftside">
        <img src="./images/logo-white.png">
        <ul>
            <li>Activity</li>
            <li>User</li>
            <li>Days</li>
            <li>Product</li>
            <li>Performance</li>
            <li>Post</li>
            <li>Forum</li>
        </ul>
    </div>
    <div class="data">
        <div class="heartbeat">
            <h3>Rythme cardiaque</h3>
            <img src="./images/heartbeat.png">
        </div>
        <div class="flex graphs">
            <div class="quality graph">
                <h3>Qualité de jeu</h3>
                <img src="./images/graph1.png">
            </div>
            <div class="frequency graph">
                <h3>Fréquence de jeux</h3>
                <img src="./images/graph2.png">
            </div>
            <div class="rythm graph">
                <h3>Rythme cardiaque</h3>
                <img src="./images/graph3.png">
            </div>
        </div>
        <div class="interaction graph">

            <h3>Interaction Joueur</h3>
            <div class="flex"><img src="./images/court.png" class="court">
                <div class="ball"></div>
            </div>
        </div>
    </div>
</div>
</body>

</html>