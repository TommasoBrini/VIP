function hideElement(element){
    element.removeClass("selected");
    element.addClass("unset");
}

$(document).ready(function(){
    $("div.slider > button").click(function(){

        if($(this).hasClass("unset")){
            hideElement($("div.slider > button.selected"));
            $(this).removeClass("unset");
            $(this).addClass("selected");
        }
    });

    $("div.losing").ready(function(){
        $("button.raise").click(function(){
            $("button.second").replaceWith("<select class='raise' name='raise' id='raise'><option value'5'>5</option><option value='10'>10</option><option value='50'>50</option><option value='100'>100</option></select>");
            $("button.last1").replaceWith("<button class='last1 grey raise'>RAISE</button>");
            $("button.last2").replaceWith("<button class='last2 grey back'>BACK</button>");

            $("button.raise").click(function(){
                $("select.raise").replaceWith("<button class='green'>STAI VINCENDO</button>");
                $("button.last1").replaceWith("<button class='last1 grey raise'>RAISE</button>");
                $("button.last2").replaceWith("<button class='last2 grey'>BUY NOW</button>");
            });
            
            $("button.back").click(function(){
                $("select.raise").replaceWith("<button class='red second'>STAI PERDENDO</button>");
                $("button.last1").replaceWith("<button class='last1 grey raise'>RAISE</button>");
                $("button.last2").replaceWith("<button class='last2 grey'>BUY NOW</button>");
            })
        });
        
    });

    $("button.timer").ready(function(){
        var countDownDate = new Date("Dec 25, 2022 00:00:00").getTime();

        // Update the count down every 1 second
        var x = setInterval(function() {

        // Get today's date and time
                        var now = new Date().getTime();
                            
                        // Find the distance between now and the count down date
                        var distance = countDownDate - now;
                        
                        // Time calculations for days, hours, minutes and seconds
                        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                        var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                            
                        // Output the result in an element with id="demo"
                        $("button.timer").replaceWith("<button class='timer'>" + hours + ":" + minutes + ":" + seconds + "</button>");
                            
                        // If the count down is over, write some text 
                        if (distance < 0) {
                            clearInterval(x);
                            $(this).replaceWith("00:00:00");
                        }
                        }, 1000);
    });
    

});