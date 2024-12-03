<?php
include "./database/connection.php";
include "./userAuth.php";

session_start();
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

function countCartItems() {
    $totalItems = 0;
    foreach ($_SESSION['cart'] as $item) {
        $totalItems += $item['quantity'];
    }
    return $totalItems;
}
?>
<style>
    .fa-solid{
        font-size: 30px;
        color: black;  
    }
    .forcart{
      position: relative;
    }
    .fcart{
      background-color: white;
      padding: 0px 3px;
      border-radius: 50%;
      position: absolute;
      top:-3px;
      right: 7px;
      color: black;
      width: fit-content;
      font-size: 15px;
      font-weight: bolder;
    }
</style>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <!-- <script src="https://kit.fontawesome.com/c6fcacdfc7.js" crossorigin="anonymous"></script> -->
    <title>Document</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
          <a class="navbar-brand" href="home.php"><h1>ShopNG</h1></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Features</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Pricing</a>
              </li>
              <li class="nav-item forcart">
                <a class="nav-link" href="productaddtocart.php"><i class="fa-solid fa-cart-shopping"></i></a>
                <div class="fcart"><?php echo countCartItems()?>

                </div>
              </li>
            </ul>
          </div>
        </div>
      </nav>
</body>
</html>