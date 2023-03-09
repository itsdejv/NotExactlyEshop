<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Get values
    $productId = htmlspecialchars($_POST["productId"], ENT_QUOTES, 'UTF-8');
    $productPath = htmlspecialchars($_POST["productPath"], ENT_QUOTES, 'UTF-8');

    // Proccess
    include "../classes/dbh.classes.php";
    include "../classes/products.classes.php";
    include "../classes/products-contr.classes.php";

    $productCtrl = new ProductsCtrl();
    $productCtrl->deleteProduct($productId, $productPath);

    header("location: ../products.php?product=deleted");
} else {
    header("location: ../gallery.php");
}