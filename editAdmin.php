<?php
include "./database/connection.php";
include "./adminAuth.php";


//for uploading
if(isset($_POST['upload_product'])){
    $productName = $_POST['product_name'];
    $productPrice = $_POST['product_price'];
    $productQty = $_POST['product_qty'];
    $productBrand = $_POST['product_brand'];
    $productCat = $_POST['product_cat'];
    $productDesc = $_POST['product_desc'];
    $file_path = "productIMG/";
    $file = $file_path.basename(($_FILES['product_img']['name']));
    // echo $file;
    if(empty($_POST['product_name'])){
        header("Location:admin/admindash.php?err=Enter a prduct name");
        return;
    }
    if(empty($_POST['product_price'])){
        header("Location:admin/admindash.php?err= Enter a product price");
        return;
    }
    if(empty($_POST['product_qty'])){
        header("Location:admin/admindash.php?err=Enter product quauntity");
        return;
    }
    if(empty($_POST['product_brand'])){
        header("Location:admin/admindash.php?err=Enter the product brand");
        return;
    }
    if(empty($_POST['product_cat'])){
        header("Location:admin/admindash.php?err=Enter the product Category");
        return;
    }
    if(empty($_POST['product_desc'])){
        header("Location:admin/admindash.php?err=Enter the product Description");
        return;
    }
  
    if(!is_writable($file_path)  ){
       
        header("Location: admindash.php?err=upload directory is not writtenable");
        exit;
    }
    $query = "INSERT INTO products(product_name,product_desc,product_price,product_qty,
    product_brand,product_cat,product_img) VALUE('$productName','$productDesc','$productPrice',
    '$productQty','$productBrand','$productCat','$file')"; 
    $response = mysqli_query($connection, $query);

    if ($response){
        echo "product added";
        move_uploaded_file($_FILES['product_img']["tmp_name"],$file);
        header("Location: savedProduct.php");
       
    }else{
        echo "something went wrong".mysqli_error($connection);
    }
    }

    //admin Logout
    if(isset($_POST['logout'])){
        session_destroy();
        header("Location: adminlogin.php?err=You have logged out, Login again to continue");
        exit();
    }





?>