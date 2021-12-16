        <form action='#' method='POST'>
           <h2>INSERT PRODUCT</h2>
            <section>
                <label for="tipoProdotto">AUCTION:</label><input type="checkbox" id="checkbox" name="checkbox" />
            </section>
            <div class="inline first">
                <div>
                    <section class="inline">
                        <label for="name">Nome:</label><input type="text" id="name" name="name" />
                    </section>    
                    <section class="inline">
                        <label for="prezzo">Prezzo (€):</label><input type="text" id="prezzo" name="prezzo" />
                    </section>
                    <section class="inline">
                        <label for="base">Base Asta (€):</label><input type="text" id="base" name="base" />
                    </section>
                    <section class="inline">
                        <label for="data">Date:</label><input type="date" id="start" name="start" />
                    </section>
                    <section class="inline">
                        <label for="time">Time:</label><input type="time" id="time" name="time" />
                    </section>
                    <section class="inline">
                        <label for="disponibilità">Disponibilità:</label><input type="text" id="disponibilità" name="disponibilità" />
                    </section>
                </div>
                <section>
                    <label for="immagine">Immagine Prodotto:</label><input type="file" id="immagine" name="immagine" accept="image/png , image/jpeg" /> 
                </section>
            </div>
            <div class="inline immagine">
                <img src="./img/prodotto.png" id="imgshow" alt="prodotto"/>
            </div>
            <section>
                <label for="descrizione">Descrizione:</label>
                <textarea type="text" id="descrizione" name="descrizione"></textarea>
            </section>
            <div>
                <input type="submit" id="insert" name="insert" value="INSERT">
            </div>
        </form>
    