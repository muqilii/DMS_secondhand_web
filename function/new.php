<?php

include "connectDB.php";

$sql = "SELECT cart_id FROM `cart` ORDER BY cart_id DESC LIMIT 1";
$result = $conn->query($sql);

// Check the query result
if ($result === false) {
    die("查询失败: " . $conn->error);
}

// Fetch the row from the query result
$row = $result->fetch_assoc();
$last_cart_id = $row["cart_id"];
$cart_id = $last_cart_id+1;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_to_cart"])&& $_POST["b_id"]!='Guest') {
    // Get the data you want to insert (replace these with your actual data)
    $p_id = $_POST["p_id"];
    $b_id = $_POST["b_id"];
    
    // Your SQL query to insert data into the 'order' table
    $sql = "INSERT INTO `cart` (cart_id, b_id) VALUES (
        '$cart_id',
        '$b_id'
    )";
    // Execute the query
    if ($conn->query($sql) === TRUE) {
        // On successful insertion, redirect to index.php
        echo "<script>alert('Successfully added!!'); window.location.href = 'index.php';</script>";
    } else {
        //echo "<script>alert('Please .'); window.location.href = 'index.php';</script>";
    }

    $sql = "INSERT INTO `cart_product` (cart_id, p_id) VALUES (
        '$cart_id',
        '$p_id'
    )";
        if ($conn->query($sql) === TRUE) {
            // On successful insertion, redirect to index.php
            echo "<script>alert('Successfully added!!'); window.location.href = 'index.php';</script>";
        } else {
            //echo "<script>alert('Please .'); window.location.href = 'index.php';</script>";
        }

}
elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_to_cart"])&& $_POST["b_id"]=='Guest'){


    echo "<script>alert('Please Log in first'); window.location.href = 'index.php';</script>";

}
else{
    ;
}
?>
