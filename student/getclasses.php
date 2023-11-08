<?php
include('../connection.php');
$session_id = $_POST['session_id'];
if($session_id!='')
{
$class_result =mysqli_query($conn,"select distinct term_id, term_name from term where year=$session_id");
$options = "<option value=''>Select term</option>";
while($row = mysqli_fetch_assoc($class_result)) {
$options .= "<option  value='".$row['term_id']."'>".$row['term_name']."</option>";
}
echo $options;

}


?>