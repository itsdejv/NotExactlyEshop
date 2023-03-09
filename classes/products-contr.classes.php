<?php

class ProductsCtrl extends Products
{
    function __construct()
    {

    }

    public function uploadProduct($productImg, $productName, $productPrize, $productDescr){
        // Check if user filled everything
        if($this->emptyInput($productImg, $productName, $productPrize, $productDescr) == false){
            header("location: ../products.php?error=emptyInput");
            exit();
        }

        $this->addProduct($productImg, $productName, $productPrize, $productDescr);

    }

    public function deleteProduct($productId, $productPath){
        $this->removeProduct($productId, $productPath);
    }


    // Check if user filled everything
    private function emptyInput($productImg, $productName, $productPrize, $productDescr){
        global $result;
        if(empty($productName) || empty($productImg['name']) || empty($productPrize) || empty($productDescr)){
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    // Check if name is correctly written
    private function checkFileName($productName){
        global $result;
        if(!preg_match('/^\p{L}+$/ui', $productName)){
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }
}