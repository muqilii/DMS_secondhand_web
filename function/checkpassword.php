<?php
include "connectDB.php";

$user = $_POST["username"];
$pwd = $_POST["Userpassword"];
$usertype = $_POST["UserType"];

if ($usertype == "b") {
    $sql = "SELECT b_id,b_name FROM buyer WHERE b_name = ? AND b_password = ? LIMIT 1";
} elseif ($usertype == "s") {
    $sql = "SELECT s_id, s_name FROM seller WHERE s_name = ? AND s_password = ? LIMIT 1";
} elseif ($usertype == "a") {
    $sql = "SELECT a_id,a_name FROM admin WHERE a_name = ? AND a_password = ? LIMIT 1";
}

$stmt = mysqli_prepare($conn, $sql);

// Check if the preparation of the statement was successful
if (!$stmt) {
    die('mysqli_prepare failed: ' . htmlspecialchars(mysqli_error($conn)));
}

mysqli_stmt_bind_param($stmt, "ss", $user, $pwd);
mysqli_stmt_execute($stmt);

// Check if the execution of the statement was successful
if (!$stmt) {
    die('mysqli_stmt_execute failed: ' . htmlspecialchars(mysqli_error($conn)));
}

$result = mysqli_stmt_get_result($stmt);

// Check if the result is valid
if (!$result) {
    die('mysqli_stmt_get_result failed: ' . htmlspecialchars(mysqli_error($conn)));
}

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);

   
   

    $username = $row[$usertype . '_name']; 
    echo $username;
    
    $user_id = $row[$usertype . '_id'];
    
    session_start();
    $_SESSION['username'] = $username;
    $_SESSION['user_id'] = $user_id;

    if ($usertype == "b") {
        header("location: index.php");
    } elseif ($usertype == "s") {
        header("location: cemo.php");
    }elseif ($usertype == "a") {
        header("location: admin_d.php");
    exit(); // Ensure script stops here to prevent further execution

}
}
// Login failed
echo "Oops! Your username, password, or usertype is incorrect!";
echo "<br><br> Go back to <a href='Login.html'> Login page </a>";
?>