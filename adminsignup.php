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
    <title>AdminSignUP</title>
</head>
<body>
<?php
include "./components/navbar.html"
?>



<form method="POST" action="processAdmin.php" class="w-25 rounded shadow mx-auto mt-5">
        <div class="form-group">
            <label for="" class="text-primary">Admin Name</label>
            <input type="text" name="admin_name" class="form-control py-2">
        </div>

        <div class="form-group">
            <label for="" class="text-primary">Email</label>
            <input type="email" name="admin_email" class="form-control py-2">
        </div>
        <div class="form-group">
            <label for="" class="text-primary">Password</label>
            <input type="password" name="admin_password" class="form-control py-2">
        </div>
        <div class="form-group">
            <label for="" class="text-primary">Confirm Password</label>
            <input type="password" name="adminVerify_password" class="form-control py-2">
        </div>


        </div class="text-center mt-3">
        <button name="adminSignup" class="btn btn-primary w-100 py-2">Sign Up</button>
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