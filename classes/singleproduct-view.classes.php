<?php

class SingleProductView extends DbConn
{

    public function printSingleProduct($productId){
        $query = "SELECT * FROM products WHERE products_id = ?;";

        $stmt = $this->connect()->prepare($query);

        if(!$stmt->execute([$productId])){
            $stmt = null;
            header("products.php?stmt=failed");
            exit();
        }

        if($stmt->rowCount() > 0){
            return $stmt;
        } else{
            return false;
        }
    }
}