<?php
include "./database/connection.php";
mysqli_report(MYSQLI_REPORT_OFF);

//Admin Signup
if (isset($_POST['adminSignup'])){
    if(empty($_POST['admin_name'])){
        header("Location:adminsignup.php?err=Please enter an Admin name");
        return;
    }
    if(empty($_POST['admin_email'])){
        header("Location:adminsignup.php?err=Email can not be empty");
        return;
    }
    if(empty($_POST['admin_password'])){
        header("Location:adminsignup.php?err=Password can not be empty");
    } elseif (!preg_match("/[0-9]/", $_POST['admin_password'])) {
        header("Location:adminsignup.php?err=Password must contain atleast one number");
        return;
    }
    if($_POST['admin_password']!== $_POST['adminVerify_password']){
        header("Location:adminsignup.php?err=Password does not match");
        return;
    }

    $adminPass = password_hash($_POST['adminVerify_password'], PASSWORD_DEFAULT);
    $adminName = $_POST['admin_name'];
    $adminEmail = $_POST['admin_email'];

    $query = "INSERT INTO admin(admin_name,admin_email,admin_pass) VALUES('$adminName','$adminEmail','$adminPass')";
    //  echo "<br />"."Saved to DB";
    $res = mysqli_query($connection, $query);
    if ($res) {
        header("Location: adminlogin.php");
    }else{
        echo "Something went wrong".mysqli_error($connection).mysqli_errno($connection);
        if (mysqli_errno($connection)=== 1062) {
            header("Location:adminsignup.php?err= Email already taken");
        }
    }
}

//Admin Login
if(isset($_POST['adminLogin'])){
    $login_email = $_POST['login_email'];
    $login_password = $_POST['login_password'];

    $login_query = "SELECT * FROM admin WHERE admin_email = '$login_email'";
    $resp = mysqli_query($connection, $login_query);
    $result = mysqli_fetch_assoc($resp);
     if($result){
        // print_r($result); 
        $_SESSION['admin_name']=$result['admin_name'];
        $_SESSION['admin_email']=$result['admin_email'];

        $existingHashfromDB = $result['admin_pass'];
        if(password_verify($_POST['login_password'],$existingHashfromDB)){
            // echo "confirmed";
            $rand =  random_bytes(20);
            $token = bin2hex($rand);
            $token_expire = time()+(60 * 3600);
            $admin_id = $result['admin_id'];
            session_start();
            $_SESSION['adminID']=$admin_id;
            $_SESSION['token']=$token;
            $_SESSION['token_exp']=$token_expire;

            header("Location: admindash.php");
        }else{
            header("Location: adminlogin.php?err= Incorrect Password");
        }
     }else{
        header("Location: adminlogin.php?err= Admin details not found, create a new admin");
     }

}




?>