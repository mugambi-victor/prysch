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
       
       
        .student1 {
            height: 100px;
            background-image: url("image/studentsicon.jpg");


        }
        .mm{
        padding-top:1rem;
    }
    .mrow{
       padding-left:10rem;   
       transition: 1s;
    }
    body{
        font-family: 'Nunito', sans-serif;
    }
    @media(max-width:997px){
        .mrow{
       padding-left:0rem;   
       transition: 1s;

    }
    .skulname{
       
       padding-left: 0;
       margin-left: 0;
    }
.the-skul{
    padding-left: 0;
   
   display: flex;
   justify-content: center;

   padding-bottom:2rem ;
}
    }
    .skulname{
       
        padding-top: 6rem;
        padding-bottom: 1rem;
        display: flex;
   justify-content: center;
        background-color: whitesmoke;
        color:#0036AB;
    }
    </style>
</head>

<body><?php include('header2.php');
 include('sidebar.php');?>
 <h6 class="the-skul skulname" >School Name Here</h6>
<div class="container-fluid">
        <div class="container mm col-md ">
            <div class="row mrow d-flex">
        <div class="col-md">
            <div class="row">
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
    </div>
                
                <div class="col-md">
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellat, aperiam expedita. Tenetur laboriosam odio, nisi recusandae inventore, voluptatem illo excepturi nemo amet labore, accusamus tempore autem rem officia odit et.</p>
                </div>
            </div>

    </div>
    <script src="sidebar.js"></script>
</body>

</html>