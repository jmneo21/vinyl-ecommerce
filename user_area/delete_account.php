<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Account</title>
</head>
<body>
    <h3 class="text-danger mb-4">Delete Account</h3>
    <form action="" method="post" class="mt-5">
        <div class="form-outline mb-4">
            <input type="submit" class="form-control w-50 m-auto" name="delete" value="Delete Account" onclick="return confirm('Are you sure you want to delete your account? This action cannot be undone.');">
        </div>
        <div class="form-outline mb-4">
            <input type="submit" class="form-control w-50 m-auto" name="dont_delete" value="Don't Delete Account">
        </div>
    </form>

<?php
$username_session=$_SESSION['username'];
if(isset($_POST['delete'])){
    $delete_payment_details_query = "DELETE FROM `payment_details` WHERE order_id IN (SELECT order_id FROM `order_details` WHERE user_id=(SELECT user_id FROM `user` WHERE username='$username_session'))";
    $result_payment_details = mysqli_query($conn, $delete_payment_details_query);

    $delete_order_items_query = "DELETE FROM `order_items` WHERE `user_id` = (SELECT `user_id` FROM `user` WHERE `username` = '$username_session')";
    $result_delete_order_items=mysqli_query($conn, $delete_order_items_query);

    $delete_order_details_query="DELETE FROM `order_details` WHERE user_id=(SELECT user_id FROM `user` WHERE username='$username_session')";
    $result_order_details=mysqli_query($conn,$delete_order_details_query);

    $delete_query="DELETE FROM `user` WHERE username='$username_session'";
    $result=mysqli_query($conn,$delete_query);
    if($result && $result_order_details && $result_payment_details && $delete_order_items_query){
        session_destroy();
        echo"<script>alert('Account Deleted Successfully!')</script>";
        echo"<script>window.open('../index.php','_self')</script>";
    }
}

if(isset($_POST['dont_delete'])){
    echo"<script>window.open('profile.php','_self')</script>";

}
?>
</body>
</html>