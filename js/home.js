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