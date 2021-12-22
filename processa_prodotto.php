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
    $id = $dbh->insertProduct($nomeProdotto, $descrizione, $descrizioneBreve, $prezzo, $baseAsta, $disponibilità);
    /*$id = $dbh->insertProduct("Csio", "dfsjewfjknje", "ascjkeva", 123, NULL, 12, 14);*/
    if($id!=false){
        var_dump("Inserimento completato correttamente!");
    }
    else{
        var_dump("qualcosa non va");
    }
    //header("location: index.php");
}

if($_POST["azione"]==2){
    //MODIFICO IL PRODOTTO SELEZIONATO 
}

if($_POST["azione"]==3){
    //ELIMINO IL PRODOTTO SELEZIONATO 
    $msg = "Cancellazione completata correttamente!";
    header("location: index.php?formmsg=".$msg);
}

