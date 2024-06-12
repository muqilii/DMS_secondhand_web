<?php 
include "connectDB.php";

$s_id = $_POST['s_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") { 

    $selectedFruits = isset($_POST["hlhl"]) ? $_POST["hlhl"] : []; 
    foreach ($selectedFruits as $p_name) {

        $sql = "DELETE p.*
FROM product p
JOIN product_category pc ON p.p_id = pc.p_id
WHERE p.p_name = '$p_name' AND pc.s_id = '$s_id'";
        if ($conn->query($sql) === TRUE) {
            echo "Succesfully delete!!";
        } else {
            echo "Error in deletion: " . $conn->error;
        }
        echo "<br>";
        echo "You have delete " .$p_name ;
        echo "<br>";
    } 
}





        

echo "<br>";
echo "<br>";

echo "<script>alert('Successfully delete!!'); window.location.href = 'cemo.php';</script>";

?>