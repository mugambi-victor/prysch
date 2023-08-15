<?php
//include('db_connect.php');
include('../connection.php');

session_start();
if (!isset($_SESSION["email"])) {
  header("location:admin_login.php");
}

$options = "";
$options1 = "";
$optionr = "";


?>

<?php

// // Connect to first database
// $db1 = new mysqli('localhost', 'root', '', 'ozitekie_srms');

// // Check connection
// if ($db1->connect_error) {
//   die("Connection failed: " . $db1->connect_error);
// }
// $id = isset($_GET['id']) ? $_GET['id'] : '';
// // Retrieve data from form
// $id_no = isset($_POST['rno']) ? $_POST['rno'] : '';
// //$id_no = $_POST['id_no'];
// $name = isset($_POST['s_name']) ? $_POST['s_name'] : '';
// //$name = $_POST['name'];
// $contact = isset($_POST['pno']) ? $_POST['pno'] : '';

// $email = isset($_POST['email']) ? $_POST['email'] : '';
// //$email = $_POST['email'];


// // Insert data into first database
// $sql1 = "INSERT INTO student (id,id_no,name,contact, email) VALUES (NULL, '$id_no','$name','$contact', '$email')";
// if ($db1->query($sql1) === TRUE) {
//   // echo "...";
// } else {
//   echo "Error: " . $sql1 . "<br>" . $db1->error;
// }

// $db1->close();

// ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="ol.png">
    <title>AddStudent</title>



    <style>
    h3 {
        display: flex;
        flex-direction: row;

    }

    

    a:active {
        background-color: #8432DF;
    }

    #myHeader {
        color: blue;
    }

    .mm {
        padding-top: 10rem;
    }

    .mrow {
       padding-left:10rem;
        transition: 1s;
    }
    
    </style>
</head>

<body>
    <?php include('header.php');
include('sidebar.php');?>
  

        
  <div class="container-fluid col-sm  d-flex">


<div class="container mm">
       
            <div class="col-sm col-md mrow">
              
            <?php
        if (isset($_REQUEST['submit'])) {
            $sname = $_REQUEST['s_name'];
            $spass = $_REQUEST['s_pass'];
            $srno=$_REQUEST['rno'];
            $p_name=$_REQUEST['p_name'];
            $pno=$_REQUEST['pno'];
            $email=$_REQUEST['email'];
            $p_pass=$_REQUEST['p_pass'];
            $dob=$_REQUEST['dob'];
            $term=$_REQUEST['term'];
            $yoj=$_REQUEST['yoj'];
            $arget="../student/images/".basename( $_FILES["uploads"]["name"]);
            $filename = $_FILES["uploads"]["name"];
       
            if (isset($_REQUEST['class']) && is_numeric($_REQUEST['class']))
            $class = $_REQUEST['class'];
            else
            $class = 0;
            $year=$_REQUEST['academic_year'];
            $check= "SELECT * FROM student WHERE regno='$srno'";
            $rs = mysqli_query($conn, $check);
            if (mysqli_num_rows($rs) > 0) { ?>
                <!-- Error Alert -->
                <div class=" alert alert-danger alert-dismissible fade show">
                    <strong>Sorry!</strong>That Registration No. has already been taken.
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                <?php
                	}
                 else {
                  $checkfees=mysqli_query($conn,"select *from termfees where term =$term and class=$class");
                  if(mysqli_num_rows($checkfees)>0){
                    $resp=mysqli_fetch_assoc($checkfees);
                    $total=$resp['amount'];
                    $feestructure=$resp['fee_structure'];
                 
                  }else{
                    $total=0;
                    $feestructure="";
                  }

                $res = mysqli_query($conn, "insert into student values('0','$sname','$dob','$srno','$spass','$class', '$year','$term','$p_name','$pno','$email','$p_pass','$filename','$yoj',$total,'1','$feestructure')");
                if($res && move_uploaded_file($_FILES['uploads']['tmp_name'],$arget)){ ?>
                <!-- Success Alert -->
                <div class="alert alert-success alert-dismissible fade show">
                    <strong>Success!</strong> Data inserted to the database.
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                <?php
                  
                }
                else{?>
                <!-- Error Alert -->
                <div class="alert alert-danger alert-dismissible fade show">
                    <strong>Error!</strong> A problem has been occurred while submitting your data.
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                <?php
                }
            }
           
          
        } ?>
            <div class="row ">
                <form class="row g-3" enctype="multipart/form-data" method="post">
                    <h3 class="fw-bold d-flex justify-content-center ">Student Information</h3>
                    <hr class="my-2">

                    <div class="col-md-6">
                        <label for="s_name" class="form-label">Student Name</label>
                        <input type="text" placeholder="name" name="s_name" class="form-control" id="s_name" required>
                    </div>
                    <div class="col-md-6">
                        <label for="rno" class="form-label">Registration Number</label>
                        <input type="text" placeholder="Registration Number" class="form-control" name="rno" required>
                    </div>
                    <div class="col-md-6">
                        <label for="year" class="form-label">Academic Year</label>
                        <select class="form-select" aria-label="Default select example" name="academic_year"
                            id="year-list" required>
                            <option selected>Open this select menu</option>
                            <?php
  $session_result = mysqli_query($conn, "select distinct id,sname from academic_year");
            if (mysqli_num_rows($session_result) > 0) {
                // output data of each row
                while ($row = mysqli_fetch_assoc($session_result)) {
                    $options=$options."<option value= $row[id] >$row[sname]</option>";
            
                }
                 
            }
           echo $options;
            ?>
                        </select>
                    </div>
                    <div class="col-md">
                        <label for="term" class="fomr-label">Term</label>
                        <select name="term" class="form-select" id="termlist">
                            <option value="">select term</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="class" class="form-label">Class </label> <br>
                        <select class="form-select" name="class" id="classlist">
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

                    <div class="col-md-6">
                        <label for="s_pass" class="form-label">Password</label>
                        <input type="text" class="form-control" id="s_pass" placeholder="password" name="s_pass"
                            required>
                    </div>
                    <div class="col-md-6">
                        <label for="dob" class="form-label">DOB</label>
                        <input type="date" class="form-control" id="dob" placeholder="date og birth" name="dob"
                            required>
                    </div>
                    <div class="col-md-6">
                        <label for="yoj" class="form-label">YEAR OF JOINING</label>
                        <input type="text" class="form-control" id="yoj" placeholder="year of joining eg, 2020"
                            name="yoj" required>
                    </div>
                    <div class="col-md-6">
                        <label for="uploads" class="form-label">Upload Photo</label>
                        <input type="file" class="form-control" id="uploads" name="uploads" required>
                    </div>
                    <hr class="my-2">
                    <h3 class="fw-bold d-flex justify-content-center">Parent/Guardian Information</h3>
                    <div class="col-md-6">
                        <label for="s_name" class="form-label">Parent/Guardian Name</label>
                        <input type="text" placeholder="parents name" name="p_name" class="form-control" id="p_name"
                            required>
                    </div>
                    <div class="col-md-6">
                        <label for="pno" class="form-label">Phone Number</label>
                        <input type="number" placeholder="Phone Number" class="form-control" name="pno" required>
                    </div>
                    <div class="col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" placeholder="Email" name="email" class="form-control" id="email" required>
                    </div>
                    <div class="col-md-6">
                        <label for="p_pass" class="form-label">password</label>
                        <input type="text" placeholder="Password" class="form-control" name="p_pass" required>
                    </div>
                    <div class="col-12 d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary" name="submit">Add Student</button>
                    </div>
                </form>
            </div>
        </div>
        </div>
        <script src="jquery.js"></script>
        <script src="sidebar.js"></script>
        <script>
        $('#year-list').on('change', function() {
            var session_id = this.value;

            $.ajax({
                type: "POST",
                url: "getclasses.php",
                data: 'session_id=' + session_id,
                success: function(result) {
                    $("#termlist").html(result);
                }
            });
        });
        </script>
</body>

</html>