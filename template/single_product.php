<?php  
    $prodotto = $templateParams["prodotto"];
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
            </ul>
</form>
