<?php
include('../include/connect.php');
include('../functions/common_function.php');
@session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <!--bootstrap css link-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" 
    rel="stylesheet" 
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" 
    crossorigin="anonymous">

    <!--font awesome link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" 
    integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        body{
            overflow: hidden;
        }
    </style>
</head>
<body>
    <div class="container-fluid m-3">
        <h2 class="text-center mb-5">Admin Login</h2>
        <div class="row d-flex justify-content-center">
            <div class="col-lg-6 col-xl-5">
                <img src="../images/login.jpg" alt="Admin Login" class="img-fluid">
            </div>
            <div class="col-lg-6 col-xl-5">
                <form action="" method="post">
                    <div class="form-outline mb-4">
                        <label for="user_username" class="form-label">Username</label>
                        <input type="text" id="user_username" name="user_username" placeholder="Enter Your Username" required="required" class="form-control">
                    </div>
                    <div class="form-outline mb-4">
                        <label for="user_password" class="form-label">Password</label>
                        <input type="text" id="user_password" name="user_password" placeholder="Enter Your Password" required="required" class="form-control">
                    </div>
                    <div>
                        <input type="submit" class="bg-dark py-2 px-3 border-0 text-white" name="user_login" value="Login">
                        <p class="small fw-bold mt-2 pt-1">Don't have an account? <a href="admin_registration.php" class="link-danger">Register</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
<?php

if(isset($_POST['user_login'])){
    $user_username=$_POST['user_username'];
    $user_password=$_POST['user_password'];

    $select_query="SELECT * FROM `user` WHERE username='$user_username'";
    $result=mysqli_query($conn,$select_query);
    $row_count=mysqli_num_rows($result);
    $row_data=mysqli_fetch_assoc($result);
    $user_ip=getIPAddress();

    $select_admin_query="SELECT * FROM `user` WHERE user_type='admin'";
    $select_admin=mysqli_query($conn,$select_admin_query);

    if(mysqli_num_rows($select_admin) > 0) {

        // set session variables for the admin user
        $admin_user = mysqli_fetch_assoc($select_admin);
        $_SESSION["admin_id"] = $admin_user["id"];
        $_SESSION["admin_username"] = $admin_user["username"];
    
        // redirect to the admin dashboard or another page
        header("Location: index.php");
        exit();
    
    } else {
        // no admin user found
        echo "No admin user found.";
    }

    //cart item
    //$select_query_cart="SELECT * FROM `cart_details` WHERE ip_address='$user_ip'";
    //$select_cart=mysqli_query($conn,$select_query_cart);
    //$row_count_cart=mysqli_num_rows($select_cart);

    //if($row_count>0){
        //$_SESSION['username']=$user_username;
        //if (password_verify($user_password, $row_data['password'])) {
            /* echo "<script>alert('Login Succesful')</script>"; */
            //if($row_count==1 and $row_count_cart==0){
                //$_SESSION['username']=$user_username;
                //echo "<script>alert('Login Succesful')</script>";
                //echo "<script>window.open('index.php','_self')</script>";
           // }else{
               // $_SESSION['username']=$user_username;
               // echo "<script>alert('Login Succesful')</script>";
               // echo "<script>window.open('payment.php','_self')</script>";
           // }
       // }else{
       //     echo "<script>alert('Invalid Credentials!')</script>";
      //  }

  //  }else{
   //     echo "<script>alert('Invalid Credentials!')</script>";
   // }

}

?>