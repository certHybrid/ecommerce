<?php
session_start();
if(!$_SESSION['utoken'] || $_SESSION['utoken_exp']<time()){
    header("Location: userlogin.php?err=Your session has expired, please log in");
    $_SESSION = [];
    session_destroy();
    exit();
}
include "./database/connection.php";
$userID = $_SESSION['userID'];
// echo $userID;
$query = "SELECT * FROM users WHERE users_id='$userID'";
$stmt = mysqli_prepare($connection, $query);
if (!$stmt) {
    die("Query preparation failed: " . mysqli_error($connection));
}
$resp = mysqli_query($connection, $query);
$userInfo = mysqli_fetch_assoc($resp);
?>