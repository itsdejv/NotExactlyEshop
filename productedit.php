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
                    <form class="form-group" action="includes/productedit.inc.php?path=<?php echo $singleProduct["products_img_path"]?>&id=<?php echo $singleProduct["products_id"]?>" method="post" enctype='multipart/form-data'>
                        <img src="<?php echo $singleProduct["products_img_path"] ?>" style="width: 150px; height: 150px" alt=""><br>
                        <input class="form-control" type="file" name="productImg" value=""><br>
                        <input class="form-control" type="text" name="productName" placeholder="Name of the product" value="<?php echo $singleProduct["products_name"] ?>"><br>
                        <input class="form-control" type="text" name="productPrize" placeholder="Prize of the product" value="<?php echo $singleProduct["products_prize"] ?>"><br>
                        <textarea class="form-control" type="text" name="productDescr" placeholder="Description of the product" value="<?php echo $singleProduct["products_descr"] ?>"><?php echo $singleProduct["products_descr"] ?></textarea><br>
                        <input type="submit" value="Edit product info" name="submit" class="btn btn-success mb-2">
                    </form>
                    <form action="includes/productsremove.inc.php" method="post">
                        <input type="hidden" name="productId" value="<?php echo $singleProduct['products_id'] ?>">
                        <input type="hidden" name="productPath" value="<?php echo $singleProduct['products_img_path'] ?>">
                        <?php 
                        if(isset($_SESSION["adminStatus"])){
                            if($_SESSION["adminStatus"] === 1) { ?>
                                <input type="submit" value="Delete" class="btn btn-danger mb-2">
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

