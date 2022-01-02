<?php foreach($templateParams["auctions"] as $asta){ 
    $date = new DateTime();
    $start = $asta["AnnoInizio"]."-".$asta["MeseInizio"]."-".$asta["GiornoInizio"]." ".$asta["OraInizio"].":00";
    $startDate = new DateTime($start);
    $end = $asta["AnnoFine"]."-".$asta["MeseFine"]."-".$asta["GiornoFine"]." ".$asta["OraFine"].":00";
    $endDate = new DateTime($end);

    if($date->getTimeStamp() < $startDate->getTimeStamp()){
        require($templateParams["auctionBefore"]);
    } else if($date->getTimeStamp() < $endDate->getTimeStamp()){
        if(!isset($templateParams["auctionWinning"])){
            require($templateParams["auctionWinning"]);
        } else {
            require($templateParams["auctionLosing"]);
        }
    } else {
        if($asta["CodVincitore"] != NULL){
            require($templateParams["auctionLose"]);
        } else {
            require($templateParams["auctionWin"]);
        }
    }
    /*
    switch($asta["Stato"]){
        case "BEFORE":
            if(isset($templateParams["auctionBefore"])){
                require($templateParams["auctionBefore"]);
            }
            break; 
        case "AFTER":
            if($asta["CodVincitore"] != NULL){
                require($templateParams["auctionLose"]);
            } else {
                require($templateParams["auctionWin"]);
            }
            break;
        case "STARTED":
            if(!isset($templateParams["auctionWinning"])){
                require($templateParams["auctionWinning"]);
            } else {
                require($templateParams["auctionLosing"]);
            }
        default:
            break;
    }
    */
}

