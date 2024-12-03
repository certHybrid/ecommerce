<?php
include "./userAuth.php";
session_start();
if (isset($_SESSION['productInfo'])){
    $productInfo = $_SESSION['productInfo'];
}
$err = null;
if(isset($_GET['err'])){
$err = $_GET['err'];
};
?>
<style>
    .bod{
        color: white;
        background-image: linear-gradient(to right, rgba(0,0,0,200), rgba(2,0,0,1));
    }
    main{
        width: 40%;
        display: flex;
        justify-content: space-between;
        align-content: center;
        margin: 50px auto;
        flex-wrap: wrap;
    }
    .con{
        width: 49%;
        height: 400px;
        padding: 10px;
        display: block;
        justify-content: center;
        align-content: center;
        color: white;
    }
</style>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <title>Preview Item</title>
</head>
<body class="bod">
    <?php include "./components/navbarhome.php"?>
    <h2>Preview Item</h2>
    <main>
        <div class="con">
            <img src="<?php echo $productInfo['product_img'] ?>" alt="<?php echo $productInfo['product_name'] ?>" width="200px">
        </div>

        <div class="con">
            <h1 ><?php echo $productInfo['product_name'] ?></h1>
            <h2><span>N</span><?php echo $productInfo['product_price'] ?></h2>
            <h4><span>Brand: </span><?php echo $productInfo['product_brand'] ?></h4>
            <p><span>Available in Stock: </span><?php echo $productInfo['product_qty'] ?><span> quantities</span></p>
            <p><span>Description: </span><?php echo $productInfo['product_desc'] ?></p>
            <form action="productProcess.php" method="get">
                <div><input type="number" name="qty" style="width: 80px; margin-bottom:10px;" value="1"></div>
                <input type="number" hidden name="cartID" value="<?php echo $productInfo['id']?>">
                <button name="addToCart" class="btn btn-primary" type="submit">Add to cart</button>
            </form>
        </div>
    </main>
    <div>
            <?php if ($err) {
                echo "<h4 class='bg-danger w-25 rounded m-auto text-white text-center p-1'>" . $err . "</h4>";
            }
            ?>
        </div>
</body>
</html>