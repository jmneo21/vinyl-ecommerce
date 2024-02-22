<?php
include('../include/connect.php');
include('../functions/common_function.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <!--bootstrap css link-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" 
    rel="stylesheet" 
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" 
    crossorigin="anonymous">

    <!--font awesome link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" 
    integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!--css file-->
    <link rel="stylesheet" href="../style.css">
    <!--css style-->
    <style>
        .admin_image {
    width: 100px;
    object-fit: contain;
}
    .col-md-12 {
  height: 150px; /* Adjust the height to your desired value */
}
body{
    overflow-x:hidden;
}
.product_img{
        width:100px;
        object-fit:contain;
    }
   
    </style>
</head>
<body>
    <!--nav bar-->
    <div class="container-fluid p-0">
        <!--first child-->
        <nav class="navbar navbar-expand-lg bg-dark">
            <div class="container-fluid">
                <img src="../images/logo.png" alt="" class="logo">
                <nav class="navbar navbar-expand-lg">
                    <ul class="navbar nav">
                    <li class="nav-item">
          <a class="nav-link active text-white" aria-current="page" href="../index.php">Go to Home Page</a>
        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link text-white">Welcome Admin</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </nav>
        <!--second child-->
        <div class="bg-light">
            <h3 class="text-center p-2">Manage Details</h3>
        </div>
        <!--third child-->
        <div class="row">
            <div class="col-md-12 bg-secondary p-1 d-flex align-items-center">
                <div class="p-3">
                    <a href=""><img src="../images/profile1.jpg" alt="" class="admin_image"></a>
                    <p class="text-white text-center">Admin Name</p>
                </div>
                <div class="button text-center mx-auto">
                    <button class="my-3"><a href="insert_product.php" class="nav-link text-dark bg-white my-1">Insert Products</a></button>
                    <button><a href="index.php?view_products" class="nav-link text-dark bg-white my-1">View Products</a></button>
                    <button><a href="index.php?insert_category" class="nav-link text-dark bg-white my-1">Insert Genres</a></button>
                    <button><a href="index.php?view_categories" class="nav-link text-dark bg-white my-1">View Categories</a></button>
                    <button><a href="index.php?list_orders" class="nav-link text-dark bg-white my-1">All Orders</a></button>
                    <button><a href="index.php?list_payments" class="nav-link text-dark bg-white my-1">All Payments</a></button>
                    <button><a href="index.php?list_users" class="nav-link text-dark bg-white my-1">List Users</a></button>
                    <button><a href="../index.php" class="nav-link text-dark bg-white my-1">Logout</a></button>
                </div>
            </div>
        </div>
    </div>
    <!-- Fourt child -->
    <!-- php get function/insert categories -->
    <div class="container my-3">
        <?php
        if(isset($_GET['insert_category'])){
            include('insert_categories.php');
        }
        if(isset($_GET['insert_brands'])){
            include('insert_brands.php');
        }
        if(isset($_GET['view_products'])){
            include('view_products.php');
        }
        if(isset($_GET['edit_products'])){
            include('edit_products.php');
        }
        if(isset($_GET['delete_product'])){
            include('delete_product.php');
        }
        if(isset($_GET['view_categories'])){
            include('view_categories.php');
        }
        if(isset($_GET['edit_category'])){
            include('edit_category.php');
        }
        if(isset($_GET['delete_category'])){
            include('delete_category.php');
        }
        if(isset($_GET['list_orders'])){
            include('list_orders.php');
        }
        if(isset($_GET['list_payments'])){
            include('list_payments.php');
        }
        if(isset($_GET['list_users'])){
            include('list_users.php');
        }
        
        ?>
        
    </div>
    <!-- last child -->
    <div class="bg-dark p-3 text-center text-white">
        <p>All rights reserved ©- designed by pup students - 2023</p>
    </div>

  <!--bootstrap js link--> 
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" 
    crossorigin="anonymous">
   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>    
</body>
</html>