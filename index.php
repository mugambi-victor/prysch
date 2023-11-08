<?php include('connection.php');
ob_start();
session_start();?>

<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="shortcut icon" href="admin/ol.png" >
    <title>Index</title>
 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<link href="bootstrap_5.1.3/css/bootstrap.min.css" rel="stylesheet" >
<script src="bootstrap_5.1.3/js/bootstrap.min.js"></script>

    <style>
       
       .navbar{
        background:#051094;
       }
       .schoolname{
        width:4rem; 
        font-family:monospace
       }
       body{
       background:whitesmoke;
       }
        /* buttons */
     .bt{
        padding:.3rem .9rem;
        border: 1px solid;
        border-radius: 10px;
        background-color:#0036AB;
        color:white;
       
    }
    .bt:hover{
        background-color: #948905;
        color:black;
       
    }
    .bt-danger{
        padding:.3rem .9rem;
        border: 1px solid;
        border-radius: 10px;
        background-color:red;
        color:white;
        text-decoration: none;
    }
    .bt-danger:hover{
        background-color: #948905;
        color:black;
       
    }
    .link{
        text-decoration: none;
    }
    </style>
</head>

<body style="background-image:url('classroom.jpg'); background-size:cover; ">
<nav class="navbar navbar-expand-lg navbar-light " style="background:#051094;">
        <div class="container-fluid">
        <img src="images/shyne.png" class="pe-2" height="100" alt="CoolBrand"/> <br>
            
               
               <p class="schoolname text-wrap text-white fw-bold" >SHYNE STUDENT MANAGEMENT SYSTEM</p>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                
                <ul class="navbar-nav ms-auto">
                    
                    <li class="nav-item dropdown">
                        <a class="nav-link text-white dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">Users</a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li> <a class="dropdown-item"  href="admin_login.php">Admin Login</a></li>
                            <li> <a class="dropdown-item"  href="student/s_login.php">Student Login</a></li>
                            <li> <a class="dropdown-item"  href="parent/parent_login.php">Parent Login</a></li>
                        </ul>
                    </li>
                
                </ul>
            </div>
        </div>
    </nav>


    <div class="container" >
    <div class="mt-4 p-5 text-white rounded" style="background:#051094">
  <center><h1>Primary School Student Information Management System</h1></center>
  
</div>
   <div class="container mt-5">
   <div class="row">
        <div class="col-md">
            <button class="bt  mt-2 form-control"><a class=" text-white link "  aria-current="page" href="admin/admin_login">Admin</a></button>
        
        </div>
        <div class="col-md">
            <button class="bt  mt-2 form-control"> <a class=" text-white link" aria-current="page" href="Accounts/accounts_login">Accounts</a></button>
       
        </div>
        <div class="col-md">
            <button class="bt  mt-2 form-control"> <a class="  text-white link " href="student/s_login" tabindex="-1" aria-disabled="true">Parent</a></button>
       
        </div>
        <div class="col-md">
            <button class="bt  mt-2 form-control"> <a class="  text-white link " href="parent/parent_login">Teacher</a></button>
       
        </div>
    </div>
   </div>
 
</body>
</html>