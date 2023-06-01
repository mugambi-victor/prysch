<?php 
include('connection.php');

session_start ();
$s=$_SESSION["email"];
if(!isset($_SESSION["email"]))

	header("location:admin_login.php"); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="shortcut icon" href="ol.png" >
    
    <title>StudentResults</title>
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

    <div class="container" >
     
<?php
if(isset($_REQUEST["profile"])){
    $exam=$_REQUEST["exam"];
    $rno=$_REQUEST["rno"];
    $classs=$_REQUEST["classs"];
    ?>
    <table class="table text-uppercase mt-2 table-striped table-bordered col-sm caption-top">
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
                    $query = mysqli_query($conn, "select distinct marks_id,student_name,regno,student_id,subject_id,term_id,exam,marks,comment from marks where exam='$exam' and regno='$rno'");
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
                    <p>Viewing marks for:</p>
                   
                    <p>
                    Student Name: <?php echo $student;?> <br>
                    Student Regno: <?php echo $rno;?><br>
                    Year: <?php echo $yrname;?><br>
                    Term: <?php echo $termname;?><br>
                    Exam Name: <?php echo $examm;?> </p>
                </caption>
        <tr>
            <th>Subject Name</th><th>Mark</th><th>Grade</th>
        </tr><?php
    
    $query=mysqli_query($conn, "select distinct marks_id,student_name,regno,student_id,subject_id,exam,marks,comment from marks where exam='$exam' and regno='$rno'");
    while($result=mysqli_fetch_assoc($query)) {

$grade="";
$getranges=mysqli_query($conn,"select *from ranges");
// while($ress=mysqli_fetch_assoc($getranges)){
//     if($query!==null){
//         if($result['marks']>$ress['from']&&$result['marks']<=$ress['to']){
//             $grade=$ress['grade'];
//         }
        
// }
if($query!==null){
    if($result['marks']>80&&$result['marks']<=100){
        $grade="A";
    }
    elseif($result['marks']>65&&$result['marks']<=80){
        $grade="B";
    }
    elseif($result['marks']>55&&$result['marks']<=65){
        $grade="C";
    }
    elseif($result['marks']>40&&$result['marks']<=55){
        $grade="D";
    }
    elseif($result['marks']>0&&$result['marks']<=40){
        $grade="E";
    }
 ?>

    


<tr>
                        <td style="width:50%;"><?php 
                        $rr=$result['subject_id'];
                        
                        $qy=mysqli_query($conn,"select *from subject where id=$rr");
                        while($row=mysqli_fetch_assoc($qy)){
                            echo $row['subject_name']; 
                        }?>
                       </td>
                        <td style=" width:50%; "><?php echo $result['marks']; ?></td>
                        <td style=" width:50%; "><?php echo $grade; ?></td>
                     
                    </tr>
    
        
           
          
</div>

          <?php }}
          echo "</table>";
        
        
        


$query2=mysqli_query($conn, "select * from marks where exam='$exam' and regno='$rno'"); 
$sum=0;
$mean=0;
$n=mysqli_num_rows($query2);
$i=1;
while($r=mysqli_fetch_assoc($query2)){
    $r['marks'];
$sum=$sum+$r['marks'];

}$i++;
if($i>0){
    $mean=$sum/$n;
}

if($query!==null){
    if($mean>80&&$mean<=100){
        $grade="A";
    }
    elseif($mean>65&&$mean<=80){
        $grade="B";
    }
    elseif($mean>55&&$mean<=65){
        $grade="C";
    }
    elseif($mean>40&&$mean<=55){
        $grade="D";
    }
    elseif($mean>0&&$mean<=40){
        $grade="E";
    }
   
    echo "\nAverage Score: <b>".$mean."</b><br>GRADE:<b> ".$grade."</b> <br><br>"; 
 
   
}
?>
<div>
<form action="editstudentmarks.php" method="post">
                <input type="text" name="rno" value="<?php echo $rno; ?>" hidden>
                <input type="text" name="exam" value="<?php echo $exam; ?>" hidden>
                <input type="text" name="semester" value="<?php echo $semester; ?>" hidden>
                <input type="submit" class="btn btn-primary" name="edit" value="Edit marks"> 
      
                </form>
</div>

                <?php
}

elseif(isset($_REQUEST['results'])){
    $rno=$_REQUEST['rno'];
    $examfinder=mysqli_query($conn,"select* from examview where regno='$rno'");
    while($res=mysqli_fetch_assoc($examfinder)){
        echo $res['exam_name'];
    }
    }
?>


</body>
</html>