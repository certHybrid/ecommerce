<?php
include "./database/connection.php";
include "./userAuth.php";
session_start();
if (isset($_SESSION['cart'])) {

    echo '<pre>';
    print_r($_SESSION['cart']); // Print the entire cart contents
    echo '</pre>';
    foreach ($_SESSION['cart'] as $item) {
        // echo "Quantity: " . $item['quantity']. "<br>";
        $shopQty = $item['quantity'];
        $shopID = $item['id'];
        $productName = $item['name'];
        $userID = $userInfo['users_id'];
        $userName = $userInfo['user_name'];

        //query to insert cart items by user into database
        $cart_query = "INSERT INTO cart (user_id, user_name, product_id, product_name, quantity) 
        VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($connection, $cart_query);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, 'isssi', $userID, $userName, $shopID, $productName, $shopQty);
            $cart_resp = mysqli_stmt_execute($stmt);
            if ($cart_resp) {
                echo "Item added to cart: Product ID $shopID - Quantity: $shopQty<br>";
            } else {
                echo "Error inserting into cart table: " . mysqli_error($connection) . "<br>";
            }
            mysqli_stmt_close($stmt);
        } else {
            echo "Prepared statement failed: " . mysqli_error($connection) . "<br>";
        }

        //query to fetch item to reduce quantity in product database
        $query = "SELECT * FROM products WHERE id='$shopID'";
        $resp = mysqli_query($connection, $query);

        if ($resp) {
            $res = mysqli_fetch_assoc($resp);
            // print_r ($res['id']);
            $dbQty = $res['product_qty'];
        } else {
            echo "cannot find from DB";
        }
        // echo "shop quantity".$dbQty."<br>";
        $newQty = $dbQty - $shopQty;
        echo "New quantity" . $newQty . "<br>";

        $update_query = "UPDATE products SET product_qty = '$newQty' WHERE id = '$shopID'";
        $rez = mysqli_prepare($connection, $update_query);
        if ($rez) {
            $update_res = mysqli_stmt_execute($rez);
            if ($update_res) {
                echo "database updated";
            } else {
                echo "Error occur updating db";
            }
        }
    }
} else {
    echo "Cart is empty.";
    header("Location: receipt.php");
}
//clear cart
unset($_SESSION['cart']);

if (!isset($_SESSION['cart'])) {
    echo "Cart is cleared.";
}
