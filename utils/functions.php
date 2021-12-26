<?php

function getEmptyProduct(){
    return array("Nome" => null, "Descrizione" => null, "DescrizioneBreve" => null, "Prezzo" => null, "Base_asta" => null, "Disponibilita" => null, "Immagine" => null);
}

function getAction($action){
    $result = "";
    switch($action){
        case 1:
            $result = "Inserisci";
            break;
        case 2:
            $result = "Modifica";
            break;
        case 3:
            $result = "Cancella";
            break;
    }

    return $result;
}

function getAviable(){
    return $templateParam["aviableProducts"];
}

function getMounth($mese){
    $result = "";
    switch($mese){
        case 1:
            $result = "Jan";
            break;
        case 2:
            $result = "Feb";
            break;
        case 3:
            $result = "Mar";
            break;
        case 4:
            $result = "Apr";
            break;
        case 5:
            $result = "May";
            break;
        case 6:
            $result = "Jun";
            break;
        case 7:
            $result = "Jul";
            break;
        case 8:
            $result = "Aug";
            break;
        case 9:
            $result = "Sept";
            break;
        case 10:
            $result = "Oct";
            break;
        case 11:
            $result = "Nov";
            break;
        case 12:
            $result = "Dec";
            break;
    }

    return $result;
}
?>

