<?php

//récuperation du login et du mdp s'ils ont été saisis
if (isset($_POST['login']) AND isset($_POST['mdp'])){
    $postlogin = $_POST['login'];
    $postmdp = $_POST['mdp'];


// Connexion à la base de données
$dbh = new PDO('mysql:host=cl1-sql20;dbname=dki06713', 'dki06713','SND0gv4FoBsy');


//tester la connexion

try{
    // recuperation de tous les utilisateurs avec leurs droits et essentiellement les droits d'acces

    //Création de la requete
$requete="SELECT * FROM identification WHERE user=\"$postlogin\"AND password=\"$postmdp\"";    


//Exectution de la requete
$resultat= $dbh -> query($requete);

if ($resultat) {
                
    foreach($resultat as $ligne) {
        
        $login = $ligne[0];
        
        $mdp=$ligne[1];

        $droits=$ligne[2];
        $nom=$ligne[3];
        $prenom=$ligne[4];
        $adresse=$ligne[5];
        $mail=$ligne[6];
        $id=$ligne[7];

        $_SESSION["login"]=$login;
        $_SESSION["mdp"]=$mdp;
        $_SESSION["droits"]=$droits;
        $_SESSION["nom"]=$nom;
        $_SESSION["prenom"]=$prenom;
        $_SESSION["adresse"]=$adresse;
        $_SESSION["mail"]=$mail;
        $_SESSION["id"]=$id;

        
    }
   

}
else{
    echo 'Connexion echouée';
}
}
catch (PDOException $e) {
        //la connexion a echoué
        print "Erreur est !: ".$e->getMessage()."<br/>";
        die();
        echo 'la connexion a echoué';
        
}
}
?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="icon" href="./images/favicon.ico" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="./scripts/menu.js"></script>
    <script src="./scripts/admin.js"></script>
</head>

    <header>
    <div>
            <a href="produit.php"><img src="./images/logo-black.png" class="logo"></a>
        </div>
        <div class="flex topright">
            <div class="flexcolumn"><img src="./images/user-avatar.png" class="avatar">
                <?php
            if(isset($_SESSION["login"])) { 
            echo '<p class="hello">Bonjour<br>'.$_SESSION["login"].' !</p>'; 
            }else{ 
            echo '<p class="hello">Connexion</p>'; 
            } 
            
?>
            </div>
            <div class="connexion" id="connect">
<?php 

if(isset($_SESSION['login'])){
             echo '<form class="formconnexion" action="deconnexion.php" method="post">
             <img src="./images/close-circular-button.png" class="close">
             <h3>'.$_SESSION['login'].'</h3>
             <a href = "profil.php" class="boutonconnect">Voir mon profil</a>
             <p><input type="submit" value="Se déconnecter"  class="boutonconnect" /></p>
         </form>';
}

else{

echo '<form class="formconnexion" method="POST" action="">
<img src="./images/close-circular-button.png" class="close">
<h3>CONNEXION</h3>
<input type="text" name="login" maxlength="250" id="login" placeholder="Nom d\'utilisateur">


<input type="password" name="mdp" id="mdp" placeholder="Mot de passe">
<p class="linksp"><a href="inscription.php">Pas encore de compte ? S\'inscrire !</a> </p>
<p class="linksp"><a href="recuperation.php">Mot de passe oublié</a></p>


<p>
    <input name="Valider" type="submit" value="Connexion" class="connexion-button" />

</p>

</form>';
}
?>
        </div>
    </header>
    <div class="wrapper-menu">
            <div class="line-menu half start"></div>
            <div class="line-menu"></div>
            <div class="line-menu half end"></div>
          </div>
    <nav>
           
        <ul>
            <a href="./commande.php"><li>COMMANDE</li></a>
            <a href="./produit.php"><li>PRODUIT</li></a>
            <a href="./equipe.php"><li>EQUIPE</li></a>
            <a href="./livre.php"><li>LIVRE D'OR</li></a>
            <?php if(isset($_SESSION['droits']) && $_SESSION['droits'] == 3){
      echo '<a href="./admin.php"><li>ADMINISTRATION</li></a>';}?>
        </ul>
    </nav>