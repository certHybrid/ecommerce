<?php
include "./database/connection.php";
include "./userAuth.php";
$err = null;
if (isset($_GET['err'])) {
    $err = $_GET['err'];
};
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <title>Home</title>
</head>
<style>
    ::-webkit-scrollbar {
  width: 10px;
    }
    h1 {
        color: red;
    }

    .allbg {
        position: relative;
        background-image: linear-gradient(to right, rgba(0, 0, 0, 200), rgba(2, 0, 0, 1));
    }

    .sec {
        color: white;
        width: 100%;
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        height: 800px;
        background-color: rgb(39,42,53);

    }

    .nav1 {
        position: fixed;
        top: 0;
        width: 100%;
        z-index: +5;
    }

    .blackimgcon {
        width: 30%;
        height: inherit;
        background-color: white;
        padding: 30px;

    }
</style>

<body class="allbg">
    <div class="nav1"><?php include "./components/navbarhome.php" ?></div>
    <div style="display: flex; justify-content:space-between; color:white; margin-top:100px;">
        <h1>Welcome to Market Place <span><?php echo $userInfo['user_name'] ?></span></h1>
        <div>
            <form action="./userProcess.php" method="post">
                <button class="btn btn-danger" name="userlogout" type="submit">Logout</button>
            </form>
        </div>
    </div>
    <h2 style="color: black; padding:5px; background-color:white">Browse All Items</h2>
    <section class="sec">
        <div style="width: 68%; height:100%;" class="overflow-x-auto">
            <?php
            include "./products.php"
            ?>
        </div>
        <div class="blackimgcon">
            <img src="./productIMG/Download_premium_png_of_PNG_Young_black_business_woman_photo_photography_electronics_by_Ratcharin_Noiruksa_about_black_woman_png__women_with_laptop__laptop_png__black_woman_in_suit_png__and_black_-rem.png" alt="photo" width="100%" height="100%">
        </div>
        <div>
            <?php if ($err) {
                echo "<h4 class='bg-danger w-25 rounded m-auto text-white text-center p-1'>" . $err . "</h4>";
            }
            ?>
        </div>
    </section>

</body>

</html>