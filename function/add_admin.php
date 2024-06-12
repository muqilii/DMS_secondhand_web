<?php 
include "connectDB.php";

    $sql = "SELECT p_id FROM product ORDER BY p_id DESC LIMIT 1";
    $result = $conn->query($sql);

    if ($result === false) {
        die("False: " . $conn->error);
    }

    $row = $result->fetch_assoc();
    $last_p_id = $row["p_id"];
    echo "<br>";
    echo "<br>";


    $p_id = $last_p_id + 1;
    $p_name1 = $_POST['p_name'];
    $p_name = preg_replace('/\s+/', '_', $p_name1);
    
    $amount = $_POST['amount'];
    $price = $_POST['price'];
    $c_id = $_POST['c_id'];
    $s_id = $_POST['s_id'];
    $picture = "image/".$p_name.".jpg";
    $information = $_POST['information'];

    $sql = "INSERT INTO product (p_id, p_name, amount, price, picture, information) VALUES ('$p_id', '$p_name', '$amount', '$price','$picture', '$information')";

    if ($conn->query($sql) === TRUE) {
        echo "Successfully insert!!";
    } else {
        echo "Error in  insert: " . $conn->error;
    }
    
    $sql = "INSERT INTO product_category (p_id, c_id, s_id) VALUES ('$p_id', '$c_id', '$s_id')";

    if ($conn->query($sql) === TRUE) {
        echo "Successfully insert!!";
    } else {
        echo "Error in  insert: " . $conn->error;
    }
        

echo "<script>alert('Successfully insert!!'); window.location.href = 'admin_a.php';</script>";

?>