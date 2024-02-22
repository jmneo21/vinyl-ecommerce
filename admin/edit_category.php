<?php
if(isset($_GET['edit_category'])){
    $edit_category=$_GET['edit_category'];
    
    $get_categories="SELECT * FROM `product_category` WHERE id=$edit_category";
    $result=mysqli_query($conn,$get_categories);
    $row=mysqli_fetch_assoc($result);
    $category_title=$row['name'];

    
}

if(isset($_POST['edit_category'])){
    $cat_title=$_POST['category_title'];

    $update_query="UPDATE `product_category` SET name='$cat_title' WHERE id=$edit_category";
    $result_cat=mysqli_query($conn,$update_query);
    if($result_cat){
        echo "<script>alert('Category has been updated successfully!')</script>";
        echo "<script>window.open('./index.php?view_categories','_self')</script>";
    }
}

?>


<div class="container mt-3">
    <h1 class="text-center">Edit Category</h1>
    <form action="" method="post" class="text-center">
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="category_title" class="form-label">Category Title</label>
            <input type="text" name="category_title" id="category_title" class="form-control" required="required" value="<?php echo $category_title?>">
        </div>
        <input type="submit" value="update category" class="btn btn-dark px-3 mb-3" name="edit_category">
    </form>
</div>