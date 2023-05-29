<?php include('connection.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <title>Document</title>
    <style>
        body {
            background-color: whitesmoke;
        }

        /* .mine {
            width: 600px;
            border: 1px;
            margin: auto;
            background-color: white;
        }

        .mine form {
            width: 70%;
            margin: 4% auto;
            padding: 30px;
        }

        .mine form input, select{
            width: 80%;
            padding: 10px;
            border: 1px solid #00585e;
            border-radius: 10px;
            background-color: antiquewhite;
        }

        .mine form label {
            padding: 15px;
            padding-top: 15px;
        } */
.container{
    align:center;
}
     
    </style>
  
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-light bg-info">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">
                <img src="images/mylogo.png" height="80"/>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                   
                    
                </ul>
                <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="admin_dashboard.php"><i class='far fa-times-circle' style='font-size:48px;color:inherit'></i></a>
                    </li>
                  
                </ul>
            </div>
        </div>
    </nav> 
<?php
  if(isset($_POST['exam'])) {
        $ename=mysqli_real_escape_string($conn,$_REQUEST['ename']);
        $cname=mysqli_real_escape_string($conn,$_REQUEST['class-list']);
        $year=mysqli_real_escape_string($conn,$_REQUEST['session']);
        
        $res1 = mysqli_query($conn, "insert into exam values('0','$ename',$year,$cname )");
        if ($res1) {?>
            <!-- Success Alert -->
<div class="alert alert-success alert-dismissible fade show">
    <strong>Success!</strong> Data sent successfully.
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
      <?php  } else {?>
           <!-- Error Alert -->
           <div class="alert alert-danger alert-dismissible fade show">
               <strong>Error!</strong> A problem has occurred while submitting your data.
               <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
           </div>
<?php           
        }
    }


?>

    <!-- form for creating exam !-->
    <div class="container align-items-center">
        <div class="row align-items-center">
        <div class="col-sm-8 ">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); 
            ?>">
            <h2>Create Exam</h2>
            <label for="ename">Exam Name</label><br>
            <input type="text" name="ename" class="form-control" placeholder="exam name " required> <br> <br>
            <label for="year-list">Year</label><br>
            <select class="form-select" name="session" id="session-list">
            <option class="form-select" value="">Select academic year</option>
            <?php
            $session_result = mysqli_query($conn, 'select distinct id,sname from academic_year ORDER BY id DESC');
           
            if (mysqli_num_rows($session_result) > 0) {
                // output data of each row
                while ($row = mysqli_fetch_assoc($session_result)) {
            ?>
                    <option value="<?php echo $row['id']; ?>"><?php echo $row['sname']; ?></option>
            <?php
                }
            }
            ?>
        </select> <br> <br>

             <!-- dropdown for class -->
        <select name="class-list" class="form-select" id="class-list">
            <option value=''>Select class</option>
        </select>
            
            <button type="submit"  class="btn btn-outline-primary" name="exam" style="margin:5px;">submit</button>
            <button type="button" class="btn btn-outline-primary" > <a href="#" style="color: inherit; text-decoration:none;">View Classes</a> </button>
        </form>
        </div>

        </div>
        
       
    </div>


</body>
<script src="jquery.js"></script>
<script>
    $('#session-list').on('change', function() {
        var session_id = this.value;
        $.ajax({
            type: "POST",
            url: "getclasses.php",
            data: 'session_id=' + session_id,
            success: function(result) {
                $("#class-list").html(result);
            }
        });
    }); </script>
</html>