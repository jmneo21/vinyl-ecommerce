<!-- connect to file -->
<?php
include('./include/connect.php');
include('functions/common_function.php');
session_start();
?>
<!<DOCTYPE html>
<html lang="en">
<head>
    <meta charset ="UTF-8">
    <meta http - equiv ="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Vinyl Records Shop</title>
    
    <!-- bootsrap css link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" 
    rel="stylesheet" 
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" 
    crossorigin="anonymous">
<!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" 
    integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- java link-->
    <script src="path/to/your/script.js"></script>

    <!-- css file -->
    <link rel="stylesheet" href="style.css">

  <!-- card body style -->
  <style>
    .card-body {
    width: 100%;
    height: 150px;
}
    .card-text {
    font-size: 12px;
}
    .card-title {
    font-size: 14px;
}
body{
    overflow-x:hidden;
}
  </style>
</head> 
<body>
    <!-- navbar -->
        <div class="container-fluid p-0">
            <!-- first child -->
            <nav class="navbar navbar-expand-lg bg-dark">
  <div class="container-fluid">
    <img src="./images/logo.png" alt="" class="logo">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active text-white" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="display_all.php">Products</a>
        </li>
        <?php
        if(isset($_SESSION['username'])){
          echo "<li class='nav-item'>
          <a class='nav-link text-white' href='./user_area/profile.php'>My Account</a>
        </li>";
        }else{
          echo "<li class='nav-item'>
          <a class='nav-link text-white' href='./user_area/user_registration.php'>Register</a>
        </li>";
        }
        
        ?>
        <li class="nav-item">
          <a class="nav-link text-white" href="#">Contact</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="cart.php"><i class="fa-solid fa-cart-shopping"></i><sup><?php
          cart_item();?></sup></a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="#">Total Price: ₱<?php total_cart_price();?></a>
        </li>
        
      </ul>
      <form class="d-flex" action="" method="get">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search_data">
        
        <input type="submit" value="Search" class="btn btn-outline-light" name="search_data_product">
      </form>
    </div>
  </div>
</nav>

<!-- call cart function -->
<?php
cart();
?>

<!-- second child -->
<nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
    <ul class="navbar-nav me-auto">
        
        <?php
        if(!isset($_SESSION['username'])){
          echo "<li class='nav-item'>
          <a class='nav-link text-white' href='#'>Welcome Guest</a>
      </li>";
        }else{
          echo "<li class='nav-item'>
          <a class='nav-link text-white' href=''>Welcome <strong>".$_SESSION['username']."!</strong></a>
      </li>";
        }

        if(!isset($_SESSION['username'])){
          echo "<li class='nav-item'>
          <a class='nav-link text-white' href='./user_area/user_login.php'>Login</a>
      </li>";
        }else{
          echo "<li class='nav-item'>
          <a class='nav-link text-white' href='./user_area/logout.php'>Logout</a>
      </li>";
        }
        ?>
    </ul>
</nav>
<!-- image carousel -->

<!-- third child -->
<div class="bg-light">
    <h3 class="text-center">Vinyl Records</h3>
    <p class="text-center">"Spin Your Memories with the Classics: Your Destination for Vintage Vinyl"</p>
</div>

<!-- Fourth Child -->
<div class="row px-1">
    <div class="col-md-10">
        <!-- products -->
        <div class="row">
    <!-- fetching products -->
        <?php
        //calling function
        search_product();
        get_unique_categories();
        ?>                       
</div>
    </div> 
    <!-- side nav bar -->
<div class="col-md-2 bg-light p-0">

<!-- Genres to display -->
<ul class="navbar-nav me-auto text-center">
        <li class="nav-item bg-secondary">
            <a href="#" class="nav-link text-white">
                <h4>Genres</h4></a>
        </li>

        <?php
       getcategories();
        ?>
        
</ul>
</div>
</div>

<!-- include footer -->
<?php include("./include/footer.php")

?>
</div>

    <!-- bootstrap js link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" 
    crossorigin="anonymous">

   
</body>
</html>