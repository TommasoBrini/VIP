<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $templateParams["titolo"] ?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo $templateParams["css"] ?>" />
    <?php 
    if(isset($templateParams["js"])): ?>
    <script
    src="https://code.jquery.com/jquery-3.4.1.min.js"
    integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
    crossorigin="anonymous"></script>
    <script src="<?php echo $templateParams["js"]?>" type="text/javascript"></script>
    <?php endif; ?> 
</head>
<body class="<?php echo $templateParams["bg"] ?>">
    <header>
        <img src="<?php echo IMG_DIR?>VIP_logo.png" alt="Logo" onclick="window.location.href='index.php'"/>
        <img src="<?php echo IMG_DIR?>account.png" alt="Account" onclick="window.location.href='index_login.php'"/>
        <img src="<?php echo IMG_DIR?>cart.png" alt="Cart" onclick="window.location.href='index_cart.php'"/>
        <div class="slider">
            <?php
                if($templateParams["slider"]){
                    require("slider.php");
                }
            ?>
        </div>
    </header>
    <main class="products" id="products">
        <?php
            if(isset($templateParams["nome"])){
                require($templateParams["nome"]);
            }
        ?>
    </main>
    <footer>
        <h3><?php echo $_SESSION["email"];?></h3>
    </footer>
</body>
</html>