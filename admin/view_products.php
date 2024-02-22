<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h3 class="text-center text-success">All Products</h3>
    <table class="table table-bordered mt-5 text-dark text-center">
        <thead class="bg-secondary">
            <tr>
                <th>Product ID</th>
                <th>Product Title</th>
                <th>Product Image</th>
                <th>Product Price</th>
                <th>Total Sold</th>
                <th>Status</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody class="bg-light text-dark">
            <?php
            $get_products="SELECT * FROM `product`";
            $result=mysqli_query($conn,$get_products);
            $number=0;
            while($row=mysqli_fetch_assoc($result)){
                $product_id=$row['id'];
                $product_name=$row['name'];
                $product_image=$row['product_image'];
                $product_price=$row['price'];
                $product_status=$row['status'];
                $number++;
                ?>
                <tr class='text-center'>
                <td><?php echo $product_id?></td>
                <td><?php echo $product_name?></td>
                <td><img src='./product_images/<?php echo $product_image?>' class='product_img'/></td>
                <td>₱<?php echo $product_price?></td>
                <td><?php
                $get_count="SELECT * FROM `order_items` WHERE product_id=$product_id";
                $result_count=mysqli_query($conn,$get_count);
                $rows_count=mysqli_num_rows($result_count);
                echo $rows_count;

                ?></td>
                <td><?php echo $product_status?></td>
                <td><a href='index.php?edit_products=<?php echo $product_id?>' class='text-dark'><i class='fa-solid fa-pen-to-square'></i></a></td>
                <td><a href='index.php?delete_product=<?php echo $product_id?>' class='text-dark' onclick="return confirm('Are you sure you want to delete this category?')"><i class='fa-solid fa-trash'></i></a></td>
            </tr>
            <?php
            }
            ?>
            


        </tbody>

    </table>
</body>
</html>