<?php
// FIXME: change to your own details
$servername = "localhost";
$username   = "root"; // for local host
$password   = "";   // for local host
$db = "second_hand_store";  // change to the database name in your local XAMPP

// Create connection
$conn = new mysqli($servername, $username, $password, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//else echo"Connected successfully."
?>
