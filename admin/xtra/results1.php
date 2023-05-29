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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <title>Document</title>
    
    
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-info" style="margin-bottom:20px;">
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
                        <a class="nav-link" aria-current="page" href="admin_dashboard.php"><i class='far fa-times-circle' style='font-size:48px;color:inherit'></i></a>
                    </li>
                  
                </ul>
            </div>
        </div>
    </nav>
    <div class="container" >
    <table class="table table-striped col-sm-8">
        <tr>
            <th>Subject Name</th><th>Mark</th><th>Grade</th>
        </tr> 
<?php
if(isset($_REQUEST["profile"])){
    $exam=$_REQUEST["exam"];
    $rno=$_REQUEST["rno"];
    $classs=$_REQUEST["classs"];
    $query=mysqli_query($conn, "select distinct marks_id,student_name,regno,student_id,subject_id,exam,marks,comment from marks where exam='$exam' and regno='$rno'");
    while($result=mysqli_fetch_assoc($query)) {

$grade="";

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
              
          
            }
        ?>
</table>
<?php $query=mysqli_query($conn, "select * from marks where exam='$exam' and regno='$rno'"); 
$sum=0;
$mean=0;
$i=1;
while($r=mysqli_fetch_assoc($query)){
    $r['marks'];
$sum=$sum+$r['marks'];

}$i++;
if($i>0){
    $mean=$sum/$i;
}

echo "\nthe mean is:".$mean; ?>


</body>
</html>