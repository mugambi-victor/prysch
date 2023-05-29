<?php include("../connection.php");
session_start();
$s = $_SESSION["s_login"];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <style>
        .units-content {
            margin: 50px 300px;
            background-color: whitesmoke;
        }

        .units-content form {
            padding: 50px;
            margin: 50px 50px;
            font-size: larger;
            text-decoration: none;

        }

        .units-content h2 {
            color: blueviolet;
        }

        .units-content input {
            padding: 20px;
            margin: 0 5px 0 30px;
            text-align: center;
            
        }

        button {
            padding: 10px;
            font-size: large;
        }
    </style>
</head>

<body>
    
        <?php


        if (isset($_REQUEST['submit'])&&!empty($_POST['subjects'])) {
          
            $i = 0;
            if( count ($_POST['subjects'])!=0){
            foreach ($_POST['subjects'] as $textbox) {

                $data = mysqli_query($conn, "select *from student where regno='$s'");
                if ($data) {
                    while ($row = mysqli_fetch_assoc($data)) {
                        $student_id=$row['id'];
                        $subjectname = $textbox;
                        
                        $subjectname[$i];
                        $check= "SELECT distinct id,subject_id,class_id,student_id FROM subjectandstudent WHERE subject_id=$textbox and student_id=$student_id";
                        $rs = mysqli_query($conn, $check);
                        if (mysqli_num_rows($rs) > 0) {  ?>
                            <!-- Error Alert -->
                        <div class="alert alert-danger alert-dismissible fade show">
                            <strong>Error!</strong> You have already registered for this subject.
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                        <?php	}
                            else{
                                $sql1 = mysqli_query($conn, "insert into subjectandstudent values(0,$subjectname,$row[class], $row[id])");
                                if ($sql1) {?>
                                    <!-- Success Alert -->
                        <div class="alert alert-success alert-dismissible fade show">
                            <strong>Success!</strong> Ypu have successfully registered subjects for the year.
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                              <?php
                                }
                                $i++;
                            }
                      
                    }
                }
            }
        }}
        else{
            ?>
            <!-- Error Alert -->
        <div class="alert alert-danger alert-dismissible fade show">
            <strong>Error!</strong> You have to Select atleast one subject.
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php
        }
    
        ?>
        
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

    <div class="container">
       <div class="d-flex justify-content-center " style="margin-top:30px;">
            <form method="post" action=" ">
                        <h2>Select subjects</h2>
        <?php
        $sql = mysqli_query($conn, "select distinct id,regno,class from student where regno='$s'");
        
        if ($sql) {
            while ($res = mysqli_fetch_assoc($sql)) {
                $c= $res['class'];
                $sql2 = mysqli_query($conn, "select distinct id,subject_name,class,subject_code from subject where class=$c");
                if ($sql2) { ?>
                   
                        <?php 
                        while ($data = mysqli_fetch_assoc($sql2)) {
                           
                            echo "<input type='checkbox' name='subjects[]' value='" . $data['id'] . "'>"." ". $data['subject_name'] . "<br/>";
                           
                        } ?>
                        <button type="submit" class="btn btn-outline-primary" name="submit">Submit</button>
                    </form>
        <?php }
            }
           
        }
        else{  ?>
            <!-- Error Alert -->
        <div class="alert alert-danger alert-dismissible fade show">
            <strong>Error!</strong> .
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php
         } ?>

    </div>
    </div>
 
</body>

</html>