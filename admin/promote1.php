<?php
include('../connection.php');
session_start();

$_GET['id'];
$id = $_GET['id'];
$option4="";
$options="";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="shortcut icon" href="ol.png" >
    <title>Document</title>
</head>
<body>
    <?php
   include('header.php');
    $getdata=mysqli_query($conn, "select *from student where id=$id");
    $res=mysqli_fetch_assoc($getdata);

    $check=mysqli_query($conn ,"select *from exam where term_id='$res[term_id]'");
    if(mysqli_num_rows($check)>0){

    
    $rescheck=mysqli_fetch_assoc($check);
    $getstudentexam=mysqli_query($conn, "select *from results where exam_id = '$rescheck[exam_id]' and regno='$res[regno]'");
    echo $rescheck['exam_id'];
    if(mysqli_num_rows($getstudentexam)>0){

    

    $newyear=$res['session_id']+1;

    $getnewterm=mysqli_query($conn,"select MIN(term_id) as term_id from term where year=$newyear");
    $term=mysqli_fetch_assoc($getnewterm);
    $tid=$term['term_id'];

    $newfee=mysqli_query($conn,"select *from termfees where term_id=$tid");
    $rest=mysqli_fetch_assoc($newfee);
    $newfees=$rest['amount']+$res['total'];
    

    $newclass=$res['class']+1;
    $updatequery=mysqli_query($conn,"update student set term_id=$tid,session_id=$newyear, class=$newclass where id=$id");
    if($updatequery){
        ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success!!</strong>Student has been promoted successfully!
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>

    <?php
    }

}else{
    ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Sorry!!</strong>A problem occurred.
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>

    <?php
  
}}
else{?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Sorry!!</strong>Student has to complete exams and be graded.
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php }
    ?>
</body>
</html>