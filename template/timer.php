<script type='text/javascript'>
        if("<?php echo $asta["Stato"] ?>" == "AFTER"){
            $("button#timer" + <?php echo $asta["IDProdotto"] ?>).replaceWith("<button class='timer' id='timer" +  <?php echo $asta["IDProdotto"] ?> +"'>00:00:00</button>");
        } else {
            var countDownDate = null;
            <?php $nextState = "";?>

            if("<?php echo $asta["Stato"] ?>" == "BEFORE") {
                countDownDate = new Date("<?php echo getMounth($asta["MeseInizio"])." ".$asta["GiornoInizio"].", ".$asta["AnnoInizio"]." ".$asta["OraInizio"].":00" ?>").getTime();
            } else if("<?php echo $asta["Stato"] ?>" == "STARTED"){
                countDownDate = new Date("<?php echo getMounth($asta["MeseFine"])." ".$asta["GiornoFine"].", ".$asta["AnnoFine"]." ".$asta["OraFine"].":00" ?>").getTime();
            }
            
            <?php if($asta["Stato"] == "BEFORE"){
                    $nextState = "STARTED";
            } 
            if($asta["Stato"] == "STARTED") {
                $nextState = "AFTER";
            }   ?>
            // Update the count down every 1 second
            var x = setInterval(function() {

                // Get today's date and time
                var now = new Date().getTime();
                                
                // Find the distance between now and the count down date
                var distance = countDownDate - now;
    
                // Time calculations for hours, minutes and seconds
                var hours = Math.floor(distance / (1000 * 60 * 60));
                var minutes = Math.floor((distance / (1000 * 60 * 60) - hours) * 60);
                var seconds = Math.floor((((distance / (1000 * 60 * 60) - hours) * 60) - minutes) * 60);

                hours < 10 ? hours = '0'+hours : hours = hours;
                minutes < 10 ? minutes = '0'+minutes : minutes = minutes;
                seconds < 10 ? seconds = '0'+seconds : seconds = seconds;

                // Output the result in an element with id="demo"
                $("<?php echo "button#timer".$asta["IDProdotto"] ?>").replaceWith("<?php echo "<button class='timer' id='timer".$asta["IDProdotto"]."'>" ?>" + hours + ":" + minutes + ":" + seconds + "</button>");  

                // If the count down is over, write some text 
                if (distance < 0) {
                    clearInterval(x);
                    <?php
                        $dbh->updateAuctionState($asta["IDProdotto"], $nextState);
                    ?>
                    document.location.reload(true);
                }
            }, 1000);
        }
</script>