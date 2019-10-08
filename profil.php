<?php session_start();?>
<!DOCTYPE html>

<body id="profil">
    <?php include('./includes/headermenu.php'); 
?>
<div class="profil">
    <div class="divprofil">

    <div class="infoprofil">
    <h1>Mon profil</h1>
        <p><span>Votre login :</span>
            <?php echo $_SESSION['login']?>
        </p>
        <p><span>Votre nom :</span>
            <?php echo $_SESSION['nom']?>
        </p>
        <p><span>Votre prénom :</span>
            <?php echo $_SESSION['prenom']?>
        </p>
        <p><span>Votre adresse :</span>
            <?php echo $_SESSION['adresse']?>
        </p>
        <p><span>Votre mail :</span>
            <?php echo $_SESSION['mail']?>
        </p>

    </div>
    <div>
        

        <form class="form" method="POST" action="">
        <h2>Modifier mes informations</h2>
<?php
        include('./includes/dbconnect.php'); 

//requete de modification de login
    if(isset($_POST['loginedit'])){
        
         $editNom = "UPDATE identification SET user = \"".$_POST['loginedit']."\"WHERE user = \"".$_SESSION['login']."\"";

         $req = $dbh -> query($editNom);
         
         if ($req){
             echo '<p class="retour">Votre login a été modifié !</p>';
             $_SESSION['login'] = $_POST['loginedit'];
         }
         else{
            echo '<p class="retour">Une erreur est survenue lors de la modification.</p>';
        }
    
}
//requete de modification de nom
if(isset($_POST['nomedit'])){
        
    $editNom = "UPDATE identification SET nom = \"".$_POST['nomedit']."\" WHERE user = \"".$_SESSION['login']."\"";

    $req = $dbh -> query($editNom);
    
    if ($req){
        echo '<p class="retour">Votre nom a été modifié !</p>';
        $_SESSION['nom'] = $_POST['nomedit'];
    }
    else{
        echo '<p class="retour">Une erreur est survenue lors de la modification.</p>';
    }

}
//requete de modification de prenom
if(isset($_POST['prenomedit'])){
        
    $editNom = "UPDATE identification SET prenom = \"".$_POST['prenomedit']."\" WHERE user = \"".$_SESSION['login']."\"";

    $req = $dbh -> query($editNom);
    
    if ($req){
        echo '<p class="retour">Votre prénom a été modifié !</p>';
        $_SESSION['prenom'] = $_POST['prenomedit'];
    }
    else{
        echo '<p class="retour">Une erreur est survenue lors de la modification.</p>';
    }

}
//requete de modification de mot de passe
if(isset($_POST['mdpedit'])){
        
    $editNom = "UPDATE identification SET password = \"".$_POST['mdpedit']."\" WHERE user = \"".$_SESSION['login']."\"";

    $req = $dbh -> query($editNom);
    
    if ($req){
        echo 'Votre mot de passe a été modifié !';
        $_SESSION['prenom'] = $_POST['prenomedit'];
    }
    else{
        echo '<p class="retour">Une erreur est survenue lors de la modification.</p>';
        }

}
//requete de modification de adresse
if(isset($_POST['adressedit'])){
        
    $editNom = "UPDATE identification SET adresse = \"".$_POST['adressedit']."\" WHERE user = \"".$_SESSION['login']."\"";

    $req = $dbh -> query($editNom);
    
    if ($req){
        echo '<p class="retour">Votre adresse a été modifiée !</p>';
        $_SESSION['adresse'] = $_POST['adressedit'];
    }
    else{
        echo '<p class="retour">Une erreur est survenue lors de la modification.</p>';
    }

}
//requete de modification de mail
if(isset($_POST['mailedit'])){
    $mail_exp = "^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$^";
        
    $editNom = "UPDATE identification SET mail = \"".$_POST['mailedit']."\" WHERE user = \"".$_SESSION['login']."\"";

    $req = $dbh -> query($editNom);
//On vérifie que le texte saisi est bien une adresse mail
    if ($req && preg_match($mail_exp,$_POST['mailedit'])){
        echo '<p class="retour">Votre mail a été modifié !</p>';
        $_SESSION['mail'] = $_POST['mailedit'];
    }
    else{
        echo '<p class="retour">Votre adresse mail est invalide.</p>';
    }

}

?>
            <input type="text" name="loginedit" class="editlarge" placeholder="Modifier votre login">
            <input name="Valider" type="submit" value="Modifier" class="edit"  />
        </form>
        <form class="form" method="POST" action="">
            <input type="text" name="nomedit"class="editlarge" placeholder="Modifier votre nom">
            <input name="Valider" type="submit" value="Modifier" class="edit"  />
        </form>
      
        <form class="form" method="POST" action="">
            <input type="text" name="prenomedit"class="editlarge" placeholder="Modifier votre prénom">
            <input name="Valider" type="submit" value="Modifier" class="edit"  />
        </form>
        <form class="form" method="POST" action="">
            <input type="text" name="adressedit" class="editlarge" placeholder="Modifier votre adresse">
            <input name="Valider" type="submit" value="Modifier" class="edit"  />
        </form>
        <form class="form" method="POST" action="">
            <input type="text" name="mailedit" class="editlarge" placeholder="Modifier votre mail">
            <input name="Valider" type="submit" value="Modifier" class="edit"  />
        </form>
        <form class="form" method="POST" action="">
            <input type="text" name="mdpedit" class="editlarge" placeholder="Modifier votre mot de passe">
            <input name="Valider" type="submit" value="Modifier" class="edit"  />
        </form>
    </div>
    </div>
    
    <div class="mescommandes">
    <h2>Mes commandes</h2>
    <?php
    $mail = $_SESSION['mail'];
    $req = "SELECT * FROM commandes WHERE mail= '$mail'ORDER BY nom";
    $commande = $dbh -> query($req);

//On compte le nbr de lignes
   if($commande){
    $nbr = "SELECT COUNT(*)AS nb_nombre FROM commandes WHERE mail= '$mail'";
    $donnee = $dbh -> query($nbr);
    while ($donnees = $donnee->fetch()){
    $numero = $donnees['nb_nombre'];

       echo '<h3>Vous avez '.$numero.' commande en cours</h3>';
    }
while ($commandes = $commande->fetch())
{

//On affiche chaque ligne du tableau    
    echo '<div class="commandeuniq">
    <hr>
            <div class="flex">
            <p><span>Nom : </span> '.$commandes['nom'].'</p>
            <p><span>Prénom : </span>'.$commandes['prenom'].'</p>
            <p class="adresse"><span>Adresse de livraison : </span> '.$commandes['adresse'].' à '.$commandes['ville'].' '.$commandes['code'].'</p>
            <p><span>Taille : </span>'.$commandes['size'].'</p>
            </div>
            </div>
           ';
}
} 
else{
    echo '<h3>Vous n\'avez pas de commande en cours</h3>';
}
    ?>
    
    </div>
    </div>