<?php
include('../connection.php');
session_start();
$s = $_SESSION["s_login"];
if (!isset($_SESSION["s_login"])) {
    header("location:s_login.php");
}
$get_studentdata = mysqli_query($conn, "select *from student where regno='$s'");
$rest = mysqli_fetch_assoc($get_studentdata);



?>
<!DOCTYPE html>
<html lang="en">

<head>
      
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../admin/ol.png" >
    <title>SIMS | FeeInfo</title>
</head>
<style>
    .mm{
        margin-top:7rem
    }
    .card-containerr{
        background-color:#0036AB;
    }
    @media(min-width:997px){
    .mrow{
        padding-left:10rem
    }
    
}

    @media(max-width:997px) {
        
    .card-containerr {
        border-radius: .3rem;
        height:200px;
        background-color:#0036AB;
    }
    .mrow{
        padding-left:0rem
    }
    .mm{
        margin-top:5rem
    }
    .card-img{
        visibility: hidden;
    }
   
    }
    .term-select{
    margin-top: 1rem;
}
</style>
<body>
   
<?php include('header.php');
include('sidebar.php');
?>
<div class="container-fluid col-sm  d-flex">
<?php 

  

   
    $sql = mysqli_query($conn, "select *from student where regno='$s' ");
    $result = mysqli_fetch_assoc($sql);
        $a = $result['id'];
        $b=$result['term_id'];
        ?>
    <div class="container mm col-sm">
        <div class="row mrow">
            <div class="col-sm">

                <div class="mt-4 ms-1 row card-containerr d-flex text-white text-center p-0 ">
                    <p class="text-center fs-2 mon pt-2 " style="margin-top: -0.56%;">Fee Summary Info</p>
                    <div class="col-sm">
                    <?php
                        $term=$result['term_id'];
                        $getterm = mysqli_query($conn, "select *from term where term_id =$term");
                        $restt = mysqli_fetch_assoc($getterm);
                        $termname = $restt['term_name'];
                    $year=$restt['year'];
                     $getyr = mysqli_query($conn, "select *from academic_year where id =$year ");
                     $restt = mysqli_fetch_assoc($getyr);
                     $yrname = $restt['sname'];

                   
                    ?> 
                        <p class="lead text-capitalize"><span class="mon">Current Term: </span><?php echo $yrname . "<br/> " . $termname?></p>
                        
                            <p class=" fs-5"><span class="mon">Term Fee:</span><br> Kshs <?php echo number_format($result['total']); ?></p>
                            
                        
                        </div>
                    <div class=" col-sm a">
                        <img src="../image/R1.png" class="card-img" alt="...">
                    </div>




                </div>
            </div>
        
            <div class="col-sm">
                <!-- <p>Open a PDF file <a href="../admin/fees/fee_structures/curriculum_vitae1.pdf">example</a>.</p> -->
                <p class="fs-2 fw-bold mt-3 mon">Fee Payment History</p>
                <div class="row">
                    <div class="col-sm">
                        <form action="" method="post">
                         
                            <select name="session" class="form-select bg-light" id="session-list" required>
                                <option value="">Select academic year</option>
                                <?php

                                //begin here
                                
                                $yrid = $rest['session_id'];

                                $session_result = mysqli_query($conn, "select * from academic_year where id=$yrid");

                                if (mysqli_num_rows($session_result) > 0) {
                                    // output data of each row
                                    while ($row = mysqli_fetch_assoc($session_result)) {
                                        ?>
                                        <option value="<?php echo $row['id']; ?>">
                                            <?php echo $row['sname']; ?>
                                        </option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                            
                            <select name="term" class="form-select term-select bg-light" id="term">
                                <option value="">select Term</option>

                            </select>
                            <center> <button type="submit"  class="bt mt-2 "
                                    name="history" role=""><i class="fa fa-eye"></i> View History</button></center>
                        </form>
                    </div>
                </div>
                <?php
                if (isset($_REQUEST['history'])) {
                    
                    $term = $_REQUEST['term'];

                    $year = $_REQUEST['session'];

                    $getyr = mysqli_query($conn, "select *from academic_year where id =$year ");
                    $restt = mysqli_fetch_assoc($getyr);
                    $yrname = $restt['sname'];


                    $getterm = mysqli_query($conn, "select *from term where term_id =$term");
                    $restt = mysqli_fetch_assoc($getterm);
                    $termname = $restt['term_name'];
                    $check = mysqli_query($conn, "select *from payments where regno='$s' and term =$term ");
                    if (mysqli_num_rows($check) > 0) {



                        ?>
                        <table class="table table-bordered table-striped text-capitalize caption-top">
                            <caption>List of payments made in
                                <?php echo $yrname . " " . $termname ?> 
                            </caption>
                            <th>
                                s/n
                            </th>
                            <th>
                                Transaction ID
                            </th>
                          
                            <th>
                                amount
                            </th>
                            <?php
                            $x = 1;
                            $sum = 0;
                            $getdata = mysqli_query($conn, "select *from payments where regno='$s' and term=$term");
                            while ($res = mysqli_fetch_assoc($getdata)) {
                                ?>
                                <tr>
                                    <td>
                                        <?php echo $x++; ?>
                                    </td>
                                    <td>
                                        <?php echo $res['trans_id'] ?>
                                    </td>
                                    <td>
                                        <?php
                                        $sum = $sum + $res['amount_paid'];
                                        echo $res['amount_paid'] ?>
                                    </td>

                                </tr>

                                <?php
                            }

                            ?>
                            <tr>
                                

                            </tr>

                        </table>

                        <?php

                    } else {
                        ?>
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>Sorry!</strong> No payments yet!! If you have paid but the payment does not reflect here,
                            please contact the Accounts office <a href="">here</a>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <?php

                    }
                }
                ?>

            </div>

        </div>
        <button type="button" name="back" class=" mt-4 p-2 bt-danger"><a href="s_dashboard.php" class="text-white"><i class="bi-arrow-left-circle-fill"></i>GoBack</a></button>
    </div>
    
            </div>
    <script src="../jquery.js"></script>
    <script>
        function PrintPage() {
            window.print();
        }
        $('#session-list').on('change', function () {
            var session_id = this.value;
            $.ajax({
                type: "POST",
                url: "getclasses.php",
                data: 'session_id=' + session_id,
                success: function (result) {
                    $("#term").html(result);
                }
            });
        });

        $('.bb').on('click', function() {
    function hasClass(element, clsName) {
return(' ' + element.className + ' ').indexOf(' ' + clsName + ' ') > -1;
}
let val1 = document.getElementById('collapseExample');

    if(hasClass(val1, 'active')){
        $('#collapseExample').removeClass('active');
    }else{
        $('#collapseExample').addClass('active');
    }

});

    </script>
</body>

</html>