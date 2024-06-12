<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
  <link rel='icon' href="img/hand.png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
  <title>CART</title>
</head>

<body>
  <header class="pb-3">
    <nav class="navbar navbar-expand-md d-flex justify-content-between  py-1">
      <div class="wrapper container-fluid d-flex justify-content-space-between ">
        <a class="navbar-brand text-uppercase text-light " href="index.php"><img class="logo" src="img/hand.png" alt="Logo" width="200" height="200">SECOND-HAND STORE</a>
        <button type="button" class="navbar-toggler border-0 " data-bs-toggle="collapse" data-bs-target="#navbarNav"
          aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <i class="fas fa-chevron-circle-down text-red font-l"></i>
        </button>
        <div class="collapse navbar-collapse " id="navbarNav">
          <ul class="navbar-nav d-flex flex-grow-1 justify-content-around">
            <li class="nav-item">
              <a class="nav-link text-uppercase text-light" aria-current="page" href="index.php"><i
                  class="fas fa-home"></i> Home</a>
            </li>
            <li class="nav-item">
              <select id="categorySelect" class="form-select">
                <option value="index.php" selected disabled>Select Category</option>
                <option value="Food.php">Food</option>
                <option value="Electronic.php">Electronic</option>
                <option value="Furniture.php">Furniture</option>
                <option value="Cloth.php">Cloth</option>
                <option value="Sports items.php">Sports items</option>
              </select>
            </li>
            <li class="nav-item">
              <a class="nav-link text-uppercase text-light" href="cart1111.php"><i class="fas fa-history"></i> History Order</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-uppercase text-light" href="wishlist.php"><i class="fas fa-shopping-cart"></i> My Cart</a>
            </li>
            <li class="nav-item">
              <li class="nav-item">
                <a href="Login.html" class="btn bg-red text-light">Register/Login</a>
              </li>  
            </li>
          </ul>
        </div>
      </div>
      <div class="nav-info d-none d-xl-flex">
        <ul class="d-flex flex-grow-1 justify-content-around align-items-center mx-3 my-0">
        <?php
                session_start(); 
                $loggedInUser = isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest';
                $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 'Guest';
              echo '<li><a class="text-light" href="buyer_information.php">' . htmlspecialchars($loggedInUser) . '</a></li>';?>
               <li><a href="logout.php" style="color:white;">Logout</a></li> 
        </ul>
      </div>
    </nav>
    <div class="heading">
      <div class="heading-top mb-5">
        <h1>History Order</h1>
        
      </div>
     

       
    </div>
  </header>
  <form method="post" action="checkout.php">
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Unit Price</th>
                <th>Total Price</th>
            </tr>
        </thead>
        <tbody>
  <?php
    include "connectDB.php";

    $start_time = microtime(true);

    //$sql = "SELECT * FROM `order` JOIN product USING(p_id) WHERE b_id = '$user_id' ";
    $sql = "SELECT * FROM `order` 
    JOIN `order_product` USING(o_id) 
    JOIN `product` USING(p_id) 
    WHERE `order`.`b_id` = '$user_id'
    ORDER BY `order`.`o_id` ASC";

    $result = mysqli_query($conn, $sql);
    $num_results = mysqli_num_rows($result);

    $end_time = microtime(true);
$query_time = number_format($end_time - $start_time, 5);

    echo "<a class='result-heading' href='#'>";
    echo "<h6 class='ps-3 pt-3'> We found <strong>{$num_results}</strong> Results for <strong>\"Your Order\"</strong> in {$query_time} seconds:</h6>";
    echo "</a>";
 
    
    $prev_order_id = null; // 用于保存上一次的 order_id

    while ($row = mysqli_fetch_assoc($result)) {
        $order_id = $row["o_id"];
        $fruitname = $row["p_name"];
        $price = $row["price"];
        $pic = $row["picture"];
        $information = $row["information"];
        $product_id = $row["p_id"];
        $quantity = $row["quantity"];
    
        // 如果当前的 order_id 与上一个相同，则跳过此次循环
        if ($order_id == $prev_order_id) {
          echo "<tr>";
          echo "<td></td>"; // Placeholder for Order ID if the same as the previous one
          echo "<td>{$fruitname}</td>";
          echo "<td>{$quantity}</td>";
          echo "<td>{$price}$</td>";
          echo "<td>" . ($price * $quantity) . "$</td>";
          echo "</tr>";
          continue;
      }

      // 输出信息
      echo "<tr>";
      echo "<td>{$order_id}</td>";
      echo "<td>{$fruitname}</td>";
      echo "<td>{$quantity}</td>";
      echo "<td>{$price}$</td>";
      echo "<td>" . ($price * $quantity) . "$</td>";
      echo "</tr>";

      // 更新上一个 order_id 的值
      $prev_order_id = $order_id;
  }

?>


  
  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf"
    crossorigin="anonymous"></script>
  <script src="https://kit.fontawesome.com/6abfc73bc9.js" crossorigin="anonymous"></script>
  <script>
    document.getElementById('categorySelect').addEventListener('change', function() {
      var selectedOption = this.value;
      if (selectedOption !== '#') {
        window.location.href = selectedOption;
      }
    });
  </script>
</body>

</html>