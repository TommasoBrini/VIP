<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $templateParams["titolo"] ?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo $templateParams["css"] ?>" />
    <script
    src="https://code.jquery.com/jquery-3.4.1.min.js"
    integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
    crossorigin="anonymous"></script>
    <?php if(isset($templateParams["js"])): ?>
    <script src="<?php echo $templateParams["js"]?>" type="text/javascript"></script>
    <?php endif; ?> 
</head>
<body class="<?php echo $templateParams["bg"] ?>">
    <header>
        <img src="<?php echo IMG_DIR?>VIP_logo.png" alt="Logo" onclick="window.location.href='index.php'"/>
        <?php 
        if(isset($_SESSION['email'])){
            echo '<img src="'.IMG_DIR.'logout.png" alt="Log-out" onclick="logout()"/>';
            if(!$templateParams["notifica"]){
                echo '<img src="'.IMG_DIR.'notifica0.png" alt="Pannello Notifiche" onclick="window.location.href='."'index_notify.php'".'"/>';
            } else{
                echo '<img src="'.IMG_DIR.'notifica1.png" alt="Pannello Notifiche" onclick="window.location.href='."'index_notify.php'".'"/>';
            }
            
        } else {
            echo '<img src="'.IMG_DIR.'account.png" alt="Log-in" onclick="window.location.href='."'index_login.php'".'"/>';
            echo '<img src="'.IMG_DIR.'notifica0.png" alt="Pannello Notifiche" onclick="window.location.href='."'index_login.php'".'"/>';
        }
        if($dbh->checkSeller()){
            echo '<img src="'.IMG_DIR.'add.png" alt="Add product" onclick="window.location.href='."'index_gestione_product.php?action=1'".'"/>';
        } else {
            echo '<img src="'.IMG_DIR.'cart.png" alt="Cart" onclick="window.location.href='."'index_cart.php'".'"/>';
        }?>
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
        <h3><?php echo isset($_SESSION["email"]) ? $_SESSION["email"] : "Register or login to buy or raise.";?></h3>
    </footer>
    <?php require($templateParams["logout"]);?>
</body>
</html>
