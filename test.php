<?php
$url = "https://restcountries.com/v3.1/all";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);

//return page contents
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec($ch);
// echo $result;
curl_close($ch);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<ul>
    <?php 
    // Iterate over each country and display the name
    foreach ($countries as $country) {
        // Check if 'name' exists in the country data
        if (isset($country['name']['common'])) {
            echo "<li>" . $country['name']['common'] . "</li>";
        }
    }
    ?>
   </ul>
</body>
</html>