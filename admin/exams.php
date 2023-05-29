<?php include('connection.php');
session_start();
$a=$_SESSION["email"];
if (!isset($_SESSION["email"])) {

    header("location:admin_login.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <link rel="shortcut icon" href="ol.png" >

    <title>CreateExams</title>
    <style>
        .nav a:hover {
            background-color:slateblue;
        }
    </style>

</head>

<body>

<?php include('header.php');?>
<div class="container-fluid col-sm  d-flex">
<?php 

  include('sidebar.php');

   ?>

    <!-- form for creating exam !-->
    <div class="container col-md m-1 align-items-center">

    <?php
  if(isset($_POST['exam'])) {
        $ename=mysqli_real_escape_string($conn,$_REQUEST['ename']);
        $cname=mysqli_real_escape_string($conn,$_REQUEST['class-list']);
        $year=mysqli_real_escape_string($conn,$_REQUEST['session']);
        
        $res1 = mysqli_query($conn, "insert into exam values('0','$ename',$year,$cname )");
        if ($res1) {?>
            <!-- Success Alert -->
<div class="alert alert-success alert-dismissible fade show">
    <strong>Success!</strong> Data sent successfully.
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
      <?php  } else {?>
           <!-- Error Alert -->
           <div class="alert alert-danger alert-dismissible fade show">
               <strong>Error!</strong> A problem has occurred while submitting your data.
               <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
           </div>
<?php           
        }
    }


?>

    <!-- form for creating exam !-->
    <div class="container align-items-center">
        <div class="row align-items-center">
        <div class="col-sm-8 ">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); 
            ?>">
            <h2>Create Exam</h2>
            <label for="ename">Exam Name</label><br>
            <input type="text" name="ename" class="form-control" placeholder="exam name " required> <br> <br>
            <label for="year-list">Year</label><br>
            <select class="form-select" name="session" id="session-list">
            <option class="form-select" value="">Select academic year</option>
            <?php
            $session_result = mysqli_query($conn, 'select distinct id,sname from academic_year ORDER BY id DESC');
           
            if (mysqli_num_rows($session_result) > 0) {
                // output data of each row
                while ($row = mysqli_fetch_assoc($session_result)) {
            ?>
                    <option value="<?php echo $row['id']; ?>"><?php echo $row['sname']; ?></option>
            <?php
                }
            }
            ?>
        </select> <br> <br>

             <!-- dropdown for class -->
        <select name="class-list" class="form-select" id="class-list">
            <option value=''>Select class</option>
        </select>
            
            <button type="submit"  class="btn btn-outline-primary" name="exam" style="margin:5px;">submit</button>
            <button type="button" class="btn btn-outline-primary" > <a href="#" style="color: inherit; text-decoration:none;">View Classes</a> </button>
        </form>
        </div>

        </div>
        
       
    </div>


</body>
<script src="jquery.js"></script>
<script>
    $('#session-list').on('change', function() {
        var session_id = this.value;
        $.ajax({
            type: "POST",
            url: "getclasses.php",
            data: 'session_id=' + session_id,
            success: function(result) {
                $("#class-list").html(result);
            }
        });
    }); </script>

</html>