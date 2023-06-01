<?php
include('../connection.php');
session_start();
$s = $_SESSION["s_login"];

$c_id = $_POST['c_id'];

if($c_id!='')
{
$class_result =mysqli_query($conn,"select distinct term_id from results where student_class=$c_id and regno='$s'");
$options = "<option value=''>Select term</option>";

while($row = mysqli_fetch_assoc($class_result)) {
    $term_id=$row['term_id'];
    $gettermname=mysqli_query($conn,"select *from term where term_id=$term_id");
    $r=mysqli_fetch_assoc($gettermname);
$options .= "<option value='".$term_id."'>".$r['term_name']."</option>";
}
echo $options;

}



?>