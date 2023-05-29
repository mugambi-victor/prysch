<?php
include('../connection.php');
session_start();
$a=$_SESSION["email"];
if (!isset($_SESSION["email"])) {

    header("location:admin_login.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- <script>
        window.history.forward();
    </script> -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="ol.png" >
    <title>AdminDashboard</title>


    <style>
        .nav a:hover {
            background-color:slateblue;

        }

        .nav a:active {
            background-color: slateblue;
        }

        .student1 {
            height: 100px;
            background-image: url("image/studentsicon.jpg");


        }

        /* style="background:#051094;;" */
    </style>
</head>

<body><?php include('header2.php');?>
<div class="container-fluid col-sm  d-flex">
<?php 

  include('sidebar.php');

   ?>

        <div class="container ms-1  col-md">
       
            <p class="display-6"><i class="bi-house-fill"></i>Dashboard</p>
            <div class="row mt-4">
                <div class="col-md students">
                    <?php
                    $query = mysqli_query($conn, "select *from student");
                    $result = mysqli_num_rows($query);

                    ?>
                    <div class="m-1 row d-flex text-center p-0 bg-secondary">
                        <div class="col p">
                            <p class="text fw-bold display-3"><?php echo $result; ?> </p>
                            <p>Students</p>

                        </div>
                        <div class=" col a">
                            <img src="../image/student-icon1.jpg" class="card-img" alt="...">
                        </div>




                    </div>
                </div>

                <div class="col-md studen1">

                    <?php
                    $query1 = mysqli_query($conn, "select *from exam");
                    $result1 = mysqli_num_rows($query1);

                    ?>
                    <div class=" m-1 row d-flex text-center p-0 bg-primary">
                        <div class="col p">
                            <p class="text fw-bold display-3"><?php echo $result1; ?> </p>
                            <p>Exams</p>

                        </div>
                        <div class=" col a">
                            <img src="../image/department.png" class="card-img" alt="...">
                        </div>




                    </div>
                </div>
                

    </div>

</body>

</html>