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
    
     <link rel="shortcut icon" href="ol.png" >
    
    <title>ViewStudents</title>
    <style>
        a:hover{
            background-color: #8432DF;
        }
    </style>
</head>
<body>
<?php include('header.php');?>
<div class="container-fluid col-sm  d-flex">
<?php 

  include('sidebar.php');

   ?>

    <div class="container m-5" style="margin-top:">
    <form action="" method="post">
        <select  class="form-select" name="session" id="session-list">
            <option value="">Select academic year</option>
            <?php
            $session_result=mysqli_query($conn, "select*from academic_year ORDER BY id DESC");
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
        <div class="col">
            <select class="form-select" name="classs" id="class-list">
                <option value=''>Select class</option>
            </select>
         </div>
        <div class="col">
            <input type="submit" value="submit" name="submit" class="btn btn-primary">
        </div>
            </form>
      <div class="col table-responsive-lg">
               <table  class=" col-sm-12">
                   <tr>
                       <th>Student Name</th><th>Registration Number</th><th>Parent's email</th> <th>Parent's No.</th>
                   </tr>
    <?php 
    if(isset($_REQUEST["submit"])){
        $year=mysqli_real_escape_string($conn,$_REQUEST["session"]);
        $class=mysqli_real_escape_string($conn,$_REQUEST["classs"]);
 
      
        $sql=mysqli_query($conn,"select * from student where class=$class");
        
        while($row=mysqli_fetch_assoc($sql)){
      
           echo "<tr><td><form method='post' action='viewstudentprofile.php'><label>" . $row['s_name'] . "</label></td><td><input style='border:0;' name='rno' type='text' readonly value=" . $row['regno'] . "></td><td>" . $row['email'] . "</td><td>" . $row['pno'] . "</td><td><input type='submit' class='btn btn-info' value='view profile' name='profile'></form></a></td></tr>"; }?>
                   
               </table>
           </div>
        </div></div>
      <?php }
    ?>
 
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
    });
   
    </script>

</body>
</html>