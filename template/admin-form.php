<?php  
    $prodotto = $templateParams["prodotto"];
?>

        <form action='processa_prodotto.php' method='POST'>
            <h2>ADMIN SETTING</h2>
            <section>
                <label for="checkbox">AUCTION:</label><input type="checkbox" id="checkbox" name="checkbox" />
            </section>
            <ul>
                <li>
                    <label for="Nome">Name:</label><input type="text" id="Nome" name="Nome" value="<?php echo $prodotto["Nome"]; ?> " />
                </li>
                <li>
                    <label for="Prezzo">Price (€):</label><input type="text" id="Prezzo" name="Prezzo" value="<?php echo $prodotto["Prezzo"]; ?> "/>
                </li>
                <li>
                <label for="Base_asta">Base Price (€):</label><input type="text" id="Base_asta" name="Base_asta" value="<?php echo $prodotto["Base_asta"]; ?> "/>
                </li>
                <li>
                    <label for="data">Date:</label><input type="date" id="data" name="data" />
                    <label for="time">Time:</label><input type="time" id="time" name="time" />
                </li>
                <li>
<<<<<<< HEAD
                    <label for="Disponibilita">Disponibilità:</label><input type="text" id="Disponibilita" name="Disponibilita" value="<?php echo $prodotto["Disponibilita"]; ?> "/>
=======
                    <label for="disponibilità">Disponibilità:</label><input type="text" id="disponibilità" name="disponibilità" value="<?php echo $prodotto["Disponibilita"]; ?> "/>
>>>>>>> 64e690c866c7836797970b72a2ef52aedb8d9623
                </li>
                <li>
                    <label for="Immagine">Immagine Prodotto:</label><input type="file" id="Immagine" name="Immagine" accept="image/png , image/jpeg" /> 
                </li>
                <li>
                    <img src="./img/account.png" id="imgshow" alt="prodotto"/>
                </li>
                <li>
                    <label for="Descrizione">Descrizione:</label><textarea type="text" id="Descrizione" name="Descrizione"><?php echo $prodotto["Descrizione"]; ?></textarea>
                </li>
                <li>
                    <label for="DescrizioneBreve">Descrizione Breve:</label><textarea type="text" id="DescrizioneBreve" name="DescrizioneBreve"><?php echo $prodotto["DescrizioneBreve"]; ?></textarea>
                </li>
                <li>
                    <input type="submit" id="insert" name="insert" value="<?php echo $templateParams["azione"]; ?>">
                </li>
            </ul> 
        </form>
