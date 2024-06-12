<?php 
include "connectDB.php";


if ($_SERVER["REQUEST_METHOD"] == "POST") { 

    $selectedFruits = isset($_POST["hlhl"]) ? $_POST["hlhl"] : []; 
    foreach ($selectedFruits as $p_name) {

        $sql = "DELETE FROM product WHERE p_name = '$p_name'";
        if ($conn->query($sql) === TRUE) {
            echo "Succesfully delete!!";
        } else {
            echo "Error in deletion " . $conn->error;
        }
        echo "<br>";
        echo "You have delete " .$p_name ;
        echo "<br>";
    } 
}





        

echo "<br>";
echo "<br>";

echo "<script>alert('Successfully delete!!'); window.location.href = 'admin_d.php';</script>";

?>