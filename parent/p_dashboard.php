<?php
include("../connection.php");
session_start();
$s = $_SESSION["p_login"];

if (!isset($_SESSION["p_login"])) {
    header("location:p_login.php");
}


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
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
  <style>
      
        /* .dropbtn {
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
            background-color: #A3765D;
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

    

        .the-content p {
            margin: auto;
        }

        .the-content i {
            margin-left: 10px;
            background-color: antiquewhite;
            padding: 20px;
        }

        .students {
          
           width:60%;
            background-color: #cdcdbb;
            text-decoration: none;
            margin-left: 1%;
            margin-top: 0;
        }

        .students i {
            margin-left: 10px;
            text-decoration: none;

        }

        .students a {
            text-decoration: none;
        }

        .subj {
            background-color: inherit;
            
        }

        ul {
        margin-left: 40%;
        }

        ul li {
            display: block;
            text-decoration: none;
            color:teal;
            font-size: 20px;
        } */
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
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">Account</a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li> <a class="dropdown-item"  href="#">Profile</a></li>
                            <li> <a class="dropdown-item"  href="../logout.php">Logout</a></li>
                           
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- <div class="header">
        <a href="#default" class="logo">welcome <?php echo ($s)   ?></a>
        <div class="header-right">
            <a class="active" href="t_dashboard.php">Home</a>
            <div class="subnav">
                <button class="subnavbtn">Profile <i class="fa fa-caret-down"></i></button>
                <div class="subnav-content">
                    <a href="#link1">View Profile</a>
                    <a href="../logout.php">Logout</a>
                </div>
            </div>

        </div>
    </div> -->
    <div class="row">
<div class="col-3">
<nav class ="navbar bg-light">
<ul class =" vic nav navbar-nav" style="margin-left:20%; ">
<li class ="  nav-item ">

<a href="results.php" class ="nav-link"> <i class='fas'>&#xf501;</i> RESULTS</a>
</li>
<li class ="nav-item">
<a href="../news.php" class="nav-link"><i class='fas'>&#xf508;</i>NEWS& ANNOUNCEMENTS</a>
</li>
<li class ="nav-item">
<a href="add_teacher.php" class="nav-link"><i class='fas'>&#xf508;</i> CONTACT SCHOOL</a>
</li>



</li>
</ul>
</nav>
</div>
<div class="col-9">
<div class="container">
    <div class="row">
<div class="col-sm-8">
   
</div>
<div class="col-sm"></div>
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