<?php 
include "./database/connection.php";
include "./adminAuth.php";
include "./editAdmin.php";

 if (isset($_GET['deleteProduct'])){
        $product_id = $_GET['productID'];

        $del_query = "DELETE FROM products WHERE id = '$product_id'";

        $res = mysqli_query($connection, $del_query);
        if (!$res){
            echo "delete not working";
            header("Location: savedProduct.php?err=Product not found");
            return;
        }
        else{
            header("Location: savedProduct.php");
        }

    }




?>