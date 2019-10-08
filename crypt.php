<?php
// laissons le salt initialisé par PHP
$hashed_password = crypt('guilhem');

$user_input = "guilhem";

if (hash_equals($hashed_password, crypt($user_input, $hashed_password))) {
   echo "Mot de passe correct !";
   echo "Voici le mot de passe crypté : \n".$hashed_password;
}
else{
    echo "mot de passe incorrect";
}
?>