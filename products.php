<!-- INCLUDING HEADER -->
<?php
include "skeleton/header.php";
?>

<!-- MAIN SECTION -->
<main>
<section class="section-products">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-md-8 col-lg-6">
                <div class="header">
                    <h3>Not Exactly Eshop</h3>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- Single Product -->
            <?php

            include "classes/dbh.classes.php";
            include "classes/products-view.classes.php";

            $productsView = new ProductsView();
            $productsResult = $productsView->productsPrint();

            if($productsResult){
                foreach ($productsResult as $singleProduct){ ?>
                <div class="col-6 col-md-6 col-lg-4 col-xl-3">
                    <div class="single-product">
                        <a href="singleproduct.php?id=<?php echo $singleProduct['products_id'] ?>" class="product-link">
                            <div class="part-1">
                                <div class="product-image" style="background-image: url(<?php echo $singleProduct['products_img_path'] ?>);">
                                </div>
                            </div>
                            <div class="part-2">
                                <h3 class="product-title"><?php echo $singleProduct['products_name'] ?></h3>
                                <h4 class="product-price"><?php echo $singleProduct['products_prize'] ?> Kč</h4>
                            </div>
                        </a>
                    </div>
                </div> <?php
                }
            } else {
                echo "There are no products!";
            }?>
            <?php if(isset($_SESSION["adminStatus"])){
                if($_SESSION["adminStatus"] === 1) { ?>
                    <div class="col-6 col-md-6 col-lg-4 col-xl-3">
                        <div class="single-product"  data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                            <div class="single-product">
                                <div class="d-flex flex-column justify-content-center align-items-center part-1 product-add-button">
                                    <h1>+</h1>
                                </div>
                                <div class="part-2">
                                    <h3 class="product-title">New Product</h3>
                                    <h4 class="product-price">add new product!</h4>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">Add new product</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="includes/products.inc.php" method="post" enctype='multipart/form-data'>
                                            <input class="form-control" type="file" name="productImg"><br>
                                            <input class="form-control" type="text" name="productName" placeholder="Name of the product"><br>
                                            <input class="form-control" type="text" name="productPrize" placeholder="Prize of the product"><br>
                                            <textarea class="form-control" type="text" name="productDescr" placeholder="Description of the product"></textarea><br>
                                            <input class="btn btn-success mb-2" type="submit" value="Upload a product" name="submit">
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } 
            }?>
        </div>
    </div>
    </section>
</main>


<!-- INCLUDING HEADER -->
<?php
include "skeleton/footer.php";
?>