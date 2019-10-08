<!DOCTYPE html>
<?php
session_start();

?>

<body id="inscription">
    <?php include('./includes/headermenu.php'); ?>


    <form class="formcommande" method="POST" action="inscription.php">
        <h1>S'inscrire</h1>
        <p><input type="text" name="login" maxlength="250" placeholder="Nom d'utilisateur" required></p>
        <p><input type="password" name="password" placeholder="Mot de passe" required></p>
        <p><input type="nom" name="nom" placeholder="Votre nom" required></p>
        <p><input type="prenom" name="prenom" placeholder="Votre prénom" required></p>
        <p><input type="adresse" name="adresse" placeholder="Votre adresse postale" required></p>
        <p><input type="mail" name="mail" placeholder="Votre adresse mail" required></p>



        <?php
//Expression régulière permettant de vérifier le champ mail
$mail_exp = "^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$^";

if (isset($_POST['Valider'])){

include('./includes/dbconnect.php');
$login = $_POST['login'];
$password = $_POST['password'];
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$adresse = $_POST['adresse'];
$mail = $_POST['mail'];
$droits = 1;
//vérification de l'adresse mail

  //Création de la requete
  $requete="INSERT INTO identification(user, password, droits, Nom, Prenom, adresse, mail) VALUES ('$login','$password','$droits','$nom','$prenom','$adresse','$mail')";   


  //Execution de la requete
  $resultat= $dbh -> query($requete);
  if(!preg_match($mail_exp,$_POST['mail'])) {
   echo "Votre adresse mail est invalide";
  }
  //on veérifie l'adresse mail et l'ajout dans la bdd
  elseif($resultat && preg_match($mail_exp,$_POST['mail'])){
      echo '<p class="retour">Votre compte a bien été créé !</p><a class="button-retour" href="produit.php">Retour à la page d\'accueil</a></p>';

  }
  else{
      echo '<p class="retour">La création de votre compte a échoué, veuillez recommencer<br>';  
  }
}


?>
        <input name="Valider" type="submit" class="formbutton" placeholder="Valider mon inscription" class="inscription-button" />

    </form>