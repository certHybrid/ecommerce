<?php
include "../database/connection.php";
$err = null;
if(isset($_GET['err'])){
$err = $_GET['err'];
};

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <title>AdminSignIn</title>
</head>
<body>
<?php
include "./components/navbar.html"
?>

<form method="POST" action="processAdmin.php" class="w-25 rounded shadow mx-auto mt-5">
        <div class="form-group">
            <label for="" class="text-primary">Admin Email</label>
            <input type="email" name="login_email" class="form-control py-2">
        </div>
        <div class="form-group">
            <label for="" class="text-primary">Admin Password</label>
            <input type="password" name="login_password" class="form-control py-2">
        </div>

        </div class="text-center mt-3">
        <button name="adminLogin" class="btn btn-primary w-100 py-2">LOGIN</button>
        </div>
    </form>

    <div >
        <?php if ($err){
            echo "<h4 class='bg-danger w-25 rounded m-auto text-white text-center p-1'>".$err."</h4>";
        }
        ?>
    </div>



    
</body>
</html>