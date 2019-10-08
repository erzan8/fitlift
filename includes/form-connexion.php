<?php
session_start();

//récuperation du login et du mdp s'ils ont été saisis
if (isset($_POST['login']) AND isset($_POST['mdp'])){
    $postlogin = $_POST['login'];
    $postmdp = $_POST['mdp'];
    echo $postlogin;


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

        $_SESSION["login"]=$login;
        $_SESSION["mdp"]=$mdp;
        $_SESSION["droits"]=$droits;
        
    }
    echo "<span>Vous êtes connecté !!!!!!!!!</span>";
   

}
}
catch (PDOException $e) {
        //la connexion a echoué
        print "Erreur est !: ".$e->getMessage()."<br/>";
        die();
        echo 'la connexion a echoué';
        
}



?>