<?php
include "./database/connection.php";
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

    <title>UserSignup</title>
</head>
<style>
    h1{
        color: red;
    }
</style>
<body>
    <h2>Register an account</h2>
<form method="POST" action="userProcess.php" class="w-25 rounded shadow mx-auto mt-5">
        <div class="form-group">
            <label for="" class="text-primary">Username</label>
            <input type="text" name="user_name" class="form-control py-2">
        </div>

        <div class="form-group">
            <label for="" class="text-primary">Email</label>
            <input type="email" name="user_email" class="form-control py-2">
        </div>
        <div class="form-group">
            <label for="" class="text-primary">Password</label>
            <input type="password" name="user_password" class="form-control py-2">
        </div>
        <div class="form-group">
            <label for="" class="text-primary">Confirm Password</label>
            <input type="password" name="userVerify_password" class="form-control py-2">
        </div>


        </div class="text-center mt-3">
        <button name="userSignup" class="btn btn-primary w-100 py-2">Sign Up</button>
        </div>

    </form>
    <h3 style="text-align: center;">Already have an account? <a href="userlogin.php" style="text-decoration: none;">Login</a></h3>

    <div >
        <?php if ($err){
            echo "<h4 class='bg-danger w-25 rounded m-auto text-white text-center p-1'>".$err."</h4>";
        }
        ?>
    </div>


    
</body>
</html>