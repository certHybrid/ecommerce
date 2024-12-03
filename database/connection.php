<?php
$connection = mysqli_connect("127.0.0.1","root","", "Market");
if (!$connection){
    echo "Something went wrong".mysqli_connect_error();
} else{
    echo "";
}
?>