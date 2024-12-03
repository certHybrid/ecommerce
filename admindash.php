<?php
include "./adminAuth.php";
include "./editAdmin.php";
$err = null;
if(isset($_GET['err'])){
$err = $_GET['err'];
};

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

    <title>Admin Dashboard</title>
</head>

<body>

    <h1>
        Welcome to your dashboard <?php echo $adminInfo['admin_name'] ?>
    </h1>
    <div >
        <?php if ($err){
            echo "<h4 class='bg-danger w-25 rounded m-auto text-white text-center p-1 '>".$err."</h4>";
        }
        ?>
    </div>

    <h2>Upload a product</h2>
    <form method="post" action="./editAdmin.php" enctype="multipart/form-data">
    
        <div class="mb-3 w-50">
            <input type="text" class="form-control" name="product_name" placeholder="Product Name">
        </div>
        <div class="mb-3 w-50">
            <input type="text" class="form-control" name="product_price" placeholder="Proudct Price">
        </div>
        <div class="mb-3 w-50">
            <input type="number" class="form-control" name="product_qty" placeholder="Proudct Quantity">
        </div>
        <div class="mb-3 w-50">
            <input type="text" class="form-control" name="product_brand" placeholder="Proudct Brand">
        </div>
        <div class="mb-3 w-50">
            <input type="text" class="form-control" name="product_cat" placeholder="Proudct Category">
        </div>
        <div class="mb-3 w-50">
            <textarea class="form-control" name="product_desc" rows="3" placeholder="Description"></textarea>
        </div>
        <div class="mb-3 w-25">
            <input type="file" class="form-control" name="product_img" placeholder="Proudct Image">
        </div>
        <button name="upload_product" class="btn btn-primary">Upload new product</button>
        <button onclick="location.href='savedProduct.php'" class="btn btn-secondary" type="button">Preview Products</button>
    </form>


    <form action="./editAdmin.php" method="post">
    <button name="logout" class="btn btn-danger">Logout</button>
    </form>
    


</body>

</html