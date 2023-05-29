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
    <title>Class_Students</title>
    <style>
     
         input{
             border:0;
             background-color:inherit;
         }
         .nav a:hover{
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

   
    <div class="container col-md">
    <?php
if (isset($_POST["submit"])) {
            $student_classname = mysqli_real_escape_string($conn,$_POST['classs']);
            $exam=mysqli_real_escape_string($conn,$_POST['exam']);
            $term=mysqli_real_escape_string($conn,$_POST['term']);


            $sql = mysqli_query($conn, "select * from student where class='$student_classname' and term_id=$term");
            if(mysqli_num_rows($sql)>0){
            while($res=mysqli_fetch_assoc($sql)){?>
            <div class="row">
            <div class="col">
            <form action="addmarks.php" method="post">
            <input type="text" hidden value="<?php echo $res['id']; ?>" name="student">
            <input type="text" hidden value="<?php echo $res['class']; ?>" name="class">
            <input type="text" hidden value="<?php echo $term; ?>" name="term">
            <input type="text" hidden value="<?php echo $exam; ?>" name="exam">
            <table class="table table-responsive-sm table-info">
                <tr>
          
                    <td><input type="text"  class="form-control " style="borders:0;" name="s_name" readonly value="<?php echo $res['s_name']; ?>"></td> <td><input type="text"  class="form-control"name="rno" readonly value="<?php echo $res['regno']; ?>"></td><td><input style="margin-top:0;"  type="submit" class="btn btn-primary" name="submit" value="add marks"></td>
                </tr>
            </table>
            </form>
            </div>
            </div>
           
          
           
            
           
           <?php }
           }else
           {
            echo"soryy! no students here";
           }}
          ?>
            </div>
</body>
</html>