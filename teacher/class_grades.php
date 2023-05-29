<?php include('../connection.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../vee.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <title>Document</title>
    <style>
        /* .students{
            margin-left:30%
           }
        .contt{
            margin:5%;
       

        }
        .students input{
            padding:5px;
            text-align:center;
            border: 1px solid teal;
            font-size:20px;
            background-color:#046e84;
            color:white;
            border-radius:10px;
        }
         */
         input{
             border:0;
             background-color:inherit;
         }
    </style>
</head>
<body>
<!-- <div class="header" >

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
                   
                    
                </ul>
                <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="s_dashboard.php"><i class='far fa-times-circle' style='font-size:48px;color:inherit'></i></a>
                    </li>
                  
                </ul>
            </div>
        </div>
    </nav>
    <div class="container " style="margin-left:200px; margin-top:50px;">
    <?php
if (isset($_POST["submit"])) {
            $student_classname = $_POST['classs'];
            $exam=$_POST['exam'];
         
            $sql = mysqli_query($conn, "select * from student where class='$student_classname'");
            while($res=mysqli_fetch_assoc($sql)){?>
            
            <div class="col-8">
            <form action="addmarks.php" method="post">
            <input type="text" hidden value="<?php echo $res['id']; ?>" name="student">
            <input type="text" hidden value="<?php echo $res['class']; ?>" name="class">
            <input type="text" hidden value="<?php echo $exam; ?>" name="exam">
            <table class="table table-info ">
                <tr>
          
                    <td><input type="text"  style="padding:10px;" readonly value="<?php echo $res['s_name']; ?>"></td> <td><input type="text" style="padding:10px;" readonly value="<?php echo $res['regno']; ?>"></td><td><input style="margin-top:0;"  type="submit" class="btn btn-primary" name="submit" value="add marks"></td>
                </tr>
            </table>
            </form>
            </div>
          
           
            
           
           <?php }}
          ?>
            </div>
</body>
</html>