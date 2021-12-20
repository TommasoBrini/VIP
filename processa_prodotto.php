<?php
require "bootstrap.php";

if(!isset($_POST["action"])){
    header("location: index.php");
}

if($_POST["action"]==1){
    //INSERISCO UN NUOVO PRODOTTO NEL DATABASE
    $nomeProdotto = htmlspecialchars($_POST["Nome"]);
    $descrizione = htmlspecialchars($_POST["Descrizione"]);
    $descrizioneBreve = htmlspecialchars($_POST["DescrizioneBreve"]);
    $prezzo = htmlspecialchars($_POST["Prezzo"]);
    $baseAsta = htmlspecialchars($_POST["Base_asta"]);
    $disponibilità = htmlspecialchars($_POST["Disponibilita"]);
    //$id = $dbh->insertProduct($nomeProdotto, $descrizione, $descrizioneBreve, $prezzo, $baseAsta, $disponibilità, null);
    $id = $dbh->insertProduct("Csio", "dfsjewfjknje", "ascjkeva", 123, "", 12, null);
    if($id!=false){
        header("location: index.php");
    }
    else{
        header("location: index_login.php");
    }
    
}

if($_POST["action"]==2){
    //MODIFICO IL PRODOTTO SELEZIONATO 
}

if($_POST["action"]==3){
    //ELIMINO IL PRODOTTO SELEZIONATO 
    $msg = "Cancellazione completata correttamente!";
    header("location: index.php?formmsg=".$msg);
}

