<?php
include('../connection.php');
session_start();
$t = $_SESSION["emp_login"];
if (!isset($_SESSION["emp_login"]))

    header("location:t_login.php");
$session_result = mysqli_query($conn, 'select * from academic_year');
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
        table {
            border: solid 1px;
        }

        table td,
        th {
            border: solid 1px;
        }


        .subPopup {
            text-align: center;
            width: 100%;
            position: relative;
        }

        .formPopup {
            display: none;
            position: absolute;
            left: 45%;
            top: 5%;
            transform: translate(-50%, 5%);
            border: 3px solid #999999;
            z-index: 9;
        }

        .formContainer {
            max-width: 700px;
            padding: 20px;
            background-color: #fff;
        }

        .formContainer .btn {
            padding: 12px 20px;
            border: none;
            background-color: #8ebf42;
            color: #fff;
            cursor: pointer;
            width: 100%;
            margin-bottom: 15px;
            opacity: 0.8;
        }

        .formContainer .cancel {
            background-color: #cc0000;
        }

        .formContainer .btn:hover,
        .openButton:hover {
            opacity: 1;
        }

        .openBtn {
            display: flex;
            justify-content: left;
        }

        .openButton {
            border: none;
            border-radius: 5px;
            background-color: #1c87c9;
            color: white;
            padding: 5px 10px;
            cursor: pointer;

        }

        .formContainer input[type=text],
        .formContainer input[type=number] {
            width: 80%;
            padding: 15px;
            margin: 5px 0 20px 0;
            border: none;
            background: #eee;
        }

        .formContainer input[type=text]:focus,
        .formContainer input[type=number]:focus {
            background-color: #ddd;
            outline: none;
        }


        input[type=text],
        input[type=number] {
            width: 80%;
            padding: 15px;
            margin: 5px 0 20px 0;
            border: none;
            background: #eee;
        }

        input[type=text]:focus,
        input[type=number]:focus {
            background-color: #ddd;
            outline: none;
        }



        .tablee table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 80%;
        }

        td,
        th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;

        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }

        .result-form {
            margin-left: 150px;
            margin-top: 50px;
            width: 80%;
            background-color: whitesmoke;
        }

        .result-form input {
            width: 80%;
            background-color: gray;
        }

        .top-left {
            padding: 30px;
        }

        .maincontent {
            padding: 20px;

        }

        #student_select {
            margin: 50px 200px;
            padding: 50px;
        }

        #student_select select {

            color: blueviolet;
       font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
       font-weight:bold;
            padding: 10px;
            border: teal solid;
            border-radius: 20px;
        }

        #student_select option {
            color: blueviolet;
        }

        #subjectss {
            margin: 50px 200px;
        }

        #subjectss input {
            border-radius: 20px;

        }

        #subject_name {
            width: 350px;
            text-align: center;
        }

        #marks {
            width: 350px;

        }

        #sub_btn {
            padding: 10px;
            font-size: larger;

        }
    </style>
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-light bg-info">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">
                <img src="../images/mylogo.png" height="80"/>
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
<!-- <div class="header" >
        <a href="#default" class="logo">welcome <?php echo ($t)   ?></a>
        <div class="header-right">
            <a class="active" href="t_dashboard.php">Home</a>
            <div class="subnav">
                <button class="subnavbtn">Profile <i class="fa fa-caret-down"></i></button>
                <div class="subnav-content">
                    <a href="#link1">View Profile</a>
                    <a href="../logout.php">
                        <h2>
                            <font color="red">Logout</font>
                        </h2></a>

                </div>
            </div>

        </div>
    </div> -->

  <div class="container">
      <div class="row">
      <div class="row g-3">
  <div class="col">
  <form action="class_grades.php" method="post">
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
      
  <select class="form-select  form-select-sm" name="exam" id="exam-list">
            <option value=''>Select Exam</option>
        </select>
  </div>
  
  <center><input type="submit" class="btn btn-primary" name="submit" value="Enter"></center>
  </form>
</div>
      </div>
  </div>
        </div>
    <?php
   
        if (isset($_POST["submit1"])) {
            // $sstudent_name = $_POST['student'];
            $student_classname = $_POST['class'];
            $exam=$_POST['exam'];
         
            $sql = mysqli_query($conn, "select * from final where class_id='$student_classname' and student_id='$sstudent_name'");
            if($sql){
                echo"hey";
            }
            while ($res = mysqli_fetch_assoc($sql)) { ?>
                <form id="subjectss" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);
                                                ?>" method="post">
                    <input type="text" hidden value="<?php echo $sstudent_name; ?>" name="student">
                    <input type="text" hidden value="<?php echo $student_classname; ?>" name="s_class">
                    <input type="number" hidden value="<?php echo $exam; ?>" name="exam">
    
                    <input type="text" hidden value="<?php echo $res['subject_id']; ?>" name="sub_id[]">
    
                    <table style="border:0; width:700px;">
                        <tr>
                            <td style="background-color: whitesmoke; border:0;"> <input type="text" value="<?php echo $res['subject_name']; ?>" name="subname[]" id="subject_name" readonly></td>
                            <td style="background-color: whitesmoke; border:0;"> <input type="text" name="marks[]" id="marks" placeholder="Enter Mark Here"></td>
                        </tr>
                    </table>
                <?php
            }
                ?>
                <input type="submit" name="submit2" id="sub_btn" value="submit">
                </form>
    
            <?php
        }
            ?>
        <?php
        if (isset($_REQUEST["submit2"])) {

            $i = 0;
            $sum = 0;
            foreach ($_POST['marks'] as $textbox) {
                $student = $_POST['student'];
                $s_class = $_POST['s_class'];
                $mark = $textbox;
                $subject = $_POST['sub_id'][$i];
                $exam_id=$_POST['exam'];
               
                $sum = $sum + $textbox;
                $check=mysqli_query($conn,"select * from marks where subject_id=$subject  and student_id=$student and exam=$exam_id");
                $ans=mysqli_fetch_assoc($check);
                if($ans){
                    echo'<script> alert("sorry results for this student have already been added")</script>';
                }
                else{
                    $crud = mysqli_query($conn, "insert into marks values('0',$student,$subject,$exam_id,$mark)");
                    if (!$crud) {
                        echo $mark . $subject;
                        echo $student;
                    }
                    else {
                        echo'<script>alert("data inserted")</script>';
                        # code...
                        $results = mysqli_query($conn, "insert into results values('',$exam_id,$s_class,$student,$sum)");
                        if (!$results) {
                            echo $sum;
                        }
                    }
                    $i++;
                }
               
            }
            
        }
        ?>
        

</body>
<script src="../jquery.js"></script>
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

   

    //     function submitAdd(){
    // document.frmAddAssessment.btnSubmit.value=”Add”;
    // document.frmAddAssessment.submit();
    // }

    // var k = "The respective values are :";
    //     function Geeks() {
    //         var input = document.getElementsByName('marks[]');

    //         for (var i = 0; i < input.length; i++) {
    //             var a = input[i];
    //             k = k + "marks[" + i + "].value= "
    //                                + a.value ;
    //         }

    //     document.getElementById("par").innerHTML = k;
    //     document.getElementById("po").innerHTML = "Output";
    // }

    function openForm() {
        document.getElementById("popupForm").style.display = "block";
    }

    function closeForm() {
        document.getElementById("popupForm").style.display = "none";
    }
</script>

</html>