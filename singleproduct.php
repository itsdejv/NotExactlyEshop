<!-- INCLUDING HEADER -->
<?php
include_once("skeleton/header.php")
?>

<!-- MAIN SECTION -->
<main>

<?php
if(isset($_GET["id"])){
    $productId = $_GET["id"];
    
    // Checking if searched product has a valid id
    if($productId == null){
        header("location: products.php?error=productnotfound");
    }

    // Product proccess
    include("classes/dbh.classes.php");
    include("classes/singleproduct-view.classes.php");

    $singleProductView = new SingleProductView();
    $singleProductResult = $singleProductView->printSingleProduct($productId);

    if($singleProductResult){
        foreach($singleProductResult as $singleProduct){ ?>
        <div class="container">
                <div class="row">
                    <div class="col-12 single-product-header">
                        <h1><?php echo $singleProduct["products_name"] ?></h1>
                    </div>
                    <div class="col-lg-6 d-flex flex-column justify-content-center align-items-center single-product-left-section">
                        <img src="<?php echo $singleProduct["products_img_path"] ?>"  alt="">
                    </div>
                    <div class="col-lg-6 single-product-right-section">
                        <h2><?php echo $singleProduct["products_prize"] ?> Kč</h2>
                        <?php
                        if(isset($_SESSION["adminStatus"])){
                            if($_SESSION["adminStatus"] === 1){ ?>
                                <a href="productedit.php?id=<?php echo $productId ?>">Edit Product</a>
                            <?php }
                        }
                        ?>
                        <h4>Popis produktu</h4>
                        <p><?php echo $singleProduct["products_descr"]?></p>
                    </div>
                </div>
        </div>
        <?php
        } 
    }
} else {
    header("location: products.php?error=productnotfound");
}
?>

</main>

<!-- INCLUDING Footer -->
<?php
include "skeleton/footer.php";
?>