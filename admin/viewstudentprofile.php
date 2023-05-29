<?php
include('connection.php');
session_start ();
if(!isset($_SESSION["email"]))

	header("location:admin_login.php"); 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="shortcut icon" href="ol.png" >
    <title>StudentProfile</title>
    
    
    
    <style>
        .gradient-custom {
/* fallback for old browsers */
background: #f6d365;

/* Chrome 10-25, Safari 5.1-6 */
background: -webkit-linear-gradient(to right bottom, rgba(246, 211, 101, 1), rgba(253, 160, 133, 1));

/* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
background: linear-gradient(to right bottom, rgba(246, 211, 101, 1), rgba(253, 160, 133, 1))
}

    </style>
</head>
<body>
<?php include('header.php');?>
<div class="container-fluid col-sm  d-flex">
<?php 

  include('sidebar.php');

   
    if(isset($_REQUEST['profile'])){
            $regno=mysqli_real_escape_string($conn,$_REQUEST["rno"]);
          
            $query=mysqli_query($conn, "select * from student where regno ='$regno'");
            while($result=mysqli_fetch_assoc($query)){
               
            
    ?>
    
    <div class="container col-md ">
    <section class="vh-100"  style="background-color: #f4f5f7; ">
  
  <div class="row  d-flex justify-content-center align-items-center h-100 ">
    <div class="col col-lg-10 mb-4 mb-lg-0">
      <div class="card mb-9" style="border-radius: .5rem;">
        <div class="row g-3">
          <div class="col-md-4 gradient-custom text-center text-white"
            style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">
            <?php echo "<img  class='img-fluid my-5' style='width: 150px; padding:0;' src='../student/images/".$result['photo']. " ' >"; ?>
            
            <h5><?php echo $result['s_name']; ?></h5>
            <p><?php echo $result['regno']; ?></p>
            <i class="far fa-edit mb-5"></i>
          </div>
          <div class="col-md-8">
            <div class="card-body p-4">
              <h6>Information</h6>
              <hr class="mt-0 mb-4">
              <div class="row pt-1">
                <div class="col-6 mb-3">
                  <h6>DOB</h6>
                  <p class="text-muted"><?php echo $result['dob']; ?></p>
                </div>
                
                <div class="col-6 mb-3">
                  <h6>year joined</h6>
                  <p class="text-muted"><?php echo $result['year']; ?></p>
                </div>
              </div>
              <div class="row">
                <h5>Class info</h5> <hr>
  <div class="col-md-4">
    <label for="course" class="form-label">CLass name</label>
    
    <?php 
    $cid=$result['class'];
    $getclass=mysqli_query($conn,"select *from class where class_id =$cid");
    $classresult=mysqli_fetch_assoc($getclass);
    $classname=$classresult['class_name'];
    ?>
<p class="text-muted"><?php echo $classname; ?></p>
   
  </div>

 
  <div class="col-md-4">
    <label for="year" class="form-label">Year</label>
    
    <?php 
     
    $yrid=$result['session_id'];
    $getyr=mysqli_query($conn,"select *from academic_year where id =$yrid");
    $yrresult=mysqli_fetch_assoc($getyr);
    $yrname=$yrresult['sname'];
    ?>
 <p class="text-muted"><?php echo $yrname; ?></p>
    
  </div>

  
  <div class="col-md-4">
    <label for="semester" class="form-label">Term</label>
    
    <?php 
    $tid=$result['term_id'];
    $getterm=mysqli_query($conn,"select *from term where term_id =$tid");
    $termresult=mysqli_fetch_assoc($getterm);
    $termname=$termresult['term_name'];
    ?>
 <p class="text-muted"><?php echo $termname ?></p>
  </div>

  </div>
  
              <h6>Parent/Guardian Information</h6>
              <hr class="mt-0 mb-4">
              <div class="row pt-1">
                <div class="col-6 mb-3">
                  <h6>Parent/Guardian Name</h6>
                  <p class="text-muted"><?php echo $result['parent_name']; ?></p>
                </div>
                <div class="col-6 mb-3">
                  <h6>Parent/Guardian phone</h6>
                  <p class="text-muted"><?php echo $result['pno']; ?></p>
                </div>
                <div class="col-6 mb-3">
                  <h6>Parent's Email</h6>
                  <p class="text-muted"><?php echo $result['email']; ?></p>
                </div>
              </div>
              <div class="d-flex justify-content-start">
                
                <form action="editstudentprofile.php" method="post">
                <input type="text" name="rno" value="<?php echo $result['regno']; ?>" hidden>
                <input type="submit" class="btn btn-primary" name="edit" value="Edit Profile"> 
      
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  
</div>
</section>
</div>
<?php }} ?>
</body>
</html>