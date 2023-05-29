<?php include('../connection.php');
ob_start();
session_start();?>

<!DOCTYPE html>
<html lang="en">
    
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="../vee.css">
    <link rel="stylesheet" type="text/css" href="../foots.css">
    <script type="text/javascript" src="file.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <style>
        .emp_form {
            width: 500px;
            margin: 2% auto;
            border-style: groove;
            height: max-content;
            border-radius: 20px;
        }

        .emp_form input {
            width: 100%;
            padding: 20px 5px;
            margin: 5px 0;
            border: 0;
            border-bottom: 1px solid #999;
            border-radius:5px;
            outline: none;
            background: transparent;
        }

        .form-style-4 {
            width: 80%;
            margin: 50px;

        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-info">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">
                <img src="../images/mylogo.png" height="80"/>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                   
                    
                </ul>
                <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="../index.php"><i class='far fa-times-circle' style='font-size:48px;color:inherit'></i></a>
                    </li>
                  
                </ul>
            </div>
        </div>
    </nav> 
<!-- <div class="header">
        <a href="#default" class="logo">Myschool</a>
        <div class="header-right">
            <a class="active" href="admin_login.php">Admin login</a>
            <a href="">Student Login</a>
            <a href="">Employee Login</a>
        </div>
    </div> -->
    <div class="container" style="border:0; margin-top:40px;">
        <form class="needs-validation" style=" margin:auto;  width:40%;" action="" method="post">
          <center>  <div class="iccon" style="padding:10px;"><img src="../images/Business-people-TEC-homepage_0.png" alt="" width="100" height="90"></div>
        <h2>Parent Login</h2></center>

    <div class="mb-3">
        <label class="form-label" for="inputEmail">Email</label>
        <input type="email" class="form-control" name='email' id="inputEmail" placeholder="Email..." required>
    </div>
    <div class="mb-3">
        <label class="form-label" for="inputPassword">Password</label>
        <input type="password" class="form-control" name="pass" id="inputPassword" placeholder="Password" required>
    </div>
   <center> <button type="submit" name="login" class="btn btn-primary" style="margin:20px;">Sign in</button></center>
</form></div>
    <?php

if(isset($_REQUEST['login']))
{
$a = $_REQUEST['email'];
$b = $_REQUEST['pass'];

$res = mysqli_query($conn,"select* from student where email='$a'and p_password='$b'");
$result=mysqli_fetch_array($res);
if($result)
{
	$_SESSION["p_login"]="$a";
	header("Location:p_dashboard.php");
}
else	
{?>
  <!-- Error Alert -->
  <div class="alert alert-danger alert-dismissible fade show">
    <strong>Error!</strong> Incorrect Email or Password!!!! Please try again.
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
<?php
	
  

}
}
    ?>
    
    <footer class="bg-primary text-center text-white">
  <!-- Grid container -->
  <div class="container p-4 pb-0">
    <!-- Section: Social media -->
    <section class="mb-4">
      <!-- Facebook -->
      <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"
        ><i class="fa fa-facebook left"></i> Facebook</a>

      <!-- Twitter -->
      <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"
        ><i class="fa fa-twitter left"></i> Twitter</a>

      <!-- Google -->
      <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"
        ><i class="fa fa-google-plus left"></i> Google +</a>

      <!-- Instagram -->
      <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"
        ><i class="fa fa-instagram left"></i> Instagram</a>

    </section>
    <!-- Section: Social media -->
  </div>
  <!-- Grid container -->

  <!-- Copyright -->
  <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
    © 2020 Copyright:
    <a class="text-white" href="https://mdbootstrap.com/">Gambino solutions</a>
  </div>
  <!-- Copyright -->
</footer>

</body>
</html>