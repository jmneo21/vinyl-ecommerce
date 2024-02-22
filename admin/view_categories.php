<h3 class="text-center text-success">All Categories</h3>
<table class="table table-bordered mt-5">
    <thead class="bg-secondary text-dark">
        <tr class="text-center">
            <th>Sl no</th>
            <th>Category Title</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody class="bg-light text-dark">
        <?php
        $select_category="SELECT * FROM `product_category`";
        $result=mysqli_query($conn,$select_category);
        $number=0;
        while($row=mysqli_fetch_assoc($result)){
            $category_id=$row['id'];
            $category_title=$row['name'];
            $number++;
        
 ?>
        <tr class="text-center">
            <td><?php echo $number;?></td>
            <td><?php echo $category_title?></td>
            <td><a href='index.php?edit_category=<?php echo $category_id?>' class='text-dark'><i class='fa-solid fa-pen-to-square'></i></a></td>
            <td><a href='index.php?delete_category=<?php echo $category_id?>' class='text-dark'
            onclick="return confirm('Are you sure you want to delete this category?')"><i class='fa-solid fa-trash'></i></a></td>

        </tr>
        <?php
        }?>
    </tbody>
</table>