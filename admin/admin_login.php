<?php include('connection.php');
ob_start();
session_start();?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
 
    <script type="text/javascript" src="file.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <style>
       

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
                        <a class="nav-link" aria-current="page" href="index1.php"><i class='far fa-times-circle' style='font-size:48px;color:inherit'></i></a>
                    </li>
                  
                </ul>
            </div>
        </div>
    </nav> 
    <?php

if(isset($_REQUEST['login']))
{
$a =mysqli_real_escape_string($conn,$_REQUEST['email']);
$b = mysqli_real_escape_string($conn,$_REQUEST['pass']);

$res = mysqli_query($conn,"select* from admin where email='$a' and passwords='$b'");
$result=mysqli_fetch_assoc($res);
if($result)
{
	
	$_SESSION["account_login"]="1";
    $_SESSION["email"]=$result["email"];
	header("location:admin_dashboard.php");
}
else	
{
    ?>
    <!-- Error Alert -->
<div class="alert alert-danger alert-dismissible fade show">
    <strong>Error!</strong> Incorrect Email or Password!!!! Please try again.
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
<?php
   
	
  

}
}
    ?>
       
    <div class="container m-4" style="border:0; ">
    <div class="row">
        
        <div class="col-md ps-5">
        <form class="needs-validation form-container" style=" margin:auto; width:50%;  border:px solid;" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); 
            ?>" method="post">
          <center>  <div class="iccon" style="padding:10px;"><img src="../images/OIP1.jfif" alt="" width="100" height="80"></div>
        <h2>Admin Login</h2></center>

    <div class="mb-3">
        <label class="form-label" for="inputEmail">Email</label>
        <input type="email" class="form-control" name='email' id="inputEmail" placeholder="Admin Email" required>
    </div>
    <div class="mb-3">
        <label class="form-label" for="inputPassword">Password</label>
        <input type="password" class="form-control" name="pass" id="inputPassword" placeholder="Password" required>
    </div>
   <center> <button type="submit" name="login" class="btn btn-primary">Sign in</button></center>
</form>
        </div>
   
    </div>
        
</div>

</body> 
</html>