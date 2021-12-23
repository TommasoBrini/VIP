<?php
require "bootstrap.php";

if(!isset($_POST["azione"])){
    header("location: index.php");
}

if($_POST["azione"]==1){
    //INSERISCO UN NUOVO PRODOTTO NEL DATABASE
    $nomeProdotto = htmlspecialchars($_POST["Nome"]);
    $descrizione = htmlspecialchars($_POST["Descrizione"]);
    $descrizioneBreve = htmlspecialchars($_POST["DescrizioneBreve"]);
    $prezzo = htmlspecialchars($_POST["Prezzo"]);
    $baseAsta = htmlspecialchars($_POST["Base_asta"]);
    $disponibilità = htmlspecialchars($_POST["Disponibilita"]);
    if($nomeProdotto=="" || $descrizione=="" || $descrizioneBreve=="" || $prezzo=="" || ($baseAsta=="" && $disponibilità=="")){
        var_dump("Riempire tutti i campi");
    } else {
        if(isset($_POST["checkbox"])){
            $id = $dbh->insertAuction($nomeProdotto, $descrizione, $descrizioneBreve, $prezzo, $baseAsta, "", "");
        } else {
            $id = $dbh->insertProduct($nomeProdotto, $descrizione, $descrizioneBreve, $prezzo, $disponibilità);
        }
        if($id!=false){
            var_dump("Inserimento completato correttamente!");
        }
        else{
        var_dump("qualcosa non va");
        }
    }
}

if($_POST["azione"]==2){
    //MODIFICO IL PRODOTTO SELEZIONATO 
}

if($_POST["azione"]==3){
    //ELIMINO IL PRODOTTO SELEZIONATO 
    $msg = "Cancellazione completata correttamente!";
    header("location: index.php?formmsg=".$msg);
}

