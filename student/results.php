<?php
include("../connection.php");
session_start();
$s = $_SESSION["s_login"];
if (!isset($_SESSION["s_login"])) {
    header("location:s_login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
      
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../admin/ol.png" >
    <title>RESULTS</title>
<style>
    .mm{
        margin-top:7rem;
        padding:1rem;
    }
    a{
        text-decoration: none;
    }
    @media(min-width:997px){
         .mrow{
        padding-left:10rem
    }
   
    }
    @media (max-width:997px) {
        .mm{
        margin-top:5rem;
       
    }
    }
</style>
</head>

<body>

<?php include('header.php');
 include('sidebar.php');?>
<div class="container-fluid col-sm  d-flex">
    <div class="container mm col-sm">
        <div class="row mrow">
            <div class="col-sm">
                <h2 class="fw-bold mon all-headers" >SELECT EXAM</h2>
            <form action="transcript.php" method="POST">
            <!-- dropdown for class -->
            <div class="row">
                <div class="col-sm">
            <!-- <label for="class" class="form-label">Class</label> -->
            <select name="class" id="c-list" class=" form-select mt-3 bg-light">
            <option value="" class="dropdown-item" >select class</option>
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

            </div>
            <div class="col-sm">
           

            <!-- <label for="t-list" class="form-label">Term</label> -->
            <select name="term" id="t-list" class=" form-select mt-3 bg-light">
                <option value="" >select term</option>
            </select>
            </div>
            </div>
            <div class="row mt-4">
                <div class="col-sm">
            <!-- <label for="exam" class="form-label">Exam</label> -->
            <select name="exam" id="exam-list" class=" form-select  bg-light">
                <option value="" >select exam</option>
            </select>
            <center> <button type="submit" class="bt mt-2 btn-primary" name="submit">Submit <i class="fa fa-paper-plane-o" style=""></i></button> <button type="button" name="back" class="bt-danger p-2 mt-2 "><a href="s_dashboard.php"
                    class="text-white"><i class="bi-arrow-left-circle-fill" ></i> GoBack</a></button>
   
            </center>
        </form>
        </div>
            </div>
</div>

       
    



        <?php
        if (isset($_REQUEST["submit"])) {


            $session = $_REQUEST["session"];
            // $exam=$_REQUEST["exam"];
            $semester = $_REQUEST["semester"];
            $student_name = $_REQUEST["sname"];
            $checckexam = mysqli_query($conn, "select distinct exam from marks where regno='$s' and semester=$semester and yrid=$session");
            if (mysqli_num_rows($checckexam) == 0) {
                echo ("sorry!! your grades for this semester do not exist. contact admin") . mysqli_connect_error();

            } else {
                $finde = mysqli_query($conn, "select distinct exam from marks where regno='$s' and semester=$semester and yrid=$session");
                $re = mysqli_fetch_assoc($finde);
                $exam = $re['exam'];
                echo $exam;


                ?>
                <table class="table table-primary caption-top">
                    <caption>List of Subjects and Scores</caption>
                    <tr>
                        <th>Subject</th>
                        <th>Score</th>
                        <th>Grade</th>
                    </tr>
                    <?php
                    $query = mysqli_query($conn, "select * from marks where exam=$exam and regno='$s'");
                    while ($result = mysqli_fetch_assoc($query)) {



                        $grade = "";
                        if ($query !== null) {
                            if ($result['marks'] > 80 && $result['marks'] <= 100) {
                                $grade = "A";
                            } elseif ($result['marks'] > 65 && $result['marks'] <= 80) {
                                $grade = "B";
                            } elseif ($result['marks'] > 55 && $result['marks'] <= 65) {
                                $grade = "C";
                            } elseif ($result['marks'] > 40 && $result['marks'] <= 55) {
                                $grade = "D";
                            } elseif ($result['marks'] > 0 && $result['marks'] <= 40) {
                                $grade = "E";
                            }
                            ?>
                            <center>
                                <div class="results">

                                    <tr>
                                        <td style="width:50%;">
                                            <?php
                                            $rr = $result['unit_id'];

                                            $qy = mysqli_query($conn, "select *from unit where id=$rr");
                                            while ($row = mysqli_fetch_assoc($qy)) {
                                                echo $row['unit_name'];
                                            } ?>
                                        </td>
                                        <td style=" width:50%; ">
                                            <?php echo $result['marks']; ?>
                                        </td>
                                        <td style=" width:50%; ">
                                            <?php echo $grade; ?>
                                        </td>
                                    </tr>


                                </div>

                            </center>



                        <?php }


                    }
                    $query = mysqli_query($conn, "select * from marks where exam='$exam' and regno='$s'");
                    $sum = 0;
                    $mean = 0;
                    $grade = "";
                    $i = 1;
                    while ($r = mysqli_fetch_assoc($query)) {
                        $n = mysqli_num_rows($query);
                        $m = $r['comment'];
                        $sum = $sum + $r['marks'];

                    }
                    $i++;
                    if ($i > 1) {

                        $mean = $sum / $n;
                    }
                    if ($query !== null) {
                        if ($mean > 80 && $mean <= 100) {
                            $grade = "A";
                        } elseif ($mean > 65 && $mean <= 80) {
                            $grade = "B";
                        } elseif ($mean > 55 && $mean <= 65) {
                            $grade = "C";
                        } elseif ($mean > 40 && $mean <= 55) {
                            $grade = "D";
                        } elseif ($mean > 0 && $mean <= 40) {
                            $grade = "E";
                        }

                        echo "\nAverage Score: <b>" . $mean . "</b><br>GRADE:<b> " . $grade . "</b> <br><br>";


                    }
            }
        }
       
        ?>
                </table>


    
    </div>
    </div>
    
        </div>
            <!-- <div class="form-group purple-border" style="display:hidden">
            <label for="exampleFormControlTextarea4">Teacher's Comment</label>
            <textarea class="form-control " readonly id="exampleFormControlTextarea4" rows="2"></textarea>
        </div>
</div> -->


</body>

<script src="../jquery.js"></script>

<script>
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
    

</script>

</html>