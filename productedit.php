<!-- INCLUDING HEADER -->
<?php
include "skeleton/header.php";

if(isset($_SESSION["adminStatus"])){
    if($_SESSION["adminStatus"] === 1 ) { 
        if(isset($_GET["id"])){
            $productId = $_GET["id"];
            
            // Checking if searched product has a valid id
            if($productId == null){
                header("location: products.php?error=productnotfound");
            }
        
            // Product proccess
            include "classes/dbh.classes.php";
            include "classes/singleproduct-view.classes.php";
        
            $singleProductView = new SingleProductView();
            $singleProductResult = $singleProductView->printSingleProduct($productId);

            foreach($singleProductResult as $singleProduct) {?>
                <!-- MAIN SECTION -->
                <main>
                    <form action="includes/productedit.inc.php?path=<?php echo $singleProduct["products_img_path"]?>&id=<?php echo $singleProduct["products_id"]?>" method="post" enctype='multipart/form-data'>
                        <img src="<?php echo $singleProduct["products_img_path"] ?>" style="width: 50px; height: 50px" alt=""><br>
                        <input type="file" name="productImg" value=""><br>
                        <input type="text" name="productName" placeholder="Name of the product" value="<?php echo $singleProduct["products_name"] ?>"><br>
                        <input type="text" name="productPrize" placeholder="Prize of the product" value="<?php echo $singleProduct["products_prize"] ?>"><br>
                        <input type="text" name="productDescr" placeholder="Description of the product" value="<?php echo $singleProduct["products_descr"] ?>"><br>
                        <input type="submit" value="Edit product info" name="submit">
                    </form>
                    <form action="includes/productsremove.inc.php" method="post">
                        <input type="hidden" name="productId" value="<?php echo $singleProduct['products_id'] ?>">
                        <input type="hidden" name="productPath" value="<?php echo $singleProduct['products_img_path'] ?>">
                        <?php 
                        if(isset($_SESSION["adminStatus"])){
                            if($_SESSION["adminStatus"] === 1) { ?>
                                <input type="submit" value="Delete">
                            <?php }
                        } ?>
                    </form>
                </main>
            <?php }
        }
    } else {
        header("location: products.php");
    }
} else {
    header("location: products.php");
}

