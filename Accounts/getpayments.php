<?php
include('../connection.php');
$transaction_id = $_POST['transaction_id'];
if($transaction_id!='')
{
    $class_result =mysqli_query($conn,"select * from payments where id=$transaction_id");
   while($row = mysqli_fetch_assoc($class_result)) {
    $amount=$row['amount_paid'];
    
    }
 
   echo $amount;
     
}
?>