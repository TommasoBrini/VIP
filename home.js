const productWin = "<div class='product win'><img class='img' src='./img/occhiali.jpg' alt='product photo'/><div class='topright'><button class='timer'>00:00</button><textarea readonly class='description'>Breve descrizione del prodotto</textarea></div><button class='green'>€ 59.500.000,00</button><button class='green'>HAI VINTO!</button><button class='last green'>VEDI IL PRODOTTO</button></div>";

const productLose ="<div class='product lose'><img class='img' src='./img/occhiali.jpg' alt='product photo'/><div class='topright'><button class='timer'>00:00</button><textarea readonly class='description'>Breve descrizione del prodotto</textarea></div><button class='red'>€ 59.500.000,00</button><button class='red'>HAI PERSO!</button><button class='last red'>VEDI IL PRODOTTO</button></div>";

const productBefore ="<div class='product before'><img class='img' src='./img/occhiali.jpg' alt='product photo'/><div class='topright'><button class='timer'>15:00</button><textarea readonly class='description'>Breve descrizione del prodotto</textarea></div><button class='grey'>€ 59.500.000,00</button><button class='grey'>INIZIERA' A BREVE</button><button class='last grey'>VEDI IL PRODOTTO</button></div>";

const productLosing ="<div class='product before'><img class='img' src='./img/occhiali.jpg' alt='product photo'/><div class='topright'><button class='timer'>02:32</button><textarea readonly class='description'>Breve descrizione del prodotto</textarea></div><button class='yellow'>€ 59.500.000,00</button><button class='red'>PUOI RILANCIARE</button><button class='last1 grey'>RAISE</button><button class='last2 grey'>BUY NOW</button></div>";

const productWinning ="<div class='product before'><img class='img' src='./img/occhiali.jpg' alt='product photo'/><div class='topright'><button class='timer'>04:20</button><textarea readonly class='description'>Breve descrizione del prodotto</textarea></div><button class='yellow'>€ 59.500.000,00</button><button class='green'>STAI VINCENDO</button><button class='last1 grey unable'>RAISE</button><button class='last2 grey'>BUY NOW</button></div>";

const productBuyNow ="<div class='product before'><img class='img' src='./img/occhiali.jpg' alt='product photo'/><div class='topright'><button class='timer'>04:20</button><textarea readonly class='description'>Breve descrizione del prodotto</textarea></div><button class='yellow'>€ 99.999.999,00</button><button class='yellow'>SICURO?</button><button class='last1 grey'>YES</button><button class='last2 grey'>NO</button></div>";

const productRaise ="<div class='product before'><img class='img' src='./img/occhiali.jpg' alt='product photo'/><div class='topright'><button class='timer'>04:20</button><textarea readonly class='description'>Breve descrizione del prodotto</textarea></div><button class='yellow'>€ 59.500.000,00</button><select class='raise' name='raise' id='raise'><option value'5'>5</option><option value='10'>10</option><option value='50'>50</option><option value='100'>100</option></select><button class='last1 grey'>RAISE</button><button class='last2 grey'>BACK</button></div>";

function hideElement(element){
    element.removeClass("selected");
    element.addClass("unset");
}

function loadProduct(){
    for($i=0; $i<5; $i++){
        $("nav#products").append(productWin);
        $("nav#products").append(productLose);
        $("nav#products").append(productBefore);
        $("nav#products").append(productLosing);
        $("nav#products").append(productWinning);
        $("nav#products").append(productBuyNow);
        $("nav#products").append(productRaise);        
    }
}

$(document).ready(function(){
    loadProduct();

    $("div.slider > button").click(function(){

        if($(this).hasClass("unset")){
            hideElement($("div.slider > button.selected"));
            $(this).removeClass("unset");
            $(this).addClass("selected");
        }
    });
    

});