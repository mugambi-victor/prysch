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
    <style>
        body {
    background: #0fa295;
}

.form-control:focus {
    box-shadow: none;
    border-color: #BA68C8
}

.profile-button {
    background: rgb(99, 39, 120);
    box-shadow: none;
    border: none
}

.profile-button:hover {
    background: #682773
}

.profile-button:focus {
    background: #682773;
    box-shadow: none
}

.profile-button:active {
    background: #682773;
    box-shadow: none
}

.back:hover {
    color: #682773;
    cursor: pointer
}

.labels {
    font-size: 11px
}

.add-experience:hover {
    background: #BA68C8;
    color: #fff;
    cursor: pointer;
    border: solid 1px #BA68C8
}
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
                        <a class="nav-link" aria-current="page" href="admin_dashboard.php"><i class='far fa-times-circle' style='font-size:48px;color:inherit'></i></a>
                    </li>
                  
                </ul>
            </div>
        </div>
    </nav> 
<?php
if(isset($_REQUEST["save"])){
    $uname=$_REQUEST["uname"];
    $email=$_REQUEST["email"];
    $pass=$_REQUEST["pass"];
    $save=mysqli_query($conn,"UPDATE admin SET username = '$uname', email = '$email', passwords='$pass' WHERE email='$s' ");
    if(isset($save)){
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>profile Updated Successfully!!!!</strong> 
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
    else{
        echo "sth is wrong";
    }
}
?>
<?php
$sql=mysqli_query($conn, "select *from admin where email='$s'");
while($result=mysqli_fetch_assoc($sql)){
?>

<div class="container rounded bg-white mt-5 mb-5">
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); 
            ?>" method="post">
           
        <div class="col-md-12 border-right">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Profile Settings</h4>
                </div>
                <div class="row mt-2">
                    <div class="col-md-6"><label class="labels">Name</label><input type="text" name="uname" class="form-control"  value='<?php echo $result["username"]; ?>'></div>
                    <div class="col-md-6"><label class="labels">Surname</label><input type="text" class="form-control" name="email" value='<?php echo $result["email"]; ?>' readonly></div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12"><label class="labels">Password</label><input type="text" name="pass" class="form-control"  value='<?php echo $result["passwords"]; ?>'></div>
                  
                </div>

                <div class="mt-5 text-center"><button class="btn btn-primary " name="save" type="submit">Save Profile</button></div>
            </div>
        </div>
        </div>
    </div>
</div>
</div>


</div></form>
<?php } ?>

</body>
</html>