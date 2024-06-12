<?php
// 在这里设置商品的信息和价格
$products = [
    ['id' => 1, 'name' => 'Product A', 'price' => 10.00],
    ['id' => 2, 'name' => 'Product B', 'price' => 20.00],
    ['id' => 3, 'name' => 'Product C', 'price' => 30.00],
];

// 初始化购物车
session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// 处理加入购物车操作
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_to_cart"])) {
    $product_id = $_POST["product_id"];
    $quantity = $_POST["quantity"];

    // 检查购物车中是否已经有该商品
    $found = false;
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['product_id'] == $product_id) {
            $item['quantity'] += $quantity;
            $found = true;
            break;
        }
    }

    // 如果购物车中没有该商品，则添加新的项
    if (!$found) {
        $_SESSION['cart'][] = ['product_id' => $product_id, 'quantity' => $quantity];
    }
}

// 处理更新购物车数量操作
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update_cart"])) {
    $updates = $_POST["updates"];
    foreach ($updates as $product_id => $quantity) {
        // 更新购物车中的商品数量
        foreach ($_SESSION['cart'] as &$item) {
            if ($item['product_id'] == $product_id) {
                $item['quantity'] = $quantity;
                break;
            }
        }
    }
}

// 处理移除购物车商品操作
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["remove_from_cart"])) {
    $product_id = $_POST["product_id"];

    // 从购物车中移除商品
    $_SESSION['cart'] = array_filter($_SESSION['cart'], function ($item) use ($product_id) {
        return $item['product_id'] != $product_id;
    });
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>结算页面</title>
</head>
<body>

<h1>购物车</h1>

<form method="post" action="checkout.php">
    <table border="1">
        <tr>
            <th>商品</th>
            <th>价格</th>
            <th>数量</th>
            <th>小计</th>
            <th>操作</th>
        </tr>

        <?php
        $total = 0;
        foreach ($_SESSION['cart'] as $item) {
            $product = $products[$item['product_id'] - 1];
            $subtotal = $product['price'] * $item['quantity'];
            $total += $subtotal;
            ?>
            <tr>
                <td><?php echo $product['name']; ?></td>
                <td><?php echo $product['price']; ?></td>
                <td>
                    <input type="number" name="updates[<?php echo $item['product_id']; ?>]" value="<?php echo $item['quantity']; ?>" min="0">
                </td>
                <td><?php echo $subtotal; ?></td>
                <td>
                    <button type="submit" name="remove_from_cart" value="<?php echo $item['product_id']; ?>">移除</button>
                </td>
            </tr>
            <?php
        }
        ?>

        <tr>
            <td colspan="3">总计</td>
            <td><?php echo $total; ?></td>
            <td></td>
        </tr>
    </table>

    <button type="submit" name="checkout">结算</button>
</form>

</body>
</html>
