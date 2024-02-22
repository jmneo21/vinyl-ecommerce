<?php
include('../include/connect.php');
include('../functions/common_function.php');

if(isset($_GET['user_id'])){
    $user_id=$_GET['user_id'];

}

// getting total items and total price of all items
$get_ip_address=getIPAddress();
$total_price=0;
$cart_query_price="SELECT * FROM `cart_details` WHERE ip_address='$get_ip_address'";
$result_cart_price=mysqli_query($conn,$cart_query_price);
$invoice_number=mt_rand();
$status='pending';

$count_products=mysqli_num_rows($result_cart_price);

while($row_price=mysqli_fetch_array($result_cart_price)){
    $product_id=$row_price['product_id'];
    $select_product="SELECT * FROM `product` WHERE id=$product_id";
    $run_price=mysqli_query($conn,$select_product);

    while($row_product_price=mysqli_fetch_array($run_price)){
        $product_price=array($row_product_price['price']);
        $product_sum_price=array_sum($product_price);
        $total_price+=$product_sum_price;
    }
}

//getting quantity from cart
$get_cart="SELECT * FROM `cart_details`";
$run_cart=mysqli_query($conn,$get_cart);
$get_item_quantity=mysqli_fetch_array($run_cart);
$quantity=$get_item_quantity['quantity'];
if($quantity==0){
    $quantity=1;
    $subtotal=$total_price;
}else{
    $quantity=$quantity;
    $subtotal=$total_price*$quantity;
}
//DONT FORGET payment_id, I did not include payment_id
$insert_orders="INSERT INTO `order_details` (user_id,total_price,invoice_number
,total_products,order_date,order_status) VALUES($user_id,$subtotal,$invoice_number,$count_products,
NOW(),'$status')";
$result_query=mysqli_query($conn,$insert_orders);
if($result_query){
    echo "<script>alert('Orders are Submitted Successfully')</script>";
    echo "<script>window.open('profile.php','_self')</script>";
}

//order_items
$insert_order_items="INSERT INTO `order_items` (product_id,user_id,quantity,invoice_number,order_status) 
VALUES($product_id,$user_id,$quantity,$invoice_number,'$status')";
$result_order_items=mysqli_query($conn,$insert_order_items);

//delete items from cart
$empty_cart="DELETE FROM `cart_details` WHERE ip_address='$get_ip_address'";
$result_delete=mysqli_query($conn,$empty_cart);
?>

