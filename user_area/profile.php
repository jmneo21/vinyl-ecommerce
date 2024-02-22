<!-- connect to file -->
<?php
include('../include/connect.php');
include('../functions/common_function.php');
session_start();
?>
<!<DOCTYPE html>
<html lang="en">
<head>
    <meta charset ="UTF-8">
    <meta http - equiv ="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Welcome <?php echo $_SESSION['username'] ?></title>
    
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
.logo{
    width:5%;
    height:5%;
}
.profile_image{
    width:90%;
    height:90%;
    margin:auto;
    display:block;
    object-fit:contain;
}

  </style>
</head> 
<body>
    <!-- navbar -->
        <div class="container-fluid p-0">
            <!-- first child -->
            <nav class="navbar navbar-expand-lg bg-dark">
  <div class="container-fluid">
    <img src="../images/logo.png" alt="" class="logo">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active text-white" aria-current="page" href="../index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="../display_all.php">Products</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="profile.php">My Account</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="#">Contact</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="../cart.php"><i class="fa-solid fa-cart-shopping"></i><sup><?php
          cart_item();?></sup></a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="#">Total Price: ₱<?php total_cart_price();?> </a>
        </li>
        
      </ul>
      <form class="d-flex" action="../search_product.php" method="get">
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
          <a class='nav-link text-white' href='logout.php'>Logout</a>
      </li>";
        }
        ?>
    </ul>
</nav>
<!-- image carousel -->



<!-- fourth child -->
<div class="row">
    <div class="col-md-2 mt-2">
<ul class="navbar-nav bg-light text-center" style="height:100vh">
        <li class="nav-item bg-secondary">
        <a class="nav-link text-white" aria-current="page" href=""><h4>Your Profile</h4></a>
        </li>

        <?php
        $username=$_SESSION['username'];
        $user_image="SELECT * FROM `user` WHERE username='$username'";
        $result_image=mysqli_query($conn,$user_image);
        $row_image=mysqli_fetch_array($result_image); //change later
        $user_image=$row_image['user_image'];
        echo "<li class='nav-item'>
        <img src='./user_images/$user_image' class='profile_image my-4' alt=''>
    </li>";
         
        ?>

        <li class="nav-item">
        <a class="nav-link text-dark" aria-current="page" href="profile.php">Pending Orders</a>
        </li>
        <li class="nav-item">
        <a class="nav-link text-dark" aria-current="page" href="profile.php?edit_account">Edit Account</a>
        </li>
        <li class="nav-item">
        <a class="nav-link text-dark" aria-current="page" href="profile.php?my_orders">My Orders</a>
        </li>
        <li class="nav-item">
        <a class="nav-link text-dark" aria-current="page" href="profile.php?delete_account">Delete Account</a>
        </li>
        <li class="nav-item">
        <a class="nav-link text-dark" aria-current="page" href="logout.php">Logout</a>
        </li>

</ul>
    </div>
    <div class="col-md-10 text-center">
        <?php
        get_user_order_details();
        if(isset($_GET['edit_account'])){
            include('edit_account.php');
        }
        if(isset($_GET['my_orders'])){
            include('user_orders.php');
        }
        if(isset($_GET['delete_account'])){
          include('delete_account.php');
      }
        ?>
    </div>
</div>


<!-- include footer -->
<?php include("../include/footer.php")

?>
</div>

    <!-- bootstrap js link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" 
    crossorigin="anonymous">

   
</body>
</html>