<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php $templateParams["titolo"] ?></title>
    <link rel="stylesheet" type="text/css" href="./css/style.css" />
    <script
    src="https://code.jquery.com/jquery-3.4.1.min.js"
    integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
    crossorigin="anonymous"></script>
    <script src="<?php echo JS_DIR?>home.js" type="text/javascript"></script>
</head>
<body>
    <header>
        <img src="<?php echo IMG_DIR?>VIP_logo.png" alt="Logo" />
        <img src="<?php echo IMG_DIR?>account.png" alt="Account" />
        <img src="<?php echo IMG_DIR?>cart.png" alt="Cart" />
        <div class="slider">
            <button class="selected">ASTE</button><button class="unset">PRODOTTI</button>
        </div>
    </header>
    <main class="products" id="products">
        <?php
        require($templateParams["nome"]);
        ?>
    </main>
    <footer>
        <h3>QUESTO E' IL FOOTER DELLA PAGINA, AVRA' BISOGNO DI UN TESTO LUNGO PER POTER METTERE IL TESTO A CAPO.</h3>
    </footer>
</body>
</html>