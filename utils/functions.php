<?php
function getEmptyProduct(){
    return array("Nome" => null, "Descrizione" => null, "DescrizioneBreve" => null, "Prezzo" => null, "Base_asta" => null, "Disponibilita" => null, "Immagine" => null);
}

function getAction($action){
    $result = "";
    switch($action){
        case 1:
            $result = "Insert";
            break;
        case 2:
            $result = "Update";
            break;
        case 3:
            $result = "Delete";
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

/*Manu*/
////////   
function isUserLoggedIn(){
    return !empty($_SESSION['email']);
}

function registerLoggedUser($email){
    $_SESSION["email"] = $email;
}

////////
function getAnnoMeseGiorno($dataStringa){
    $anno = substr($dataStringa, 0, 4);
    $mese = substr($dataStringa, 5, 2);
    $giorno = substr($dataStringa, 8, 2);
    $data = array("anno" => "$anno", "mese" => "$mese", "giorno" => "$giorno");
    return $data;
}

function getData($anno,$mese,$giorno){
    if(strlen($mese)==1){
        if(strlen($giorno)==1){
            return "$anno-0$mese-0$giorno";
        }else{
            return "$anno-0$mese-$giorno";
        }
    } elseif(strlen($giorno)==1) {
        return "$anno-$mese-0$giorno";
    }
    return "$anno-$mese-$giorno";
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

function uploadImage($path, $image){
    $imageName = basename($image["name"]);
    $fullPath = $path.$imageName;
    
    $maxKB = 500;
    $acceptedExtensions = array("jpg", "jpeg", "png", "gif");
    $result = 0;
    $msg = "";
    //Controllo se immagine è veramente un'immagine
    $imageSize = getimagesize($image["tmp_name"]);
    if($imageSize === false) {
        $msg .= "File caricato non è un'immagine! ";
    }
    //Controllo dimensione dell'immagine < 500KB
    if ($image["size"] > $maxKB * 1024) {
        $msg .= "File caricato pesa troppo! Dimensione massima è $maxKB KB. ";
    }

    //Controllo estensione del file
    $imageFileType = strtolower(pathinfo($fullPath,PATHINFO_EXTENSION));
    if(!in_array($imageFileType, $acceptedExtensions)){
        $msg .= "Accettate solo le seguenti estensioni: ".implode(",", $acceptedExtensions);
    }

    //Controllo se esiste file con stesso nome ed eventualmente lo rinomino
    if (file_exists($fullPath)) {
        $i = 1;
        do{
            $i++;
            $imageName = pathinfo(basename($image["name"]), PATHINFO_FILENAME)."_$i.".$imageFileType;
        }
        while(file_exists($path.$imageName));
        $fullPath = $path.$imageName;
    }

    //Se non ci sono errori, sposto il file dalla posizione temporanea alla cartella di destinazione
    if(strlen($msg)==0){
        if(!move_uploaded_file($image["tmp_name"], $fullPath)){
            $msg.= "Errore nel caricamento dell'immagine.";
        }
        else{
            $result = 1;
            $msg = $imageName;
        }
    }
    return array($result, $msg);
}

function echoMessage($msg, $redirect) {
    echo '<script type="text/javascript">
    alert("' . $msg . '")
    window.location.href = "'.$redirect.'"
    </script>';
}

function winnerMessage($productName, $price){
    return "You have won '".$productName."' at an auction for ".number_format($price, 0, ",", ".")." €.";
}

function buyNowMessage($productName, $price){
    return "You finished the auction by buying '".$productName."' for ".number_format($price, 0, ",", ".")." €.";
}

function endedWithoutBidMessage($productName){
    return "The '".$productName."' auction ended without bids";
}

function buyMessage(){
    return "Buy Now";
}

function raiseMessage($bet){
    return "Raise of ".number_format($bet, 0, ",", ".")." €";
}

function unaviableProductMessage($productName){
    return "The availability requested for '".$productName."' is insufficient, the product has been removed from the cart.";
}

function unaviableProductSellerMessage($productName){
    return "The '".$productName."' product is finished.";
}

function orderCompleted($products, $orderId){
    $message = "Your order containing:";
    foreach($products as $prod){
        $message = $message." ".$prod['quantita']."x '".$prod['nome']."',";
    }
    $time = intval(time());
    $time += 172800;
    $time = date("Y-m-d", $time);
    $message = $message." has been successfully placed. Delivery is estimated for ".$time." at the address 'Via dell'Università 50, Cesena (FC), 47522'.";
    return $message;
}

function orderCarriedOut($products, $orderId){
    $message = "Your products:";
    foreach($products as $prod){
        $message = $message." ".$prod['quantita']."x '".$prod['nome']."',";
    }
    $time = intval(time());
    $time += 172800;
    $time = date("Y-m-d", $time);
    $message = $message." has been sold. Ship the products to the following address: 'Via dell'Università 50, Cesena (FC), 47522'.";
    return $message;
}


function insertProductMessage($productName){
    return "You have uploaded your product '".$productName."' correctly!";
}

function insertAuctionMessage($productName){
    return "You have uploaded your auction '".$productName."' correctly!";
}
?>

