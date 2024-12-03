<?php
include "./database/connection.php";
include "./adminAuth.php";
include "./editAdmin.php";


$err = null;
if(isset($_GET['err'])){
$err = $_GET['err'];
};



$disp_query = "SELECT * FROM products";
$res = mysqli_query($connection, $disp_query);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

    <title>savedProduct</title>
</head>
<body>
<form action="./editAdmin.php" method="post">
    <button name="logout" class="btn btn-danger">Logout</button>
    </form>
    <button class="btn btn-secondary" onclick="location.href='admindash.php'">Upload New Product?</button>
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Items Available in Store</th>
                </tr>
                <tr>
                    <th>Id</th>
                    <th>Product name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Brand</th>
                    <th>Category</th>
                    <th>Image</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($result =mysqli_fetch_assoc($res)) {?>
                    <tr>
                       <td><?php echo $result ['id']?></td>
                       <td><?php echo $result ['product_name']?></td>
                       <td><?php echo $result ['product_desc']?></td>
                       <td><?php echo $result ['product_price']?></td>
                       <td><?php echo $result ['product_qty']?></td>
                       <td><?php echo $result ['product_brand']?></td>
                       <td><?php echo $result ['product_cat']?></td>
                       <td><?php if (!empty($result['product_img'])){?>
                        <img src="<?php echo $result['product_img']; ?>" alt="Product Image" width="50">
                        <?php } else { ?>
                            echo "No image";
                        <?php } ?>
                        </td>
                        <td>
                            <form action="adminDelProduct.php" method="get">
                                <input type="text" hidden name="productID" value="<?php echo $result['id'] ?>">
                            <button class="btn btn-danger" name="deleteProduct" type="submit">Delete Item</button>
                            </form>
                        </td>
                        <td>
                            <button class="btn btn-warning">Edit Item</button>
                        </td>
                    </tr>
                    
                    <?php }?>
                
            </tbody>

        </table>

    </div>

    <div>
    <?php if ($err){
            echo "<h4 class='bg-danger w-25 rounded m-auto text-white text-center p-1 '>".$err."</h4>";
        }
        ?>
    </div>


</body>
</html>