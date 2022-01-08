<?php foreach($templateParams["auctions"] as $asta){
    $date = new DateTime();
    $oneWeekAgo = new DateTime();
    date_sub($oneWeekAgo, date_interval_create_from_date_string('7 days'));
    $start = $asta["AnnoInizio"]."-".$asta["MeseInizio"]."-".$asta["GiornoInizio"]." ".$asta["OraInizio"].":00";
    $startDate = new DateTime($start);
    $end = $asta["AnnoFine"]."-".$asta["MeseFine"]."-".$asta["GiornoFine"]." ".$asta["OraFine"].":00";
    $endDate = new DateTime($end);
    if($date->getTimeStamp() < $startDate->getTimeStamp()){
        require($templateParams["auctionBefore"]);
    } else if(($date->getTimeStamp() < $endDate->getTimeStamp()) && $asta['CodVincitore'] == NULL){
        if($asta["CodCliente"] == NULL || (isset($_SESSION["email"]) ? $asta["CodCliente"] != $_SESSION["email"] : TRUE)){
            require($templateParams["auctionLosing"]);
        } else {
            require($templateParams["auctionWinning"]);
        }
    } else {
        if($asta["CodVincitore"] == NULL){
            $vincitore = $dbh->setWinner($asta["IdAsta"]);
            if($vincitore != NULL){
                $asta["CodVincitore"]=$vincitore;
            }
        }
        if($endDate->getTimeStamp() > $oneWeekAgo->getTimeStamp()){
            if(((isset($_SESSION["email"]) ? $asta["CodVincitore"] == $_SESSION["email"] : FALSE)) || ($asta['CodVincitore'] == NULL && $dbh->checkSeller())){
                require($templateParams["auctionWin"]);
            } else {
                require($templateParams["auctionLose"]);
            }
        }
    }
}
?>
