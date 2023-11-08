<?php
include('../connection.php');
$term_id = $_POST['term_id'];

if($term_id!='')
{
$class_result =mysqli_query($conn,"select *from exam where term_id='$term_id'");
$options = "<option value=''>Select exam</option>";
while($row = mysqli_fetch_assoc($class_result)) {
$options .= "<option  value='".$row['exam_id']."'>".$row['exam_name']."</option>";
}
echo $options;

}



?>