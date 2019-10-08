<?php
try{
    $dbh = new PDO('mysql:host=cl1-sql20;dbname=dki06713', 'dki06713','SND0gv4FoBsy');

}
catch (PDOException $e) {
        //la connexion a echoué
        print "Erreur est !: ".$e->getMessage()."<br/>";
        die();
        echo 'la connexion a echoué';
        
}
?>