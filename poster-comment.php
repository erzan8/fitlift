<?php session_start();
include('./includes/dbconnect.php');

if(isset($_SESSION['login'])){
$auteur = $_SESSION['login'];
}

if(isset($_POST["commentaire"])){
//Si un commentaire est rédigé on le publie et ajoute à la bdd
    $commentaire = $_POST["commentaire"];

    $requete= "INSERT INTO commentaires(auteur, commentaire, datecommentaire) VALUES ('$auteur', '$commentaire', NOW())";    

//Exectution de la requete
    $resultat= $dbh -> query($requete);
}
?>