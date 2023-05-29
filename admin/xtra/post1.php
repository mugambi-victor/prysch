<?php 
include('connection.php');
session_start ();
if(!isset($_SESSION["account_login"]))

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
if(isset($_REQUEST["add"]))
	{	
        $title=mysqli_real_escape_string($conn,$_REQUEST["title"]);
        $details=mysqli_real_escape_string($conn,$_REQUEST["details"]);
$target="image/".basename( $_FILES["uploadfile"]["name"]);

        $filename = $_FILES["uploadfile"]["name"];
        // $tempname = $_FILES["uploadfile"]["tmp_name"];    
            // $folder = "image/".$filename;

            // move_uploaded_file( $_FILES["uploadfile"]["name"][0],$folder."/".$filename);
	mysqli_query($conn,"insert into post values('','$title','$details','$filename')");	
    if(move_uploaded_file($_FILES['uploadfile']['tmp_name'],$target)){
        echo "uploaded";
    }
    }

?> <div class="container">
<div class="col-sm-8">
    <form method="post" enctype="multipart/form-data">
   <center> <h2>Create Post</h2></center>
<table class="table table-bordered">
	
	<tr>	
		<th>Title</th>
		<td><input type="text" name="title"  class="form-control" placeholder="Title goes here..."/>
		</td>
	</tr>
	<tr>	
		<th>Details</th>
		<td><textarea name="details" rows="8" columns="10"  class="form-control"placeholder="Type here..."></textarea>
		</td>
	</tr>
<tr>
    <th>
        Image
    </th>
    <td><input type="file" 
                   name="uploadfile" 
                   value="" /></td>
</tr>
	<tr>
		<td colspan="2">
			<center><input type="submit" class="btn btn-secondary" value="Post" name="add" style="font-size:large;"/></center>
		</td>
	</tr>
</table> 
</form>
    </div>

</div>
    
</body>
</html>