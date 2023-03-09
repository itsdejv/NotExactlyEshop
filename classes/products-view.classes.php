<?php

class ProductsView extends DbConn
{
    public function productsPrint(){
        $query = "SELECT * FROM products ORDER BY products_id";

        $stmt = $this->connect()->prepare($query);

        if(!$stmt->execute()){
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