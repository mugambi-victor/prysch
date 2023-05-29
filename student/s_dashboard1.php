<?php
include("../connection.php");
session_start();
$s = $_SESSION["s_login"];

if (!isset($_SESSION["s_login"])) {
    header("location:s_login.php");
}
 $grade="";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOME</title>
    <link rel="stylesheet" type="text/css" href="../vee.css">
    <link rel="stylesheet" type="text/css" href="../foots.css">
    <script src="../jquery.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <style>
      
        .list-group-item:hover{
            background-color:teal;
        }
        .nav-link{
            color:blue;
        }
        
    </style>
</head>

<body style="background-color: white;">
<nav class="navbar navbar-expand-lg navbar-light bg-info">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">
                <img src="../images/mylogo.png" height="80"/>
            </a> <h2><?php echo "welcome ".$s; ?></h2>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
               
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">Account</a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li> <a class="dropdown-item"  href="profile.php">Profile</a></li>
                            <li> <a class="dropdown-item"  href="../logout.php">Logout</a></li>
                           
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
  

        
    <div class="row">
<div class="col-sm-3">
<nav class ="navbar bg-light">
<ul class =" vic nav navbar-nav" style="margin-left:20%; ">

<li class ="nav-item">
<a href="results.php" class="nav-link">  RESULTS</a>
</li>

<li class ="nav-item">
<a href="../news.php" class="nav-link"> ANNOUNCEMENTS</a>
</li>

</li>
</ul>
</nav>
</div>
<div class="col-sm-9">
<div class="container">
    <div class="row">
<div class="col-sm-8">
   <center> <span><h2>SUBJECTS</h2></span></center>
<?php
                $sql = mysqli_query($conn, "select *from student where regno='$s'  ");
                $result = mysqli_fetch_assoc($sql);
                    $a = $result['id'];
                    $b=$result['class'];
                    $sql2 = mysqli_query($conn, "select distinct id,subject_name from subject where class=$b");

                    if ($sql2) {
                       
                        $i = 0;
                        foreach ($sql2 as $row) { ?>
                            

                                <ul class="list-group  text-center">
                                    <li class="list-group-item">  <?php echo $row['subject_name'] . "<br>"; ?></li> 
                                </ul>
                                 <br>
        

                <?php }
                        $i++;
                    }?>
</div>
<div class="col-sm">
<h4> <I>CURRENT YEAR EXAMS</I> </h4>
<form action="" method="POST">
<select name="examname" id="">
    <?php 
    $sexams= mysqli_query($conn, "select *from examview where regno='$s'  ");
   
    while( $res=mysqli_fetch_assoc($sexams)){;
        $class=$res['class'];
        ?>
   
        <option value="<?php echo $res['exam_id']; ?>"><?php echo $res['exam_name']; ?></option>


    
<?php
    }
    ?>
      </select>
         <center>   <input type="submit" class="btn btn-primary" name="submit" value="submit"></center>
        </form>
        <table class="table-primary">
        <tr><th>Subject</th> <th>Score</th><th>Grade</th></tr>
      <?php
    if(isset($_REQUEST["submit"])&&!empty($_REQUEST["examname"])){
        $exam=$_REQUEST["examname"];
        
        $results=mysqli_query($conn, "select * from finalmarks where exam_id=$exam and regno='$s' and class=$class ");
         
        while($resultq=mysqli_fetch_assoc($results)) {
      
        if($results!==null){
            if($resultq['marks']>80&&$resultq['marks']<=100){
                $grade="A";
            }
            elseif($resultq['marks']>65&&$resultq['marks']<=80){
                $grade="B";
            }
            elseif($resultq['marks']>55&&$resultq['marks']<=65){
                $grade="C";
            }
            elseif($resultq[marks]>40&&$resultq['marks']<=55){
                $grade="D";
            }
            elseif($resultq['marks']>0&&$resultq['marks']<=40){
                $grade="E";}
           ?>
           
            <div class="results">
        
        <tr>
            <td style="width:50%;"><?php echo $resultq['subject_name']; ?></td>
            <td style=" width:50%; "><?php echo $resultq['marks']; ?></td>
            <td style=" width:50%; "><?php echo $grade; ?></td>
        </tr>
   
    
</div>
<?php  }}}?>
      
           </table>
         
</div></div>

<script>
    $(document).ready(function() {
        $("a").hover(function() {
            $(this).css("color", "#d08c29");
            $(this).css("font-size", "larger")
        }, function() {
            $(this).css("color", "blue");
});




    });
    </script>
  
</body>

</html>