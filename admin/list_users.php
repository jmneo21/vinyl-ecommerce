<h3 class="text-center text-success">All Users</h3>
<table class="table table-bordered mt-5 text-center">
    <thead class="bg-secondary">

    <?php
    $get_user="SELECT * FROM `user`";
    $result=mysqli_query($conn,$get_user);
    $row_count=mysqli_num_rows($result);
    

if($row_count==0){
    echo "<h2 class='text-danger text-center mt-5'>No Users</h2>";
}else{
    echo "<tr>
    <th>Sl no</th>
    <th>Name</th>
    <th>Username</th>
    <th>Email Address</th>
    <th>Address</th>
    <th>Mobile Number</th>
</tr>
</thead>
<tbody class='bg-light text-dark'>";
    $number=0;
    while($row_data=mysqli_fetch_assoc($result)){
        $user_id=$row_data['user_id'];
        $username=$row_data['username'];
        $user_email=$row_data['user_email'];
        $first_name=$row_data['first_name'];
        $last_name=$row_data['last_name'];
        $user_image=$row_data['user_image'];
        $user_address=$row_data['user_address'];
        $mobile_no=$row_data['mobile_no'];
        $number++;
        echo " <tr>
        <td>$number</td>
        <td>$first_name $last_name</td>
        <td>$username</td>
        <td>$user_email</td>
        <td>$user_address</td>
        <td>$mobile_no</td>

    </tr>";

    }
}
    
    ?>
    </tbody>
</table>