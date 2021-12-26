<?php  
    $prodotto = $templateParams["prodotto"];
    $azione = getAction($templateParams["azione"]);
?>

        <form action='processa_prodotto.php' method='POST' enctype="multipart/form-data">
            <h2>ADMIN SETTING</h2>
            <section>
                <label for="checkbox">AUCTION:</label><input type="checkbox" id="checkbox" name="checkbox" 
                <?php if($templateParams["azione"]!=1 && !isset($prodotto["Disponibilita"])){
                    echo ' checked="checked" ';
                } ?>/>
            </section>
            <ul>
                <li>
                    <label for="Nome">Name:</label><input type="text" id="Nome" name="Nome" value="<?php echo $prodotto["Nome"]; ?>" />
                </li>
                <li>
                    <label for="Prezzo">Price (€):</label><input type="number" id="Prezzo" name="Prezzo" value="<?php echo floatval($prodotto["Prezzo"]); ?>" required="required"/>
                </li>
                <li>
                <label for="Base_asta">Base Price (€):</label><input type="number" id="Base_asta" name="Base_asta" value="<?php echo floatval($prodotto["Base_asta"]); ?>"/>
                </li>
                <li>
                    <label for="data">Date:</label><input type="date" id="data" name="data" />
                    <label for="time">Time:</label><input type="time" id="time" name="time" />
                </li>
                <li>
                    <label for="Disponibilita">Disponibilità:</label><input type="number" id="Disponibilita" name="Disponibilita" value="<?php echo floatval($prodotto["Disponibilita"]); ?>"/>
                </li>
                <li>
                    <?php if($templateParams["azione"]!=3): ?>
                    <label for="Immagine">Immagine Prodotto:</label><input type="file" id="Immagine" name="Immagine" accept="image/png , image/jpeg" /> 
                    <?php endif; ?>
                </li>
                <li>
                    <?php if($templateParams["azione"]!=1): ?>
                        <img src="data:image/jpeg;base64,<?php echo base64_encode($prodotto["Immagine"]);?>" id="imgshow" alt="prodotto"/>
                    <?php else: ?>
                    <img src="./img/account.png" id="imgshow" alt="prodotto"/>
                    <?php endif; ?>
                </li>
                <li>
                    <label for="Descrizione">Descrizione:</label><textarea type="text" id="Descrizione" name="Descrizione" required="required"><?php echo $prodotto["Descrizione"]; ?></textarea>
                </li>
                <li>
                    <label for="DescrizioneBreve">Descrizione Breve:</label><textarea type="text" id="DescrizioneBreve" name="DescrizioneBreve" required="required"><?php echo $prodotto["DescrizioneBreve"]; ?></textarea>
                </li>
                <li>
                    <input type="submit" id="insert" name="insert" value="<?php echo $azione; ?>"/>
                </li>
            </ul>
	    <input type="hidden" name="azione" value="<?php echo $templateParams["azione"]; ?>" /> 
        </form>
