<?php
// include connect file
/* include('./include/connect.php'); */


//getting products
function getproducts(){
    global $conn;

    //condition to check isset or not
    if(!isset($_GET['genre'])) {


    $select_query="SELECT * FROM `product` ORDER BY RAND() LIMIT 0,12";
        $result_query=mysqli_query($conn,$select_query);
        //$row=mysqli_fetch_assoc($result_query);
        //echo $row['name'];
        while($row=mysqli_fetch_assoc($result_query)){
          $product_id=$row['id'];
          $product_name=$row['name'];
          $product_description=$row['description'];
          $product_image=$row['product_image'];
          $product_price=$row['price'];
          $product_category=$row['category_id'];
          echo "<div class='col-md-3 mb-2'>
          <div class='card' style='width: 17rem;''>
                  <img src='./admin/product_images/$product_image' class='card-img-top' alt='$product_name'>
                  <div class='card-body'>
                      <h5 class='card-title'>$product_name</h5>
                      <p class='card-text'>$product_description</p>
                      <p class='card-text'>Price: $product_price ₱</p>
                      <a href='index.php?add_to_cart=$product_id' class='btn btn-warning'>Add to Cart</a>
                      <a href='product_details.php?id=$product_id' class='btn btn-secondary'>View More</a>
                  </div>
            </div>
      </div>";
        }
}
}

//getting all products
function get_all_products(){
    global $conn;

    //condition to check isset or not
    if(!isset($_GET['genre'])) {


    $select_query="SELECT * FROM `product`";
        $result_query=mysqli_query($conn,$select_query);
        //$row=mysqli_fetch_assoc($result_query);
        //echo $row['name'];
        while($row=mysqli_fetch_assoc($result_query)){
          $product_id=$row['id'];
          $product_name=$row['name'];
          $product_description=$row['description'];
          $product_image=$row['product_image'];
          $product_price=$row['price'];
          $product_category=$row['category_id'];
          echo "<div class='col-md-3 mb-2'>
          <div class='card' style='width: 17rem;''>
                  <img src='./admin/product_images/$product_image' class='card-img-top' alt='$product_name'>
                  <div class='card-body'>
                      <h5 class='card-title'>$product_name</h5>
                      <p class='card-text'>$product_description</p>
                      <p class='card-text'>Price: $product_price ₱</p>
                      <a href='index.php?add_to_cart=$product_id' class='btn btn-warning'>Add to Cart</a>
                      <a href='product_details.php?id=$product_id' class='btn btn-secondary'>View More</a>
                  </div>
            </div>
      </div>";
        }
}

}

//getting unique categories
function get_unique_categories(){
    global $conn;

    //condition to check isset or not
    if(isset($_GET['genre'])) {
        $category_id=$_GET['genre'];


    $select_query="SELECT * FROM `product` WHERE category_id=$category_id";
        $result_query=mysqli_query($conn,$select_query);
        $num_of_rows=mysqli_num_rows($result_query);
        if($num_of_rows==0) {
            echo "<h2 class='text-center text-danger'>No Available Product!</h2>";
        }
        
        while($row=mysqli_fetch_assoc($result_query)){
          $product_id=$row['id'];
          $product_name=$row['name'];
          $product_description=$row['description'];
          $product_image=$row['product_image'];
          $product_price=$row['price'];
          $product_category=$row['category_id'];
          echo "<div class='col-md-3 mb-2'>
          <div class='card' style='width: 17rem;''>
                  <img src='./admin/product_images/$product_image' class='card-img-top' alt='$product_name'>
                  <div class='card-body'>
                      <h5 class='card-title'>$product_name</h5>
                      <p class='card-text'>$product_description</p>
                      <p class='card-text'>Price: $product_price ₱</p>
                      <a href='index.php?add_to_cart=$product_id' class='btn btn-warning'>Add to Cart</a>
                      <a href='product_details.php?id=$product_id' class='btn btn-secondary'>View More</a>
                  </div>
            </div>
      </div>";
        }
}
}


// displaying categories in sidenav
function getcategories(){
    global $conn;
    $select_genres="SELECT * FROM `product_category`";
    $result_genres=mysqli_query($conn, $select_genres);
    while($row_data=mysqli_fetch_assoc($result_genres)) {
      $genre_title=$row_data['name'];
      $genre_id=$row_data['id'];
      echo "<li class='nav-item'>
      <a href='index.php?genre=$genre_id' class='nav-link text-dark'>$genre_title</a>
  </li>";
    }
}

// searching products

function search_product(){
    global $conn;
    if(isset($_GET['search_data_product'])) {
        $search_data_value=$_GET['search_data'];

    $search_query="SELECT * FROM `product` WHERE keyword LIKE '%$search_data_value%'";
        $result_query=mysqli_query($conn,$search_query);
        $num_of_rows=mysqli_num_rows($result_query);
        if($num_of_rows==0) {
            echo "<h2 class='text-center text-danger'>No Results Match!</h2>";
        }
        while($row=mysqli_fetch_assoc($result_query)){
          $product_id=$row['id'];
          $product_name=$row['name'];
          $product_description=$row['description'];
          $product_image=$row['product_image'];
          $product_price=$row['price'];
          $product_category=$row['category_id'];
          echo "<div class='col-md-3 mb-2'>
          <div class='card' style='width: 17rem;''>
                  <img src='./admin/product_images/$product_image' class='card-img-top' alt='$product_name'>
                  <div class='card-body'>
                      <h5 class='card-title'>$product_name</h5>
                      <p class='card-text'>$product_description</p>
                      <p class='card-text'>Price: $product_price ₱</p>
                      <a href='index.php?add_to_cart=$product_id' class='btn btn-warning'>Add to Cart</a>
                      <a href='product_details.php?id=$product_id' class='btn btn-secondary'>View More</a>
                  </div>
            </div>
      </div>";
        }
}
}

// view details function
function view_details() {
    global $conn;

    //condition to check isset or not
    if(isset($_GET['id'])) {
    if(!isset($_GET['genre'])) {
        $product_id=$_GET['id'];


    $select_query="SELECT * FROM `product` WHERE id=$product_id";
        $result_query=mysqli_query($conn,$select_query);
        while($row=mysqli_fetch_assoc($result_query)){
          $product_id=$row['id'];
          $product_name=$row['name'];
          $product_description=$row['description'];
          $product_image=$row['product_image'];
          /* $product_image1=$row['product_image1'];
          $product_image2=$row['product_image2']; */
          $product_price=$row['price'];
          $product_category=$row['category_id'];
          echo "<div class='col-md-3 mb-2'>
          <div class='card' style='width: 17rem;''>
                  <img src='./admin/product_images/$product_image' class='card-img-top' alt='$product_name'>
                  <div class='card-body'>
                      <h5 class='card-title'>$product_name</h5>
                      <p class='card-text'>$product_description</p>
                      <p class='card-text'>Price: $product_price ₱</p>
                      <a href='index.php?add_to_cart=$product_id' class='btn btn-warning'>Add to Cart</a>
                      <a href='product_details.php?id=$product_id' class='btn btn-secondary'>View More</a>
                  </div>
            </div>
      </div>
      
      <div class='col-md-8'>
                <!-- related images -->
                <div class='row'>
                    <div class='col-md-12'>
                        <h4 class='text-center mb-5'>More From This Author</h4>
                    </div>
                    <div class='col-md-6'>
                    <img src='./images/Alison Wonderland - Awake.jpg' class='card-img-top' alt='$product_name'>
                    </div>
                    <div class='col-md-6'>
                    <img src='./images/Alison Wonderland - Awake.jpg' class='card-img-top' alt='$product_name'>
                    </div>
                </div>
            </div>";
        }
}
}
}

// get IP address function
function getIPAddress() {
    //whether ip is from the share internet
    if(!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    //whether ip is from the proxy
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    //whether ip is from the remote address
    else{
        $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}
/* $ip=getIPAddress();
echo 'User Real IP Address - '.$ip; */

//cart function
function cart() {
    if(isset($_GET['add_to_cart'])) {
        global $conn;
        $get_ip_address=getIPAddress();
        $get_product_id=$_GET['add_to_cart'];

        $select_query="SELECT * FROM `cart_details` WHERE ip_address='$get_ip_address' AND
        product_id=$get_product_id";
        $result_query=mysqli_query($conn,$select_query);
        $num_of_rows=mysqli_num_rows($result_query);
    if($num_of_rows>0) {
        echo "<script>alert('This item is already present inside the cart')</script>";
        echo "<script>window.open('index.php','_self')</script>";
    }else{
        $insert_query="INSERT INTO `cart_details` (product_id,ip_address,quantity) VALUES ($get_product_id
        ,'$get_ip_address',0)";
        $result_query=mysqli_query($conn,$insert_query);
        echo "<script>alert('Item is added to cart')</script>";
        echo "<script>window.open('index.php','_self')</script>";

    }
    }

}

// function to get cart item numbers
function cart_item(){
    if(isset($_GET['add_to_cart'])) {
        global $conn;
        $get_ip_address=getIPAddress();


        $select_query="SELECT * FROM `cart_details` WHERE ip_address='$get_ip_address'";
        $result_query=mysqli_query($conn,$select_query);
        $count_cart_items=mysqli_num_rows($result_query);
    
    }else{
        global $conn;
        $get_ip_address=getIPAddress();


        $select_query="SELECT * FROM `cart_details` WHERE ip_address='$get_ip_address'";
        $result_query=mysqli_query($conn,$select_query);
        $count_cart_items=mysqli_num_rows($result_query);
    }
    echo $count_cart_items;
    }


    // total price function
    function total_cart_price() {
        global $conn;
        $get_ip_address=getIPAddress();
        $total_price=0;

        $cart_query="SELECT * FROM `cart_details` WHERE ip_address='$get_ip_address'";
        $result=mysqli_query($conn,$cart_query);
   
        while($row=mysqli_fetch_array($result)){

        $product_id=$row['product_id'];
        $select_products="SELECT * FROM `product` WHERE id=$product_id";
        $result_products=mysqli_query($conn,$select_products);

        while($row_product_price=mysqli_fetch_array($result_products)){
            $product_price=array($row_product_price['price']);
            $product_values=array_sum($product_price);
            $total_price+=$product_values;

    }
    }
    echo $total_price;
    }


    //get user order details
    function get_user_order_details(){
        global $conn;
        $username=$_SESSION['username'];
        $get_details="SELECT * FROM `user` WHERE username='$username'";
        $result_query=mysqli_query($conn,$get_details);

        while($row_query=mysqli_fetch_array($result_query)){
            $user_id=$row_query['user_id'];
            if(!isset($_GET['edit_account'])){
                if(!isset($_GET['my_orders'])){
                    if(!isset($_GET['delete_account'])){
                        $get_orders="SELECT * FROM `order_details` WHERE user_id=$user_id 
                        AND order_status='pending'";
                        $result_order_query=mysqli_query($conn,$get_orders);
                        $row_count=mysqli_num_rows($result_order_query);
                        if($row_count>0){
                            echo "<h3 class='text-center text-success mt-5 mb-2'>You have <span class='text-danger'>$row_count</span> pending orders</h3>
                            <p class='text-center'><a href='profile.php?my_orders' class='text-dark'>Order Details</a></p>";
                        }else{
                            echo "<h3 class='text-center text-success mt-5 mb-2'>You have zero pending orders</h3>
                            <p class='text-center'><a href='../index.php' class='text-dark'>Explore Products</a></p>";
                        }
                    }
                }
            }
        }


    }
?>