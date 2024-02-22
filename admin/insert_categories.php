<!-- database connection -->
<?php
include('../include/connect.php');

//connect insert_categories to database col product_category
if (isset($_POST['insert_categories'])) {
    $category_title = $_POST['title_categories'];

    //select data from database
    $select_query="select * from `product_category` where name='$category_title'";
    $result_select = mysqli_query($conn, $select_query);
    $number=mysqli_num_rows($result_select);
    if($number>0){
        echo "<script>alert('Category is present in database!')</script>";
    }else{
    $insert_query = "insert into `product_category` (`name`) values ('$category_title')";
    $result = mysqli_query($conn, $insert_query);

    if ($result) {
        echo "<script>alert('Category has been inserted successfully')</script>";
    } else {
        echo "<script>alert('Failed to insert category')</script>";
    }
}
}
?>

<h2 class="text-center">Insert Genres</h2>
<form action=""method="post" class="mb-2">
    <div class="input-group w-90 mb-2">
        <span class="input-group-text" id="basic-addon1 bg-info"><i class="fa-solid fa-receipt"></i></span>
        <input type="text" class="form-control" name="title_categories" placeholder="Insert Genres"
        aria-label="Username" aria-describedby="basic-addon1">
    </div>
    <div class="input-group w-10 mb-2 m-auto">

        <input type="submit" class="bg-dark p-2 my-3 border-0 text-white" name="insert_categories" value="Insert Categories"></button>
    </div>
</form>