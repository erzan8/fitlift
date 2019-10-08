<?php session_start();?>
<!DOCTYPE html>
<script src="./scripts/admin.js"></script>

<body id="admin">
    <?php include('./includes/headermenu-white.php'); 
    include('./includes/dbconnect.php'); 
?>
    <h1>Administration</h1>
    <div class="flex">
        <h2 id="profils">Profils</h2>
        <h2 id="commandes">Commandes</h2>
    </div>

    <?php
//Requete pour ajouter un profil
if(isset($_POST['Creer'])){
    $addUser = "INSERT INTO identification (user, password, droits, Nom, Prenom, adresse, mail) VALUES (\"".$_POST['login']."\", \"".$_POST['mdp']."\", \"".$_POST['droits']."\", \"".$_POST['nom']."\", \"".$_POST['prenom']."\", \"".$_POST['adresse']."\", \"".$_POST['mail']."\")";
    $req = $dbh -> query($addUser);

    if ($req){
    echo '<p class="retour">Le profil a bien été créé !</p>';
    }
    else{
    echo '<p class="retour">Une erreur est survenue lors de la création.</p>';
    }

}
?>
    <div class="profils">
        <h3>Ajouter un profil</h3>
        <form class="formajout" method="POST" action="">
            <input type="text" name="login" id="login" placeholder="Saisir un login" required>
            <input type="text" name="nom" id="nom" placeholder="Saisir un nom" required>
            <input type="text" name="prenom" id="prenom" placeholder="Saisir un prénom" required>
            <input type="text" name="mdp" id="mdp" placeholder="Saisir un mot de passe" required>
            <input type="text" name="adresse" id="adresse" placeholder="Saisir une adresse" required>
            <input type="text" name="mail" id="mail" placeholder="Saisir un mail" required>
            <input type="text" name="droits" id="droits" placeholder="Attribuer les droits (1, 2 ou 3)" required>
            <input name="Creer" type="submit" value="Créer le profil" class="connexion-button" />
        </form>

        <?php

    //On récupère la table identification et on récupère les données pour l'id
    $users = "SELECT * FROM identification ORDER BY nom";
    $result = $dbh -> query($users);
    $donnees = $result->fetch();

    

    
    //requete de modification de login
    if(isset($_POST['loginedit'])){

    $editNom = "UPDATE identification SET user = \"".$_POST['loginedit']."\"WHERE id = \"".$donnees['id']."\"";

    $req = $dbh -> query($editNom);

    if ($req){
    echo 'Le login a été modifié !';
    }
    else{
    echo 'Une erreur est survenue lors de la modification.';
    }

    }
    //requete de modification de nom
    if(isset($_POST['nomedit'])){

    $editNom = "UPDATE identification SET nom = \"".$_POST['nomedit']."\" WHERE id = \"".$donnees['id']."\"";

    $req = $dbh -> query($editNom);

    if ($req){
    echo 'Votre nom a été modifié !';
    $_SESSION['nom'] = $_POST['nomedit'];
    }
    else{
    echo 'Une erreur est survenue lors de la modification.';
    }

    }
    //requete de modification de prenom
    if(isset($_POST['prenomedit'])){

    $editNom = "UPDATE identification SET prenom = \"".$_POST['prenomedit']."\" WHERE id = \"".$donnees['id']."\"";

    $req = $dbh -> query($editNom);

    if ($req){
    echo 'Votre prénom a été modifié !';
    $_SESSION['prenom'] = $_POST['prenomedit'];
    }
    else{
    echo 'Une erreur est survenue lors de la modification.';
    }

    }
    //requete de modification de mot de passe
    if(isset($_POST['mdpedit'])){

    $editNom = "UPDATE identification SET password = \"".$_POST['mdpedit']."\" WHERE id = \"".$donnees['id']."\"";

    $req = $dbh -> query($editNom);

    if ($req){
    echo 'Votre mot de passe a été modifié !';
    $_SESSION['prenom'] = $_POST['prenomedit'];
    }
    else{
    echo 'Une erreur est survenue lors de la modification.';
    }

    }
    //requete de modification de adresse
    if(isset($_POST['adressedit'])){

    $editNom = "UPDATE identification SET adresse = \"".$_POST['adressedit']."\" WHERE id = \"".$donnees['id']."\"";

    $req = $dbh -> query($editNom);

    if ($req){
    echo 'Votre adresse a été modifié !';
    $_SESSION['adresse'] = $_POST['adressedit'];
    }
    else{
    echo 'Une erreur est survenue lors de la modification.';
    }

    }
    //requete de modification de mail
    if(isset($_POST['mailedit'])){
    $mail_exp = "^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$^";

    $editNom = "UPDATE identification SET mail = \"".$_POST['mailedit']."\" WHERE id = \"".$donnees['id']."\"";

    $req = $dbh -> query($editNom);
    //On vérifie que le texte saisi est bien une adresse mail
    if ($req && preg_match($mail_exp,$_POST['mailedit'])){
        echo 'Votre mail a été modifié !';
        $_SESSION['mail'] = $_POST['mailedit'];
    }
    else{
    echo 'Votre adresse mail est invalide.';
    }

    }

    ?>

        <?php
// On récupère tout le contenu de la table id
$users = "SELECT * FROM identification ORDER BY nom";
$result = $dbh -> query($users);

//requete de suppression de profil 
if(isset($_GET['id']) && isset($_POST['supprofil'])){    
   $id = $_GET['id'];
    $del = "DELETE FROM identification WHERE id = \"".$id."\"";
    $req = $dbh -> query($del);
    if($req){
        echo '<p class="retour">Ce profil a été supprimé</p>';
    }
    else{
        echo '<p class="retour">Erreur lors de la suppression du profil</p>';
    }
}

while ($donnees = $result->fetch())
{

//On affiche chaque ligne du tableau    
    echo '<div class="user">
            <div class="flex centre">
            <p><span>Login :</span> '.$donnees['user'].'</p>
            <p><span>Nom : </span>'.$donnees['Nom'].'</p>
            <p><span>Prénom :</span> '.$donnees['Prenom'].'</p>
            <p><span>Mail : </span>'.$donnees['mail'].'</p>
            <p><span>Adresse :</span> '.$donnees['adresse'].'</p>
            <p><span>Droits : </span>'.$donnees['droits'].'</p>
            <p><span>ID : </span>'.$donnees['id'].'</p>
            <div class="boutonsedit">
            <form method="post" action="admin.php?id='.$donnees['id'].'">
           <input type="submit" name="supprofil" value="Supprimer">
           </form>
            <p class="modif">Modifier</p>
            <div class="modifications flex">
         
            <form class="formconnexion" method="POST" action="">
            <input type="text" name="loginedit"id="loginedit" placeholder="Modifier le login">
            <input name="Valider" type="submit" value="Modifier" class="connexion-button" />
        </form>
        <form class="formconnexion" method="POST" action="">
            <input type="text" name="nomedit"id="nomedit" placeholder="Modifier le nom">
            <input name="Valider" type="submit" value="Modifier" class="connexion-button" />
        </form>
      
        <form class="formconnexion" method="POST" action="">
            <input type="text" name="prenomedit"id="prenomedit" placeholder="Modifier le prénom">
            <input name="Valider" type="submit" value="Modifier" class="connexion-button" />
        </form>
        <form class="formconnexion" method="POST" action="">
            <input type="text" name="adressedit"id="adressedit" placeholder="Modifier l\'adresse">
            <input name="Valider" type="submit" value="Modifier" class="connexion-button" />
        </form>
        <form class="formconnexion" method="POST" action="">
            <input type="text" name="mailedit"id="mailedit" placeholder="Modifier le mail">
            <input name="Valider" type="submit" value="Modifier" class="connexion-button" />
        </form>
        <form class="formconnexion" method="POST" action="">
            <input type="text" name="droitedit"id="droitedit" placeholder="Modifier les droits (1, 2 ou 3)">
            <input name="Valider" type="submit" value="Modifier" class="connexion-button" />
        </form>
                    
                </div>
            </div> 
               
            </div>
            <hr>
            </div>';

}

?>
    </div>

    <div class="commandes">
        <?php
        
//requete de suppression de commande 
if(isset($_GET['id']) && isset($_POST['supcommande'])){    
    $id = $_GET['id'];
     $del = "DELETE FROM commandes WHERE id = \"".$id."\"";
     $req = $dbh -> query($del);
     if($req){
         echo '<p class="retour">Cette commande a été supprimée</p>';
     }
     else{
         echo '<p class="retour">Erreur lors de la suppression de la commande</p>';
     }
 } 

// On récupère tout le contenu de la table commandes
$orders = "SELECT * FROM commandes ORDER BY nom";
$result = $dbh -> query($orders);

while ($commande = $result->fetch())
{

//On affiche chaque ligne du tableau    
    echo '<div class="commandeuniq">
    <hr>
            <div class="flex">
            <p><span>Nom :</span> '.$commande['nom'].'</p>
            <p><span>Prénom : </span>'.$commande['prenom'].'</p>
            <p><span>Adresse :</span> '.$commande['adresse'].'</p>
            <p><span>Code postal : </span>'.$commande['code'].'</p>
            <p><span>Ville :</span> '.$commande['ville'].'</p>
            <p><span>Mail : </span>'.$commande['mail'].'</p>
            <p><span>Taille : </span>'.$commande['size'].'</p>
            <form method="post" action="admin.php?id='.$commande['id'].'">
           <input type="submit" name="supcommande" value="Supprimer">
           </form>
            </div>
            </div>
           ';
}
?>
    </div>
    </div>