<?php
include('connection.php');
session_start ();
if(!isset($_SESSION["email"]))

	header("location:admin_login.php"); 
$session_result = mysqli_query($conn, 'select distinct id, sname from academic_year ORDER BY id DESC');
$student_year = "";
$student_classname = "";
$sstudent_name = "";
$option4 = "";
$options1="";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="shortcut icon" href="ol.png" >
    <title>Grading</title>
   
  
  
    <style>
            
        .mm{
        padding-top:10rem;
    }
    .mrow{
       padding-left:12rem;   
       transition: 1s;
    }
    </style>
    
</head>

<body>
<?php include('header.php');


  include('sidebar.php');
  ?>

   
<div class="container-fluid col-sm  d-flex">

    <div class="container mm mx-3">
     

        <div class="mrow ">
            <div class="col-md">
               <form action="class_grades.php" method="post">
                <label for="session" class="form-label">Academic Year</label>
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
  <div class="col-md">
  <label for="term" class="form-label">Term</label>
  <select class="form-select" name="term" id="term-list">
            <option value=''>Select term</option>
        </select>
  </div>
  
  
  
      
  <div class="row">
  <div class="col-md">
  <label for="exam" class="form-label">Exam</label>
  <select class="form-select" name="exam" id="exam-list">
            <option value=''>Select Exam</option>
        </select>
  </div>
  <div class="col-md">
  <label for="class" class="form-label">Class </label> <br> 
    <select  class="form-select" name="classs" id="classlist">
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
  <center><input type="submit" class="btn btn-primary mt-5" name="submit" value="Grade students"></center>
  </form>
</div>
  </div>
  
        </div>
      
    <?php
   
        if (isset($_POST["submit1"])) {
            // $sstudent_name = $_POST['student'];
            $student_classname = mysqli_real_escape_string($conn,$_POST['class']);
            $exam=mysqli_real_escape_string($conn,$_POST['exam']);
         
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
                $student = mysqli_real_escape_string($conn,$_POST['student']);
                $s_class =mysqli_real_escape_string($conn,$_POST['class']);
                $mark = mysqli_real_escape_string($conn,$textbox);
                $subject = $_POST['sub_id'][$i];
                $exam_id=mysqli_real_escape_string($conn,$_POST['exam']);
               
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

<script src="jquery.js"></script>
<script>
    
    const sideBar = document.querySelector('.sidebar');
const toggler = document.querySelector('.toggler');
const mrow= document.querySelector('.mrow');
const container= document.querySelector('.container');
  
  toggler.addEventListener('click', function() {
   
    if (sideBar.style.marginLeft== '-250px')
    {
        sideBar.style.marginLeft= '0';
        mrow.style.paddingLeft= '12rem';
    }
    else 
    {
        
        sideBar.style.marginLeft= '-250px';
        mrow.style.paddingLeft= '2rem';
    }
   

  });

 

  
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