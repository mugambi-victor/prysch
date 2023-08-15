<?php
include('../connection.php');
$session_id = $_POST['session_id'];

if($session_id!='')
{
$class_result =mysqli_query($conn,"select * from term where year=$session_id");
$optionr = "<option value=''>Select term</option>";
while($row = mysqli_fetch_assoc($class_result)) {
$optionr .= "<option value='".$row['term_id']."'>".$row['term_name']."</option>";
}
echo $optionr;

}



?>