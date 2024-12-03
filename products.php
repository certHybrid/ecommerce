<?php
include "./database/connection.php";
include "./userAuth.php";
$disp_query = "SELECT * FROM products";
$res = mysqli_query($connection, $disp_query);

?>
<style>
    .sect {
        display: flex;
        justify-content:left;
        align-items: center;
        align-content: center;
        flex-wrap: wrap;
        
    }
    .bod {
        background-color: black;
        color: white;
    }
    .imgcon{
        width: 220px; 
        height:250px; 
        margin:20px; 
        transition: all ease-in-out 0.8s;
    }
    .imgcon:hover{
        transform:scaleX(1.1);
    }
</style>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <title>products</title>
</head>

<body class="bod">


    <section class="sect">
        <?php while ($result = mysqli_fetch_assoc($res)) { ?>

            <div class="imgcon">
                <div style="width:150px; height:100px"><?php if (!empty($result['product_img'])) { ?>
                        <img src="<?php echo $result['product_img']; ?>" alt="Product Image" width="100%" height="100%">
                    <?php } else { ?>
                        echo "No image";
                    <?php } ?>
                </div>

                <div style="padding:5px">
                    <h5><?php echo $result['product_name'] ?></h5>
                </div>
                <div style="padding:5px">
                    <h5><span>N</span><?php echo $result['product_price'] ?></h5>
                </div>
                <div style="padding:5px">
                    <form action="productProcess.php" method="get">
                        <input type="text" hidden name="productID" value="<?php echo $result['id'] ?>">
                        <button class="btn btn-dark" name="previewItem" type="submit">Preview Item</button>
                    </form>
                </div>
            </div>
        <?php } ?>
    </section>

    <div>
        <?php if ($err) {
            echo "<h4 class='bg-danger w-25 rounded m-auto text-white text-center p-1'>" . $err . "</h4>";
        }
        ?>
    </div>










</body>

</html>