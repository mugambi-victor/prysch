<?php include('connection.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../vee.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <title>Document</title>
    <style>
       
     
        </style>
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-light bg-info">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">
                <img src="images/mylogo.png" height="80"/>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                   
                    
                </ul>
                <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="s_dashboard.php"><i class='far fa-times-circle' style='font-size:48px;color:inherit'></i></a>
                    </li>
                  
                </ul>
            </div>
        </div>
    </nav>
<div class="container" style="margin-top:50px;"> 
    <div class="col-10"><?php
    
    if(isset($_POST["submit"])){
        $rno=mysqli_real_escape_string($conn,$_POST['rno']);
        $sstudent_name=mysqli_real_escape_string($conn,$_POST['student']);
        $student_classname=mysqli_real_escape_string($conn,$_POST['class']);
        $exam=mysqli_real_escape_string($conn,$_POST['exam']);
        $sname=mysqli_real_escape_string($conn,$_POST['s_name']);
        $sql = mysqli_query($conn, "select distinct subject_id,student_id,class_id,subject_name from final where class_id='$student_classname' and student_id='$sstudent_name'");
        while ($res = mysqli_fetch_assoc($sql)) { ?>
        <div class="students">
        <form id="subjectss" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);
                                            ?>" method="post">
                <input type="text"hidden value="<?php echo $sstudent_name; ?>" name="student">
                <input type="text"hidden value="<?php echo $rno; ?>" name="rno">
                <input type="text" hidden value="<?php echo $student_classname; ?>" name="s_class">
                <input type="text" hidden value="<?php echo $exam; ?>" name="exam">
                <input type="text" hidden value="<?php echo $sname; ?>" name="sname">
                <input type="text" hidden value="<?php echo $res['subject_id']; ?>" name="sub_id[]">

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
                $crud = mysqli_query($conn, "insert into marks values('0','$sname2','$reg',$student,$subject,$exam_id,$mark,'$comment')");
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
                    $results = mysqli_query($conn, "insert into results values('','$sname2','$reg',$exam_id,$s_class,$student,$sum)");
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