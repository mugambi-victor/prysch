<?php
include('connection.php');
session_start ();
if(!isset($_SESSION["account_login"]))

	header("location:admin_login.php"); 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

   
<style>
    h4:before,
        h4:after {
            content: "";
            flex: 1 1;
            border-bottom: 2px solid #630436;
            margin: auto;
        }
        h4 {
            display: flex;
            flex-direction: row;
            color:#630436;;
        }
</style>
</head>
<body>
    <?php include('header.php') ?>
    <div class="container">
   <form action="" class="row g-3"  enctype="multipart/form-data" method="post" style="margin-top:50px;">
<?php
if (isset($_REQUEST['save'])) {
    $regno= $_REQUEST['regno'];
    $sname = $_REQUEST['sname'];
    $p_name=$_REQUEST['pname'];
    $pno=$_REQUEST['pno'];
    $email=$_REQUEST['pemail'];
    $dob=$_REQUEST['dob'];
    $yoj=$_REQUEST['yoj'];
    $arget="student/images/".basename( $_FILES["uploads"]["name"]);
    $filename = $_FILES["uploads"]["name"];


    if (isset($_REQUEST['class']) && is_numeric($_REQUEST['class'])){
      $class = $_REQUEST['class'];
    }
   
   
    $year=$_REQUEST['academic_year'];
    if($filename==''){
      $res=mysqli_query($conn,"update student set s_name='$sname',dob='$dob',class='$class', year='$year',parent_name='$p_name',pno='$pno',email='$email', dob='$dob' where regno='$regno'");
      if($res){ ?>
        <!-- Success Alert -->
<div class="alert alert-success alert-dismissible fade show">
<strong>Success!</strong>Data updated successfully.
<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
  <?php  }
      else{
          echo "error!!";
      }
    }
    else{
      $res=mysqli_query($conn,"update student set s_name='$sname',dob='$dob',class='$class', year='$year',parent_name='$p_name',pno='$pno',email='$email', dob='$dob', photo='$filename' where regno='$regno'");
      if($res&& move_uploaded_file($_FILES['uploads']['tmp_name'],$arget)){ ?>
         <!-- Success Alert -->
        <div class="alert alert-success alert-dismissible fade show">
        <strong>Success!</strong>Data updated successfully.
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
          <?php  }
    else{  ?>
      <!-- Error Alert -->
      <div class="alert alert-danger alert-dismissible fade show">
          <strong>Error!</strong> A problem has occurred while adding class to the database.
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
<?php  }
    }
   
   }
    if(isset($_REQUEST['edit'])){
            $regno=$_REQUEST["rno"];
            
            $query=mysqli_query($conn, "select * from student where regno ='$regno'");
            while($result=mysqli_fetch_assoc($query)){
               
                
    ?>
        
    <div class="row">
    <div class="col-md-6">
    <label for="sname" class="form-label">student Name</label>
    <input type="text" class="form-control" id="sname" value="<?php echo $result['s_name'] ?>" name="sname" required>
  </div>
  <div class="col-md-6">
    <label for="dob" class="form-label">DOB</label>
    <input type="text" class="form-control" id="dob" value="<?php echo $result['dob'] ?>" name="dob" >
    <input type="text" class="form-control" id="regno" value="<?php echo $result['regno'] ?>" name="regno"  hidden>
  </div>
    </div>
  
    <div class="row">
    <div class="col-md-6">
    <label for="year" class="form-label">Academic Year</label>
    <select class="form-select" aria-label="Default select example" name="academic_year" id="year-list" required>
  <option selected>Open this select menu</option>
  <?php
  $session_result = mysqli_query($conn, "select * from academic_year");
            if (mysqli_num_rows($session_result) > 0) {
                // output data of each row
                while ($row = mysqli_fetch_assoc($session_result)) {
                    $options=$options."<option value= $row[id] >$row[sname]</option>";
            
                }
            }
            echo $options;
            ?>
</select>
  </div>
  <div class="col-md-6">
    <label for="" class="form-label">Class</label>
    <select class="form-select" aria-label="Default select example"  name="class" id="class-list" required>
  <option value=''>Open this select menu</option>
</select>
  </div>
    </div>
  <div class="row">
  <div class="col-md-6">
    <label for="yoj" class="form-label">Year of Joining</label>
    <input type="text" class="form-control" id="yoj"value="<?php echo $result['year'] ?>" name="yoj" required>
  </div>
  </div>
    <div class="row">
    <div class="col-md-6">
    <label for="pname" class="form-label">Parent/guardian Name</label>
    <input type="text" class="form-control" id="pname" value="<?php echo $result['parent_name'] ?>" name="pname" required>
  </div>
  <div class="col-md-6">
    <label for="pemail" class="form-label">Parent/Guardian Email</label>
    <input type="email" class="form-control" id="pemail"value="<?php echo $result['email'] ?>" name="pemail" required>
  </div>
    </div>
 <div class="row">
 <div class="col-md-6">
    <label for="pno" class="form-label">Parent/Guardian Phone</label>
    <input type="text" class="form-control" id="pno"value="<?php echo $result['pno'] ?>" name="pno" required>
  </div>
  <div class="col-md-6">
    <label for="uploads" class="form-label">Update Photo</label>
    <input type="file" class="form-control" value="<?php echo $result['photo'] ?>" id="uploads"  name="uploads" >
  </div></div>
  
  <div class="col-md-6">
    <center><input type="submit" class="btn btn-danger"  name="save" value="save" required></center>
  </div>
  <?php }} ?>
  </div>
</body>
<script src="jquery.js"></script>
<script >
      $('#year-list').on('change', function() {
        var session_id = this.value;

        $.ajax({
            type: "POST",
            url: "getclasses.php",
            data: 'session_id=' + session_id,
            success: function(result) {
                $("#class-list").html(result);
            }
        });
    });
</script>
</html>