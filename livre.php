<?php
session_start();
include('./includes/dbconnect.php');

if(isset($_SESSION['login'])){
    $auteur = $_SESSION['login'];
    }
    
    if(isset($_POST["commentaire"])){
    //Si un commentaire est rédigé on le publie et ajoute à la bdd
        $commentaire = $_POST["commentaire"];
    
        $requete= "INSERT INTO commentaires_livre(auteur, commentaire, datecommentaire) VALUES ('$auteur', '$commentaire', NOW())";    
    
    //Exectution de la requete
        $resultat= $dbh -> query($requete);
    }

?>
<!DOCTYPE html>

<body id="livre">
    <?php include('./includes/headermenu-white.php');?>
    <h1>Livre d'or</h1>
    <div class="commenterOr">
        <form method="post" class="formOr" action="livre.php">

            <label for="commentaire">Commentaire</label>
            <textarea name="commentaire" id="commentaireOr" placeholder="Ajouter votre commentaire en tant que <?php if(isset($_SESSION['login'])){ echo $_SESSION['login'];}else{echo 'invité';}?>..."></textarea>
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

        $delete = "DELETE FROM commentaires_livre WHERE id = \"".$id."\"";
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

        $editcom = "UPDATE commentaires_livre SET commentaire = \"".$_POST['editcom']."\" WHERE id = \"".$id."\"";
        $req = $dbh -> query($editcom);
        
        if ($req){
            echo '<p class="retour">Le commentaire a été modifié</p>';
        }
        else{
            echo '<p class="retour">Le commentaire n\'a pas pu être modifié</p>';
        }
    }
       //Requete pour afficher les commentaires
       $comments = "SELECT * FROM commentaires_livre ORDER BY datecommentaire DESC";
       $tabcomments= $dbh -> query($comments);

       while ($donnees = $tabcomments->fetch()){
            echo '<div class="singlecomment"><div><h4><span>'.$donnees['auteur'].'</span> posté le '.$donnees['datecommentaire'].'</h4><p>'.$donnees['commentaire'].'</p></div></div>';
            //Si l'utilisateur est connecté et que ses droits sont de 3, alors il peut supprimer un commentaire
        
            if(isset($_SESSION['droits'])){
                
                if($_SESSION['droits'] == 3){
                
            echo '<div class="flex"><form method="post" action="livre.php?id='.$donnees['id'].'"><input type="submit" class="suppr" name="supprimer" value="Supprimer"></form>';
            echo '<input type="submit" class="edit" value="Modifier">';
            echo '<form method="post" class= "modifier" action="livre.php?id='.$donnees['id'].'">
                    <textarea class="editcom" name="editcom" placeholder="Modifier votre commentaire..."></textarea>
                    <input type="submit" class="modif" value="Modifier">
            </form></div>';
                    

                }
                // si c'est un utilisateur lambda, il peut modifier et supprimer son commentaire
                else if($_SESSION['droits'] == 1 && $_SESSION['login'] == $donnees['auteur']){
                    echo '<div class="flex"><form method="post" action="livre.php?id='.$donnees['id'].'"><input type="submit" class="suppr" name="supprimer" value="Supprimer"></form>';
                    echo '<input type="submit" class="edit" value="Modifier">';
                    echo '<form method="post" class= "modifier" action="livre.php?id='.$donnees['id'].'">
                            <textarea class="editcom" name="editcom" placeholder="Modifier votre commentaire..."></textarea>
                            <input type="submit" class="modif" value="Modifier">
                    </form></div>';
                } 
            }
       }

        ?>
    </div>