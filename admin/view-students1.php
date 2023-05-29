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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <title>Document</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-info">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">
                <img src="images/new.PNG" height="80"/>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">Account</a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li> <a class="dropdown-item"  href="viewprofile.php">Profile</a></li>
                            <li> <a class="dropdown-item"  href="logout.php">Logout</a></li>
        
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container" style="margin-top:20px;">
        <div class="col-sm-12">
        <form action="" method="post">
        <select  class="form-select" name="session" id="session-list">
            <option value="">Select academic year</option>
            <?php
            $session_result=mysqli_query($conn, "select*from academic_year ORDER BY id DESC");
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
        <div class="col">
            <select class="form-select" name="classs" id="class-list">
                <option value=''>Select class</option>
            </select>
         </div>
        <div class="col">
            <input type="submit" value="submit" name="submit" class="btn btn-primary">
        </div>
            </form>
      <div class="col table-responsive-lg">
               <table  class=" col-sm-12">
                   <tr>
                       <th>Student Name</th><th>Registration Number</th><th>Parent's email</th> <th>Parent's No.</th>
                   </tr>
    <?php 
    if(isset($_REQUEST["submit"])){
        $year=mysqli_real_escape_string($conn,$_REQUEST["session"]);
        $class=mysqli_real_escape_string($conn,$_REQUEST["classs"]);
 
      
        $sql=mysqli_query($conn,"select * from student where class=$class");
        
        while($row=mysqli_fetch_assoc($sql)){
      
           echo "<tr><td><form method='post' action='viewstudentprofile.php'><label>" . $row['s_name'] . "</label></td><td><input style='border:0;' name='rno' type='text' readonly value=" . $row['regno'] . "></td><td>" . $row['email'] . "</td><td>" . $row['pno'] . "</td><td><input type='submit' class='btn btn-info' value='view profile' name='profile'></form></a></td></tr>"; }?>
                   
               </table>
           </div>
        </div></div>
      <?php }
    ?>
 
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
    });
   
    </script>

   
</body>
</html>