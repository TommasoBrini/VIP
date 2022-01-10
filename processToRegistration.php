<?php
require_once("bootstrap.php");

if(isset($_POST["email"]) && isset($_POST["password"])) {
    $userExist = $dbh->checkUserExist($_POST["email"]);
    if(count($userExist)==1) {
        //Already registered user
        $dbh->echoMessage("You're already registered, login!", "index_login.php");
    } else {
        //Controllo che email e password rispettano i requisiti, cripto la password e inserisco l'email, la password, l'IdVenditore nel DB
    }
}

?>