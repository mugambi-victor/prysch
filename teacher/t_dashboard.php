<?php
include("../connection.php");
session_start();
$t = $_SESSION["emp_login"];
if (!isset($_SESSION["emp_login"]))

    header("location:t_login.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOME</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../vee.css">
    <link rel="stylesheet" type="text/css" href="../foots.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <style>
        .dropbtn {
            background-color: #A3765D;
            color: #522E75;
            padding: 6px 8px 6px 16px;
            font-size: 16px;
            border: none;
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f1f1f1;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .dropdown-content a {
            color: white;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            background-color:  #A3765D;
        }

        .dropdown-content a:hover {
            background-color: #522E75;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .dropdown:hover .dropbtn {
            background-color: #3e8e41;
        }
        .menu{
            height:auto;
            background-color:#00585E;
            margin-top:150px;
        }
        .linkss{
           width:100%;
            margin-bottom:30px;

        }
        .linkss a{
            margin-left:5%;
            text-decoration:none;
            padding:20px;
            color:white;
            
        }
        li a:hover{
            color:white;
        }
       li{
          margin-left:50px;
        }
    </style>
</head>

<body style="background-color: whitesmoke;">

    <!-- <div class="header">
        <a href="#default" class="logo">welcome <?php echo ($t)   ?></a>
        <div class="header-right">
            <a class="active" href="t_dashboard.php">Home</a>
            <div class="subnav">
                <button class="subnavbtn">Profile <i class="fa fa-caret-down"></i></button>
                <div class="subnav-content">
                    <a href="#link1">View Profile</a>
                    <a href="../logout.php">
                        <h2>
                            <font color="red">Logout</font>
                        </h2></a>

                </div>
            </div>

        </div>
    </div> -->

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
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="../index.php">Home</a>
                    </li>
                   
                    <li class="nav-item">
                        <a class="nav-link" href="../news.php">News and Announcemnts</a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">Account</a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li> <a class="dropdown-item"  href="admin_login.php">Profile</a></li>
                            <li> <a class="dropdown-item"  href="teacher/t_login.php">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-sm">
            <ul class="list-group list-group-horizontal bg-light text-center">
  <li class="list-group-item btn btn-outline-primary"><a href="grades.php"><i class='fas'>&#xf508;</i>Manage Grades</a></li>
  <li class="list-group-item btn btn-outline-primary"><a href="grades.php"><i class='fas'>&#xf508;</i>View Student</a></li>
  <li class="list-group-item btn btn-outline-primary"><a href="../index.php"><i class="fa fa-fw fa-envelope"></i> HomePage</a></li>
  <li class="list-group-item btn btn-outline-primary"><a href="#home"><i class='fas'>&#xf4ff;</i> Messages</a></li>
</ul>
            </div>
       
        </div>
    </div>
   

    
  


</body>

</html>