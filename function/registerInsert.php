<?php
include "connectDB.php";  

$name = $_POST["username"];  
$pwd = $_POST["password"];  
$phone = $_POST["phone"];
$info = $_POST["information"];
$UserType = $_POST["UserType"];

// Check if the username already exists
if ($UserType === "buyer") {
    // Check if the username already exists
    $checkSql = "SELECT b_name FROM buyer WHERE b_name = '$name' ";
    $checkResult = mysqli_query($conn, $checkSql);

    if (mysqli_num_rows($checkResult) > 0) {
        $row = mysqli_fetch_array($checkResult);
        echo "Username $name has been registered!!!";
        echo "<br><hr><br> Go to  <a href='register.html'> Register page </a>";
        return;
    }

    // Get the maximum existing ID in the buyer table
    $maxIdQuery = "SELECT MAX(b_id) AS maxId FROM buyer";
    $maxIdResult = mysqli_query($conn, $maxIdQuery);
    $maxIdRow = mysqli_fetch_assoc($maxIdResult);
    $newId = $maxIdRow['maxId'] + 1;

    // Insert data into the buyer table with the new ID
    $sql = "INSERT INTO `buyer` (`b_id`, `b_name`, `b_password`, `phone`, `information`) VALUES ('$newId', '$name', '$pwd', '$phone', '$info')";
} 
elseif ($UserType === "seller") {
    // Check if the username already exists
    $checkSql = "SELECT s_name FROM seller WHERE s_name = '$name' ";
    $checkResult = mysqli_query($conn, $checkSql);

    if (mysqli_num_rows($checkResult) > 0) {
        $row = mysqli_fetch_array($checkResult);
        echo "Username $name has been registered!!!";
        echo "<br><hr><br> Go to  <a href='register.php'> Register page </a>";
        return;
    }

    // Get the maximum existing ID in the seller table
    $maxIdQuery = "SELECT MAX(s_id) AS maxId FROM seller";
    $maxIdResult = mysqli_query($conn, $maxIdQuery);
    $maxIdRow = mysqli_fetch_assoc($maxIdResult);
    $newId = $maxIdRow['maxId'] + 1;

    // Insert data into the seller table with the new ID
    $sql = "INSERT INTO `seller` (`s_id`, `s_name`, `s_password`, `phone`, `information`) VALUES ('$newId', '$name', '$pwd', '$phone', '$info')";
} 
else {
    echo "<script>alert('Invalid UserType !'); window.location.href = 'register.html';</script>";

    return;
}

$result = mysqli_query($conn, $sql);

echo "Successfully registered";
echo "<br><br> Go back to <a href='Login.html'> login page </a>";
?>