<h1>NEWS</h1>
<table>
    <?php if(isset($templateParams["NoNews"])): ?>
        <p class="noOrder">Non hai news da leggere. Continua a fare acquisti sul nostro sito, a più tardi!</p>
    <?php else: ?>
    <thead>
        <tr>
            <th id="date">DATE</th>
            <th id="testo">TEXT</th>
            <th id="ref">PRODUCT</th>
            <th> </th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($templateParams["notify"] as $news): ?>
        <tr class="border_bottom">
        <td id="date" class="cell_date"><?php echo date("Y-m-d", time())?></td>
        <td id="testo" class="cell_testo"><?php echo $news["Text"]?></td>
        <td id="ref" classe="cell_ref"><?php if(!isset($news["IdOrdine"])):?>
                <a href="./index_single_product.php?id=<?php if(isset($news["IdAsta"])){
                        echo $news["IdAsta"];
                    } else {
                        echo $news["IDProdotto"];
                    }?>">VEDI PRODOTTO</a>
                <?php endif; ?>
        </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
    <?php endif; ?>
</table>

<!-- $news["TimeStamp"] -->