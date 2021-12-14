<?php
    require 'database.php';

    $dbh = new DatabaseHelper("localhost", "root", "", "VIP", 3307);
    $auct = $dbh->getAuctions();
    
    function productBefore($img, $description, $prezzo) {
        return "<div class='product before'><img class='img' src='data:image/jpeg;base64,".base64_encode($img)."' alt='product photo'/><div class='topright'><button class='timer'>15:00</button><textarea readonly class='description'>"+$description+"</textarea></div><button class='grey'>".$prezzo."</button><button class='grey'>INIZIERA' A BREVE</button><button class='last grey'>VEDI IL PRODOTTO</button></div>";
    }

    function loadAuctions(){
        $auctions = "";
        foreach($auct as $auction){
            switch($auction["Stato"]){
                case "befor":
                    $auctions = $auctions.productBefore($auction["Immagine"], $auction["Descrizione"], $auction["Prezzo"]);
                    break;
                default:
                    break;
            }
        }
        echo $auctions;
    }



?>