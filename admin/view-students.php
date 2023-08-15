<?php include('../connection.php');
session_start();
$a=$_SESSION["email"];
if (!isset($_SESSION["email"])) {

    header("location:admin_login.php");
}

$optionr=""; 
$options=""; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="ol.png">

    <title>ViewStudents</title>
    <style>
    
    .mm {
        padding-top: 10rem;
    }

    .mrow {
    padding-left:10rem;
        transition: 1s;
    }
    </style>
</head>

<body>
    <?php include('header.php');
     include('sidebar.php');
    ?>
<div class="container-fluid mm ">
    <div class="container col-sm   ">

        <div class="row mrow col-md-12 ">
            <form action="" method="post">
            <p class="lead fw-bold">Search student by Registration Number</p>
                        <input type="text" name="searchbox" placeholder="search registration no..." class="form-control"
                            required>
                    
                  
                        <input type="submit" name="search" class="btn m-2 btn-primary" value="Search">
               



            </form>
        

    <?php
    if(isset($_REQUEST['search'])){
        $regno=$_REQUEST['searchbox'];


        $sql1=mysqli_query($conn, "select * from student where regno='$regno'");
        if(mysqli_num_rows($sql1)>0){
            ?>
    <table class=" col-sm-12 table table-bordered table-striped">
        <tr>
            <th>Student Name</th>
            <th>Registration Number</th>
            <th>Parent's email</th>
            <th>Parent's No.</th>
            <th>Actions</th>
        </tr>
        <?php

            while($row=mysqli_fetch_assoc($sql1)){
      
                echo "<tr><td><form method='post' action='viewstudentprofile.php'><label class='text-capitalize'>" . $row['s_name'] . "</label></td><td><input class='text-uppercase' style='border:0;' name='rno' type='text' readonly value=" . $row['regno'] . "></td><td>" . $row['email'] . "</td><td>" . $row['pno'] . "</td><td><input type='submit' class='btn btn-info' value='view profile' name='profile'></form></a><a  href='promote.php?id=$row[id]' class='btn btn-primary mt-2'>Promotestudent</a></td></tr>  </table>"; 
                }
                
        }
        else{
            echo "<div class='lead mt-2 text-dark'>No records found in the database</div>";
        }
        
            }?>


<hr class="my-2">
        <form action="" method="post" id="myform">
            <p class="lead fw-bold">View Students by class</p>
            <div class="row">
                <div class="col-md">
                    <label for="" class="form-label">Academic year</label>
                    <select class="form-select" name="session" id="session-list" required>
                        <option selected>select academic year</option>
                        <?php
  $optionss="";
  $a_result = mysqli_query($conn, "select* from academic_year");
            if (mysqli_num_rows($a_result) > 0) {
                // output data of each row
                while ($r = mysqli_fetch_assoc($a_result)) {
                    $optionss=$optionss."<option value= $r[id] >$r[sname]</option>";
            
                }
                 
            }
           echo $optionss;
            ?>
                    </select>
                </div>
                <div class="col-md">
                    <label for="term_name" class="form-label">Term</label>
                    <select class="form-select" name="term_name" id="term-list" required>
                        <option value=''>Select Term</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md">
                    <label for="" class="form-label">Class</label>
                    <select class="form-select" name="class" id="class-list" required>
                        <option selected>select Class</option>
                        <?php
  $d_result = mysqli_query($conn, "select* from class");
            if (mysqli_num_rows($d_result) > 0) {
                // output data of each row
                while ($r = mysqli_fetch_assoc($d_result)) {
                    $options=$options."<option value= $r[class_id] >$r[class_name]</option>";
            
                }
                 
            }
           echo $options;
            ?>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <input type="submit" value="View Students" name="submit" id="formsubmit" class="btn btn-primary mt-1">
            </div>
            </div>


        </form>
        
        
            
<div class="row  mrow">
                <?php 
              if(isset($_REQUEST["submit"])){
            ?>

                <?php
                  $year=mysqli_real_escape_string($conn,$_REQUEST["session"]);
                  $term=mysqli_real_escape_string($conn,$_REQUEST["term_name"]);
                 
                  $class=mysqli_real_escape_string($conn,$_REQUEST["class"]);
              
                  ?>

                <table class=" table table-striped table-bordered caption-top">
                    <?php
                    //get year names
                    $yrname = mysqli_query($conn,"select *from academic_year where id=$year");
                    $yr_res=mysqli_fetch_assoc($yrname);
                    $year1=$yr_res['sname'];
                    //get term
                    $termname = mysqli_query($conn,"select *from term where term_id=$term");
                    $term_res=mysqli_fetch_assoc($termname);
                    $term1=$term_res['term_name'];
                    //get class
                    $classname = mysqli_query($conn,"select *from class where class_id=$class");
                    $class_res=mysqli_fetch_assoc($classname);
                    $class1=$class_res['class_name'];
                    
                  $sql=mysqli_query($conn,"select *from student where term_id=$term and class=$class");
                  if(mysqli_num_rows($sql)>0){
                    ?>
                    <caption>List of students in Year:<?php echo $year1 ?> Term: <?php echo $term1 ?> Class: <?php echo $class1 ?></caption>
                    <tr>
                        <th>Student Name</th>
                        <th>Registration Number</th>
                        <th>Parent's email</th>
                        <th>Parent's No.</th>
                        <th>Actions</th>
                    </tr>
                    <?php
                  while($row=mysqli_fetch_assoc($sql)){
                
                     echo "<tr><td><form method='post' action='viewstudentprofile.php'><label class='text-capitalize'>" . $row['s_name'] . "</label></td><td><input class='text-uppercase' style='border:0;' name='rno' type='text' readonly value=" . $row['regno'] . "></td><td>" . $row['email'] . "</td><td>" . $row['pno'] . "</td><td><input type='submit' class='btn btn-info' value='view profile' name='profile'></form></a></td></tr>"; }}
                     else{
                        
                        ?>
            <div class="alert mt-2 alert-danger alert-dismissible fade show" role="alert">
                <strong>Sorry!!</strong> No Records found.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php
                       
                    }?>

                </table>
            </div>
        </div>
        </div>



        </div>
        </div>
        <?php }
   
    ?>
        <script src="sidebar.js"></script>
        <script src="../jquery.js"></script>
        <script>
        $('#session-list').on('change', function() {
            var session_id = this.value;
            $.ajax({
                type: "POST",
                url: "getclasses.php",
                data: 'session_id=' + session_id,
                success: function(result) {
                    $("#term-list").html(result);
                }
            });
        });
        </script>

</body>

</html>