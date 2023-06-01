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
    <link rel="shortcut icon" href="ol.png">
    <title>Class_Students</title>
    <style>
    input {
        border: 0;
        background-color: inherit;
    }

    .nav a:hover {
        background-color: slateblue;
    }
    .mm{
        margin-top:11rem;
    }
    .mrow{
        padding-left:10rem;
    }
    </style>
</head>

<body>

    <?php include('header.php');?>
    <div class="container-fluid col-sm  d-flex">
        <?php 

  include('sidebar.php');

   ?>


        <div class="container mm col-md">
            <?php
if (isset($_POST["submit"])) {
            $student_classname = mysqli_real_escape_string($conn,$_POST['classs']);
            $exam=mysqli_real_escape_string($conn,$_POST['exam']);
            $term=mysqli_real_escape_string($conn,$_POST['term']);


            $sql = mysqli_query($conn, "select * from student where class='$student_classname' and term_id=$term");
            if(mysqli_num_rows($sql)>0){
            while($res=mysqli_fetch_assoc($sql)){
                
                
                ?>
            <div class="row mrow">
                <div class="col">
                    <form action="addmarks.php" method="post">
                        <input type="text" hidden value="<?php echo $res['id']; ?>" name="student">
                        <input type="text" hidden value="<?php echo $res['class']; ?>" name="class">
                        <input type="text" hidden value="<?php echo $term; ?>" name="term">
                        <input type="text" hidden value="<?php echo $exam; ?>" name="exam">
                        <table class="table table-responsive-sm table-bordered table-striped">
                            <tr>
                                <th>
                                    Name
                                </th>
                                <th>
                                    Regno
                                </th>
                                <th>
                                    Action
                                </th>
                            </tr>
                            <tr>

                                <td><input type="text" class="form-control text-capitalize" style="borders:0;" name="s_name" readonly
                                        value="<?php echo $res['s_name']; ?>"></td>
                                <td><input type="text" class="form-control" name="rno" readonly
                                        value="<?php echo $res['regno']; ?>"></td>
                                <td>
                                    <?php
                                    $check_graded=mysqli_query($conn, "select * from results where regno='$res[regno]' and student_class='$student_classname' and term_id=$term and exam_id=$exam");
                                    if(mysqli_num_rows($check_graded)>0){
                                        ?>
                                        </form>
                                        <form method='post' action='editstudentmarks.php'>
                                            <input type="text" name="rno" value="<?php echo $res['regno']; ?>" hidden>
                                            <input type="text" name="exam" value="<?php echo $exam; ?>" hidden>
                                            <input style="margin-top:0;" type="submit" class="btn btn-warning" name="edit" value="Edit Marks">  
                                        </form>
                                           
                                    </td>
                                        <?php
                                    }else{
                                    ?>
                                    <input style="margin-top:0;" type="submit" class="btn btn-primary" name="submit" value="Add marks">
                                    <?php } ?>
                                    </td>
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