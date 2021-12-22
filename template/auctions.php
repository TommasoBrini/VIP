<?php foreach($templateParams["auctions"] as $asta): 
    switch($asta["Stato"]):
        case "BEFORE":?>
            <div class='auction before'>
                <header>
                    <label for="title"><?php echo $asta["Nome"]?></label>
                </header>
                <img class='img' src='data:image/jpeg;base64,<?php echo base64_encode($asta["Immagine"]);?>' alt='product photo'/>
                <div class='topright'>
                    <button class="timer"></button>
                    <textarea readonly class='description'><?php echo $asta["DescrizioneBreve"];?></textarea>
                </div>
                <button class='grey'><?php echo number_format($asta["Prezzo"]);?> €</button>
                <button class='grey'>INIZIERA' A BREVE</button>
                <button class='last grey'>VEDI IL PRODOTTO</button>
            </div>
            <?php
            break; 
        
        case "FINITA":
            if($asta["OraFine"] == 20):?>
            <div class='auction win'>
                <header>
                    <label for="title"><?php echo $asta["Nome"]?></label>
                </header>
                <img class='img' src='data:image/jpeg;base64,<?php echo base64_encode($asta["Immagine"]);?>' alt='product photo'/>
                <div class='topright'>
                    <button class='timer'>00:00</button>
                    <textarea readonly class='description'><?php echo $asta["DescrizioneBreve"];?></textarea>
                </div>
                <button class='green'><?php echo number_format($asta["Prezzo"]);?> €</button>
                <button class='green'>HAI VINTO!</button>
                <button class='last green'>VEDI IL PRODOTTO</button>
            </div>
            <?php
            else:
            ?>
                <div class='auction lose'>
                    <header>
                        <label for="title"><?php echo $asta["Nome"]?></label>
                    </header>
                    <img class='img' src='data:image/jpeg;base64,<?php echo base64_encode($asta["Immagine"]);?>' alt='product photo'/>
                    <div class='topright'>
                        <button class='timer'>00:00</button>
                        <textarea readonly class='description'><?php echo $asta["DescrizioneBreve"];?></textarea>
                    </div>
                    <button class='red'><?php echo number_format($asta["Prezzo"]);?> €</button>
                    <button class='red'>HAI PERSO!</button>
                    <button class='last red'>VEDI IL PRODOTTO</button>
                </div>
            <?php
            endif;
            break;
        case "INIZIATA":?>
            <div class='auction losing'>
                <header>
                    <label for="title"><?php echo $asta["Nome"]?></label>
                </header>
                <img class='img' src='data:image/jpeg;base64,<?php echo base64_encode($asta["Immagine"]);?>' alt='product photo'/>
                <div class='topright'>
                    <button class='timer'>02:32</button>
                    <textarea readonly class='description'><?php echo $asta["DescrizioneBreve"];?></textarea>
                </div>
                <button class='yellow'><?php echo number_format($asta["Prezzo"]);?> €</button>
                <button class='red second'>PUOI RILANCIARE</button>
                <button class='last1 grey raise'>RAISE</button><button class='last2 grey'>BUY NOW</button>
            </div>
            <?php
            break;
        default:
            break;?>
    <?php endswitch;
endforeach; ?>