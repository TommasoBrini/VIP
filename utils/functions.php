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
?>

