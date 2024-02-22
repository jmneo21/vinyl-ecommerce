<h3 class="text-center text-success">All Payments</h3>
<table class="table table-bordered mt-5 text-center">
    <thead class="bg-secondary">

    <?php
    $get_payments="SELECT * FROM `payment_details`";
    $result=mysqli_query($conn,$get_payments);
    $row_count=mysqli_num_rows($result);
    

if($row_count==0){
    echo "<h2 class='text-danger text-center mt-5'>No payments received yet</h2>";
}else{
    echo "<tr>
    <th>Sl no</th>
    <th>Invoice number</th>
    <th>Amount</th>
    <th>Payment Type</th>
    <th>Order date</th>
</tr>
</thead>
<tbody class='bg-light text-dark'>";
    $number=0;
    while($row_data=mysqli_fetch_assoc($result)){
        $order_id=$row_data['order_id'];
        $payment_id=$row_data['pd_id'];
        $amount=$row_data['amount'];
        $invoice_number=$row_data['invoice_number'];
        $payment_type=$row_data['payment_type'];
        $order_date=$row_data['date'];
        $number++;
        echo " <tr>
        <td>$number</td>
        <td>$invoice_number</td>
        <td>₱$amount</td>
        <td>$payment_type</td>
        <td>$order_date</td>

    </tr>";

    }
}
    
    ?>
    </tbody>
</table>