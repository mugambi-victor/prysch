<?php include('../connection.php');
session_start();
$a = $_SESSION['accounts_email'];
if (!isset($a)) {
    header('location:accounts_login.php');

}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <script>
    window.history.forward();
    </script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../admin/ol.png">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>

    <title>AccountsDashboard</title>
    <style>
    .container {
        background-color: whitesmoke;
    }
    </style>
</head>

<body>

    <?php

    include('header1.php');

    include('sidebar.php');
    ?>
    <div class="container">
        <p class="display-6"><i class="bi-house-fill"></i>AccountsDashboard</p>
        <div class="row">
            <div class="col-md col-sm students">
                <?php
                        $query = mysqli_query($conn, "select *from student");
                        $result = mysqli_num_rows($query);

                        ?>
                <div class="m-1 row d-flex text-center p-0 bg-secondary">
                    <div class="col-sm col-md p">
                        <p class="text fw-bold display-3">
                            <?php echo $result; ?>
                        </p>
                        <p>Students</p>

                    </div>
                    <div class=" col-sm col-md a">
                        <img src="../image/student-icon1.jpg" class="card-img" alt="...">
                    </div>




                </div>
            </div>
            <div class="col-md col-sm">
                <div class="div ">
                    <?php 
    //invoices
    $getstudents=mysqli_query($conn,"select max(term_id) as t from student");
    $sum=0;
    while( $m=mysqli_fetch_assoc($getstudents)){
        $mterm1= $m['t'];
        if($mterm1>0){
        $getstudents4=mysqli_query($conn,"select * from student where term_id=$mterm1");
       while($m4=mysqli_fetch_assoc($getstudents4)){
      $sum=$sum+$m4['total'];
       }

      
    }
   
    //payments

    $getstudents2=mysqli_query($conn,"select max(term_id) as c from student");
    $sum1=0;
    
    while( $m2=mysqli_fetch_assoc($getstudents2)){
        $mterm2= $m2['c'];
        if($mterm2>0){
        $getstudents3=mysqli_query($conn,"select * from payments where term=$mterm2");
       
        
        while($m3=mysqli_fetch_assoc($getstudents3)){
      $sum1=$sum1+$m3['amount_paid'];
        }}
    
    
   //etting term name and academic year name
    $getterm=mysqli_query($conn,"select *from term where term_id=$mterm1");
    $x=mysqli_fetch_assoc($getterm);
   $currentterm= $x['term_name'];
    $yr=$x['year'];
    $getyr=mysqli_query($conn,"select *from academic_year where id=$yr");
    $y=mysqli_fetch_assoc($getyr);
    $currentyr= $y['sname'];
    ?>
                    </p>

                    <div class="col-md">
                        <canvas id="myChart" style="width:100%;"></canvas>

                        <script>
                        var xValues = ["Invoices", "Payments"];
                        var yValues = ['<?php echo $sum ?>', '<?php echo $sum1 ?>', 5000];
                        var barColors = ["red", "green", "blue"];

                        new Chart("myChart", {
                            type: "bar",
                            data: {
                                labels: xValues,
                                datasets: [{
                                    backgroundColor: barColors,
                                    data: yValues
                                }]
                            },
                            options: {
                                legend: {
                                    display: false
                                },
                                title: {
                                    display: true,
                                    text: "Invoices vs Payments summary for <?php echo $currentyr ?> ( <?php echo $currentterm ?>  )"
                                }
                            }
                        });
                        </script>
                        <?php }} ?>
                    </div>
                </div>
            </div>




</body>

</html>