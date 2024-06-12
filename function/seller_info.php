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
        <ul class="d-flex flex-grow-1 justify-content-around align-items-center mx-3 my-0">
        </ul>
        </div>
      </div>
      <div class="nav-info d-none d-xl-flex">
        <?php
                session_start(); 
                $loggedInUser = isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest';
                $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 'Guest';
              echo '<li><a class="text-light" href="seller_information.php">' . htmlspecialchars($loggedInUser) . '</a></li>';?>
               <li><a href="logout.php" style="color:white;">Logout</a></li> 

    </nav>
    <div class="heading">
      <div class="heading-top mb-5">
        <h1>Your Information</h1>
      </div>
     

       
    </div>
  </header>
  <div class="boxes search-boxes d-md-flex">
        <!-- left  -->
        <section class="filter-search p-3">
        </section>
    <section class="result container-fluid">
  <?php
    include "connectDB.php";

    $start_time = microtime(true);

    $sql = "SELECT * FROM `seller` WHERE s_id = '$user_id' ";
    $result = mysqli_query($conn, $sql);
    $num_results = mysqli_num_rows($result);

    $end_time = microtime(true);
    $query_time = number_format($end_time - $start_time, 5);

    echo "<a class='result-heading' href='#'>";
    echo "<h6 class='ps-3 pt-3'> We found result in {$query_time} seconds:</h6>";
    echo "</a>";

    echo "<!DOCTYPE html>";
    echo "<html lang='en'>";
    echo "<head>";
    echo "    <meta charset='UTF-8'>";
    echo "    <title>User Profile</title>";
    echo "    <style>";
    echo "        body {";
    echo "            font-family: Arial, sans-serif;";
    echo "            background-color: #f4f4f4;";
    echo "            margin: 0;";
    echo "            padding: 0;";
    echo "        }";
    echo "";
    echo "        .container {";
    echo "            width: 80%;";
    echo "            margin: 20px auto;";
    echo "            background-color: #fff;";
    echo "            padding: 20px;";
    echo "            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);";
    echo "            border-radius: 5px;";
    echo "        }";
    echo "";
    echo "        .result-heading {";
    echo "            text-decoration: none;";
    echo "            color: #333;";
    echo "        }";
    echo "";
    echo "        .result-heading h6 {";
    echo "            margin: 0;";
    echo "            padding-left: 10px;";
    echo "            padding-top: 10px;";
    echo "        }";
    echo "";
    echo "        .user-info {";
    echo "            margin-top: 20px;";
    echo "        }";
    echo "";
    echo "        .user-info p {";
    echo "            margin: 0;";
    echo "            padding: 5px;";
    echo "        }";
    echo "    </style>";
    echo "</head>";
    echo "<body>";
    echo "    <div class='container'>";
    
    $row = mysqli_fetch_assoc($result);
    $information = $row["information"];
    $s_name = $row["s_name"];
    $phone = $row["phone"];
    
    echo "        <div class='user-info'>";
    echo "            <p><strong>User ID:</strong> {$user_id}</p>";
    echo "            <p><strong>User Name:</strong> {$s_name}</p>";
    echo "            <p><strong>Phone:</strong> {$phone}</p>";
    echo "            <p><strong>Information:</strong> {$information}</p>";
    echo "        </div>";
    echo "    </div>";
    echo "</body>";
    echo "</html>";
 
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