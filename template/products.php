<?php
    foreach($templateParams["products"] as $product){
        if($product["Disponibilita"] == 0){
            if(isset($templateParams["productSoldOut"])){
                require($templateParams["productSoldOut"]);
            }
        } else {
            if(isset($templateParams["productAviable"])){
                require($templateParams["productAviable"]);
            }
        } 
    }
?>