<?php foreach($templateParams["auctions"] as $asta){
    $date = new DateTime();
    $start = $asta["AnnoInizio"]."-".$asta["MeseInizio"]."-".$asta["GiornoInizio"]." ".$asta["OraInizio"].":00";
    $startDate = new DateTime($start);
    $end = $asta["AnnoFine"]."-".$asta["MeseFine"]."-".$asta["GiornoFine"]." ".$asta["OraFine"].":00";
    $endDate = new DateTime($end);
    

    if($date->getTimeStamp() < $startDate->getTimeStamp()){
        require($templateParams["auctionBefore"]);
    } else if($date->getTimeStamp() < $endDate->getTimeStamp()){
        if($asta["CodCliente"] == NULL || $asta["CodCliente"] != $_SESSION["email"]){
            require($templateParams["auctionLosing"]);
        } else {
            require($templateParams["auctionWinning"]);
        }
    } else {
        if($asta["CodVincitore"] == $_SESSION["email"]){
            require($templateParams["auctionWin"]);
        } else {
            require($templateParams["auctionLose"]);
        }
    }
}
?>
