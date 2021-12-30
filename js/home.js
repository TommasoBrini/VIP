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
});

function selectClick(e) {
    if (!e) e = window.event;
    e.stopPropagation();
}

function timer(year, month, day, time, id, state){
    var countDownDate = new Date(month + " " + day + ", " + year + " " + time + ":00").getTime();
        if(state == 'FINISHED'){
            
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
                    $("button#timer" + id).replaceWith("<button class='timer' id='timer" +  id +"'>00:00:00</button>");
                }
            }, 1000);
        }
}
