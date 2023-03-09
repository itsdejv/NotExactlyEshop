<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Get values from user
    $productImg = $_FILES['productImg'];
    $productName = htmlspecialchars($_POST["productName"], ENT_QUOTES, 'UTF-8');
    $productPrize = htmlspecialchars($_POST["productPrize"], ENT_QUOTES, 'UTF-8');
    $productDescr = htmlspecialchars($_POST["productDescr"], ENT_QUOTES, 'UTF-8');

    // Proccess
    include "../classes/dbh.classes.php";
    include "../classes/products.classes.php";
    include "../classes/products-contr.classes.php";

    $productCtrl = new ProductsCtrl();
    $productCtrl->uploadProduct($productImg, $productName, $productPrize, $productDescr);

    header("location: ../products.php?product=uploaded");

} else {
    header("location: ../products.php");
}