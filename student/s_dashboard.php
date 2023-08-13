<?php
include("../connection.php");
session_start();
$s = $_SESSION["s_login"];

if (!isset($_SESSION["s_login"])) {
    header("location:s_login.php");
}
$getstudent=mysqli_query($conn,"select *from student where regno='$s'");
if(mysqli_num_rows($getstudent)>0){
    $res=mysqli_fetch_assoc($getstudent);
    date_default_timezone_set('Africa/Nairobi');
    $a=time();
    $b=date('d-m-Y');
    $c=date ("h:i:sa", $a);
    
    $insertlog=mysqli_query($conn,"insert into loginout_logs values(0,'$res[regno]','login','$c','$b')");
    if(!isset($insertlog)){
        echo "problem sending logs";
    }
}

 $grade="";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <script>
    window.history.forward();
    </script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../admin/ol.png">
    <title>StudentDashboard</title>
    <style>
    .modtitle {
        margin-top: -0.56%;
    }

    body {
        background-color: whitesmoke;
    }
    .mm{
        margin-top:12rem
    }
     
     @media(min-width:997px){
         .mrow{
        padding-left:10rem
    }}
    
    </style>
</head>

<body>


    <?php include('header1.php');?>
    <div class="container-fluid col-sm  d-flex">
        <?php 

  include('sidebar.php');

   ?>

    <div class="container mm col-sm " >

            <div class="row mrow">
            <div class="col-sm-6">


<div class="row d-flex text-white text-center p-0 bg-primary">
    <p class="display-6 text-center modtitle  p-2 " >Fee Summary Info</p>
    <div class="col-sm p-2 ">
        <?php
       
         $sql = mysqli_query($conn, "select *from student where regno='$s'  ");
         $result = mysqli_fetch_assoc($sql);
    $term=$result['term_id'];
    $getterm = mysqli_query($conn, "select *from term where term_id =$term ");
    if(mysqli_num_rows($getterm)>0){}
    $restt = mysqli_fetch_assoc($getterm);
$year=$restt['year'];
 $getyr = mysqli_query($conn, "select *from academic_year where id =$year ");
 $restt = mysqli_fetch_assoc($getyr);
 $yrname = $restt['sname'];

 $gettermname=mysqli_query($conn,"select *from term where term_id=$term");
 $t=mysqli_fetch_assoc($gettermname);
    $termname = $t['term_name'];

?>
        <p class="lead text-capitalize">Current Term: <?php echo $yrname . "<br/> " . $termname?></p>
        <p class="text mt-5 fw-bold display-3"></p>
        <p class=" fs-5 ">Semester Fee: Kshs <?php 
       
        echo number_format($result['total']); ?></p>


    </div>
    <div class=" col-sm a">
        <img src="../image/R1.png" class="card-img" alt="...">
    </div>




</div>
</div>
                <div class="col-sm-6 mt-2">
                    <center> <span>
                            <h2>SUBJECTS</h2>
                        </span></center>
                    <?php
                $sql = mysqli_query($conn, "select *from student where regno='$s'  ");
                $result = mysqli_fetch_assoc($sql);
                    $a = $result['id'];
                    $b=$result['class'];
                    $sql2 = mysqli_query($conn, "select distinct id,subject_name from subject where class=$b");

                    if ($sql2) {
                       
                        $i = 0;
                        foreach ($sql2 as $row) { ?>


                    <ul class="list-group  text-center">
                        <li class="list-group-item"> <?php echo $row['subject_name'] . "<br>"; ?></li>
                    </ul>
                    <br>


                    <?php }
                        $i++;
                    }?>
                </div>
                
<div class="row">
    <div class="col-sm">


        <p class="text-center display-6 mt-2 lead"> Exam Results</Ri:a>
        </p>
        <form action="transcript.php" method="POST">
            <!-- dropdown for session/academic year -->
            <label for="class" class="form-label">Class</label>
            <select name="class" id="c-list" class="form-select">
            <option value="">select class</option>
            <?php
            $query=mysqli_query($conn,"select distinct student_class from results where regno='$s'");
            while($r=mysqli_fetch_assoc($query)){
                $getclassname=mysqli_query($conn,"select *from class where class_id='$r[student_class]'");
               

                
                $rs=mysqli_fetch_assoc($getclassname);
                ?>
               

                <option value="<?php echo $r['student_class']; ?>"><?php echo $rs['class_name']; ?></option>
                <?php
                }
            ?>
            </select>



            <label for="t-list" class="form-label">Exam</label>
            <select name="term" id="t-list" class="form-select">
                <option value="">select term</option>
            </select>

            <label for="exam" class="form-label">Exam</label>
            <select name="exam" id="exam-list" class="form-select">
                <option value="">select exam</option>
            </select>
            <center> <input type="submit" class="btn mt-2 btn-primary" name="submit" value="submit">
            </center>
        </form>
    </div>
                </div>


                <script src="https://code.jquery.com/jquery-3.6.4.js"
                    integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>

                <script>
                function PrintPage() {
                    window.print();
                }
                $('#t-list').on('change', function () {
        var term_id = this.value;
        $.ajax({
            type: "POST",
            url: "get_exams.php",
            data: 'term_id=' + term_id,
            success: function (result) {
                $("#exam-list").html(result);
            }
        });
    });
    $('#c-list').on('change', function () {
        var c_id = this.value;
        $.ajax({
            type: "POST",
            url: "get_ts.php",
            data: 'c_id=' + c_id,
            success: function (result) {
                $("#t-list").html(result);
            }
        });
    });

                $('.bb').on('click', function() {
                    function hasClass(element, clsName) {
        return(' ' + element.className + ' ').indexOf(' ' + clsName + ' ') > -1;
      }
      let val1 = document.getElementById('collapseExample');
      
                    if(hasClass(val1, 'active')){
                        $('#collapseExample').removeClass('active');
                    }else{
                        $('#collapseExample').addClass('active');
                    }

                });
                // $('.closebtn').on('click', function() {
                //     $('#collapseExample').removeClass('active');

                // });
                </script>
</body>

</html>