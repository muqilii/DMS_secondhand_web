<style>
    table {
        width: 100%; /* 设置表格宽度为父容器的100% */
        max-width: 800px; /* 设置表格的最大宽度，防止过分放大 */
        margin: 0 auto; /* 将表格居中显示 */
        transform: scale(1.1); /* 使用transform属性放大表格，1.2表示放大到120% */
    }
</style>
<?php
include "connectDB.php";

$sql = "SELECT o_id FROM `order` ORDER BY o_id DESC LIMIT 1";
$result = $conn->query($sql);

// Check the query result
if ($result === false) {
    die("查询失败: " . $conn->error);
}

// Fetch the row from the query result
$row = $result->fetch_assoc();
$last_o_id = $row["o_id"];
$o_id = $last_o_id+1;



if ($_SERVER["REQUEST_METHOD"] == "POST"&& isset($_POST["checkout"])) {

    $selectedFruits = $_POST["hlhl"]; 
    $quantities = array(); 
    $totalPrice = 0; 
    $b_id = $_POST["b_id"];
    // $price = $_POST["price"];
 
    $sql = "INSERT INTO `order` (o_id, b_id)
    VALUES ('$o_id', '$b_id')";

    if ($conn->query($sql) === TRUE) {

    } else {
    }   

    // Get the quantity of each fruit.
    foreach ($selectedFruits as $fruitname) {
        $quantity = $_POST[$fruitname] ?? 0; 
        //$sql = "SELECT * FROM `cart` JOIN product USING(p_id) WHERE b_id = '$b_id' ";

        $sql = "SELECT * FROM `cart`
        JOIN `cart_product` USING(cart_id)
        JOIN `product` USING(p_id)
        WHERE `cart`.`b_id` = '$b_id'";

		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_assoc($result);
		$a = $row["amount"];
        // echo $a;
        // echo "<br>";
        if ($quantity > 0 && $quantity < $a) {
            $quantities[$fruitname] = $quantity;
        }else{
        	echo "$fruitname is not enough !";
            echo"<br><br><a href='index.php'>Buy Again</a>";
        	return;
        }
    }
    


    // Calculate the price of each fruit and the total order price.
    $orderTable = "<table border='1'>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Total Price</th>
                </tr>";

foreach ($quantities as $fruit => $quantity) {
    // Get the price of fruit from the database
            $sql = "SELECT * FROM `cart`
        JOIN `cart_product` USING(cart_id)
        JOIN `product` USING(p_id)
        WHERE `product`.`p_name` = '$fruit'";

    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $price = $row["price"];
        $totalPrice += $price * $quantity;
        $change = $row["amount"] - $quantity;
        $sqlUpdate = "UPDATE product SET amount ='$change' where p_name = '$fruit'";
        $resultUpdate = mysqli_query($conn, $sqlUpdate);
        $p_id = $row["p_id"];

        // Output order details to the table
        $orderTable .= "<tr>
                            <td>$fruit</td>
                            <td>$quantity</td>
                            <td>$price $</td>
                            <td>" . ($price * $quantity) . "$</td>
                        </tr>";

        //$sqlInsert = "INSERT INTO `order` (o_id, p_id, b_id, quantity) VALUES ('$o_id', '$p_id', '$b_id', '$quantity')";


        // $sql = "INSERT INTO `order_product` (o_id, p_id, quantity)
        // VALUES ('$o_id', '$p_id', '$quantity')";

        // if ($conn->query($sql) === TRUE) {
        // } else {
        // }
        // $resultInsert = mysqli_query($conn, $sql);
        $sqlCheck = "SELECT * FROM `order_product` WHERE `o_id` = '$o_id' AND `p_id` = '$p_id'";
$resultCheck = mysqli_query($conn, $sqlCheck);

if ($resultCheck && mysqli_num_rows($resultCheck) == 0) {
    // 记录不存在，可以进行插入操作
    $sql = "INSERT INTO `order_product` (o_id, p_id, quantity)
            VALUES ('$o_id', '$p_id', '$quantity')";

    if ($conn->query($sql) === TRUE) {
        // 插入成功
    } else {
        // 处理错误
    }
} else {
    // 记录已经存在，根据需要进行处理
}

    }
}

// Close the table HTML
$orderTable .= "</table>";

// Output the order table
echo $orderTable;

// Output total price
echo "<br>Total Price: $" . $totalPrice;

// Add order date
echo "<br>Date: " . date("Y-m-d H:i:s");
    //$sql_clear_cart = "DELETE FROM `cart` WHERE b_id = '$b_id'";

    $sql_clear_cart = "DELETE cart_product FROM cart_product
    JOIN cart ON cart_product.cart_id = cart.cart_id
    WHERE cart.b_id = '$b_id'";
    $result_clear_cart = mysqli_query($conn, $sql_clear_cart);

    if ($result_clear_cart) {
        echo "<br>Cart cleared successfully.";
    } else {
        echo "<br>Error clearing cart: " . mysqli_error($conn);
        }

    $sql_clear_cart = "DELETE FROM cart WHERE b_id = '$b_id'";
    $result_clear_cart = mysqli_query($conn, $sql_clear_cart);

    if ($result_clear_cart) {
        //echo "<br>Cart cleared successfully.";
    } else {
        echo "<br>Error clearing cart: " . mysqli_error($conn);
        }

    echo"<br><br><a href='index.php'>Buy more</a>";
    }
    
mysqli_close($conn);
?>