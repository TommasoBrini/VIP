<?php

function getEmptyProduct(){
    return array("Nome" =>"", "Descrizione" => "", "DescrizioneBreve" => "", "Prezzo" => "", "Base_asta" => "", "Disponibilita" => "", "Immagine" => "");
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
?>

