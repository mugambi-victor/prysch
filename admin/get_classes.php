<?php
include('connection.php');
$session_id = $_POST['session_id'];
$term_id=$_POST['term_id'];
$student_id = $_POST['student_id'];
if($session_id!='')
{
$exam_result =mysqli_query($conn,"select distinct term_id, term_name from term where year='$session_id'");
$options = "<option value=''>Select term</option>";
while($row = mysqli_fetch_assoc($exam_result)) {
$options .= "<option value='".$row['term_id']."'>".$row['term_name']."</option>";
}
echo $options;

}
elseif($term_id!='')
{
    $check=mysqli_query($conn, "select distinct exam_id, exam_name from  exam where term_id='$term_id'");
    if(!$check){
        echo "hi";
    }
    $options = "<option value=''>Select exam</option>";
while($row = mysqli_fetch_assoc($check)) {
$options .= "<option value='".$row['exam_id']."'>".$row['exam_name']."</option>";
}
    
echo $options;

}



?>