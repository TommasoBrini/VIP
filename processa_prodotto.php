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

    list($result, $msg) = uploadImage(UPLOAD_DIR, $_FILES["Immagine"]);

    if($nomeProdotto=="" || $descrizione=="" || $descrizioneBreve=="" || $prezzo=="" || ($baseAsta=="" && $disponibilità=="")){
        var_dump("Riempire tutti i campi");
    } else {
        if(isset($_POST["checkbox"])){
            $dataInizio = getAnnoMeseGiorno(htmlspecialchars($_POST["data"]));
            $oraInizio = htmlspecialchars($_POST["time"]);
            $fine = getOraFine($oraInizio, htmlspecialchars($_POST["data"]));
            $dataFine = getAnnoMeseGiorno($fine["date"]);
            $oraFine = $fine["time"];
            $id = $dbh->insertAuction($nomeProdotto, $descrizione, $descrizioneBreve, $prezzo, $baseAsta, $oraInizio, $dataInizio["anno"], $dataInizio["mese"], $dataInizio["giorno"], $oraFine, $dataFine["anno"], $dataFine["mese"], $dataFine["giorno"], $msg);
        } else {
            $id = $dbh->insertProduct($nomeProdotto, $descrizione, $descrizioneBreve, $prezzo, $disponibilità, $msg);
        }
        if($id!=false){
            mex = "Inserimento completato correttamente!";
            header("location: index.php?$mex")
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

