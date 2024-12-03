<?php
include "./database/connection.php";
mysqli_report(MYSQLI_REPORT_OFF);

//User signup
if (isset($_POST['userSignup'])) {
    if (empty($_POST['user_name'])) {
        header("Location:usersignup.php?err=Please enter an Admin name");
        return;
    }
    if (empty($_POST['user_email'])) {
        header("Location:usersignup.php?err=Email can not be empty");
        return;
    }
    if (empty($_POST['user_password'])) {
        header("Location:adminsignup.php?err=Password can not be empty");
    } elseif (!preg_match("/[0-9]/", $_POST['user_password'])) {
        header("Location:usersignup.php?err=Password must contain atleast one number");
        return;
    }
    if ($_POST['user_password'] !== $_POST['userVerify_password']) {
        header("Location:adminsignup.php?err=Password does not match");
        return;
    }

    $userPassword = password_hash($_POST['userVerify_password'], PASSWORD_DEFAULT);
    $userName = $_POST['user_name'];
    $userEmail = $_POST['user_email'];

    $query = "INSERT INTO users(user_name,user_email,user_password)VALUES('$userName','$userEmail','$userPassword')";
    echo "saved to user DB";
    $res = mysqli_query($connection, $query);
    if ($res) {
        header("Location: userlogin.php");
    } else {
        echo "Something went wrong" . mysqli_error($connection) . mysqli_errno($connection);
        if (mysqli_errno($connection) === 1062) {
            header("Location:usersignup.php?err= Email already taken");
        }
    }
}

    //User Login
    if (isset($_POST['userLogin'])) {
        $login_email = mysqli_real_escape_string($connection,$_POST['login_email']);
        $login_password = mysqli_real_escape_string($connection,$_POST['login_password']);

        $login_query = "SELECT * FROM users WHERE user_email = '$login_email'";
        $resp = mysqli_query($connection, $login_query);
        $result = mysqli_fetch_assoc($resp);
        if ($result) {
            print_r($result);
            $_SESSION['user_name'] = $result['user_name'];
            $_SESSION['user_email'] = $result['user_email'];

            $existingHashfromDB = $result['user_password'];
            if (password_verify($_POST['login_password'], $existingHashfromDB)) {
                echo "confirmed";
                $rand =  random_bytes(20);
                $token = bin2hex($rand);
                $token_expire = time() + (60 * 3600);
                $user_id = $result['users_id'];
                session_start();
                $_SESSION['userID'] = $user_id;
                $_SESSION['utoken'] = $token;
                $_SESSION['utoken_exp'] = $token_expire;

                header("Location: home.php");
            } else {
                header("Location: userlogin.php?err= Incorrect Password");
            }
        } else {
            header("Location: userlogin.php?err= user details not found, create a new admin");
        }
    }

    //userLogout
    session_start();
     if(isset($_POST['userlogout'])){
        session_destroy();
        header("Location: userlogin.php?err=You have logged out, Login again to continue");
        exit();
    }



?>