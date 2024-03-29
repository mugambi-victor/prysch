<?php
include('connection.php');
session_start ();
if(!isset($_SESSION["email"]))

	header("location:admin_login.php"); 
$session_result = mysqli_query($conn, 'select distinct id,sname from academic_year ORDER BY id DESC');
$student_year = "";
$student_semester = "";
$sstudent_name = "";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="ol.png">
    <title>ViewGrades</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    
    <style>
    
    .mm{
        padding-top:5rem;
    }
    .mrow{
       padding-left:10rem;   
       transition: 1s;
       background-color:white
    }
    </style>

</head>

<body>
    <?php 
    include('header.php');

  include('sidebar.php');

   ?>

<div class="container-fluid col-sm  d-flex">
        <div class="container  mm">
            <div class="row mrow d-block">
                <div class="col-md">
                    <form action="viewgrades1" method="post">
                    <h3 class="text-center pt-3 fw-bold">
                    Select a Class to View Grades</h3>
                        <label for="session" class="form-label">Academic Year</label>
                        <select class="form-select" name="session" id="session-list" required>
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
                <div class="col-md">
                    <label for="term" class="form-label">Term</label>
                    <select class="form-select" name="term" id="term-list" required>
                        <option value=''>Select term</option>
                    </select>
                </div>

            
            <div class="col-md col-sm ">
                <div class="col">
                    <label for="exam" class="form-label">Exam</label>
                    <select class="form-select" name="exam" id="exam-list" required>
                        <option value=''>Select Exam</option>
                    </select>
                </div>
                <div class="col-md">
                    <label for="class" class="form-label">Class </label> <br>
                    <select class="form-select" name="classs" id="classlist" required>
                        <option value="">Select class</option>
                        <?php
            $class_result = mysqli_query($conn, 'select distinct class_id,class_name from class');
            if (mysqli_num_rows($class_result) > 0) {
                // output data of each row
                while ($row = mysqli_fetch_assoc($class_result)) {
            ?>
                        <option value="<?php echo $row['class_id']; ?>"><?php echo $row['class_name']; ?></option>
                        <?php
                }
            }
            ?>
                    </select>
                </div>
                <center><input type="submit" class="btn btn-primary mb-3 mt-3" name="submit" value="View Grades"></center>
                </form>
           
    


        
    </div>

    </div>
</body>
<script src="sidebar.js"></script>
<script src="jquery.js"></script>
<script>
$('#session-list').on('change', function() {
    var session_id = this.value;
    $.ajax({
        type: "POST",
        url: "get_classes.php",
        data: 'session_id=' + session_id,
        success: function(result) {
            $("#term-list").html(result);
        }
    });
});
$('#term-list').on('change', function() {
    var term_id = this.value;
    $.ajax({
        type: "POST",
        url: "get_classes.php",
        data: 'term_id=' + term_id,
        success: function(result) {
            $("#exam-list").html(result);
        }
    });
});




function openForm() {
    document.getElementById("popupForm").style.display = "block";
}

function closeForm() {
    document.getElementById("popupForm").style.display = "none";
}
</script>

</html>