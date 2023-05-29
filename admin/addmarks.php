<?php include('connection.php');
session_start();
$a=$_SESSION["email"];
if (!isset($_SESSION["email"])) {

    header("location:admin_login.php");
}
 ?>
<!DOCTYPE html>
<html lang="en">

<head>
     <script>
        window.history.forward();
    </script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

     <link rel="shortcut icon" href="ol.png" >
    <title>AddMarks</title>
    <style>
        .nav a:hover {
            background-color:slateblue;
        }
    </style>
</head>

<body>

<?php include('header.php');?>
<div class="container-fluid col-sm  d-flex">
<?php 

  include('sidebar.php');

   ?>

    <div class="container col-md  ">
        <div class="col-md">
            <?php

if(isset($_POST["submit"])){
    $rno=mysqli_real_escape_string($conn,$_POST['rno']);
    $sstudent_name=mysqli_real_escape_string($conn,$_POST['student']);
    $student_classname=mysqli_real_escape_string($conn,$_POST['class']);
    $exam=mysqli_real_escape_string($conn,$_POST['exam']);
    $term=mysqli_real_escape_string($conn,$_POST['term']);
    $sname=mysqli_real_escape_string($conn,$_POST['s_name']);
    $sql = mysqli_query($conn, "select distinct id,class,subject_name from subject where class='$student_classname'");
    while ($res = mysqli_fetch_assoc($sql)) { ?>
    <div class="col-md mt-4">
    <form id="subjectss" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);
                                        ?>" method="post">
            <input type="text"hidden value="<?php echo $sstudent_name; ?>" name="student">
            <input type="text"hidden value="<?php echo $rno; ?>" name="rno">
            <input type="text" hidden value="<?php echo $student_classname; ?>" name="s_class">
            <input type="text" hidden value="<?php echo $exam; ?>" name="exam">
            <input type="text" hidden value="<?php echo $term; ?>" name="term">
            <input type="text" hidden value="<?php echo $sname; ?>" name="sname">
            <input type="text" hidden value="<?php echo $res['id']; ?>" name="sub_id[]">

            <table class="table table-primary " >
                <tr>
                    <td> <input type="text" class="form-control text-center"  value="<?php echo $res['subject_name']; ?>" name="subname[]" id="subject_name" readonly></td>
                    <td> <input  type="number" class="form-control mark" name="marks[]" id="marks" placeholder="Enter Mark Here" required></td>
                </tr>
            </table>
        <?php
    }

        ?>
        <textarea class="form-control" name="comment" placeholder="enter comment here" row="4"></textarea> <br>
         <center><input type="submit" name="submit2" id="sub_btn" class="btn btn-primary" value="submit"></center>
        </form>
        </div>
    <?php
}
    ?>
    
    
<?php
if (isset($_REQUEST["submit2"])) {

    $i = 0;
    $sum = 0;
    
    foreach ($_POST['marks'] as $textbox) {
        $student = mysqli_real_escape_string($conn,$_POST['student']);
        $reg = mysqli_real_escape_string($conn,$_POST['rno']);
        $term= mysqli_real_escape_string($conn,$_POST['term']);
        $s_class =mysqli_real_escape_string($conn,$_POST['s_class']);
        $mark = $textbox;
        $subject = $_POST['sub_id'][$i];
        $exam_id=mysqli_real_escape_string($conn,$_POST['exam']);
       $sname2=mysqli_real_escape_string($conn,$_POST['sname']);
       $comment=mysqli_real_escape_string($conn,$_POST['comment']);
        $sum = $sum + $textbox;
        
       
        $check=mysqli_query($conn,"select *from marks where subject_id=$subject  and student_id=$student and exam=$exam_id");
        $ans=mysqli_fetch_assoc($check);
        if($ans){
            echo'<script> alert("sorry results for this student have already been added")</script>';
        }
        else{
            $crud = mysqli_query($conn, "insert into marks values('0','$sname2','$reg',$student,$subject,$term,$exam_id,$mark,'$comment')");
            if (!$crud) {
                echo $mark . $subject;
                echo $student;
            }
            else {?>
                <!-- Success Alert -->
<div class="alert alert-success alert-dismissible fade show">
<strong>Success!</strong> Data sent successfully.
<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div><?php
                
                # code...
                $results = mysqli_query($conn, "insert into results values('','$sname2','$reg',$term,$exam_id,$s_class,$student,$sum)");
                if (!$results) {
                    echo $sum;
                }
            }
            $i++;
            if($i>0){
        
                $mean=$sum/$i;
                echo'<script> alert('.$mean.')</script>';
               }
        }
       
    }
   
}
?>
</div>
</div>
</body>
</html>