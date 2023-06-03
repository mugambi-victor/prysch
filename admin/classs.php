<?php include('connection.php');
session_start();
$a=$_SESSION["email"];
if (!isset($_SESSION["email"])) {

    header("location:admin_login.php");
}

$options = "";
$optionr = "";
$optionrr = "";
$option3 = "";
$option4 = "";
$option = "";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <link rel="shortcut icon" href="ol.png">
    <title>CreateCourses</title>
    <style>
    .form-label {
        font-weight: bold;
    }

    a:hover {
        background: slateblue;
    }
    .mm{
        padding-top:10rem;
    }
    .mrow{
       padding-left:10rem;   
       transition: 1s;
    }
    </style>

</head>

<body>
    <?php include('header.php');
    include('sidebar.php');?>
    
    <div class="container-fluid  col-sm mm d-flex">
        <?php 

  

   ?>


        <div class="container ">
            <div class="row mrow ">

                <?php
 if (isset($_POST['year'])) {
    $yname =mysqli_real_escape_string($conn,$_REQUEST['yname'] );
  
    $checks=mysqli_query($conn, "select * from academic_year where sname='$yname'");
    if(mysqli_num_rows($checks)>0){
        ?>
        <div class="alert alert-danger alert-dismissible fade show">
                  <strong>Sorry!</strong>Academic year already exists.
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div><?php
    }else{
       
        $res = mysqli_query($conn, "insert into academic_year values('0', '$yname')");

        if ($res) {
            ?>
            <div class="alert alert-success alert-dismissible fade show">
                      <strong>Success!</strong>Data inserted successfully.
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div><?php
           
            $term1="January-March";
            $term2="May-July";
            $term3="September-November";
            $selectq=mysqli_query($conn,"select *from academic_year where sname='$yname'");
            if($selectq){
                $res3=mysqli_fetch_assoc($selectq);
                $id=$res3['id'];
                $tquery1=mysqli_query($conn,"insert into term values(0,'$term1',$id)");
                $tquery2=mysqli_query($conn,"insert into term values(0,'$term2',$id)");
                $tquery3=mysqli_query($conn,"insert into term values(0,'$term3',$id)");

                //set fees, initialize to null values
                //  $fquery1=mysqli_query($conn,"insert into termfees values(0,'$id','$term1',$id)");
                // $fquery2=mysqli_query($conn,"insert into termfees values(0,'$term2',$id)");
                // $fquery3=mysqli_query($conn,"insert into termfees values(0,'$term3',$id)");

 //exams 
                if($tquery1&&$tquery2&&$tquery3){
                 
                    ?><div class="alert alert-success alert-dismissible fade show">
                          <strong>success!</strong>Term created successfully.
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div><?php
                    $exam1="Opener Exam";
                    $exam2="MidTerm Exam";
                    $exam3="EndTerm Exam";
                    $selectq1=mysqli_query($conn,"select *from term where term_name='$term1' and year=$id");
                    if($selectq1){
                $res3=mysqli_fetch_assoc($selectq1);
                $id1=$res3['term_id'];
               //for term 1
                $exquery1=mysqli_query($conn,"insert into exam values(0,'$exam1',$id1)");
                $exquery2=mysqli_query($conn,"insert into exam values(0,'$exam2',$id1)");
                $exquery3=mysqli_query($conn,"insert into exam values(0,'$exam3',$id1)");
               
                    }
            
            //term 2
            $selectq2=mysqli_query($conn,"select *from term where term_name='$term2' and year=$id");
            if($selectq2){
                $exam1="Opener Exam";
                $exam2="MidTerm Exam";
                $exam3="EndTerm Exam";
                
            $res3=mysqli_fetch_assoc($selectq2);
            $id2=$res3['term_id'];
             
             $equery1=mysqli_query($conn,"insert into exam values(0,'$exam1',$id2)");
             $equery2=mysqli_query($conn,"insert into exam values(0,'$exam2',$id2)");
             $equery3=mysqli_query($conn,"insert into exam values(0,'$exam3',$id2)");

             //
            }

            //term 3
            $selectq3=mysqli_query($conn,"select *from term where term_name='$term3' and year=$id");
            if($selectq3){
                $exam1="Opener Exam";
                $exam2="MidTerm Exam";
                $exam3="EndTerm Exam";
                
            $res3=mysqli_fetch_assoc($selectq3);
            $id3=$res3['term_id'];
             
             $e2query1=mysqli_query($conn,"insert into exam values(0,'$exam1',$id3)");
             $e2query2=mysqli_query($conn,"insert into exam values(0,'$exam2',$id3)");
             $e2query3=mysqli_query($conn,"insert into exam values(0,'$exam3',$id3)");
            }
            if($exquery1&&$exquery2&&$exquery3&&$equery1&&$equery2&&$equery3&&$e2query1&&$e2query2&&$e2query3){
              
                ?>
                <div class="alert alert-success alert-dismissible fade show">
                          <strong>Success!</strong>Exams created successfully.
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div><?php
                        }
                }
                else{
                    ?>
                    <div class="alert alert-danger alert-dismissible fade show">
                              <strong>Sorry!</strong>an error occurred while creating terms.
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div><?php
                    
                    ?><div class="alert alert-danger alert-dismissible fade show">
                          <strong>Sorry!</strong> an error occurred while creating terms
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div><?php
                }
            }
            else{
                ?>
                <div class="alert alert-danger alert-dismissible fade show">
                          <strong>An error occurred contact admin</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div><?php
              
            }


        } else {
            ?>
            <div class="alert alert-danger alert-dismissible fade show">
                          <strong>Error inserting data to the database</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php
           
        }
    }
   }
   
elseif (isset($_REQUEST['create_class'])) {
    $classname = mysqli_real_escape_string($conn,$_REQUEST['cname'] );
  $checkclasss=mysqli_query($conn,"select *from class where class_name='$classname'");
  if(mysqli_num_rows($checkclasss)>0){
   
   ?><div class="alert alert-danger alert-dismissible fade show">
                          <strong>Sorry!</strong> that class already exists.
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div><?php
  }
  else{


   $res = mysqli_query($conn, "insert into class values('0','$classname')");
   if ($res) { ?>
               <!-- Success Alert -->
               <div class="alert alert-success alert-dismissible fade show">
                   <strong>Success!</strong>Class added successfully.
                   <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
               </div>
               <?php  
  
  }
  else{
   ?>
               <!-- Error Alert -->
               <div class="alert alert-danger alert-dismissible fade show">
                   <strong>Error!</strong> You can only have 4 classes in a Year <br>Or you are trying to add a class
                   thats already been added.
                   <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
               </div>
               <?php 
  }
 
}}

elseif (isset($_REQUEST['submit1'])) {
    
    $subject_name = mysqli_real_escape_string($conn,$_REQUEST['subname'] );
    $class = mysqli_real_escape_string($conn,$_REQUEST['class'] );
    $subject_code =mysqli_real_escape_string($conn,$_REQUEST['subcode'] );

    $sql=mysqli_query($conn, "select * from subject where subject_name='$subject_name' and  class='$class'");

    if(mysqli_num_rows($sql)>0){?>
            <!-- Info Alert -->
            <div class="alert alert-info alert-dismissible fade show">
                <strong>Info!</strong>subject already added.
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            <?php
           
        }
        else{
            $res1 = mysqli_query($conn, "insert into subject values(0,'$subject_name','$class','$subject_code' )");
              if($res1){
                ?>
            <!-- Success Alert -->
            <div class="alert alert-success alert-dismissible fade show">
                <strong>Success!</strong> Subject was added successfully.
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            <?php  
                 
              }else{
                ?>
            <!-- Error Alert -->
            <div class="alert alert-danger alert-dismissible fade show">
                <strong>Error!</strong> A problem has occurred while submitting your data.
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            <?php 
              }
            }
}?>
                <div class="container ">
                    <div class="row ">
                        <form class="needs-validation" style=" margin:auto; " action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); 
            ?>" method="post">

                            <h2>Create Academic Year</h2>
                            </center>

                            <div class="mb-3">
                                <label for="academic_year">Academic Year </label> <br>
                                <input type="text" name="yname" class="form-control"
                                    placeholder="Year Name eg '2020/2021' " required>
                            </div>

                            <center> <button type="submit" name="year" class="btn btn-primary">Submit</button></center>

                            <hr>
                        </form>
                    </div>

                    <div class="row">
                        <div class="col-sm col-md">
                            <!-- form for creating class -->
                            <form class="needs-validation" style=" margin:auto; " action="" method="post">

                                <h2>Create a Class</h2>
                                </center>

                                <div class="col-md col-sm mb-3">
                                    <label for="cname">Class Name</label>
                                    <input type="text" name="cname" class="form-control" placeholder="Class Name"
                                        required>
                                </div>
                                <center> <button type="submit" name="create_class"
                                        class="btn btn-primary">Submit</button></center>
                            </form>
                        </div>

                        <!-- form for creating subject -->
                        <div class="col-sm col-md">
                            <form class="needs-validation" style=" margin:auto;"
                                action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">

                                <h2>Create a Subject</h2>
                                </center>
                                <div class="row ">
                                    <div class="col-md col-sm">
                                        <label for="class" class="form-label">Class </label> <br>
                                        <select class="form-select" name="class" id="classlist">
                                            <option value="">Select class</option>
                                            <?php
            $class_result = mysqli_query($conn, 'select distinct class_id,class_name from class');
            if (mysqli_num_rows($class_result) > 0) {
                // output data of each row
                while ($row = mysqli_fetch_assoc($class_result)) {
            ?>
                                            <option value="<?php echo $row['class_id']; ?>">
                                                <?php echo $row['class_name']; ?></option>
                                            <?php
                }
            }
            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm col-md mb-3">
                                    <label for="subname">Subject Name</label>
                                    <input type="text" name="subname" class="form-control" placeholder="subject Name"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label for="subname">Subject Code</label>
                                    <input type="text" name="subcode" class="form-control" placeholder="subject Code"
                                        required>
                                </div>
                                <center> <input type="submit" name="submit1" class="btn btn-primary"> 
                                </center>
                            </form>

                        </div>
                    </div>
                </div>

                <script src="jquery.js"></script>
                <script src="sidebar.js"></script>
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
                </script>

</body>

</html>