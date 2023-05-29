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
    <title>Document</title>
    <style>
        .row{
        margin:15%;
        
        
        }
        .nav-link{
            color:white;
            font-size:larger;
        }
        .nav-item{
            margin-left:6%;
        }
        h3{
          color:white;
        }
    </style>
</head>
<body style="background-image:url('images/library-books.jpg'); background-size:cover;">
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
                        <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">Users</a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li> <a class="dropdown-item"  href="admin/admin_login.php">Admin Login</a></li>
                            <li> <a class="dropdown-item"  href="student/s_login.php">Student Login</a></li>
                            <li> <a class="dropdown-item"  href="parent/parent_login.php">Parent Login</a></li>
                        </ul>
                    </li>
                
                </ul>
            </div>
        </div>
    </nav>


    <div class="container" >
    <div class="mt-4 p-5 bg-info text-white rounded">
  <center><h1>Student Result Management System</h1></center>
  
</div>
   <div class="container">
   <div class="row">
        <div class="col">
        <a class="nav-link  btn btn-outline-info" aria-current="page" href="admin/admin_login.php">Admin</a>
        </div>
        <div class="col">

        <a class="nav-link btn btn-outline-info" href="student/s_login.php" tabindex="-1" aria-disabled="true">student</a>
        </div>
        <div class="col">
        <a class="nav-link btn btn-outline-info" href="parent/parent_login.php">Parent</a>
        </div>
    </div>
   </div>
 
</body>
</html>