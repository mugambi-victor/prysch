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
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
   
     <link rel="shortcut icon" href="ol.png" >
    <title>ViewProfile</title>
    <style>
       .mm{
        padding-top:5rem;
    }
    .mrow{
       padding-left:10rem;   
       transition: 1s;
    }
    </style>
</head>
<body>
<?php include('header.php');?>

<?php 

  include('sidebar.php');

   ?>
<div class="container-fluid col-sm  d-flex">
<div class="container rounded bg-white mm mb-5">
    <div class="col-md mrow">

    
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
                <div class="mt-5 text-center"><button class="btn btn-primary " name="create"><a href="createadmin.php" class="text-white text-decoration-none">Create New Admin</a></button></div>
            </div>
        </div>
        </div>
    </div>
</div>
</div>


</div></form>
<?php } ?>
<script src="jquery.js"></script>
<script src="sidebar.js"></script>
</body>
</html>