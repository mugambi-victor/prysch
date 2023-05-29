<?php include('connection.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <title>Document</title>
    <style>
     

       

        
    </style>
   
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
 if (isset($_POST['year'])) {
    $yname =mysqli_real_escape_string($conn,$_REQUEST['yname'] );
  
    $checks=mysqli_query($conn, "select * from academic_year where sname='$yname'");
    if(mysqli_num_rows($checks)>0){
        echo "sorry session already exists";
    }else{
        $res = mysqli_query($conn, "insert into academic_year values('0', '$yname')");
        if ($res) {
            echo "Data inserted successfully";
        } else {
            echo "error inserting data to the database";
        }
    }
   }
   


?>
<?php

if (isset($_REQUEST['create_class'])) {
     $classname = mysqli_real_escape_string($conn,$_REQUEST['cname'] );
   $a_year=mysqli_real_escape_string($conn,$_REQUEST['academic_year'] );
   $sql1=mysqli_query($conn, "select *from class where session_id=$a_year");
   $check=mysqli_num_rows($sql1);
   $q=mysqli_fetch_assoc($sql1);
   if($check<4 &&$q['class_name']!=$classname){
     
    $res = mysqli_query($conn, "insert into class values('0','$classname' ,'$a_year')");
    if ($res) { ?>
        <!-- Success Alert -->
<div class="alert alert-success alert-dismissible fade show">
<strong>Success!</strong>Class added successfully.
<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
  <?php  
    } else {
        ?>
                    <!-- Error Alert -->
                    <div class="alert alert-danger alert-dismissible fade show">
                        <strong>Error!</strong> A problem has occurred while adding class to the database.
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
         <?php 
    }
   }
   else{
    ?>
           <!-- Error Alert -->
           <div class="alert alert-danger alert-dismissible fade show">
               <strong>Error!</strong> You can only have 4 classes in a Year <br>Or you are trying to add a class thats already been added.
               <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
           </div>
<?php 
   }
  
}

?>

<?php
    if (isset($_REQUEST['submit1'])) {
        $subject_name = mysqli_real_escape_string($conn,$_REQUEST['subname'] );
        $class = mysqli_real_escape_string($conn,$_REQUEST['class'] );
        $subject_code =mysqli_real_escape_string($conn,$_REQUEST['subcode'] );

        $sql=mysqli_query($conn, "select * from subject where subject_name='$subject_name' and  class=$class");

        if(mysqli_num_rows($sql)>0){?>
        <!-- Info Alert -->
<div class="alert alert-info alert-dismissible fade show">
    <strong>Info!</strong>subject already added.
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
<?php
               
            }
            else{
                $res1 = mysqli_query($conn, "insert into subject values(0,'$subject_name',$class,'$subject_code' )");
                  if($res1){
                    ?>
            <!-- Success Alert -->
<div class="alert alert-success alert-dismissible fade show">
    <strong>Success!</strong> Subject was added successfully.
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
      <?php  
                     
                  }else{
                    ?>
                    <!-- Error Alert -->
                    <div class="alert alert-danger alert-dismissible fade show">
                        <strong>Error!</strong> A problem has occurred while submitting your data.
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
         <?php 
                  }
                }
    }
         
        
    
    ?>


    
   
<div class="container" style="border:0; margin-top:40px;">
<div class="row">
<form class="needs-validation" style=" margin:auto;  width:40%;" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); 
            ?>" method="post">
        
        <h2>Create Academic Year</h2></center>

    <div class="mb-3">
    <label for="academic_year">Academic Year </label> <br> 
    <input type="text" name="yname" class="form-control" placeholder="Year Name eg '2020/2021' " required>
    </div>
   
   <center> <button type="submit" name="year" class="btn btn-primary">Submit</button></center>

   <hr>
</form>
</div>

<div class="row">
<div class="col-sm">
    <!-- form for creating class -->
    <form class="needs-validation" style=" margin:auto;   action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); 
            ?>" method="post">
        
        <h2>Create a Class</h2></center>

    <div class="mb-3">
    <label for="academic_year">Academic Year </label> <br> 
                <?php
                $options1 = "";
                $selectQ= mysqli_query($conn, "SELECT *FROM academic_year");
                while ($row3 = mysqli_fetch_array($selectQ)) {
                    $options1 = $options1. "<option value=$row3[id]>$row3[sname]</option>";
                }?>
                <select name="academic_year" id="academic_year" class="form-select">
                    <?php echo $options1; ?>
                </select> 
    </div>
    <div class="mb-3">
    <label for="cname">Class Name</label>
                <input type="text" name="cname" class="form-control" placeholder="Class Name" required> 
    </div>
   <center> <button type="submit" name="create_class" class="btn btn-primary">Submit</button></center>
</form></div>

<!-- form for creating subject -->
<div class="col-sm">
<form class="needs-validation" style=" margin:auto; action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); 
            ?>" method="post">
        
        <h2>Create a Subject</h2></center>

    <div class="mb-3">
    
                
    </div>
    <div class="row g-3">
    <div class="col-md-6">
    <label for="academic_year">Academic Year </label> <br> 
    <select  class="form-select" name="session" id="session-list">
            <option value="">Select academic year</option>
            <?php
            $session_result = mysqli_query($conn, 'select distinct id,sname from academic_year');
            if (mysqli_num_rows($session_result) > 0) {
                // output data of each row
                while ($row = mysqli_fetch_assoc($session_result)) {
            ?>
                    <option value="<?php echo $row['id']; ?>"><?php echo $row['sname']; ?></option>
            <?php
                }
            }
            ?>
        </select>
  </div>
  <div class="col-md-6">
  <label for="class">Class</label> <br> 
  <select class="form-select" name="class" id="class-list">
            <option value=''>Select class</option>
        </select>
  </div>
    </div>
    <div class="mb-3">
    <label for="subname">Subject Name</label>
                <input type="text" name="subname" class="form-control" placeholder="subject Name" required> 
    </div>
    <div class="mb-3">
    <label for="subname">Subject Code</label>
                <input type="text" name="subcode" class="form-control" placeholder="subject Code" required> 
    </div>
   <center> <button type="submit" name="submit1" class="btn btn-primary">Submit</button></center>
</form>
    
</div>
</div>
     </div>

     <script src="jquery.js"></script>
<script>
    $('#session-list').on('change', function() {
        var session_id = this.value;
        $.ajax({
            type: "POST",
            url: "get_classes.php",
            data: 'session_id=' + session_id,
            success: function(result) {
                $("#class-list").html(result);
            }
        });
    });
 

   </script>

</body>

</html>