<?php 
include('connection.php');
session_start ();
if(!isset($_SESSION["account_login"]))

	header("location:admin_login.php"); 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOME</title>
    <link rel="stylesheet" type="text/css" href="vee.css">
    <link rel="stylesheet" type="text/css" href="foots.css">
    <script src="jquery.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
   
    </style>
</head>

<body style="background-color: whitesmoke; overflow:auto;">
    

 
    <nav class="navbar navbar-expand-lg navbar-light bg-info">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">
                <img src="images/mylogo.png" height="80"/>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">Account</a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li> <a class="dropdown-item"  href="viewprofile.php">Profile</a></li>
                            <li> <a class="dropdown-item"  href="logout.php">Logout</a></li>
        
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    
    <div class="row d-flex">
<div class="col-sm-3">
<nav class ="navbar bg-light">
<ul class =" vic nav navbar-nav" style="margin-left:20%; ">
<li class ="  nav-item ">

<a href="add_student.php" class ="nav-link">  ADMISSION</a>
</li>
<li class ="nav-item">
<a href="view-students.php" class="nav-link">  VIEW STUDENT</a>
</li>

<li class ="nav-item">
<a href="post.php" class="nav-link"> ANNOUNCEMENTS</a>
</li>
<li class ="nav-item">
<a href="classs.php" class="nav-link"> ACADEMIC YEAR</a>
</li>
<li class ="nav-item">
<a href="exams.php" class="nav-link"> EXAMS</a>
</li>
<li class ="nav-item">
<a href="grades.php" class="nav-link"> GRADING</a>
</li>
<li class ="nav-item">
<a href="viewgrades.php" class="nav-link"> VIEW GRADES</a>
</li>
</ul>
</nav>
</div>
<div class="col-sm-9">
<div class="col">  
    <div class="row">
     <div class="col-sm-4 students" >
                <?php
                $query=mysqli_query($conn, "select *from student");
                $result=mysqli_num_rows($query);
                
                ?>
                     <p>  <a style="display: flex; color:blue;" href=""><?php echo $result; ?> Students</p>
                </a>
                <a href=""></a>
            </div>
            <div class="col-sm-3 students" >
                <?php
                $query1=mysqli_query($conn, "select *from class");
                $result1=mysqli_num_rows($query1);
                
                ?>
                      <p>  <a style="display: flex; color:blue;" href=""><?php echo $result1; ?> Classes</p>
                </a>
                <a href=""></a>
            </div>
            <div class="col-sm-3 students">
              
                <?php
                $query2=mysqli_query($conn, "select *from teacher");
                $result2=mysqli_num_rows($query2);
                
                ?>
                    <p>  <a style="display: flex; color:blue;" href="" > <?php echo  $result2; ?> Teachers</a></p>
                
                <a href=""></a>
            </div></div>
</div>

  


  
   

           
   
   
    <script>
    $(document).ready(function() {
        $(" a").hover(function() {
            $(this).css("color", "#d08c29");
            $(this).css("font-size", "larger")
        }, function() {
            $(this).css("color", "blue");
});




    });
    </script>

</body>

</html>