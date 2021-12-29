<?php foreach($templateParams["auctions"] as $asta){ 
    switch($asta["Stato"]){
        case "BEFORE":
            if(isset($templateParams["auctionBefore"])){
                require($templateParams["auctionBefore"]);
            }
            break; 
        case "FINITA":
            if($asta["CodVincitore"] == NULL){
                require($templateParams["auctionLose"]);
            } else {
                require($templateParams["auctionWin"]);
            }
            break;
        case "INIZIATA":
            if(isset($templateParams["auctionWinning"])){
                require($templateParams["auctionWinning"]);
            } else {
                require($templateParams["auctionLosing"]);
            }
        default:
            break;
        }
}

