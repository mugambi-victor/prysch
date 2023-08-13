<?php 
include_once('connection.php');
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

    <link rel="shortcut icon" href="ol.png">
    <title>AddMarks</title>
    <style>
    .nav a:hover {
        background-color: slateblue;
    }

    body {
        background: whitesmoke;
    }

    .mm {
        padding-top: 10rem;
    }

    .mrow {
        padding-left: 10rem;
        transition: 1s;
    }
    </style>
</head>

<body>

    <?php 
include('header.php');
  include('sidebar.php');
   ?>
    <div class="container-fluid col-sm  d-flex">
        <div class="container mm col-md  ">
            <div class="mrow col-md">
                <?php

if(isset($_POST["submit"])){
    $rno=mysqli_real_escape_string($conn,$_POST['rno']);
    $sstudent_name=mysqli_real_escape_string($conn,$_POST['student']);
    $student_classname=mysqli_real_escape_string($conn,$_POST['class']);
    $exam=mysqli_real_escape_string($conn,$_POST['exam']);
    $term=mysqli_real_escape_string($conn,$_POST['term']);
    $sname=mysqli_real_escape_string($conn,$_POST['s_name']);
    $sql = mysqli_query($conn, "select distinct id,class,subject_name from subject where class='$student_classname'");
    ?>
                <table class="table table-bordered table-striped text-capitalize caption-top">
                    <caption>
                        <?php 
                    //student name
                    $studentdata=mysqli_query($conn,"select *from student where regno='$rno'");
                    $res=mysqli_fetch_assoc($studentdata);
                    $student=$res['s_name'];
                    //examname
                    $examdata=mysqli_query($conn,"select *from exam where exam_id=$exam");
                    $examr=mysqli_fetch_assoc($examdata);
                    $examm=$examr['exam_name']; 
                    
                    //term info
                   

                    $termn=mysqli_query($conn,"select *from term where term_id=$term");
                    $res2=mysqli_fetch_assoc($termn);
                    $termname=$res2['term_name']; 
                    //year
                    $yrdata=mysqli_query($conn,"select *from academic_year where id='$res2[year]'");
                    $yr=mysqli_fetch_assoc($yrdata);
                    $yrname=$yr['sname']; 

                    ?>
                        <p>
                            Student Name: <?php echo $student;?> <br>
                            Student Regno: <?php echo $rno;?><br>
                            Year: <?php echo $yrname;?><br>
                            Term: <?php echo $termname;?><br>
                            Exam Name: <?php echo $examm;?> </p>
                    </caption>
                    <tr>
                        <th>Subject Name</th>
                        <th>Mark</th>
                    </tr>

                    <?php
    while ($res = mysqli_fetch_assoc($sql)) 
    { ?>
                    <div class="col-md mt-4">
                        <form id="subjectss" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>"
                            method="post">

                            <input type="text" hidden value="<?php echo $sstudent_name; ?>" name="student">
                            <input type="text" hidden value="<?php echo $rno; ?>" name="rno">
                            <input type="text" hidden value="<?php echo $student_classname; ?>" name="s_class">
                            <input type="text" hidden value="<?php echo $exam; ?>" name="exam">
                            <input type="text" hidden value="<?php echo $term; ?>" name="term">
                            <input type="text" hidden value="<?php echo $sname; ?>" name="sname">
                            <input type="text" hidden value="<?php echo $res['id']; ?>" name="sub_id[]">


                            <tr>
                                <td> <input type="text" class="form-control text-center"
                                        value="<?php echo $res['subject_name']; ?>" name="subname[]" id="subject_name"
                                        readonly></td>
                                <td> <input type="number" class="form-control mark" name="marks[]" id="marks"
                                        placeholder="Enter Mark Here" required></td>
                            </tr>

                            <?php
    }

        ?>
                </table>
                <textarea class="form-control" name="comment" placeholder="Enter comment here" row="4"></textarea> <br>
                <center><input type="submit" name="submit2" id="sub_btn" class="btn btn-primary" value="submit">
                </center>
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
        
       
        $check=mysqli_query($conn,"select *from marks where subject_id=$subject and student_id=$student and exam=$exam_id");
      
        if(mysqli_num_rows($check)>0){
            die('<div class="alert alert-danger alert-dismissible fade show">
            <strong>Sorry!!</strong>Student marks have already been added.
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>');
         
        }
        else{
            $crud = mysqli_query($conn, "insert into marks values('0','$sname2','$reg',$student,$subject,$term,$exam_id,$mark,'$comment')");
            if (!$crud) {
                echo $mark . $unit;
                echo $student;
                echo ("<div class='alert alert-danger alert-dismissible fade show'>
<strong>Error!!</strong> an error occurred when submitting marks to the database.
<button type='button' class='btn-close' data-bs-dismiss='alert'></button>
</div>");
            } else {


                echo ("<div class='alert alert-success alert-dismissible fade show'>
<strong>Success!</strong> Data sent successfully.
<button type='button' class='btn-close' data-bs-dismiss='alert'></button>
</div>");

            }
            $i++;

        }

    }
    
// submitting result
    $resultss = mysqli_query($conn, "insert into results values('0','$sname2','$reg',$exam_id,$term,$s_class,$student,$sum,'$comment')");
    if (!$resultss)
    {
        die ("an error occured while inserting data to the database");
    }
    if ($i > 0) {

        $mean = $sum / $i;
    }
    //getmax exam id
    $getmaxexam=mysqli_query($conn,"select max(exam_id) as m from exam where term_id=$term");
    $ree=mysqli_fetch_assoc($getmaxexam);
    $max_exam_id=$ree['m'];  
    //promoting a student to the next term if they have paid term fees
    $getstudentdata=mysqli_query($conn,"select *from student where regno='$reg'");
    $student_res=mysqli_fetch_assoc($getstudentdata);
    if($exam_id==$max_exam_id){
        if($student_res['total']==0)
    {
        $reg=$student_res['regno'];
        $term=$student_res['term_id'];
        $current_year=$student_res['session_id'];
        $current_class=$student_res['class'];

        //first get max exam_id that beleongs to students' current term(exams belong to a term).

        $getmaxexam=mysqli_query($conn,"select max(exam_id) as m from exam where term_id=$term");
        $ree=mysqli_fetch_assoc($getmaxexam);
        $max_exam_id=$ree['m'];


        $check=mysqli_query($conn ,"select *from exam where term_id=$term");

        if(mysqli_num_rows($check)>0){

            $rescheck=mysqli_fetch_assoc($check);

            $getstudentexam=mysqli_query($conn, "select *from results where exam_id = '$max_exam_id' and regno='$reg'");

            if(mysqli_num_rows($getstudentexam)>0){
                //promote student to next year i.e class
        
                // max term
        
                $getyear=mysqli_query($conn,"select *from term where term_id=$term");
                $ree2=mysqli_fetch_assoc($getyear);
                $yrid=$ree2['year'];
                $getmaxterm=mysqli_query($conn,"select max(term_id) as t from term where year=$yrid");
                $ree1=mysqli_fetch_assoc($getmaxterm);
                $mxt=$ree1['t'];
                if($term==$mxt)
                {
                    $newyear=$current_year+1;
                    $newterm=mysqli_query($conn,"select  min(term_id) as min_t from term where year=$newyear");
                    $s=mysqli_fetch_assoc($newterm);
                    $new_term_id=$s['min_t'];
                    $newclass= $current_class+1;
                    $newfee=mysqli_query($conn,"select *from termfees where term=$new_term_id and class=$newclass");
                    if(mysqli_num_rows($newfee)>0){
                    $fees_res=mysqli_fetch_assoc($newfee);
                    $new_term_fees=$fees_res['amount'];
                    //update the data
                    $updatequery=mysqli_query($conn,"update student set term_id=$new_term_id,session_id=$newyear,total=$new_term_fees, class=$newclass where regno='$reg'");
                    if($updatequery)
                    {
                        ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Success!!</strong>Student has been promoted successfully to the next class!
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <?php
                        
                    }
                    else
                    {
                        ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Sorry!!</strong> a problem has occured while updating student term. Please contact admin.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <?php
                    }
                
                
                }
                else
                {
                    $new_term_fees=0;
                    //update the data


                    $updatequery=mysqli_query($conn,"update student set term_id=$new_term_id,session_id=$newyear,total=$new_term_fees, class=$newclass where regno='$reg'");

        
                    if($updatequery)
                    {
                        ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!!</strong>Student has been promoted successfully to the next class!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php
                        
                    }
                        
                    else
                    {
                        ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Sorry!!</strong> a problem has occured while updating student term. Please contact admin.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php
                        
                    }
                
                }
                
                echo $newyear."-".$new_term_id."-".$newclass;
            }
            else
            {

                //promote student to next term of the same class

                $new_term_id=$term+1;

                $newfee=mysqli_query($conn,"select *from termfees where term=$new_term_id and class=$current_class");

                if(mysqli_num_rows($newfee)>0)
                {
                    $fees_res=mysqli_fetch_assoc($newfee);
                    $new_term_fees=$fees_res['amount'];
                    //update the data


                    $updatequery=mysqli_query($conn,"update student set term_id=$new_term_id,total=$new_term_fees where regno='$reg'");

                    if($updatequery)
                    {
                        
                        ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!!</strong>Student has been promoted successfully to the next term!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php
                        
                    }
                    else
                    {
                        ?>

            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Sorry!!</strong> a problem has occured while updating student term. Please contact admin.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php
                        
                    }
                }
                else
                {
                    $new_term_fees=0;
                    //update the data
                    $updatequery=mysqli_query($conn,"update student set term_id=$new_term_id,total=$new_term_fees where regno='$reg'");
                    if($updatequery)
                    {
                        ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!!</strong>Student has been promoted successfully to the next term!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php
                        
                    }
                    else
                    {
                        ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Sorry!!</strong> a problem has occured while updating student term. Please contact admin.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php
                        
                    }
                }
            }
        }
        else
        {
            ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Sorry!!</strong>Student has to be graded first.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php
            
        
        }
    }

}
else
{
    ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Sorry!!</strong> Student has to complete fees to be promoted. <br>You can promote a student from
                <a href="view-students">here</a>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php
    
}

}
else{
    if($student_res['total']==0)
    {
        $reg=$student_res['regno'];
        $term=$student_res['term_id'];
        $current_year=$student_res['session_id'];
        $current_class=$student_res['class'];

        //first get max exam_id that beleongs to students' current term(exams belong to a term).

        $getmaxexam=mysqli_query($conn,"select max(exam_id) as m from exam where term_id=$term");
        $ree=mysqli_fetch_assoc($getmaxexam);
        $max_exam_id=$ree['m'];


        $check=mysqli_query($conn ,"select *from exam where term_id=$term");

        if(mysqli_num_rows($check)>0){

            $rescheck=mysqli_fetch_assoc($check);

            $getstudentexam=mysqli_query($conn, "select *from results where exam_id = '$max_exam_id' and regno='$reg'");

            if(mysqli_num_rows($getstudentexam)>0){
                //promote student to next year i.e class
        
                // max term
        
                $getyear=mysqli_query($conn,"select *from term where term_id=$term");
                $ree2=mysqli_fetch_assoc($getyear);
                $yrid=$ree2['year'];
                $getmaxterm=mysqli_query($conn,"select max(term_id) as t from term where year=$yrid");
                $ree1=mysqli_fetch_assoc($getmaxterm);
                $mxt=$ree1['t'];
                if($term==$mxt)
                {
                    $newyear=$current_year+1;
                    $newterm=mysqli_query($conn,"select  min(term_id) as min_t from term where year=$newyear");
                    $s=mysqli_fetch_assoc($newterm);
                    $new_term_id=$s['min_t'];
                    $newclass= $current_class+1;
                    $newfee=mysqli_query($conn,"select *from termfees where term=$new_term_id and class=$newclass");
                    if(mysqli_num_rows($newfee)>0){
                    $fees_res=mysqli_fetch_assoc($newfee);
                    $new_term_fees=$fees_res['amount'];
                    //update the data
                    $updatequery=mysqli_query($conn,"update student set term_id=$new_term_id,session_id=$newyear,total=$new_term_fees, class=$newclass where regno='$reg'");
                    if($updatequery)
                    {
                        ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Success!!</strong>Student has been promoted successfully to the next class!
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <?php
                        
                    }
                    else
                    {
                        ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Sorry!!</strong> a problem has occured while updating student term. Please contact admin.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <?php
                    }
                
                
                }
                else
                {
                    $new_term_fees=0;
                    //update the data


                    $updatequery=mysqli_query($conn,"update student set term_id=$new_term_id,session_id=$newyear,total=$new_term_fees, class=$newclass where regno='$reg'");

        
                    if($updatequery)
                    {
                        ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!!</strong>Student has been promoted successfully to the next class!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php
                        
                    }
                        
                    else
                    {
                        ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Sorry!!</strong> a problem has occured while updating student term. Please contact admin.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php
                        
                    }
                
                }
                
                echo $newyear."-".$new_term_id."-".$newclass;
            }
            else
            {

                //promote student to next term of the same class

                $new_term_id=$term+1;

                $newfee=mysqli_query($conn,"select *from termfees where term=$new_term_id and class=$current_class");

                if(mysqli_num_rows($newfee)>0)
                {
                    $fees_res=mysqli_fetch_assoc($newfee);
                    $new_term_fees=$fees_res['amount'];
                    //update the data


                    $updatequery=mysqli_query($conn,"update student set term_id=$new_term_id,total=$new_term_fees where regno='$reg'");

                    if($updatequery)
                    {
                        
                        ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!!</strong>Student has been promoted successfully to the next term!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php
                        
                    }
                    else
                    {
                        ?>

            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Sorry!!</strong> a problem has occured while updating student term. Please contact admin.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php
                        
                    }
                }
                else
                {
                    $new_term_fees=0;
                    //update the data
                    $updatequery=mysqli_query($conn,"update student set term_id=$new_term_id,total=$new_term_fees where regno='$reg'");
                    if($updatequery)
                    {
                        ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!!</strong>Student has been promoted successfully to the next term!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php
                        
                    }
                    else
                    {
                        ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Sorry!!</strong> a problem has occured while updating student term. Please contact admin.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php
                        
                    }
                }
            }
        }
        else
        {
            ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Sorry!!</strong>Student has to be graded first.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php
            
        
        }
    }

}
else
{
    ?>
            <!-- <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Sorry!!</strong> Student has to complete fees to be promoted. <br>You can promote a student from
                <a href="view-students">here</a>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div> -->
            <?php
    
}

}}
?>
        </div>
    </div>


?>
        </div>
    </div>

    
    <script src="sidebar.js"></script>
</body>

</html>