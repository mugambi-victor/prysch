<?php 
include("connection.php");
session_start();
$a=$_SESSION["email"];
if (!isset($_SESSION["email"])) {

    header("location:admin_login.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" >
     <link rel="shortcut icon" href="ol.png" >
    <title>Class_Students</title>
    <style>
        a:hover{
            background-color: slateblue;
        }

        
    </style>
</head>
<body>
<?php include('header.php');?>
<div class="container-fluid col-sm  d-flex">
<?php 

  include('sidebar.php');

   ?>

<div class="col-md col-sm " >
          

                <?php 
      if(isset($_REQUEST['submit'])){
        $year=$_REQUEST['session'];
        $class=$_REQUEST['classs'];
        $exam=$_REQUEST['exam'];

        ?>
          
                <?php
                $checker= mysqli_query($conn, "select distinct marks_id,student_name,regno,student_id,subject_id,term_id,exam,marks,comment from marks where exam='$exam'");
                if(mysqli_num_rows($checker)>0){

               ?>
               <table class=" table mt-1 text-capitalize table-striped table-bordered caption-top">
                <caption>
                <?php 
                   
                    //examname
                    $examdata=mysqli_query($conn,"select *from exam where exam_id=$exam");
                    $examr=mysqli_fetch_assoc($examdata);
                    $examm=$examr['exam_name']; 
                    
                    //term info
                    $query = mysqli_query($conn, "select distinct marks_id,student_name,regno,student_id,subject_id,term_id,exam,marks,comment from marks where exam='$exam'");
                    $termq=mysqli_fetch_assoc($query);
                    $term=$termq['term_id'];
                    $termn=mysqli_query($conn,"select *from term where term_id=$term");
                    $res2=mysqli_fetch_assoc($termn);
                    $termname=$res2['term_name']; 
                    //year
                    $yrdata=mysqli_query($conn,"select *from academic_year where id='$res2[year]'");
                    $yr=mysqli_fetch_assoc($yrdata);
                    $yrname=$yr['sname']; 

                    ?>
                    <p>
                        List of students in: 
                    </p>
                    <p>
                        Year: <?php echo $yrname?> <br>
                        Term: <?php echo $termname?> <br>
                        Exam: <?php echo $examm?> 
                    </p>
                </caption>
                <tr>
                    <th>Student Name</th>
                    <th>Registration Number</th>
                    <th>Class</th>
                    <th>Exam Name</th>
                    <th>Actions</th>
                </tr>
                <?php
        $select=mysqli_query($conn, "select distinct regno,student_name from marks where exam=$exam");
        $exx=mysqli_query($conn, "select *from exam where exam_id=$exam");
        while($retr=mysqli_fetch_assoc($exx)){
            $examname=$retr['exam_name'];
        }
        $exx=mysqli_query($conn, "select *from class where class_id=$class");
        while($crtr=mysqli_fetch_assoc($exx)){
            $classname=$crtr['class_name'];
            $cid=$crtr['class_id'];
        }

        while($row=mysqli_fetch_assoc($select)){
            $rno=$row['regno'];
           echo "<tr><td><form method='post' action='results.php'><label>" . $row['student_name'] . "</label></td><td><input  style='border:0;' name='rno' type='text' readonly value=" . $row['regno'] . "></td><td><input  style='border:0;' name='classs' type='text' readonly hidden value=" .$cid. ">" . $classname . "</td><td><input  style='border:0;' hidden name='exam' value=".$exam." type='text' readonly >".$examname ."</td><td><input type='submit' class='btn btn-info'  value='View Results' name='profile'></form></a></td></tr>"; 
           }?>


            </table>
        </div>
    </div>
    </div>
    <?php }
   
    
else{
    echo("<div class='alert alert-info alert-dismissible fade show'>
    <strong>Sorry!</strong>No exam found for that semester.
    <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
</div>");
}

}     
      
    ?> 
    </body>
</html>