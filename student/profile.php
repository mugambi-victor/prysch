<?php 
 include('../connection.php');
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
        .gradient-custom {
/* fallback for old browsers */
background: #f6d365;

/* Chrome 10-25, Safari 5.1-6 */
background: -webkit-linear-gradient(to right bottom, rgba(246, 211, 101, 1), rgba(253, 160, 133, 1));

/* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
background: linear-gradient(to right bottom, rgba(246, 211, 101, 1), rgba(253, 160, 133, 1))
}

    </style>
</head>
<body>
    <?php 
    $query=mysqli_query($conn, "select * from student where regno ='$s'");
    while($result=mysqli_fetch_assoc($query)){
       
    
    ?>
<section class="vh-100"  style="background-color: #f4f5f7; ">
  
    <div class="row  d-flex justify-content-center align-items-center h-100 ">
      <div class="col col-lg-6 mb-4 mb-lg-0">
        <div class="card mb-9" style="border-radius: .5rem;">
          <div class="row g-3">
            <div class="col-md-4 gradient-custom text-center text-white"
              style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">
              <?php echo "<img  class='img-fluid my-5' style='width: 150px; padding:0;' src=' images/".$result['photo']. " ' >"; ?>
              
              <h5><?php echo $result['s_name']; ?></h5>
              <p><?php echo $result['regno']; ?></p>
              <i class="far fa-edit mb-5"></i>
            </div>
            <div class="col-md-8">
              <div class="card-body p-4">
                <h6>Information</h6>
                <hr class="mt-0 mb-4">
                <div class="row pt-1">
                  <div class="col-6 mb-3">
                    <h6>DOB</h6>
                    <p class="text-muted"><?php echo $result['dob']; ?></p>
                  </div>
                  
                  <div class="col-6 mb-3">
                    <h6>year joined</h6>
                    <p class="text-muted"><?php echo $result['year']; ?></p>
                  </div>
                </div>
                <h6>Parent/Guardian Information</h6>
                <hr class="mt-0 mb-4">
                <div class="row pt-1">
                  <div class="col-6 mb-3">
                    <h6>Parent/Guardian Name</h6>
                    <p class="text-muted"><?php echo $result['parent_name']; ?></p>
                  </div>
                  <div class="col-6 mb-3">
                    <h6>Parent/Guardian phone</h6>
                    <p class="text-muted"><?php echo $result['pno']; ?></p>
                  </div>
                  <div class="col-6 mb-3">
                    <h6>Parent's Email</h6>
                    <p class="text-muted"><?php echo $result['email']; ?></p>
                  </div>
                </div>
                <div class="d-flex justify-content-start">
                  <a href="#!"><i class="fab fa-facebook-f fa-lg me-3"></i></a>
                  <a href="#!"><i class="fab fa-twitter fa-lg me-3"></i></a>
                  <a href="#!"><i class="fab fa-instagram fa-lg"></i></a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    
  </div>
</section>
<?php } ?>
</body>
</html>


