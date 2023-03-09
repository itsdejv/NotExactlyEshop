<?php

class ProductEdit extends DbConn
{
    // Function to edit product
    protected function editProduct($productName, $productPrize, $productDescr, $productImg, $productId){
        // Creating SQL query
        $query = "UPDATE products SET products_name=?, products_prize=?, products_descr=? WHERE products_id = ?;";

        // connecting to the database and preparing statement
        $stmt = $this->connect()->prepare($query);

        // Execitung the statement and replacing question marks with variables (array)
        if(!$stmt->execute([$productName, $productPrize, $productDescr, $productId])){
            $stmt = null;
            header("location: ../editprofile.php?stmt=failed");
            exit();
        }

        // Checking if user made changes
        if($stmt->rowCount() == 0 & empty($productImg['name'])){
            $stmt = null;
            header("location: ../products.php?error=changes");
            exit();
        }

        $stmt = null;
    }

    public function editProductImg($productImg, $productOldImg, $productId){

        unlink('../' . $productOldImg);

        // Getting information about picture
        $fileName = $productImg['name'];
        $fileTmpName = $productImg['tmp_name'];
        $fileSize = $productImg['size'];
        $fileError = $productImg['error'];
        $fileType = $productImg['type'];

        // Getting file extension
        $fileExt = explode('.',$fileName);
        $fileExt = strtolower(end($fileExt));

        // Creating array of allowed extensions
        $allowedExt = ['jpg', 'png', 'jpeg'];

        if(in_array($fileExt, $allowedExt)){
            if($fileError == 0){
                if($fileSize < 1000000){  // (1MB)

                    // Creating a new file with user id
                    $imgName = 'product' . $productId . "." . $fileExt;
                    $fileDir = '../img/gallery/' . $imgName;
                    $fileNormDir = 'img/gallery/' . $imgName;

                    // Moving the file in folder
                    move_uploaded_file($fileTmpName, $fileDir);

                    // Creating SQL query to add file destionation to profiles database
                    $query = "UPDATE products SET products_img_path = ?";

                    // connecting to the database and preparing statement
                    $stmt = $this->connect()->prepare($query);

                    // Execitung the statement and replacing question marks with variables (array)
                    if(!$stmt->execute([$fileNormDir])){
                        $stmt = null;
                        header("location: ../products.php?stmt=failed");
                        exit();
                    }

                    $stmt = null;
                }
                else {
                    header("location: ../products.php?error=fileSize");
                    exit();
                }
            }
        } else {
            header("location: ../products.php?error=fileTypeImg");
            exit();
        }
    }
}