//remove product from cart
<?php
include "./database/connection.php";
include "./userAuth.php";
$negqty = 1;
session_start();

if (isset($_GET['delcartitem'])) {
    $cartitemid = $_GET['delcartitem'];

    // Checking if the item exist in the session cart
    if (isset($_SESSION['cart'][$cartitemid])) {
                if ($_SESSION['cart'][$cartitemid]['quantity'] > 1) {
            $_SESSION['cart'][$cartitemid]['quantity'] -= $negqty;
        } else {
            unset($_SESSION['cart'][$cartitemid]);
        }
        header("Location: productaddtocart.php");
        exit();
    } else {
        // if it doesnt exist, it should redirect with the error
        header("Location: productaddtocart.php?err=Item not found in cart");
        exit();
    }
} else {
    // If no item ID is provided in the request
    header("Location: productaddtocart.php?err=Invalid request");
    exit();
}

function countCartItems() {
    $totalItems = 0;
    // Loop through each item in the cart and sum up the quantities
    foreach ($_SESSION['cart'] as $item) {
        $totalItems += $item['quantity'];
    }
    return $totalItems;
}






















// include "./database/connection.php";
// include "./userAuth.php";
// session_start();
// if (isset($_GET['delcartitem'])) {
//     $cartitemid = $_GET['delcartitem'];

//     // Remove the product from the session cart
//     if (isset($_SESSION['cart'][$cartitemid])) {
//         unset($_SESSION['cart'][$cartitemid]);
//         header("Location: productaddtocart.php");
//     } else {
//         header("Location: productaddtocart.php?err=Product not found in cart");
//     }
//     exit();
// } else {
//     header("Location: productaddtocart.php?err=Invalid request");
//     exit();
// }

?>

