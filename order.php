<?php session_start();?>
<!DOCTYPE html>

<body id="order">
    <?php include('./includes/headermenu.php'); ?>
    <form method="POST" action="" class="formcommande">
        <h1>Informations de commande</h1>
        <p class="consigne">Veuillez renseigner les champs suivants afin de procéder à la commande :</p>
        <p><input type="text" name="nom" placeholder="Votre Nom" required></p>
        <p><input type="text" name="prenom" placeholder="Votre Prénom" required></p>
        <p><input type="text" name="adresse" placeholder="Votre adresse postale" required></p>
        <p><input type="text" name="code" placeholder="Votre code postal" required></p>
        <p><input type="text" name="ville" placeholder="Votre ville" required></p>
        <p><input type="text" name="mail" placeholder="Votre adresse mail" required></p>
        <input type="submit" name="valider" value="Valider" class="formbutton">
        <?php
  $mail_exp = "^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$^";
//On verfie si le mail saisi est valide
if(isset($_POST['mail'])&& isset($_POST['valider'])&& preg_match($mail_exp,$_POST['mail']) && !empty($_POST['mail']) && !empty($_POST['valider'])){
//préparation du mail
$sujet = "Confirmation de commande FITLIFT";
$header="MIME-Version: 1.0\r\n";
$header.='From: Fitlift<support@fitlift.com>'."\n";
$header.='Content-Type:text/html; charset="utf-8"'."\n";
$header.='Content-Transfer-Encoding: 8bit';
$message = '
<html>
<head>
  <title>Confirmation de commande - Fitlift</title>
  <meta charset="utf-8" />
</head>
<body>
<p>L\'équipe Fitlift à bien reçu votre commande et vous en remercie !<br> Vous avez commandé une raquette taille '.$_SESSION['size'].'</p>
</body>
</html>
';

$mail = $_POST['mail'];
//Envoi du mail
mail($mail,$sujet,$message,$header);

$retour = 'Votre commande a bien été prise en compte, un mail de confirmation vous a été envoyé !';

//Requete pour ajouter la commande à la bdd
include('./includes/dbconnect.php'); 
    $addOrder = "INSERT INTO commandes(nom, prenom, adresse, code, ville, mail, size) VALUES (\"".$_POST['nom']."\", \"".$_POST['prenom']."\", \"".$_POST['adresse']."\", \"".$_POST['code']."\", \"".$_POST['ville']."\", \"".$_POST['mail']."\", \"".$_SESSION['size']."\")";
    $req = $dbh -> query($addOrder);

}
elseif(isset($_POST['mail']) && !empty($_POST['mail']) && !preg_match($mail_exp,$_POST['mail'])){
    $retour =  'L\'adresse mail saisie est invalide, veuillez recommencer !';
}

?>
        <?php if(isset($retour)){echo '<p class="retour">'.$retour.'</p>';}?>

    </form>