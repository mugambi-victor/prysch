<?php
include("../connection.php");
session_start();
$s = $_SESSION["s_login"];

if (!isset($_SESSION["s_login"])) {
    header("location:s_login.php");
}
$getstudent = mysqli_query($conn, "select *from student where regno='$s'");
if (mysqli_num_rows($getstudent) > 0) {
    $res = mysqli_fetch_assoc($getstudent);
    date_default_timezone_set('Africa/Nairobi');
    $a = time();
    $b = date('d-m-Y');
    $c = date("h:i:sa", $a);

    $insertlog = mysqli_query($conn, "insert into loginout_logs values(0,'$res[regno]','login','$c','$b')");
    if (!isset($insertlog)) {
        echo "problem sending logs";
    }
}

$grade = "";

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
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
     <!-- Include Chart.js from CDN -->
     <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

      <!-- Include Slick Slider from CDN -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel/slick/slick-theme.css"/>
    <style>
        .modtitle {
            margin-top: -0.56%;
        }

        body {
            background-color: whitesmoke;
        }

        .mm {
            margin-top: 8rem
        }
        .card-containerr{
            background-color:#0036AB;
        }
        @media(min-width:997px) {
            .mrow {
                padding-left: 10rem
            }
        }
        @media(max-width:997px) {
            .mm {
            margin-top: 5rem
        }
    .card-containerr {
        border-radius: .3rem;
        height:200px;
        background-color:#0036AB;
    }
    .card-img{
        visibility: hidden;
    }
    .pp{
        margin-top:-3rem;
    }
    .term-select{
    margin-top: .5rem;
}
}
.slick-arrow{
    background-color:gray;
    padding-top:.1rem;
    
}
.slick-arrow:hover{
    background-color:green;
}
    </style>
</head>

<body>
    <?php
    include('header1.php'); 
include('sidebar.php');

?>

    <div class="container-fluid col-sm  d-flex">
       
        <div class="container mm col-sm ">

            <div class="row mrow">
                <div class="col-sm-6">


                    <div class="row d-flex card-containerr text-white text-center p-0 ">
                        <p class="display-6 text-center modtitle text-uppercase p-2 mon" >Fee Summary Info</p>
                        <div class="col-sm ">
                            <?php

                            $sql = mysqli_query($conn, "select *from student where regno='$s'  ");
                            $result = mysqli_fetch_assoc($sql);
                            $term = $result['term_id'];
                            $getterm = mysqli_query($conn, "select *from term where term_id =$term ");
                            if (mysqli_num_rows($getterm) > 0) {
                            }
                            $restt = mysqli_fetch_assoc($getterm);
                            $year = $restt['year'];
                            $getyr = mysqli_query($conn, "select *from academic_year where id =$year ");
                            $restt = mysqli_fetch_assoc($getyr);
                            $yrname = $restt['sname'];

                            $gettermname = mysqli_query($conn, "select *from term where term_id=$term");
                            $t = mysqli_fetch_assoc($gettermname);
                            $termname = $t['term_name'];

                            ?>
                            <p class="lead text-capitalize"><span class="mon">Current Term: </span>
                                <?php echo $yrname . "<br/> " . $termname ?>
                            </p>
                           
                            <p class=" fs-5 "><span class="mon">Term Fee</span>:<br> Kshs
                                <?php

                                echo number_format($result['total']); ?>
                            </p>


                        </div>
                        <div class=" col-sm a">
                            <img src="../image/R1.png" class="card-img" alt="...">
                        </div>




                    </div>
                </div>
                <div class="col-sm-6 box mt-2">
                    <center> <span>
                            <h2 class="mon all-headers">RESULT SUMMARY</h2>
                        </span></center>
                   
                    <div class="col-md col-sm " style="width: 100%;  padding-left: 1.2rem; padding-right: 1.2rem; ">
        <div id="slider"  class="col-md col-sm">
            <!-- Your Chart container will be added dynamically here -->
            <?php
                        $getstudentdata = mysqli_query($conn, "SELECT * FROM student WHERE regno='$s'");
                        $s_result = mysqli_fetch_assoc($getstudentdata);
                        
                        $getclasses_in_results = mysqli_query($conn, "SELECT DISTINCT student_class FROM results WHERE regno='$s'");
                        $classes = [];
        
                        while ($class_res = mysqli_fetch_assoc($getclasses_in_results)) {
                            $classes[] = $class_res['student_class'];
                        }
                      foreach ($classes as $class) {
                        $query = "SELECT term_id,sum FROM results where regno='$s' && student_class='$class'";
                         $results = mysqli_query($conn, $query);


                         if (mysqli_num_rows($results) > 0) {
                             // Process the result and create arrays for labels and values
                              $labels = [];
                              $values = [];
                              while ($row = mysqli_fetch_assoc($results)) {
                                 $gettermname = mysqli_query($conn, "select term_name from term where term_id='$row[term_id]'");
                                 $res = mysqli_fetch_assoc($gettermname);
                                 $labels[] = $res['term_name'];
                                 $values[] = $row['sum'];
        }
        // Output the chart container for each class
        echo '<div>';
        echo '<canvas class="class-chart" data-class="' . $class . '"></canvas>';
        echo '</div>';
    } else {
        echo "<h2>No exams yet for Class $class</h2>";
    }

}
?>
        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm box">


                        <p class="text-center  display-6 mt-3 lead mon all-headers"> Exam Results</a>
                        </p>
                        <form action="transcript.php" method="POST">
                            <!-- dropdown for session/academic year -->
                         <div class="row">
                            <div class="col-sm">
                            <select name="class" id="c-list" class="form-select bg-light">
                                <option value="">select class</option>
                                <?php
                                $query = mysqli_query($conn, "select distinct student_class from results where regno='$s'");
                                while ($r = mysqli_fetch_assoc($query)) {
                                    $getclassname = mysqli_query($conn, "select *from class where class_id='$r[student_class]'");



                                    $rs = mysqli_fetch_assoc($getclassname);
                                    ?>


                                    <option value="<?php echo $r['student_class']; ?>"><?php echo $rs['class_name']; ?>
                                    </option>
                                    <?php
                                }
                                ?>
                            </select>
                           
                            </div>
                            <div class="col-sm">
                            <select name="term" id="t-list" class="form-select term-select bg-light">
                                <option value="">select term</option>
                            </select>
                            </div>
                         </div>
                         <div class="row">
                            <div class="col-sm">
                            <select name="exam" id="exam-list" class="form-select mt-2 bg-light">
                                <option value="">select exam</option>
                            </select>
                            <center> <button type="submit" name="submit"
                                        class="bt mt-1">Submit <i class="fa fa-paper-plane-o" ></i> </button></center>
                            
                            </div>
                         </div>
                           
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

                    $('.bb').on('click', function () {
                        function hasClass(element, clsName) {
                            return (' ' + element.className + ' ').indexOf(' ' + clsName + ' ') > -1;
                        }
                        let val1 = document.getElementById('collapseExample');

                        if (hasClass(val1, 'active')) {
                            $('#collapseExample').removeClass('active');
                        } else {
                            $('#collapseExample').addClass('active');
                        }

                    });
                // $('.closebtn').on('click', function() {
                //     $('#collapseExample').removeClass('active');

                // });
                </script>
</body>
 <!-- Include Slick Slider from CDN -->
 <script src="https://cdn.jsdelivr.net/npm/slick-carousel/slick/slick.min.js"></script>

 <script>
    // Create the charts and initialize the Slick Slider
    $(document).ready(function(){
        <?php
        // Initialize a chart for each class
        foreach ($classes as $class) {
            $getclasssname= mysqli_query($conn,"select *from class where class_id=$class");
            if(mysqli_num_rows($getclasssname) > 0) {
                $res=mysqli_fetch_assoc($getclasssname);
                $classq= $res['class_name'];
                echo "console.log('Class Name: $classq');";
            }
            // Fetch data specific to each class
            $query = "SELECT term_id, sum FROM results WHERE regno='$s' AND student_class='$class'";
            $results = mysqli_query($conn, $query);

            $labels = [];
            $values = [];

            if (mysqli_num_rows($results) > 0) {
                while ($row = mysqli_fetch_assoc($results)) {
                    $gettermname = mysqli_query($conn, "SELECT term_name FROM term WHERE term_id='$row[term_id]'");
                    $res = mysqli_fetch_assoc($gettermname);
                    $labels[] = $res['term_name'];
                    $values[] = $row['sum'];
                }
            } else {
                // No exams yet for this class
                echo "console.log('No exams yet for Class $class');";
            }

            // Output JavaScript arrays for each class
            echo "var labels$class = " . json_encode($labels) . ";\n";
            echo "var values$class = " . json_encode($values) . ";\n";
           ?>
           
            <?php
            // Initialize a chart for each class
            echo "var ctx$class = document.querySelector('.class-chart[data-class=\"$class\"]').getContext('2d');\n";
            echo "var myChart$class = new Chart(ctx$class, {\n";
            echo "    type: 'line',\n";
            echo "    data: {\n";
            echo "        labels: labels$class,\n";
            echo "        datasets: [\n";
            echo "            {\n";
            echo "                label: '$classq',\n";
            echo "                data: values$class,\n";
            echo "                borderColor: 'rgba(75, 192, 192, 1)',\n";
            echo "                borderWidth: 2,\n";
            echo "                fill: true\n";
         
            echo "            }\n";
            echo "        ]\n";
            echo "    },\n";
            echo "    options: {\n";
            echo "        scales: {\n";
            echo "            y: {\n";
            echo "                beginAtZero: true\n";
            echo "            }\n";
            echo "        }\n";
            
            echo "    }\n";
            echo "});\n";
        }
       

        ?>

        // Initialize the Slick Slider
        $('#slider').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: true,
            infinite:true,
            variableWidth: true
        });
    });
</script>



</html>

