<?php
include "./database/connection.php";
mysqli_report(MYSQLI_REPORT_OFF);

//Preview Product
if (isset($_GET['previewItem'])) {
    $product_id = $_GET['productID'];
    $prev_query = "SELECT * FROM products WHERE id = '$product_id'";
    $res = mysqli_query($connection, $prev_query);


    if ($res) {
        $result = mysqli_fetch_assoc($res);
        session_start();
        $_SESSION['productInfo'] = $result;
        header("Location: productprev.php");
    } else {
        header("Location: home.php?err=Item not found");
    }
}

//Add to Cart

// session_start();

// if (isset($_GET['addToCart'])) {
//     $cartID = $_GET['cartID'];
//     $qty = isset($_GET['qty']) ? (int)$_GET['qty'] : 1;  // Cast to integer for quantity

//     // Use prepared statement to prevent SQL injection
//     $cart_query = "SELECT * FROM products WHERE id = ?";
//     $stmt = mysqli_prepare($connection, $cart_query);

//     if ($stmt) {
//         mysqli_stmt_bind_param($stmt, 'i', $cartID);
//         mysqli_stmt_execute($stmt);
//         $result = mysqli_stmt_get_result($stmt);

//         if ($result && mysqli_num_rows($result) > 0) {
//             $rez = mysqli_fetch_assoc($result);

//             $cartItem = [
//                 'id' => $rez['id'],
//                 'name' => $rez['product_name'],
//                 'price' => $rez['product_price'],
//                 'images' => $rez['product_img'],
//                 'quantity' => $qty
//             ];

//             // If the item is already in the cart, update the quantity
//             if (isset($_SESSION['cart'][$cartID])) {
//                 $_SESSION['cart'][$cartID]['quantity'] += $qty;
//             } else {
//                 $_SESSION['cart'][$cartID] = $cartItem;
//             }

//             // Redirect with success message
//             header("Location: productprev.php?success=1");
//         } else {
//             // Redirect with error message if the product does not exist
//             header("Location: productprev.php?err=Item not found");
//         }

//         mysqli_stmt_close($stmt);
//     } else {
//         // Handle SQL error
//         echo "Database query failed: " . mysqli_error($connection);
//         exit();
//     }
//     exit();
// } else {
//     // Handle missing 'addToCart' in the query string
//     header("Location: productprev.php?err=Invalid request");
//     exit();
// }










//////////////////////////////////////////
//////////////////////////////////////////
session_start();
if (isset($_GET['addToCart'])) {
    $cartID = $_GET['cartID'];
    $qty = isset($_GET['qty']) ? $_GET['qty'] : 1;
    // echo $qty, $cartID;

    $cart_query = "SELECT * FROM products WHERE id = '$cartID'";
    $resp = mysqli_query($connection, $cart_query);

    if ($resp) {
        echo "here";
        $rez = mysqli_fetch_assoc($resp);
        if ($qty <= $rez['product_qty']) {
            $cartItem = [
                'id' => $rez['id'],
                'name' => $rez['product_name'],
                'price' => $rez['product_price'],
                'images' => $rez['product_img'],
                'quantity' => $qty
            ];
            // print_r($cartItem);

            if (isset($_SESSION['cart'][$cartID])) {
                $_SESSION['cart'][$cartID]['quantity'] += $qty;
            } else {
                $_SESSION['cart'][$cartID] = $cartItem;
            }
            header("Location:productprev.php");
        } else {
            header("Location:productprev.php?err=Please reduce quantity to available quantity in stock");
        }
    }
} else {
    header("Location: productprev.php?err=add cart");
    exit();
}
