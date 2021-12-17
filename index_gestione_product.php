<?php
require_once("bootstrap.php");

$templateParams["titolo"] = "VIP - Add Product";
$templateParams["nome"] = "admin-form.php";
$templateParams["bg"] = "white";
$templateParams["slider"] = FALSE;
<<<<<<< HEAD:index_gestione_product.php
$templateParams["prodotto"] = getEmptyProduct();
=======
$templateParams["prodotto"] = $dbh -> getProductById("1");
>>>>>>> tommaso:index_add_product.php

define("JS_DIR", "./js/add_product.js");

require("template/base.php");
?>