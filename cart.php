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
    <title>Ecommerce Website-Cart details</title>
    
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
    .cart_img {
    width: 80px;
    height: 80px;
    object-fit:contain;
}

.sample {
  margin-left: 118px;
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
          <a class="nav-link text-white" href="#">Total Price: ₱<?php total_cart_price();?> </a>
        </li>      
      </ul>
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

<!-- fourth child -->
<div class="container">
    <div class="row">
        <form action="" method="post">
        <table class="table table-bordered bg-light text-center">
            <thead>
                <tr>
                   <th>Product Title</th>
                   <th>Product Image</th>
                   <th>Quantity</th>
                   <th>Total Price</th>
                   <th>Remove</th>
                   <th colspan="2">Operations</th>
                </tr>
            </thead>
            <tbody>
                <!-- php code to display dynamic data -->
                <?php
             
                 $get_ip_address=getIPAddress();
                 $total_price=0;
         
                 $cart_query="SELECT * FROM `cart_details` WHERE ip_address='$get_ip_address'";
                 $result=mysqli_query($conn,$cart_query);
                 
            
                 while($row=mysqli_fetch_assoc($result)){
         
                    $product_id=$row['product_id'];
                    $select_products="SELECT * FROM `product` WHERE id=$product_id";
                    $result_products=mysqli_query($conn,$select_products);
         
                 while($row_product_price=mysqli_fetch_assoc($result_products)){

                     $product_price=array($row_product_price['price']);
                     $price_table=$row_product_price['price'];
                     $product_title=$row_product_price['name'];
                     $product_image=$row_product_price['product_image'];
                     $product_values=array_sum($product_price);
                     $total_price+=$product_values;
         
            
             
                ?>
                <tr>
                    <td><?php echo $product_title?></td>
                    <td><img src="./admin/product_images/<?php echo $product_image?>" alt="" class="cart_img"></td>
                    <td><!-- HTML code for the plus/minus box -->
                        <button type="button" onclick="decrement()" style="width: 20px; height: 20px; font-size: 12px;">-</button>
                        <input type="text" name="quantity" id="quantity" value="1" size="4" style="text-align: center;">
                        <button type="button" onclick="increment()" style="width: 20px; height: 20px; font-size: 12px;">+</button>
                    </td>
                    <?php
                    $get_ip_address=getIPAddress();
                    if(isset($_POST['update_cart'])) {

                        $quantities=$_POST['quantity'];
                        $update_cart="UPDATE `cart_details` SET quantity=$quantities WHERE ip_address='$get_ip_address'";
                        $result_products_quantity=mysqli_query($conn,$update_cart);
                        $total_price=$total_price*$quantities;

                    }
                    ?>
                    <td>₱<?php echo $price_table?> </td>
                    <td><input type="checkbox" name="removeitem[]" value="<?php echo $product_id?>"></td>
                    <td>
                       <!-- <button class="bg-dark px-3 border-0 mx-3 text-white" 
                       style="height: 30px;">Update</button> -->
                       
                       <input type="submit" value="Update Cart" class="bg-dark px-3 border-0 mx-3 text-white" 
                       style="height: 30px;" name="update_cart">
                      <!--  <button class="bg-dark px-3 border-0 mx-3 text-white" 
                       style="height: 30px;">Remove</button> -->
                       <input type="submit" value="Remove Cart" class="bg-dark px-3 border-0 mx-3 text-white" 
                       style="height: 30px;" name="remove_cart">
                
                    </td>

                </tr>
<?php }}

?>
            </tbody>
        </table>
        <!-- subtotal -->
        <div class="d-flex mb-4">
            <h4 class="px-3">Subtotal: <strong>₱<?php echo $total_price?></strong></h4>
        </div>
    </div>
</div>
</form>

<div class="sample mb-4">
  <a href="index.php"><button class="bg-dark px-3 border-0 mx-3 text-white" style="height: 30px;">Continue Shopping
                </button></a>
  <button class="bg-dark px-3 border-0 text-white" style="height: 30px;"><a href="./user_area/checkout.php" class="text-white
  text-decoration-none">Checkout</a></button>
</div>
<!-- function to remove item -->
<?php
function remove_cart_item(){
    global $conn;
    if(isset($_POST['remove_cart'])){
        foreach($_POST['removeitem'] as $remove_id) {
            echo $remove_id;
            $delete_query="DELETE FROM `cart_details` WHERE product_id=$remove_id";
            $run_delete=mysqli_query($conn,$delete_query);
            if($run_delete) {
                echo "<script>window.open('cart.php','_self')</script>";
            }
        }
    }
}
echo $remove_item=remove_cart_item();

?>

<!-- Javascript code to handle increment/decrement -->
<script>
  function increment() {
    var value = parseInt(document.getElementById('quantity').value, 10);
    value = isNaN(value) ? 1 : value;
    value++;
    document.getElementById('quantity').value = value;
  }

  function decrement() {
    var value = parseInt(document.getElementById('quantity').value, 10);
    value = isNaN(value) ? 1 : value;
    value < 2 ? value = 1 : value--;
    document.getElementById('quantity').value = value;
  }
</script>


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