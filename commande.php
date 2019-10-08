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
if(isset($_POST['size'])){
    $_SESSION['size'] = $_POST['size'];
    header('location: order.php');
}
?>
<!DOCTYPE html>

<body id="commande">
    <?php include('./includes/headermenu.php'); ?>
    <div class="produit">
        <div class="raquette-produit">
            <img src="./images/RaquetteN3.png" class="raquette-main raq1">
            <img src="./images/RaquetteN1.png" class="raquette-main raq2">
            <img src="./images/RaquetteN2.png" class="raquette-main raq3">
            <img src="./images/RaquetteN3.png" class="raquette-main raq4">
            <img src="./images/RaquetteN4.png" class="raquette-main raq5">
            <p class="number">01</p>
            <div class="vignettes">
                <img src="./images/vignette1.png" class="vignette v1">
                <img src="./images/vignette3.png" class="vignette v2">
                <img src="./images/vignette2.png" class="vignette v3">
                <img src="./images/vignette1.png" class="vignette v4">
                <img src="./images/vignette5.png" class="vignette v5">
            </div>
        </div>
        <div class="desc-produit">
            <h1>Raquette Liftboost</h1>
            <h2>FITLIFT EDITION</h2>
            <p class="price">279,00€</p>
            <ul>
                <li>Entraînez-vous sur des mécaniques en particulier, telles que la précision ou certains effets, grâce à des mini jeux intégrés.</li>
                <li>Corrigez vos erreurs grâce au logiciel de conseil intégré à l’application. Il vous retourne, après analyse de vos statistiques, ce que vous devriez travailler en priorité, et comment le travailler efficacement. Ainsi, améliorez-vous en comprenant précisément vos points faibles.</li>
                <li>Retrouvez la motivation grâce à un suivi poussé de ses performances. Evaluez ainsi votre progression en direct et en chiffres. De plus, vous pouvez vous comparer aux autres joueurs grâce aux classements intégrés à l’application.</li>
                <li>Ludique, découvrez pour la première fois au tennis une raquette dont la puissance est augmentée en fonction de vos envies. Grâce à son tamis en nylon anodé, profitez d’une puissance décuplée.</li>
                <li>Bénéficiez d’un prix défiant toute concurrence. Un modèle unique : meilleur, et un prix unique : moins cher</li>
            </ul>
            <div class="setsize">
                <p class="taille">TAILLE MANCHE</p>
            <form method="post" action="" class=sizeform>
                <select name="size">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                </select>
            <input type="submit" class="button" value ="SHOP NOW">
            </form>
            </div>
        </div>
    </div>
    <h2 class="carac">Caractéristiques techniques</h2>
    <div class="details">
            
            <div class="flexdetails">
                <div class= "icondesc">
            <ul> 
                <img src="./images/chronometer.png" class="icon">
                <li class="chrono">Plus de 70 heures d’autonomie pour une heure de rechargement</li>
                <img src="./images/weight-tool.png" class="icon">
                <li class="weight">Sensation de tennis inchangée, le poids et la taille sont similaires<br> aux modèles classiques.</li>
            </ul>
         
            </div>
            <div class="caracteristiques">
                <ul class="title">
                    <li>Composition</li>
                    <li>Tamis</li>
                    <li>Poids (gr.)</li>
                    <li>Rigidité</li>
                    <li>Equilibre</li>
                    <li>Profil maxi.</li>
                    <li>Longueur</li>
                    <li>Plan de cordage</li>

                </ul>
                <ul class="valeur">
                    <li>Graphite / Tungsten</li>
                    <li>645 cm² / 100 sq. in.</li>
                    <li>300</li>
                    <li>72 ra</li>
                    <li>320 mm.</li>
                    <li>26 mm.</li>
                    <li>27 in. / 68.5 cm.</li>
                    <li>16x19</li>

                </ul>
            </div>
            </div>
        </div>

    <div class="commentaires">
    <?php
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

    <div class="commenterOr">
        <form method="post" class="formOr" action="commande.php">
           
            <textarea name="commentaire" id="commentaireOr" placeholder="Ajouter un commentaire..."></textarea>
            
            <input type="submit" class="submitOr" value="Envoyer" />
            <?php if(isset($resultat)){
                echo '<p class="retour">Le commentaire a été posté</p>';
            }
            else if(isset($_POST["commentaire"]) && empty($resultat)){
                echo '<p class="retour">le commentaire na pas été posté</p>';
            }
            else{}
            ?>
        </form>
        
        <?php
       //requete de suppression de commentaire
if(isset($_GET['id']) && isset($_POST['supprimer'])){
    $id = $_GET['id'];

        $delete = "DELETE FROM commentaires WHERE id = \"".$id."\"";
        $req = $dbh -> query($delete);
        
        if ($req){
            echo '<p class="retour">Le commentaire a été supprimé</p>';
        }
        else{
            echo '<p class="retour">Le commentaire n\'a pas pu être supprimé</p>';
        }
    }
     //requete de modification de commentaire
if(isset($_GET['id']) && isset($_POST['editcom']) && !empty($_POST['editcom'])){
    $id = $_GET['id'];

        $editcom = "UPDATE commentaires SET commentaire = \"".$_POST['editcom']."\" WHERE id = \"".$id."\"";
        $req = $dbh -> query($editcom);
        
        if ($req){
            echo '<p class="retour">Le commentaire a été modifié</p>';
        }
        else{
            echo '<p class="retour">Le commentaire n\'a pas pu être modifié</p>';
        }
    }
       //Requete pour afficher les commentaires
       $comments = "SELECT * FROM commentaires ORDER BY datecommentaire DESC";
       $tabcomments= $dbh -> query($comments);

       while ($donnees = $tabcomments->fetch()){
            echo '<div class="commentcom"><div><h4>'.$donnees['auteur'].'<span> posté le '.$donnees['datecommentaire'].'</h4><p>'.$donnees['commentaire'].'</span></p></div></div>';
            //Si l'utilisateur est connecté et que ses droits sont de 3, alors il peut supprimer un commentaire
        
            if(isset($_SESSION['droits'])){
                
                if($_SESSION['droits'] == 3){
                
            echo '<div class="flex"><form method="post" action="commande.php?id='.$donnees['id'].'"><input type="submit" class="suppr" name="supprimer" value="Supprimer"></form>';
            echo '<input type="submit" class="edit" value="Modifier">';
            echo '<form method="post" class= "modifier" action="commande.php?id='.$donnees['id'].'">
                    <textarea class="editcom" name="editcom" placeholder="Modifier votre commentaire..."></textarea>
                    <input type="submit" class="modif" value="Modifier">
            </form></div>';
                    

                }
                // si c'est un utilisateur lambda, il peut modifier et supprimer son commentaire
                else if($_SESSION['droits'] == 1 && $_SESSION['login'] == $donnees['auteur']){
                    echo '<div class="flex"><form method="post" action="commande.php?id='.$donnees['id'].'"><input type="submit" class="suppr" name="supprimer" value="Supprimer"></form>';
                    echo '<input type="submit" class="edit" value="Modifier">';
                    echo '<form method="post" class= "modifier" action="commande.php?id='.$donnees['id'].'">
                            <textarea class="editcom" name="editcom" placeholder="Modifier votre commentaire..."></textarea>
                            <input type="submit" class="modif" value="Modifier">
                    </form></div>';
                } 
            }
       }    ?>
    </div>
</body>
<script src="./scripts/raquettes.js"></script>
<script src="./scripts/livre.js"></script>
</html>