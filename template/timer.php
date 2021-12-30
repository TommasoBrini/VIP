<script type='text/javascript'>
    $( document ).ready(function(){
        
        if(<?php echo $asta["Stato"] ?> == 'FINISHED'){
            $("button#timer" + <?php echo $asta["IdProdotto"] ?>).replaceWith("<button class='timer' id='timer" +  id +"'>00:00:00</button>");
        } else {
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
    
                // Output the result in an element with id="demo"
                $("button#timer" + id).replaceWith("<button class='timer' id='timer" +  id +"'>" + hours + ":" + (minutes < 10 ? "0" + minutes : minutes) + ":" + (seconds < 10 ? "0" + seconds : seconds) + "</button>");  

                // If the count down is over, write some text 
                if (distance < 0) {
                    clearInterval(x);
                    if(state == 'BEFORE'){
                        newState = 'STARTED';
                    } else {
                        newState = 'AFTER';
                    }
                    $.ajax({
                        url: "js/home.php&f=updateAuctionState?id=" + id + "&state=" + newState,
                        type: "GET",
                        success: function(data){
    
                        }
                     });
    
                    document.location.reload(true);
                }
            }, 1000);
        }
        
        timer(<?php echo $asta["AnnoInizio"].", '".getMounth($asta["MeseInizio"])."', ".$asta["GiornoInizio"].", '".$asta["OraInizio"]."', ".$asta["IDProdotto"].", '".$asta["Stato"]."'"?>);
            var_dump($("button#timer"+id).val)
            if($("button#timer"+id).val == '00:00:00'){
                <?php if($asta["stato"] == 'BEFORE'){
                        $state = 'STARTED';
                    } else {
                        $state = 'AFTER';
                    }
                    $dbh->updateAuctionState($asta["IdProdotto"], $state);
                ?>
                document.location.reload(true);
            }
        });
</script>