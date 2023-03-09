<?php

class Products extends DbConn
{
    public function addProduct($productImg, $productName, $productPrize, $productDescr)
    {
        // Getting information about product picture
        $fileName = $productImg['name'];
        $fileTmpName = $productImg['tmp_name'];
        $fileSize = $productImg['size'];
        $fileError = $productImg['error'];
        $fileType = $productImg['type'];

        // Getting file extension
        $fileExt = explode('.', $fileName);
        $fileExt = strtolower(end($fileExt));

        // Creating array of allowed extensions
        $allowedExt = ['jpg', 'png', 'jpeg'];

        if (in_array($fileExt, $allowedExt)) {
            if ($fileError == 0) {
                if ($fileSize < 1000000) { // (1MB)
                    // Creating a new file with id
                    $imgName = 'photo-' . $productName . '-' . uniqid() . '.' . $fileExt;
                    $imgName = str_replace(" ", "", $imgName);
                    $fileDir = '../img/gallery/' . $imgName;
                    $fileNormDir = 'img/gallery/' . $imgName;

                    // Moving the file in folder
                    move_uploaded_file($fileTmpName, $fileDir);

                    // Creating SQL query to add file destionation to profiles database
                    $query = "INSERT INTO products (products_img_path, products_name, products_prize, products_descr) VALUES (?,?,?,?);";

                    // Connecting to the database and preparing statement
                    $stmt = $this->connect()->prepare($query);

                    // Execitung the statement and replacing question marks with variables (array)
                    if(!$stmt->execute([$fileNormDir, $productName, $productPrize, $productDescr])){
                        $stmt = null;
                        header("location: ../editprofile.php?stmt=failed");
                        exit();
                    }
                } 
                // Throw error if file is too big
                else {
                    header("location: ../product.php?error=fileSize");
                    exit();
                }
            }
        }
    }

    public function removeProduct($productId, $productImgPath)
    {
        unlink('../' . $productImgPath);

        // Creating SQL query to add file destionation to profiles database
        $query = "DELETE FROM products WHERE products_id = ?;";

        // Connecting to the database and preparing statement
        $stmt = $this->connect()->prepare($query);

        // Execitung the statement and replacing question marks with variables (array)
        if(!$stmt->execute([$productId])){
            $stmt = null;
            header("location: ../products.php?stmt=failed");
            exit();
        }
    }
}