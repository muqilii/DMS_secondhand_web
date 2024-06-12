<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
  <link rel='icon' href="img/hand.png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
  <title>Add Product</title>
</head>

<body>
    
<header class="pb-3" >
    <nav class="navbar navbar-expand-md d-flex justify-content-between  py-1">
      <div class="wrapper container-fluid d-flex justify-content-space-between ">
        <a class="navbar-brand text-uppercase text-light " ><img class="logo" src="img/hand.png" alt="Logo" width="200" height="200">Admin Page</a>
        <button type="button" class="navbar-toggler border-0 " data-bs-toggle="collapse" data-bs-target="#navbarNav"
          aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <i class="fas fa-chevron-circle-down text-red font-l"></i>
        </button>
        <div class="collapse navbar-collapse " id="navbarNav">
          <ul class="navbar-nav d-flex flex-grow-1 justify-content-around">
          <li class="nav-item">
    <a class="nav-link text-uppercase text-light" href="admin_d.php" style="font-size: 18px;"><i class="fas fa-trash"></i>Delete</a>
</li>
<li class="nav-item">
    <a class="nav-link text-uppercase text-light" href="admin_a.php" style="font-size: 18px;"><i class="fas fa-plus"></i>Add</a>
</li>

          </ul>
        </div>
      </div>
      <div class="nav-info d-none d-xl-flex">
      <ul class="d-flex flex-grow-1 justify-content-around align-items-center mx-3 my-0">
          <?php
                session_start(); 
                $loggedInUser = isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest';
              echo '<li><a class="text-light" href="#">' . htmlspecialchars($loggedInUser) . '</a></li>';
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
        <h1>Add Product</h1>
      </div>
      
    </div>
  </header>
<head>
    <meta charset="UTF-8">
    <title>Add</title>
</head>
<div class="boxes search-boxes d-md-flex">
        <!-- left  -->
        <section class="filter-search p-3">
        </section>
    <section class="result container-fluid">
<body>
<form action="admintest.php" enctype="multipart/form-data" method="post" >
<br><br>
    <a><strong>Choose picture to update</strong>(name should be same as product)：<a><input type="file" name="file">
                  <input type="submit">
                  <br><br>
</form>
</body>

<?php 
include "connectDB.php";



echo "<form id='loginform' action='add_admin.php' method='post'>";
echo "<div class='inputBox'>";
echo "<div class='inputText'>";
echo "<input type='text' id='p_name' name='p_name'required='required' placeholder='product name' value=''>";
echo "</div>";
echo "<br>";

echo "<div class='inputText'>";
echo "<input type='text' id='amount' name='amount'required='required' placeholder='amount' value=''>";
echo "</div>";
echo "<br>";

echo "<div class='inputText'>";
echo "<input type='text' id='price' name='price'required='required' placeholder='price' value=''>";
echo "</div>";
echo "<br>";

echo "<div class='inputText'>";
echo "<input type='text' id='c_id' name='c_id'required='required' placeholder='category id' value=''>";
echo "</div>";
echo "<br>";

echo "<div class='inputText'>";
echo "<input type='text' id='s_id' name='s_id'required='required' placeholder='s_id' value=''>";
echo "</div>";
echo "<br>";

echo "<input type='text' id='information' name='information'required='required' placeholder='information' value=''>";
echo "</div>";
// echo "<div class='inputText'>";
// echo "<input type='text' id='AD' name='AD' placeholder='add or delete' value=''>";
// echo "</div>";
// echo "<br>";

// echo "<h2>Delete products</h2>";

echo "<div>";
echo "<button type='submit' name='submit' class='btn bg-red text-light' style='display: block; font-size: 12px; padding: 10px 20px;'>Submit</button><br><br>"; 
echo "</div>";
echo "</form>";


$sql = "SELECT * FROM product";

$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_assoc($result)) {
    $fruitname = $row["p_name"];
    $price = $row["price"];
    $pic = $row["picture"];
    echo "$fruitname";
    echo "<div class='fruit-item'>";
    echo "  <img src='$pic' width='192' height='108' />";
    echo "  <label>";
    echo "    $fruitname";
    echo "  </label>";
    //   echo "  <label>";
    //   echo "    Choose quantity:";
    //   echo "    <input type='number' name='$quantity' min='0' max='100' value='0' />";
    //   echo "    kg";
    //   echo "  </label>";
    echo "  <span>￥$price</span>";
    echo "</div>";
}


?>