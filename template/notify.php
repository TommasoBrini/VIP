<h1>NEWS</h1>
<table>
    <?php if(isset($templateParams["NoNews"])): ?>
        <p class="noOrder">Non hai news da leggere. Continua a fare acquisti sul nostro sito, a più tardi!</p>
    <?php else: ?>
    <thead>
        <tr>
            <th id="date">DATE</th>
            <th id="testo">TEXT</th>
            <th> </th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($templateParams["notify"] as $news): ?>
        <tr class="border_bottom">
        <td id="date" class="cell_date"><?php echo $news["TimeStamp"]?></td>
        <td id="testo" class="cell_testo"><?php echo $news["Text"]?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
    <?php endif; ?>
</table>
