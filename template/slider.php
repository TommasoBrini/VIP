<button class="<?php 
    if($templateParams["class1"]) {
        echo "selected";   
    } else {
        echo "unset";
    }
    ?>" onclick="<?php echo "window.location.href='".$templateParams["href1"]."'"; ?>"><?php echo $templateParams["button1"] ?></button><button class="<?php 
    if($templateParams["class2"]){
        echo "selected";   
    } else {
        echo "unset";
    }
    ?>" onclick="<?php echo "window.location.href='".$templateParams["href2"]."'"; ?>"><?php echo $templateParams["button2"] ?></button>