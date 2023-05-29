<?php
include('connection.php');
session_start();
if (!isset($_SESSION["account_login"])){
    header("location:admin_login.php");
}

$options = "";

    
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="vee.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
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
    <div class="col-12 row">
        <div class="container">
        <?php
        if (isset($_REQUEST['submit'])) {
            $sname = $_REQUEST['s_name'];
            $spass = $_REQUEST['s_pass'];
            $srno=$_REQUEST['rno'];
            $p_name=$_REQUEST['p_name'];
            $pno=$_REQUEST['pno'];
            $email=$_REQUEST['email'];
            $p_pass=$_REQUEST['p_pass'];
            $dob=$_REQUEST['dob'];
            $yoj=$_REQUEST['yoj'];
            $arget="student/images/".basename( $_FILES["uploads"]["name"]);
            $filename = $_FILES["uploads"]["name"];
       
            if (isset($_REQUEST['class']) && is_numeric($_REQUEST['class']))
            $class = $_REQUEST['class'];
            else
            $class = 0;
            $year=$_REQUEST['academic_year'];
            $check= "SELECT * FROM student WHERE regno='$srno'";
            $rs = mysqli_query($conn, $check);
            if (mysqli_num_rows($rs) > 0) { ?>
            <!-- Error Alert -->
<div class="alert alert-danger alert-dismissible fade show">
    <strong>Sorry!</strong>That Registration No. has already been taken.
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
<?php
                	}
                 else {
                $res = mysqli_query($conn, "insert into student values('0','$sname','$dob','$srno','$spass','$class', '$year','$p_name','$pno','$email','$p_pass','$filename','$yoj' )");
                if($res && move_uploaded_file($_FILES['uploads']['tmp_name'],$arget)){ ?>
                  <!-- Success Alert -->
                  <div class="alert alert-success alert-dismissible fade show">
                    <strong>Success!</strong> Data inserted to the database.
                    <button type="button" class="btn-success" data-bs-dismiss="alert"></button>
                  </div><?php
                  
                }
                else{?>
                <!-- Error Alert -->
<div class="alert alert-danger alert-dismissible fade show">
    <strong>Error!</strong> A problem has been occurred while submitting your data.
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
                    <?php
                }
            }
           
          
        } ?>
           

        </div>
    </div>
<div class="container">
    <div class="row">
    <form class="row g-3" enctype="multipart/form-data" method="post">
  <div class="col-md-6">
    <label for="s_name" class="form-label">Student Name</label>
    <input type="text" placeholder="name" name="s_name" class="form-control" id="s_name" required>
  </div>
  <div class="col-md-6">
    <label for="rno" class="form-label">Registration Number</label>
   <input type="text" placeholder="Registration Number" class="form-control" name="rno" required>
  </div>
  <div class="col-md-6">
    <label for="year" class="form-label">Academic Year</label>
    <select class="form-select" aria-label="Default select example" name="academic_year" id="year-list" required>
  <option selected>Open this select menu</option>
  <?php
  $session_result = mysqli_query($conn, "select distinct id,sname from academic_year");
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
  
  <div class="col-md-6">
    <label for="s_pass" class="form-label">Password</label>
    <input type="text" class="form-control" id="s_pass" placeholder="password" name="s_pass" required>
  </div>
  <div class="col-md-6">
    <label for="dob" class="form-label">DOB</label>
    <input type="text" class="form-control" id="dob" placeholder="date og birth" name="dob" required>
  </div>
  <div class="col-md-6">
    <label for="yoj" class="form-label">YEAR OF JOINING</label>
    <input type="text" class="form-control" id="yoj" placeholder="year of joining eg, 2020" name="yoj" required>
  </div>
  <div class="col-md-6">
    <label for="uploads" class="form-label">Upload Photo</label>
    <input type="file" class="form-control" id="uploads" name="uploads" required>
  </div>
  <h4>Parent/Guardian Details</h4>
  <div class="col-md-6">
    <label for="s_name" class="form-label">Parent/Guardian Name</label>
    <input type="text" placeholder="parents name" name="p_name" class="form-control" id="p_name" required>
  </div>
  <div class="col-md-6">
    <label for="pno" class="form-label">Phone Number</label>
   <input type="text" placeholder="Phone Number" class="form-control" name="pno" required>
  </div>
  <div class="col-md-6">
    <label for="email" class="form-label">Email</label>
    <input type="text" placeholder="Email" name="email" class="form-control" id="email" required>
  </div>
  <div class="col-md-6">
    <label for="p_pass" class="form-label">password</label>
   <input type="text" placeholder="Password" class="form-control" name="p_pass" required>
  </div>
  <div class="col-12">
    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
  </div>
</form>
    </div>
</div>
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
</body>

</html>