<?php
require "bootstrap.php";

if(!isset($_POST["azione"])){
    header("location: index.php");
}

//INSERIMENTO
if($_POST["azione"]==1){
    $nomeProdotto = htmlspecialchars($_POST["Nome"]);
    $descrizione = htmlspecialchars($_POST["Descrizione"]);
    $descrizioneBreve = htmlspecialchars($_POST["DescrizioneBreve"]);
    $prezzo = htmlspecialchars($_POST["Prezzo"]);
    $baseAsta = htmlspecialchars($_POST["Base_asta"]);
    $disponibilità = htmlspecialchars($_POST["Disponibilita"]);

    list($result, $msg) = uploadImage(UPLOAD_DIR, $_FILES["Immagine"]);

    if($nomeProdotto=="" || $descrizione=="" || $descrizioneBreve=="" || $prezzo=="" || ($baseAsta=="" && $disponibilità=="")){
        $mex="Enter all values";
        header("location: index_gestione_product.php?action=1&$mex");
    } else {
        if(isset($_POST["checkbox"])){
            $dataInizio = getAnnoMeseGiorno(htmlspecialchars($_POST["data"]));
            $oraInizio = htmlspecialchars($_POST["time"]);
            $fine = getOraFine($oraInizio, htmlspecialchars($_POST["data"]));
            $dataFine = getAnnoMeseGiorno($fine["date"]);
            $oraFine = $fine["time"];
            $id = $dbh->insertAuction($nomeProdotto, $descrizione, $descrizioneBreve, $prezzo, $baseAsta, $oraInizio, $dataInizio["anno"], $dataInizio["mese"], $dataInizio["giorno"], $oraFine, $dataFine["anno"], $dataFine["mese"], $dataFine["giorno"], $msg);
            $dbh->insertNotify($_SESSION["email"], "You have uploaded your auction correctly!", null, null, null, $id);
	} else {
            $id = $dbh->insertProduct($nomeProdotto, $descrizione, $descrizioneBreve, $prezzo, $disponibilità, $msg);
            $dbh->insertNotify($_SESSION["email"], "You have uploaded your product correctly!", null, null, null, $id);
	}
        if($id!=false){
            echoMessage("Your product has been uploaded!", "index_products.php");

        }
        else{
            echoMessage("OPS! Something went wrong!", "index_products.php");
        }
    }
}

//MODIFICA
if($_POST["azione"]==2){
    $id = $_POST["id"];
    $nomeProdotto = htmlspecialchars($_POST["Nome"]);
    $descrizione = htmlspecialchars($_POST["Descrizione"]);
    $descrizioneBreve = htmlspecialchars($_POST["DescrizioneBreve"]);
    if(isset($_POST["Prezzo"])){
        $prezzo = htmlspecialchars($_POST["Prezzo"]);
    } else {
        $prezzo = htmlspecialchars($_POST["PrezzoDefault"]);
    }
    $disponibilità = htmlspecialchars($_POST["Disponibilita"]);
    if(isset($_FILES["Immagine"]) && strlen($_FILES["Immagine"]["name"])>0){
        list($result, $msg) = uploadImage(UPLOAD_DIR, $_FILES["Immagine"]);
    } else {
        $msg = $_POST["ImmagineDefault"];
    }
    
    $check=count($dbh->checkProduct($id));
    $dbh->updateProduct($id, $nomeProdotto, $descrizione, $descrizioneBreve, $prezzo, $disponibilità, $msg, $check);
    echoMessage("Edit successful!", "index_products.php");
}

//CANCELLAZIONE
if($_POST["azione"]==3){
    $id = $_POST["id"];
    $check=count($dbh->checkProduct($id));
    $bol = $dbh->deleteProduct($id, $check);
    echoMessage("Your product has been deleted!", "index_products.php");
}

?>