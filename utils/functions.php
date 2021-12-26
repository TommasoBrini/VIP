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

function getData($dataStringa){
    $anno = substr($dataStringa, 0, 4);
    $mese = substr($dataStringa, 5, 2);
    $giorno = substr($dataStringa, 8, 2);
    $data = array("anno" => "$anno", "mese" => "$mese", "giorno" => "$giorno");
    return $data;
}

function aggiungiGiorno($date){
    $day=1;
    $date = strtotime("+".$day." days", strtotime($date));
    return  date("Y-m-d", $date);

}

function getOraFine($time1, $date){
    $t1=explode(":",$time1);
    $t2=explode(":", "6:00");
    //Senza considerare l'overflow
    $min=$t1[1]+$t2[1];
    $ora=$t1[0]+$t2[0];
    //Effettuo il controllo sull'overflow
    $ora+=floor($min/60);
    //Elimino l'overflow
    $min=fmod($min,60);
    $ora=fmod($ora,24);
    //Aggiungo gli zeri ai valori minori di 10
    $min=($min<10 ? "0" : "").$min;
    $ora=($ora<10 ? "0" : "").$ora;
    $time=$ora.":".$min;
    if($ora < "6"){
        $date = aggiungiGiorno($date);
    }
    return array("time" => "$time", "date" => "$date");
    }

?>

