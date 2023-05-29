<?php
include('../connection.php');
$session_id = $_POST['session_id'];
$class_id=$_POST['class_id'];
$student_id = $_POST['student_id'];
if($session_id!='')
{
$exam_result =mysqli_query($conn,"select *from class where session_id='$session_id'");
$options = "<option value=''>Select class</option>";
while($row = mysqli_fetch_assoc($exam_result)) {
$options .= "<option value='".$row['class_id']."'>".$row['class_name']."</option>";
}
echo $options;

}
elseif($class_id!='')
{
    $check=mysqli_query($conn, "select * from exam where class='$class_id'");
    if(!$check){
        echo "hi";
    }
    $result=mysqli_fetch_assoc($check);
    $class_id1=$result['class'];
    echo $result['class'];
$class_result =mysqli_query($conn,"select *from exam where class='$class_id1'");
$options = "<option value=''>Select exam</option>";
while($row = mysqli_fetch_assoc($class_result)) {
$options .= "<option value='".$row['exam_id']."'>".$row['exam_name']."</option>";
}
echo $options;

}



?>