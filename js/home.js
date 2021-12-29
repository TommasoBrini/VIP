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

function timer(year, month, day, time, id){
    var countDownDate = new Date(month + " " + day + ", " + year + " " + time + ":00").getTime();

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

/*
$("div.losing").ready(function(){
    $("button.raise").click(function(){
        $("button.second").replaceWith("<select class='raise' name='raise' id='raise'><option value='5'>5</option><option value='10'>10</option><option value='50'>50</option><option value='100'>100</option></select>");
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
*/
/*

$("div.aviable").ready(function(){
    $("button:nth-child(6)").click(function(){
        var quantity = $(this).attr("id");
        var select = "<select class='quantity' name='quantity' id='quantity'><option value='"+ quantity +"'>"+ quantity +"</option></select>";
        for(var i = 1; i<=quantity; i++){
            select = select + "<option value='"+ i +"'>"+ i +"</option>";
        }
        select += "</select>";
        $(this).replaceWith(select);
        $("button.last").replaceWith("<button class='last1 grey addCart'>ADD CART</button><button class='last2 grey back'>BACK</button>");


    })
});

function getTimer(year, month, day, hour, minute){

}
    
*/