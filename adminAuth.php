<?php
session_start();
if(!$_SESSION['token'] || $_SESSION['token_exp']<time()){
    header("Location: adminlogin.php?err=Your session has expired, please log in");
    $_SESSION = [];
    session_destroy();
    exit();
}
include "./database/connection.php";
$adminID = $_SESSION['adminID'];
$query = "SELECT * FROM admin WHERE admin_id='$adminID'";
$stmt = mysqli_prepare($connection, $query);
if (!$stmt) {
    die("Query preparation failed: " . mysqli_error($connection));
}
$resp = mysqli_query($connection, $query);

$adminInfo = mysqli_fetch_assoc($resp);

?>