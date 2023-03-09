<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_GET["path"])){
        $productOldImg = $_GET["path"];
        $productId = $_GET["id"];
        if($productOldImg === null){
            header("location: ../products.php");
            exit();
        }

        // Get values from user
        $productName = htmlspecialchars($_POST["productName"], ENT_QUOTES, 'UTF-8');
        $productPrize = htmlspecialchars($_POST["productPrize"], ENT_QUOTES, 'UTF-8');
        $productDescr = htmlspecialchars($_POST["productDescr"], ENT_QUOTES, 'UTF-8');
        $productImg = $_FILES['productImg'];

        include "../classes/dbh.classes.php";
        include "../classes/productedit.classes.php";
        include "../classes/productedit-contr.classes.php";

        $productEdit = new ProductEditCtrl();
        $productEdit->updateProduct($productName, $productPrize, $productDescr, $productImg, $productOldImg, $productId);

        header("location: ../products.php?product=edited");

    } else {
        header("location: ../products.php");
        exit();
    }

} else {
    header("location: ../products.php");
    exit();
}