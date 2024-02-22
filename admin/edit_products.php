<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
if(isset($_GET['edit_products'])){
    $edit_id=$_GET['edit_products'];
    $get_data="SELECT * FROM `product` WHERE id=$edit_id";
    $result=mysqli_query($conn,$get_data);
    $row=mysqli_fetch_assoc($result);
    $product_title=$row['name'];
    $product_description=$row['description'];
    $product_category_id=$row['category_id'];
    $product_price=$row['price'];
    $product_quantity=$row['quantity'];
    $product_image=$row['product_image'];
    $product_keywords=$row['keyword'];

    //fetching category name 
    $select_category="SELECT * FROM  `product_category` WHERE id=$product_category_id";
    $result_category=mysqli_query($conn,$select_category);
    $row_category=mysqli_fetch_assoc($result_category);
    $category_name=$row_category['name'];
   
}


?>
   <div class="container mt-5">
    <h1 class="text-center">Edit Products</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_title" class="form-label">Product Title</label>
            <input type="text" id="product_title" value="<?php echo $product_title?>" name="product_title" class="form-control" required="required">
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_description" class="form-label">Product Description</label>
            <input type="text" id="product_description"value="<?php echo $product_description?>" name="product_description" class="form-control" required="required">
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_keywords" class="form-label">Product Keywords</label>
            <input type="text" id="product_keywords" value="<?php echo $product_keywords?>" name="product_keywords" class="form-control" required="required">
        </div>
        <div class="form-outline w-50 m-auto mb-4">
        <label for="product_category" class="form-label">Product Category</label>
            <select name="product_category" class="form-select">
                <option value="<?php echo $category_name?>"><?php echo $category_name?></option>
                <?php
                    $select_category_all="SELECT * FROM  `product_category` ";
                    $result_category_all=mysqli_query($conn,$select_category_all);
                    while($row_category_all=mysqli_fetch_assoc($result_category_all)){
                    $category_title=$row_category_all['name'];
                    $product_category_id=$row_category_all['id'];
                    echo "<option value='$product_category_id'>$category_title</option>";
                 }
                ?>
   
                
            </select>       
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_image" class="form-label">Product Image</label>
            <div class="d-flex">
            <input type="file" id="product_image" name="product_image" class="form-control w-90 m-auto" required="required">
            <img src="./product_images/<?php echo $product_image?>" alt="" class="product_img">
            </div>
            
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_price" class="form-label">Product Price</label>
            <input type="text" id="product_price" value="<?php echo $product_price?>" name="product_price" class="form-control" required="required">
        </div>
        <div class="text-center">
            <input type="submit" name="edit_product" value="Update Product" class="btn btn-dark px-3 mb-3">
        </div>
    </form>
   </div>

   <!-- editing products -->

   <?php

   if(isset($_POST['edit_product'])){
    $product_title=$_POST['product_title'];
    $product_description=$_POST['product_description'];
    $product_keywords=$_POST['product_keywords'];
    $product_category=$_POST['product_category'];
    $product_price=$_POST['product_price'];

    $product_image=$_FILES['product_image']['name'];

    $tmp_image=$_FILES['product_image']['tmp_name'];

    //checking for fields empty or not
    if($product_title=='' or $product_description=='' or $product_keywords=='' or 
    $product_category=='' or $product_image=='' or $product_price==''){
        echo "<script>alert('Please fill all the fields!')</script>";
    }else{
        move_uploaded_file($tmp_image,"./product_images/$product_image");

        //query to update products
        $update_product="UPDATE `product` SET category_id='$product_category_id', name='$product_title', description='$product_description',price='$product_price',product_image='$product_image',date=NOW(),keyword='$product_keywords' WHERE id=$edit_id";
        $result_update=mysqli_query($conn,$update_product);
        if($result_update){
            echo "<script>alert('Product Updated Successfully!')</script>";
            echo "<script>window.open('./index.php?view_products','_self')</script>";
        }
    }
   }
   
   ?>
</body>
</html>