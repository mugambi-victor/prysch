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
        padding-top: 6rem;
    }

    .mrow {
    padding-left:10rem;
    padding-bottom: 2rem;
    padding-top: 2rem;
    padding-right: 1rem;
    margin-right: 0;
        transition: 1s;
        background-color: white;
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
            <p class="lead fw-bold"  style="color:#0036AB;">Search student by Registration Number</p>
                        <input type="text" name="searchbox" placeholder="search registration no..." class="form-control" style="border:0; background:whitesmoke"
                            required>
                    
                            <button type="submit" name="search" class="bt mt-2 mb-2" >Search  <i class="fa fa-search"></i></button>
                   
            </form>
        

    <?php
    if(isset($_REQUEST['search'])){
        $regno=$_REQUEST['searchbox'];


        $sql1=mysqli_query($conn, "select * from student where regno='$regno'");
        if(mysqli_num_rows($sql1)>0){
            ?>
            <div class="table-responsive">
    <table class=" col-sm-12  table table-bordered ">
        <tr style="background:#948905; color:white;">
            <th>Student Name</th>
            <th>Registration Number</th>
            <th>Parent's email</th>
            <th>Parent's No.</th>
            <th>Actions</th>
        </tr>
        <?php

            while($row=mysqli_fetch_assoc($sql1)){
      
                ?>
                <tr>
                    <td>
                        <form method='post' action='viewstudentprofile.php'>
                            <label class='text-capitalize'><?php echo $row['s_name'];?></label>
                        </td>
                        <td>
                            <input class='text-uppercase' style='border:0;' name='rno' type='text' readonly value=<?php echo $row['regno']; ?>>
                        </td>
                        <td>
                            <?php echo $row['email'] ?>
                        </td>
                        <td>
                            <?php $row['pno'];?>
                        </td>
                        <td>
                            <button type='submit' name='profile' class='bt btn-info' ><i class="fa fa-eye"></i> View Profile</button>
                           
                        </form>
                    </a>
                   <button class="bt" ><a  href='promote.php?id=<?php echo $row['id']?>' class="text-decoration-none text-white"><i class='fa fa-angle-double-up'></i>  Promote Student</a></button> 
                        </td>
                    </tr>  
                </table>
               <?php }
                
        }
        
        else{
            echo "<div class='lead mt-2 text-dark'>No records found in the database</div>";
        }
        
            }?>


<hr class="my-2">
        <form action="students_byclass.php" method="post" id="myform">
            <p class="lead fw-bold"  style="color:#0036AB;">View Students by class</p>
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
                <button type="submit" name="submit" id="formsubmit" class="bt mt-2 mb-2"><i class="fa fa-eye"></i> View Students</button>
             
            </div>
            </div>


        </form>
        
        
            
<div class="row  mrow">
              
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