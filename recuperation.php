<?php session_start();?>
<!DOCTYPE html>

<body id="recuperation">
    <?php include('./includes/headermenu.php'); ?>

<form method ="post" action="recuperation.php?mail=<?php $mail ?>" class="formcommande">

<h1>Récupération de mot de passe</h1>
    <p class="consigne">Veuillez renseigner votre adresse mail :</p>
    <p><input name ="mail" placeholder="Votre adresse mail"></p>
    

<?php 
// Si le mail a été saisi, alors on vérifie qu'il existe dans la bdd
if(isset($_POST['mail'])&& !empty($_POST['mail'])){
    include('./includes/dbconnect.php');
    $mail = $_POST['mail'];
    $mailExist = "SELECT * FROM identification WHERE mail = '$mail'";
    $req = $dbh -> query($mailExist);
    if($req){
    foreach($req as $ligne) {
    
        $mailvalid=$ligne['mail'];
        }
    }
        if(isset($mailvalid)){
        //On crée un token aléatoire
        $token = "";
            for($i=0; $i < 8; $i++) { 
               $token .= mt_rand(0,9);
            }
            //On crée le token et on l'envoie par mail et on l'ajoute à la table de récup
        $ajoutToken = "INSERT INTO recuperation(mail, token) VALUES ('$mail', '$token')";
    
    
    $header="MIME-Version: 1.0\r\n";
    $header.='From: Fitlift<support@fitlift.com>'."\n";
    $header.='Content-Type:text/html; charset="utf-8"'."\n";
    $header.='Content-Transfer-Encoding: 8bit';
    $message = '
<html>
    <head>
      <title>Récupération de mot de passe - Fitlift</title>
      <meta charset="utf-8" />
    </head>
    <body>
    <p>Vous venez de faire une demande de récupération de compte sur notre site, voici votre de code de récupération : '.$token.'</p>
    </body>
    </html>
    ';
    mail($mail, "Récupération de mot de passe - Fitlift", $message, $header);
   
    //On redirige vers la 2e page avec le formulaire de recupération
    header("Location:./reinitialisation.php?mail=$mail");
    }
    else{
    echo '<br><p class="retour">Il n\'y a pas de compte associé à l\'adresse fournie. </p>';
    }
}
?>
<input type="submit" value="valider" class="formbutton">
</form>