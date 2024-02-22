<!-- database connection -->
<?php
include('../include/connect.php');
if(isset($_POST['insert_product'])) {

    $product_title=$_POST['product_title'];
    $product_description=$_POST['description'];
    $product_category=$_POST['category'];
    $product_quantity=$_POST['quantity'];
    $product_price=$_POST['price'];
    $product_keyword=$_POST['keyword'];
    $product_status='active';

    // accessing image
    $product_image1=$_FILES['product_image1']['name'];

    // accessing image tmp name
    $temp_image1=$_FILES['product_image1']['tmp_name'];

    //checking empty condition
    if($product_title=='' or $product_description=='' or $product_category=='' or $product_quantity=='' 
    or  $product_price=='' or $product_keyword=='' or $product_image1=='') {
        echo "<script>alert('Please fill all the available fields')</script>";
        exit();
    }else{
        move_uploaded_file($temp_image1,"./product_images/$product_image1");

        //insert query
        $insert_product="INSERT INTO `product` (category_id,name,description,price,quantity,product_image,date,status,keyword)
        VALUES ('$product_category','$product_title','$product_description','$product_price','$product_quantity','$product_image1',NOW(),'$product_status','$product_keyword')";
        $result_query=mysqli_query($conn,$insert_product);
        if($result_query){
            echo "<script>alert('Successfuly inserted all the products')</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Products-Admin Dashboard</title>
<!-- bootsrap css link -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" 
    rel="stylesheet" 
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" 
    crossorigin="anonymous">
<!-- font awesome link -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" 
    integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<!-- css file -->
<link rel="stylesheet" href="style.css">
</head>
<body class="bg=light">
    <div class="container mt-3">
        <h1 class="text-center">Insert Products</h1>
        <!-- form -->
        <form action="" method="post" enctype="multipart/form-data">
            <!-- name -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_title" class="form-label">Product title</label>
                <input type="text" name="product_title"
                id="product_title" class="form-control"
                placeholder="Enter Product Title" autocomplete="off"
                required="required">
            </div>
            <!-- description -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="description" class="form-label">Description</label>
                <input type="text" name="description"
                id="description" class="form-control"
                placeholder="Enter Product Description" autocomplete="off"
                required="required">
            </div>
            <!-- keyword -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="keyword" class="form-label">Product Keywords</label>
                <input type="text" name="keyword"
                id="keyword" class="form-control"
                placeholder="Enter Product Keywords" autocomplete="off"
                required="required">
            </div>
            <!-- category/genre -->
            <div class="form-outline mb-4 w-50 m-auto">
                <select name="category" id="" class="form-select">
                    <option value="">Select a Category</option>
                    <?php
                            $select_query="SELECT * FROM `product_category`";
                            $result_query=mysqli_query($conn,$select_query);
                            while($row=mysqli_fetch_assoc($result_query)) {
                                $category_title=$row['name'];
                                $category_id=$row['id'];
                                echo "<option value='$category_id'>$category_title</option>";
                            }
                    ?>
                 
                </select>
            </div>
            <!-- quantity -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="quantity" class="form-label">Quantity</label>
                <input type="text" name="quantity"
                id="quantity" class="form-control"
                placeholder="Enter Product Quantity" autocomplete="off"
                required="required">
            </div>
            <!-- image1 -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_image1" class="form-label">Product image 1</label>
                <input type="file" name="product_image1"
                id="product_image1" class="form-control"
                required="required">
            </div>
            <!-- price -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_price" class="form-label">Product Price</label>
                <input type="text" name="price"
                id="price" class="form-control"
                placeholder="Enter Product Price" autocomplete="off"
                required="required">
            </div>
            <!-- price -->
            <div class="form-outline mb-4 w-50 m-auto">
                <input type="submit" name="insert_product" class="btn btn-dark mb-3 px-3" 
                value="Insert Products">
                <input type="submit" name="insert_product" class="btn btn-dark mb-3 px-3" 
                value="Go Back" onclick="window.location.href='index.php';">
            </div>
            
        </form>

    </div>
    
</body>
</html>