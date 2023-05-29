<?php
include('connection.php');
session_start ();
$optionrr="";
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
    <title>EditStudent</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    
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
    $sname = mysqli_real_escape_string($conn, $_REQUEST['sname']);
    $p_name=$_REQUEST['pname'];
    $pno=$_REQUEST['pno'];
    $email=$_REQUEST['pemail'];
    $dob=$_REQUEST['dob'];
    $yoj=$_REQUEST['yoj'];
    $class=$_REQUEST['class'];
    
    $term=$_REQUEST['term'];
    $arget="../student/images/".basename( $_FILES["uploads"]["name"]);
    $filename = $_FILES["uploads"]["name"];

    
    if($filename==''){
      $res=mysqli_query($conn,"update student set s_name='$sname',dob='$dob', year='$yoj',parent_name='$p_name',pno='$pno',email='$email', dob='$dob', term_id=$term where regno='$regno'");
      if($res){
        date_default_timezone_set('Africa/Nairobi');
        $a=time();
        
        $b=date('d-m-Y');
        $c=date ("h:i:sa", $a);
                $sendlog=mysqli_query($conn, "insert into operation_logs values(0,'$_SESSION[email]','edit','$regno','student','$c','$b')");
                if(!isset($sendlog)){
                  echo "a problem sending logs!! contact admin";
                }
                 ?>
                 

      
        <!-- Success Alert -->
<div class="alert alert-success alert-dismissible fade show">
<strong>Success!</strong>Data updated successfully.
<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>

  <?php  
  echo '<script>setTimeout(function(){
    window.location.href="view-students.php";
  },1000);</script>';  
}
      else{
        ?>
                 

      
        <!-- danger Alert -->
<div class="alert alert-danger alert-dismissible fade show">
<strong>Error!</strong>please contact admin.
<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>

  <?php 
         
      }
    }
    else{
      $res=mysqli_query($conn,"update student set s_name='$sname',dob='$dob', year='$yoj',parent_name='$p_name',pno='$pno',email='$email', dob='$dob', photo='$filename',term_id=$term where regno='$regno'");
      if($res&& move_uploaded_file($_FILES['uploads']['tmp_name'],$arget)){ 
        date_default_timezone_set('Africa/Nairobi');
        $a=time();
        
        $b=date('d-m-Y');
        $c=date ("h:i:sa", $a);
                $sendlog=mysqli_query($conn, "insert into operation_logs values(0,'$_SESSION[email]','edit','$regno','student','$c','$b')");
                if(!isset($sendlog)){
                  echo "a problem sending logs!! contact admin";
                }
        ?>
         <!-- Success Alert -->
        <div class="alert alert-success alert-dismissible fade show">
        <strong>Success!</strong>Data updated successfully.
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
          <?php  
         echo '<script>setTimeout(function(){
          window.location.href="view-students.php";
        },1000);</script>';   
        }
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
    <label for="yoj" class="form-label">Year of Joining</label>
    <input type="text" class="form-control" id="yoj"value="<?php echo $result['year'] ?>" name="yoj" required>
  </div>

  <div class="row">
  <div class="col-md-6">
    <label for="" class="form-label">Academic year</label>
    <select class="form-select"  name="academic" id="academic" required>
      <?php
      $getacademic=mysqli_query($conn,"select *from academic_year where id ='$result[session_id]'");
      $aresult=mysqli_fetch_assoc($getacademic);
      ?>
  <option selected value="<?php echo $academicid ?>"><?php echo $aresult['sname'] ?></option>
  <?php

            $o_result = mysqli_query($conn, "select *from academic_year");
            if (mysqli_num_rows($o_result) > 0) {
                // output data of each row
                while ($rrr = mysqli_fetch_assoc($o_result)) {
                    $optionrr=$optionrr."<option value= $rrr[id] >$rrr[sname]</option>";
                    
            
                }
                 
            }
           echo $optionrr;
            ?>
</select>
  </div>
  <div class="col-md-6">
    <label for="term" class="form-label">Academic Year Term</label>
    <select class="form-select"  name="term" id="term-list" required>
    <?php
      $tid=$result['term_id'];
      $getterm=mysqli_query($conn,"select *from term where term_id =$tid");
      $tresult=mysqli_fetch_assoc($getterm);
      ?>
  <option selected value="<?php echo $tid ?>"><?php echo $tresult['term_name'] ?></option>
  
</select>
  </div>
  </div>


  <div class="row">
  <div class="col-md-12">
    <label for="course" class="form-label">Classname</label>
    
    <?php 
    $cid=$result['class'];
    $getclass=mysqli_query($conn,"select *from class where class_id =$cid");
    $classresult=mysqli_fetch_assoc($getclass);
    $classname=$classresult['class_name'];
    
    ?>
  <input type="text" class="form-control" id="class" value="<?php echo "$cid"; ?>" hidden name="class" required>
    <input type="text" class="form-control" id="class1" value="<?php echo "$classname"; ?>" name="class1" required>
  </div>

  </div>

 


  <div class="row">
  

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
    <label for="uploads" class="form-label">Update Photo</label> <br>
    <?php echo '<img style="height:100px;" src=../student/images/'.$result['photo'].'>'?>
    <input type="file" class="form-control" value="<?php echo '<img src=../student/images/'.$result['photo'].'>';
    ?>" id="uploads"  name="uploads" >
  </div></div>
  
  <div class="col-md-6">
    <center><input type="submit" class="btn btn-danger"  name="save" value="save" required></center>
  </div>
  <?php }} ?>
  </div>
</body>
<script src="jquery.js"></script>
<script >
      $('#academic').on('change', function() {
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
    $('#yr-list').on('change', function() {
        var year_id = this.value;

        $.ajax({
            type: "POST",
            url: "getyears.php",
            data: 'year_id=' + year_id,
            success: function(result) {
                $("#sem-list").html(result);
            }
        });
    });
    $('#academic').on('change', function() {
        var academic_id = this.value;

        $.ajax({
            type: "POST",
            url: "getacademicterm.php",
            data: 'academic_id=' + academic_id,
            success: function(results) {
                $("#term-list").html(results);
            }
        });
    });
</script>
</html>