<?php
include("../connection.php");
session_start();
$sql1=mysqli_query($conn, "select *from student where email='$_SESSION[p_login]'");
$res=mysqli_fetch_assoc($sql1);
$s=$res['regno'];
if (!isset($_SESSION["p_login"])) {
    header("location:p_login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="../vee.css">
    <link rel="stylesheet" type="text/css" href="../foots.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <style>
        .selects_year{
            margin:2% 30%;
            
        }
        .selects_year select{
            width: 30%;
            padding: 10px;
            border: 1px solid teal;
            border-radius: 10px;
            background-color: antiquewhite;
        }
        .selects_year input{
            padding: 10px;
            margin-top: 15px;
            background-color: teal;
            color: white;
            font-size: large;
            border-radius: 10px;
        }
        .results table {
            font-family: arial, sans-serif;
            width: 80%;
            border:0;
        }

        .results td {
            border: 0;
            text-align: left;
            padding: 8px;

        }

        tr:nth-child(even) {
            background-color: #dddddd;
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
                        <a class="nav-link" aria-current="page" href="index1.php"><i class='far fa-times-circle' style='font-size:48px;color:inherit'></i></a>
                    </li>
                  
                </ul>
            </div>
        </div>
    </nav> 
     <!-- <div class="header">
        <a href="#default" class="logo">welcome <?php echo ($s)   ?></a>
        
        <div class="header-right">
            <a class="active" href="t_dashboard.php">Home</a>
            <div class="subnav">
                <button class="subnavbtn">Profile <i class="fa fa-caret-down"></i></button>
                <div class="subnav-content">
                    <a href="#link1">View Profile</a>
                    <a href="../logout.php">
                        
                            Logout </a>

                </div>
            </div> -->

        </div>
    </div>
    <div class="selects_year">
        <form action="" method="POST">
            <!-- dropdown for session/academic year -->
        <select  name="session" id="session-list" required>
            <option value="">Select academic year</option>
            <?php
            $session_result = mysqli_query($conn, 'select * from academic_year');
           
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
        <!-- for selecting exam -->
        
        <!-- for selecting class-->
        <select name="class" id="class" required>
        <option value=''>Select class</option>
        </select>
        <select name="exam" id="exam" required>
        <option value=''>Select Exam</option>
        </select> <br> <br>
        
     <center>   <input type="submit" class="btn" name="submit" value="submit"></center>
        </form>
    </div>

    <?php
    if(isset($_REQUEST["submit"])){
        $session=$_REQUEST["session"];
        $exam=$_REQUEST["exam"];
        $class=$_REQUEST["class"];
        
        $query=mysqli_query($conn, "select * from finalmarks where exam_id=$exam and regno='$s' and class=$class");
        while($result=mysqli_fetch_assoc($query)) {
       
               
       
            $grade="";
            if($query!==null){
                if($result['marks']>80&&$result['marks']<=100){
                    $grade="A";
                }
                elseif($result['marks']>65&&$result['marks']<=80){
                    $grade="B";
                }
                elseif($result['marks']>55&&$result['marks']<=65){
                    $grade="C";
                }
                elseif($result['marks']>40&&$result['marks']<=55){
                    $grade="D";
                }
                elseif($result['marks']>0&&$result['marks']<=40){
                    $grade="E";
                }
             ?>
          <center>
          <div class="results">
           <table style="border:0; width:700px;">
                    <tr>
                        <td style="width:50%;"><?php echo $result['subject_name']; ?></td>
                        <td style=" width:50%; "><?php echo $result['marks']; ?></td>
                        <td style=" width:50%; "><?php echo $grade; ?></td>
                    </tr>
                </table>
                
           </div>
           
          </center> 


        <?php }
              
          
        }}
    ?>

<br><br><br>
   
    <script src="../jquery.js"></script>
    <script>
	function PrintPage() {
		window.print();
	}
    $('#session-list').on('change', function() {
        var session_id = this.value;
        $.ajax({
            type: "POST",
            url: "../student/get_exams.php",
            data: 'session_id=' + session_id,
            success: function(result) {
                $("#class").html(result);
            }
        });
    });
    $('#class').on('change', function() {
        var class_id = this.value;
        $.ajax({
            type: "POST",
            url: "../student/get_exams.php",
            data: 'class_id=' + class_id,
            success: function(result) {
                $("#exam").html(result);
            }
        });
    });

    </script>
</body>
</html>