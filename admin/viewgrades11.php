<?php
include('connection.php');
session_start ();
if(!isset($_SESSION["account_login"]))

	header("location:admin_login.php"); 
$session_result = mysqli_query($conn, 'select distinct id,sname from academic_year ORDER BY id DESC');
$student_year = "";
$student_classname = "";
$sstudent_name = "";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="../vee.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
  <style>
    .active-pink-2 input[type=text]:focus:not([readonly]) {
  border-bottom: 1px solid #f48fb1;
  box-shadow: 0 1px 0 0 #f48fb1;
}
.active-pink input[type=text] {
  border-bottom: 1px solid #f48fb1;
  box-shadow: 0 1px 0 0 #f48fb1;
}
.active-purple-2 input[type=text]:focus:not([readonly]) {
  border-bottom: 1px solid #ce93d8;
  box-shadow: 0 1px 0 0 #ce93d8;
}
.active-purple input[type=text] {
  border-bottom: 1px solid #ce93d8;
  box-shadow: 0 1px 0 0 #ce93d8;
}
.active-cyan-2 input[type=text]:focus:not([readonly]) {
  border-bottom: 1px solid #4dd0e1;
  box-shadow: 0 1px 0 0 #4dd0e1;
}
.active-cyan input[type=text] {
  border-bottom: 1px solid #4dd0e1;
  box-shadow: 0 1px 0 0 #4dd0e1;
}
.active-cyan .fa, .active-cyan-2 .fa {
  color: #4dd0e1;
}
.active-purple .fa, .active-purple-2 .fa {
  color: #ce93d8;
}
.active-pink .fa, .active-pink-2 .fa {
  color: #f48fb1;
}
  </style>
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-light bg-info">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">
                <img src="images/new.png" height="80"/>
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
      <div class="row">
      <div class="row g-3">
  <div class="col">
  <form action="" method="post">
  <select  class="form-select" name="session" id="session-list">
            <option value="">Select academic year</option>
            <?php
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
  <div class="col">
  <select class="form-select" name="classs" id="class-list">
            <option value=''>Select class</option>
        </select>
  </div>
  <div class="col">
      
  <select class="form-select" name="exam" id="exam-list">
            <option value=''>Select Exam</option>
        </select>
  </div>
  
  <center><input type="submit" class="btn btn-primary" name="submit" value="Enter"></center>
  </form>
</div>
      </div>
 
        <div class="col table-responsive-lg" style="margin-top:50px;">
               <table  class=" col-sm-12">
                   <tr>
                       <th>Student Name</th><th>Registration Number</th><th>Class</th> <th>Exam Name</th>
                   </tr>
                   
      <?php 
      if(isset($_REQUEST['submit'])){
        $year=$_REQUEST['session'];
        $class=$_REQUEST['classs'];
        $exam=$_REQUEST['exam'];
        $select=mysqli_query($conn, "select distinct regno,student_name from marks where exam=$exam");
        $exx=mysqli_query($conn, "select *from exam where exam_id=$exam");
        while($retr=mysqli_fetch_assoc($exx)){
            $examname=$retr['exam_name'];
        }
        $exx=mysqli_query($conn, "select *from class where class_id=$class");
        while($crtr=mysqli_fetch_assoc($exx)){
            $classname=$crtr['class_name'];
            $cid=$crtr['class_id'];
        }

        while($row=mysqli_fetch_assoc($select)){
            $rno=$row['regno'];
            echo $exam;
           echo "<tr><td><form method='post' action='results.php'><label>" . $row['student_name'] . "</label></td><td><input  style='border:0;' name='rno' type='text' readonly value=" . $row['regno'] . "></td><td><input  style='border:0;' name='classs' type='text' readonly hidden value=" .$cid. ">" . $classname . "</td><td><input  style='border:0;' hidden name='exam' value=".$exam." type='text' readonly >".$examname ."</td><td><input type='submit' class='btn btn-info'  value='View Results' name='profile'></form></a></td></tr>"; 
           }?>
                   

               </table>
           </div>
        </div></div>
      <?php }
    ?>
       </div>
  
  </div>
</body>
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
    $('#class-list').on('change', function() {
        var class_id = this.value;
        $.ajax({
            type: "POST",
            url: "get_classes.php",
            data: 'class_id=' + class_id,
            success: function(result) {
                $("#exam-list").html(result);
            }
        });
    });

   


    function openForm() {
        document.getElementById("popupForm").style.display = "block";
    }

    function closeForm() {
        document.getElementById("popupForm").style.display = "none";
    }
</script>

</html>