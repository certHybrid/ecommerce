<?php
ob_start();
include "./database/connection.php";
include "./userAuth.php";

session_start();
$totalAmount = 0;
?>

<style>
   .bod {
      color: white;
      background-image: linear-gradient(to right, rgba(0, 0, 0, 200), rgba(2, 0, 0, 1));
   }
</style>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
   <title>Cart</title>
</head>

<body class="bod">
   <?php include "./components/navbarhome.php"; ?>
   <h1><span>Dear </span><?php echo $userInfo['user_name']; ?></h1>
   <h2>This is your carting list</h2>

   <table class="table table-striped w-50 text-center">
      <thead>
         <th>Item</th>
         <th>Price</th>
         <th>Quantity</th>
         <th>Total</th>
         <th></th>
         <th></th>
      </thead>
      <?php
      if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
         // Loop through cart items to display them
         foreach ($_SESSION['cart'] as $cartItem) {
            $itemTotal = $cartItem['price'] * $cartItem['quantity']; // Calculate item total
      ?>

            <tbody>
               <tr>
                  <td><?php echo $cartItem['name']; ?></td>
                  <td>N<?php echo $cartItem['price']; ?></td>
                  <td><?php echo $cartItem['quantity']; ?></td>
                  <td>N<?php echo $itemTotal; ?></td>
                  <td><img src="<?php echo $cartItem['images']; ?>" alt="pics" width="30px"></td>
                  <td>
                     <form action="./removeCart.php" method="get">
                        <button class="btn btn-danger" name="delcartitem" type="submit" value=<?php echo $cartItem['id'] ?>>Remove item</button>
                     </form>
                  </td>
               </tr>
            </tbody>

      <?php
            $totalAmount += $itemTotal; // Add to grand total
         }
         // Display grand total
        echo "<tr><td><strong>Grand Amount: N" . number_format($totalAmount, 2) . "</strong></td></tr><br/>";
        
      } else {
         echo "<p>Your cart is empty.</p>";
      }
      ?>
   </table>
   <br>
   <form action="./productaddtocart.php" method="get">
      <button type="submit" name="checkout" class="btn btn-primary">Proceed to Checkout</button>
   </form>
</body>
</html>



<?php
if(isset($_GET['checkout'])){
   echo $userInfo['user_email'];
   echo $totalAmount;
  
  $curl = curl_init();
  
  $data = [
      "email" => $userInfo["user_email"],
      "amount" => $totalAmount * 100, // amount in kobo
      "callback_url" => "http://localhost/market/clearcart.php"
  ];
  
  curl_setopt_array($curl, [
      CURLOPT_URL => "https://api.paystack.co/transaction/initialize",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => json_encode($data),
      CURLOPT_HTTPHEADER => [
          "Authorization: Bearer sk_test_60969f3e7e007d1e6f5933ccb8126484dec1e269",
          "Content-Type: application/json"
      ],
  ]);
  
  $response = curl_exec($curl);
  $err = curl_error($curl);
  
  curl_close($curl);
  
  if ($err) {
      echo "cURL Error #:" . $err;
  } else {
      // echo "Response ". $response;
      $rezz = json_decode($response, true);
      // echo $rezz['data'];
      // print_r($rezz['data']['authorization_url']);
      echo $rezz['data']['authorization_url'];
      // header("Location: home.php");
      header("Location:".$rezz['data']['authorization_url']);
      // echo $data;
  }
  }
  ob_end_flush();
?>