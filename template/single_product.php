<?php  
    $prodotto = $templateParams["prodotto"];
    $id = $prodotto["IDProdotto"];
?>

<form action='#' method='POST' enctype="multipart/form-data">
            <h1>SCHEDA PRODOTTO</h2>
            <ul>
                <li>
                <article>
                    <h2>Nome Prodotto</h2>
                    <p><?php echo $prodotto["Nome"]?></p>
                </article>
                </li>
                <?php if($templateParams["venditore"]): ?>
                <li>
                    <button type="button" onclick="window.location.href='index_gestione_product.php?action=2&id=<?php echo $id?>'">Modifica</button>
                </li>
                <?php endif; ?>
            </ul>
</form>
