<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
  <link rel='icon' href="img/hand.png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
  <title>Food</title>
</head>

<body>
  <header class="pb-3" style="background-image: url('img/food.jpg')">
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
              <a class="nav-link text-uppercase text-light" href="index.php"><i
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
              <a href="Login.html" class="btn bg-red text-light">Register/Login</a>
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
        <!-- <img class="logo" src="img/Cake-Logo-Transparent-white.png" alt="Logo"> -->
        <br><br>
        <h1>Food</h1>
        <!-- <p class="text-uppercase">We make Cakes for you </p> -->
      </div>

    </div>
  </header>
  <body>
    <div class="boxes search-boxes d-md-flex">
        <!-- left  -->
        <section class="filter-search p-3">
        </section>
    <section class="result container-fluid">
          
          <?php
            include "connectDB.php";
            $start_time = microtime(true);

            //$sql = "SELECT * FROM product WHERE c_id = '2'";
            $sql = "SELECT p.* 
            FROM product p
            JOIN product_category pc ON p.p_id = pc.p_id
            WHERE pc.c_id = '2'";
            $result = mysqli_query($conn, $sql);
            $num_results = mysqli_num_rows($result);

            $end_time = microtime(true);


            $query_time = number_format($end_time - $start_time, 5);

            echo "<a class='result-heading' href='#'>";
            echo "<h6 class='ps-3 pt-3'> We found <strong>{$num_results}</strong> Results for category <strong>\"Food\"</strong> in {$query_time} seconds:</h6>";
            echo "</a>";
  
      while($row = mysqli_fetch_assoc($result)) {
        $fruitname = $row["p_name"];
        $price = $row["price"];
        $pic = $row["picture"];
        $information = $row["information"];
        $product_id = $row["p_id"];

        echo "<article class='card d-flex p-3 mb-3 col-md-3'>";
        echo "  <div class='article-img w-100 position-relative text-center'>";
        echo "    <a href='#'><img class='w-100 h-100 max-width-100' src='$pic' alt='$fruitname'></a>";
        echo "    <div class='arrows position-absolute bottom-0 end-0 bg-black'>";
        echo "    </div>";
        echo "  </div>";
        echo "  <div class='article-text d-md-flex flex-grow-1 flex-column justify-content-between w-100'>";
        echo "    <a href='#'>";
        echo "      <h4 style ='font-size: 30px'>$fruitname</h4>";
        echo "    </a>";
        echo "    <p class='text-red fw-bold' style ='font-size: 20px' > $price $</p>";
        echo "    <p>$information</p>";
        echo "    <div class='price'>";
        echo "<form method='post' action='new.php'>";
        echo "<input name='p_id' type='hidden' value='" . $product_id . "'>";
        echo "<input name='b_id' type='hidden' value='" . $user_id . "'>";
        echo "<button type='submit' name='add_to_cart' class='btn bg-red text-light' style='display: block; font-size: 12px; padding: 10px 20px;'>Add to cart</button>";
        echo "</form>";
        echo "    </div>";
        echo "  </div>";
        echo "</article>";
        }
  ?>
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