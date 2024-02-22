<?php
include('../include/connect.php');
include('../functions/common_function.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Registration</title>
    <!--bootstrap css link-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" 
    rel="stylesheet" 
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" 
    crossorigin="anonymous">

    <!--font awesome link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" 
    integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" />

    
</head>
<body>
    <div class="container-fluid m-3">
        <h2 class="text-center mb-5">Admin Registration</h2>
        <div class="row d-flex justify-content-center">
            <div class="col-lg-6 col-xl-5">
                <img src="../images/admin.jpg" alt="Admin Registration" class="img-fluid">
            </div>
            <div class="col-lg-6 col-xl-5">
                <form action="" method="post" enctype="multipart/form-data">
                <div class="form-outline mb-4">
                        <label for="user_firstname" class="form-label">First Name</label>
                        <input type="text" id="user_firstname" class="form-control" 
                        placeholder="Enter Your First Name" autocomplete="off" required="required"
                        name="user_firstname">
                    </div>
                    <!-- last_name field -->
                    <div class="form-outline mb-4">
                        <label for="user_lastname" class="form-label">Last Name</label>
                        <input type="text" id="user_lastname" class="form-control" 
                        placeholder="Enter Your Last Name" autocomplete="off" required="required"
                        name="user_lastname">
                    </div>
                     <!-- user_email -->
                    <div class="form-outline mb-4">
                        <label for="user_email" class="form-label">Email Address</label>
                        <input type="text" id="user_email" class="form-control" 
                        placeholder="Enter Your Email Address" autocomplete="off" required="required"
                        name="user_email">
                    </div>
                    <!-- username field -->
                    <div class="form-outline mb-4">
                        <label for="user_username" class="form-label">Username</label>
                        <input type="text" id="user_username" class="form-control" 
                        placeholder="Enter Your Username" autocomplete="off" required="required"
                        name="user_username">
                    </div>
                    <!-- password field -->
                    <div class="form-outline mb-4">
                        <label for="user_password" class="form-label">Password</label>
                        <input type="password" id="user_password" class="form-control" 
                        placeholder="Enter Your password" autocomplete="off" required="required"
                        name="user_password">
                    </div>
                    <!-- confirm password field -->
                    <div class="form-outline mb-4">
                        <label for="confirm_user_password" class="form-label">Confirm Password</label>
                        <input type="password" id="confirm_user_password" class="form-control" 
                        placeholder="Confirm password" autocomplete="off" required="required"
                        name="confirm_user_password">
                    </div>  
                    <!-- mobile_no field -->
                    <div class="form-outline mb-4">
                        <label for="user_mobileno" class="form-label">Mobile Number</label>
                        <input type="text" id="user_mobileno" class="form-control" 
                        placeholder="Enter Your Mobile Number" autocomplete="off" required="required"
                        name="user_mobileno">
                    </div>
                    <!-- address field -->
                    <div class="form-outline mb-4">
                        <label for="user_address" class="form-label">Address</label>
                        <input type="text" id="user_address" class="form-control" 
                        placeholder="Enter Your Address" autocomplete="off" required="required"
                        name="user_address">
                    </div>
                    <!-- user_image -->
                    <div class="form-outline mb-4">
                        <label for="user_image" class="form-label">User Image</label>
                        <input type="file" id="user_image" class="form-control" required="required"
                        name="user_image">
                    </div>
                    <div>
                        <input type="submit" class="bg-dark py-2 px-3 border-0 text-white" name="admin_registration" value="Register">
                        <p class="small fw-bold mt-2 pt-1">Already have an account? <a href="admin_login.php" class="link-danger">Login</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

<!-- php code -->
<?php
if(isset($_POST['user_register'])){
    $user_username=mysqli_real_escape_string($conn,$_POST['user_username']);
    $user_firstname=mysqli_real_escape_string($conn,$_POST['user_firstname']);
    $user_lastname=mysqli_real_escape_string($conn,$_POST['user_lastname']);
    $user_email=mysqli_real_escape_string($conn,$_POST['user_email']);
    $user_password=mysqli_real_escape_string($conn,$_POST['user_password']);
    $hashed_password=password_hash($user_password, PASSWORD_DEFAULT); //password hashing
    $confirm_user_password=mysqli_real_escape_string($conn,$_POST['confirm_user_password']);
    $user_mobileno=mysqli_real_escape_string($conn,$_POST['user_mobileno']);
    $user_address=mysqli_real_escape_string($conn,$_POST['user_address']);
    $user_image=mysqli_real_escape_string($conn,$_FILES['user_image']['name']);
    $user_image_tmp=$_FILES['user_image']['tmp_name'];
    $user_ip=getIPAddress();


    //select query
    $select_query="SELECT * FROM `user` WHERE username='$user_username' OR user_email='$user_email'";
    $result=mysqli_query($conn,$select_query);
    $rows_count=mysqli_num_rows($result);

    $sql_execute = false;

    if($rows_count>0){
        echo "<script>alert('Username and Email already exist!')</script>";
    }elseif($user_password!=$confirm_user_password){
        echo "<script>alert('Passwords do not match!')</script>";
    }
    
    
    else{
         //insert query
    move_uploaded_file($user_image_tmp,"./user_images/$user_image");
    $insert_query="INSERT INTO `user` (username,user_email,password,first_name,last_name,
    mobile_no,user_address,user_image,user_ip,user_type)
    VALUES ('$user_username','$user_email','$hashed_password','$user_firstname','$user_lastname','$user_mobileno',
    '$user_address','$user_image','$user_ip','admin')";
    $sql_execute=mysqli_query($conn,$insert_query);

    }

    if($sql_execute){
        echo "<script>alert('Data inserted successfully!')</script>";
        echo "<script>window.open('index.php','_self')";
    }else{
        die(mysqli_error($conn));
    }

}
?>