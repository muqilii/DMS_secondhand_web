<?php
// Assuming you have a database connection established
include "connectDB.php";

// Check if the button is clicked
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["remove_from_cart"])) {
    // Get the data you want to use for deletion (replace these with your actual data)
    $o_id = $_POST["o_id"]; 
    $p_id = $_POST["p_id"];
    $b_id = $_POST["b_id"];
    
    // Your SQL query to delete data from the 'order' table
    $sql = "DELETE FROM `order` WHERE
        o_id = '$o_id' AND
        p_id = '$p_id' AND
        b_id = '$b_id'";
    
    // Execute the query
    if ($conn->query($sql) === TRUE) {
        // On successful deletion, redirect to index.php
        echo "<script>alert('Successfully removed!!'); window.location.href = 'index.php';</script>";
    } else {
        echo "<script>alert('Deletion failed.'); window.location.href = 'index.php';</script>";
    }
}
?>

