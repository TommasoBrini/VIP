<?php 
    foreach($templateParams["prodotto"] as $prodotto): 
?>

        <form action='#' method='POST'>
            <h2>INSERT PRODUCT</h2>
            <section>
                <label for="checkbox">AUCTION:</label><input type="checkbox" id="checkbox" name="checkbox" />
            </section>
            <ul>
                <li>
                    <label for="name">Nome:</label><input type="text" id="name" name="name" value="<?php echo $prodotto["Nome"]; ?> " />
                </li>
                <li>
                    <label for="prezzo">Prezzo (€):</label><input type="text" id="prezzo" name="prezzo" value="<?php echo $prodotto["Prezzo"]; ?> "/>
                </li>
                <li>
                <label for="base">Base Asta (€):</label><input type="text" id="base" name="base" value="<?php echo $prodotto["BaseAsta"]; ?> "/>
                </li>
                <li>
                    <label for="data">Date:</label><input type="date" id="data" name="data" />
                    <label for="time">Time:</label><input type="time" id="time" name="time" />
                </li>
                <li>
                    <label for="disponibilità">Disponibilità:</label><input type="text" id="disponibilità" name="disponibilità" value="<?php echo $prodotto["Disponibilita"]; ?> "/>
                </li>
                <li>
                    <label for="immagine">Immagine Prodotto:</label><input type="file" id="immagine" name="immagine" accept="image/png , image/jpeg" /> 
                </li>
                <li>
                    <img src="./img/account.png" id="imgshow" alt="prodotto"/>
                </li>
                <li>
                    <label for="descrizione">Descrizione:</label><textarea type="text" id="descrizione" name="descrizione"><?php echo $prodotto["Descrizione"]; ?></textarea>
                </li>
                <li>
                    <label for="descrizioneBreve">Descrizione Breve:</label><textarea type="text" id="descrizioneBreve" name="descrizioneBreve"><?php echo $prodotto["DescrizioneBreve"]; ?></textarea>
                </li>
                <li>
                    <input type="submit" id="insert" name="insert" value="INSERT">
                </li>
            </ul> 
        </form>
    
<?php
endforeach; ?>