<?php session_start();?>
<!DOCTYPE html>

<body id="reinitialisation">
    <?php include('./includes/headermenu.php'); ?>



<form method ="post" action="" class="formcommande">
<h1>Réinitialisation du mot de passe</h1>
    <p class="consigne">Veuillez renseigner le code que nous vous avons envoyé par mail :</p> 
    <p ><input name ="token" placeholder="Votre code de récupération"></p>
    <p class="consigne">Votre nouveau mot de passe : </p>
    <p><input name="newmdp" placeholder="Nouveau mot de passe"></p>
    <p class="consigne">Confirmation du nouveau mot de passe : </p>
    <p><input name="newmdpconfirm" placeholder="Confirmation du mot de passe"></p>
<input type="submit" value="Valider" name="valider" class="formbutton">

</form>
<?php

if (isset($_POST['token']) && isset($_POST['newmdp']) && isset($_POST['newmdpconfirm'])
    && !empty($_POST['token']) && !empty($_POST['newmdp']) && !empty($_POST['newmdpconfirm'])){
    $token= $_POST['token'];
    $newmdp= $_POST['newmdp'];
    $newmdpconfirm= $_POST['newmdpconfirm'];
//On vérifie le token
    $requete= "SELECT * FROM recuperation WHERE token = '$token'";
//Execution de la requete
    $verif= $dbh -> query($requete);
//Si le token existe, alors on change le mdp
    if($verif){
        $mail = $_GET['mail'];
        $changemdp= "UPDATE identification SET mdp = '$newmdp' WHERE mail = '$mail'";
//Execution de la requete
        $mdpchange= $dbh -> query($changemdp);
        if($mdpchange){
            echo '<p class="retour">Votre mot de passe a été bien été changé !</p>';
        }
        else{
            echo '<p class="retour">Votre mot de passe n\'a pas pu être changé.</p>';
        }
    }
    elseif($_POST['mdp'] != $_POST['newmdpconfirm']){
        echo '<p class="retour">Les mots de passe saisis ne correspondent pas, veuillez recommencer.</p>';
    }
}
