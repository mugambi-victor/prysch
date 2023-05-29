<?php 
include('connection.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="foots.css">
    <link rel="stylesheet" href="vee.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <style>
     
        /* .form-style-4 {
            width: 80%;
            margin: 50px;

        }

        .contents {
            text-align: center;
            color: white;
            
        }
   
     
       .container-fluid div{
           
       }
       .first-txt {
            position: absolute;
            top: 50%;
            left: 20%
        }
  
        .second-txt {
            position: absolute;
            bottom: 20px;
            left: 10px;
        }
        .images img{ 
           width:500px;
        }
        .details{
            margin-top:50px;
        }
        .content:hover{
            opacity:0.7;
        } */
      
    </style>
</head>

<body >
<nav class="navbar navbar-expand-lg navbar-light bg-info">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">
                <img src="images/mylogo.png" height="90"/>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
           
        </div>
    </nav>
    <img src="images/R.jfif" alt="" style="width:100%; height:350px;">
<div class="container">
    <div class="row">
        <center><h1>NEWS AND ANNOUNCEMENTS</h1></center>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            
                <div class="container" >
          
                <?php 
                $sql=mysqli_query($conn,"select *from post order by id desc");
        
                while($r_res=mysqli_fetch_assoc($sql))
                {
                   if($r_res['id']%2==0){

                    echo'<div class="col-sm-12 content container" >';
                    echo'<div class="row">';
                echo'<div class="col-sm images" >';
                    
                     echo "<img class='img-fluid' src=' image/".$r_res['img']. " ' >"; 
                   echo'  </div>';
                    echo '<div class="col-sm details">';
                    echo'<center><h2 class="text-justify" style="color:blue;">'.substr($r_res['title'],0,100).'</h2><hr style="color:blue;"></center><br>';
                         echo'<p class="text-justify">'.substr($r_res['details'],0,100).'</p><br>';?>
                       <center>  <a href="post_details.php?id=<?php echo $r_res['id']; ?>"  class="btn btn-danger text-center">Read more</a><br><br></center>
                         <?php
                        echo'</div>';
                        echo'</div>';
                        echo'</div>';
                 } 
                 if($r_res['id']%2==1){
                    echo'<div class="col-sm-12 content container" >';
                    echo'<div class="row">';
                   echo '<div class="col-sm details">';
                   echo'<center><h2 class="text-justify" style="color:blue;">'.substr($r_res['title'],0,100).'</h2><hr style="color:blue;"></center><br>';

                        echo'<p class="text-justify">'.substr($r_res['details'],0,100).'</p>';?>
<center>  <a href="post_details.php?id=<?php echo $r_res['id']; ?>"  class="btn btn-danger text-center">Read more</a><br><br></center>
  <?php
                       echo'</div>';
                       
                       echo'<div class="col-sm images" >';
                       echo "<img class='img-fluid'  src=' image/".$r_res['img']. " ' >"; 
                     echo'  </div>';
                     echo'</div>';
                     echo'</div>';
       
                 }} ?>

               </div>
       
 

       
    </div>
</div>




</body>

</html>