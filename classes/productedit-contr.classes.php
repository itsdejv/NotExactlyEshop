<?php

class ProductEditCtrl extends ProductEdit
{

    public function updateProduct($productName, $productPrize, $productDescr, $productImg, $productOldImg, $productId){
        // Check if inputs are empty
        if($this->emptyInput($productName, $productPrize, $productDescr, $productImg) == false){
            header("location: ../editprofile.php?error=emptyInput");
            exit();
        }

        // Editing the product
        $this->editProduct($productName, $productPrize, $productDescr, $productImg, $productId);

        if(!empty($productImg['name'])){
            $this->editProductImg($productImg, $productOldImg, $productId);
        }
    }

    // Creating function to check if inputs are empty or not
    private function emptyInput($productName, $productPrize, $productDescr, $productImg){
        global $result;
        if(empty($productName) || empty($productPrize) || empty($productDescr) || empty($productImg)){
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

}