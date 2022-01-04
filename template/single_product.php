<?php  
    $prodotto = $templateParams["prodotto"];
    $id = $prodotto["IDProdotto"];
?>

<form action='#' method='POST' enctype="multipart/form-data">
    <h1><?php echo strtoupper($prodotto["Nome"]);?></h1>
    <section>
        <ul>
            <li>
            <img src="<?php echo UPLOAD_DIR.$prodotto["Immagine"];?>" id="imgshow" alt="prodotto"/>
            </li>
            <li>
                <button>bottone1</button>
            </li>            
            <li>
                <button>bottone2</button>
            </li>
            <li>
                <button>bottone3</button>
            </li>
            <li>
                <button>bottone4</button>
            </li>
        </ul>
        
    </section>
    <section>
        <h2>DESCRIZIONE</h2>
        <textarea name="descrizione" id="descrizione" cols="30" rows="10" readonly><?php echo $prodotto["Descrizione"]; ?></textarea>
    </section>
    
    
    
    
    
    
    
    
    
    <?php if($templateParams["venditore"]): ?>
    <div>
        <button type="button" onclick="window.location.href='index_gestione_product.php?action=2&id=<?php echo $id?>'">Modifica</button>
        <button type="button" onclick="window.location.href='index_gestione_product.php?action=3&id=<?php echo $id?>'">Elimina</button>
    </div>
        
    <?php endif; ?>
</form>
