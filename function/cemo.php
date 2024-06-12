<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
  <link rel='icon' href="img/hand.png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
  <title>Delete Product</title>
  <style>
    .btn.bg-black.text-light.font-sm.fw-bold {
        font-size: 18px; /* 调整为你想要的大小 */
    }
</style>
</head>

<body>
    
<header class="pb-3" >
    <nav class="navbar navbar-expand-md d-flex justify-content-between  py-1">
      <div class="wrapper container-fluid d-flex justify-content-space-between ">
        <a class="navbar-brand text-uppercase text-light " ><img class="logo" src="img/hand.png" alt="Logo" width="200" height="200">Seller Page</a>
        <button type="button" class="navbar-toggler border-0 " data-bs-toggle="collapse" data-bs-target="#navbarNav"
          aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <i class="fas fa-chevron-circle-down text-red font-l"></i>
        </button>
        <div class="collapse navbar-collapse " id="navbarNav">
          <ul class="navbar-nav d-flex flex-grow-1 justify-content-around">
          <li class="nav-item">
    <a class="nav-link text-uppercase text-light" href="cemo.php" style="font-size: 18px;"><i class="fas fa-trash"></i>Delete</a>
</li>
<li class="nav-item">
    <a class="nav-link text-uppercase text-light" href="demo.php" style="font-size: 18px;"><i class="fas fa-plus"></i>Add</a>
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
              echo '<li><a class="text-light" href="seller_info.php">' . htmlspecialchars($loggedInUser) . '</a></li>';
              if ($loggedInUser == 'Guest') {
                echo "<script>alert('Please Log in first'); window.location.href = 'Login.html';</script>";
            }?>
               <li><a href="logout.php" style="color:white;">Logout</a></li> 
        </ul>
      </div>
    </nav>
    <div class="heading">
      <div class="heading-top mb-5">
        
        <br><br>
        <h1>Delete Product</h1>
        
      </div>
      <a href="searchCemo.php" class="btn bg-black text-light font-sm fw-bold mt-3 mt-md-0 ms-md-2">
    <i class="fas fa-search"></i> Search
    </a>
    </div>
  </header>
  <div class="boxes search-boxes d-md-flex">
        <!-- left  -->
        <section class="filter-search p-3">
        </section>
    <section class="result container-fluid">
<?php 
include "connectDB.php";

$sql = "SELECT * FROM seller WHERE s_id = '$user_id' AND s_name = '$loggedInUser'";
$result = $conn->query($sql);

// 检查是否找到匹配的记录
if ($result->num_rows > 0) {
  echo '<li><a class="text-light" href="seller_info.php">' . htmlspecialchars($loggedInUser) . '</a></li>';
} else {
    echo "<script>alert('Invalid user credentials'); window.location.href = 'index.php';</script>";
}
echo "<br>";
echo "<div class='inputText'>";

echo "</div>";

$sql = "SELECT * FROM product 
JOIN product_category USING(p_id)
 WHERE s_id ='$user_id'";

$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_assoc($result)) {
    $fruitname = $row["p_name"];
    $price = $row["price"];
    $pic = $row["picture"];
   
echo "<form id='loginform' action='delete.php' method='post'>"; 
echo "<input type='text' style ='display: none;'  id='s_id' name='s_id' placeholder='s_id' value='$user_id'>";  
echo "<article class='card d-flex p-3 mb-3 col-md-3'>";
echo "  <div class='article-img w-100 position-relative text-center'>";
echo "    <a href='#'><img class='w-100 h-100 max-width-100' src='$pic' alt='$fruitname'></a>";
echo "    <div class='arrows position-absolute bottom-0 end-0 bg-black'>";
echo "    </div>";
echo "  </div>";
echo "  <div class='article-text d-md-flex flex-grow-1 flex-column justify-content-between w-100'>";
echo "    <a href='#'>";
echo "      <h4 style ='font-size: 40px'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$fruitname</h4>";
echo "    </a>";
echo "    <p class='text-red fw-bold' style ='font-size: 30px' >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $price $</p>";
echo "    <input type='checkbox' name='hlhl[]' value='$fruitname' style='transform: scale(2); position: relative; top: 4px;'>";
echo "  </div>";
echo "</article>";


}

echo "<br>";
echo "<br>";

echo "<div>";
echo "<button type='submit' name='submit' class='btn bg-red text-light' style='display: block; font-size: 18px; padding: 20px 40px;'>Submit</button><br><br>"; 
echo "</div>";
echo "</form>";
