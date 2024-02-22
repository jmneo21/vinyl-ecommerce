<?php
include('../include/connect.php');
session_start();
if(isset($_GET['order_id'])){
    $order_id=$_GET['order_id'];

    $select_data="SELECT * FROM `order_details` WHERE order_id=$order_id";
    $result=mysqli_query($conn,$select_data);
    $row_fetch=mysqli_fetch_assoc($result);
    $invoice_number=$row_fetch['invoice_number'];
    $amount_due=$row_fetch['total_price'];
    
}

if(isset($_POST['confirm_payment'])){
    $invoice_number=$_POST['invoice_number'];
    $amount=$_POST['amount'];
    $payment_type=$_POST['payment_mode'];
    $insert_query="INSERT INTO `payment_details` (order_id,invoice_number,amount,payment_type) VALUES ($order_id,$invoice_number,$amount,'$payment_type')";
    $result=mysqli_query($conn,$insert_query);
    if($result){
        echo "<h3 class='text-center text-light'>Successfuly completed the payment</h3>";
        echo "<script>window.open('profile.php?my_orders','_self')</script>";

    }
    $update_orders="UPDATE `order_details` SET order_status='complete' WHERE order_id=$order_id";
    $result_orders=mysqli_query($conn,$update_orders);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Page</title>
    <!-- bootstrap css link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" 
    rel="stylesheet" 
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" 
    crossorigin="anonymous">
</head>
<body class="bg-secondary">
    
    <div class="container my-5">
        <h1 class="text-center text-white">Confirm Payment</h1>
        <form action="" method="post">
            <div class="form-outline my-4 text-center w-50 m-auto">
                <input type="text" class="form-control w-50 m-auto" name="invoice_number" value="<?php echo $invoice_number?>">
            </div>
            <div class="form-outline my-4 text-center w-50 m-auto">
                <label for="" class="text-white">Amount</label>
                <input type="text" class="form-control w-50 m-auto" name="amount" value="<?php echo $amount_due?>">
            </div>
            <div class="form-outline my-4 text-center w-50 m-auto">
                <select name="payment_mode" class="form-select w-50 m-auto">
                    <option>Select Payment Method</option>
                    <option>Netbanking</option>
                    <option>Paypal</option>
                    <option>UPI</option>
                    <option>Cash On Delivery</option>
                  
                </select>
            </div>
            <div class="form-outline my-4 text-center w-50 m-auto">
                <input type="submit" class="bg-dark py-2 px-3 border-0 text-white" value="Confirm" name="confirm_payment">
            </div>
        </form>
    </div>
    
</body>
</html>