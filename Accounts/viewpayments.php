<?php include('../connection.php');
session_start();
$a=$_SESSION['accounts_email'];
if(!isset($a)){
    header('location:accounts_login.php');
   
} 
$optionr=""; 
$options=""; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <link rel="shortcut icon" href="../admin/ol.png">
    <title>ViewPayments</title>
    <style>
    .mm {
        padding-top: 10rem;
    }

    .mrow {

        transition: 1s;
    }

    #modal2 {
        width: 1200px;
    }
    </style>
</head>

<body>
    <?php include("header.php"); 
include('sidebar.php')?>

    <div class="container col-sm mm">
        <div class="mrow">


            <?php
                 
                 if(isset($_REQUEST['record'])){
                    $regno=$_REQUEST['regno'];
                    $courseyear=$_REQUEST['courseyear'];
                    $semester=$_REQUEST['semester'];
                    $transid=$_REQUEST['transid'];
                    $paid=$_REQUEST['paid'];



                    
                    $check=mysqli_query($conn,"select *from payments where transaction_id='$transid'");
                    if(mysqli_num_rows($check)>0){ 
                        echo ("<div class='alert mt-3 alert-warning alert-dismissible fade show'>
                        <strong>Sorry!</strong>A payment with that Transaction Id has already been Recorded.
                        <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                    </div>");

                    }else{
                        $insertquery=mysqli_query($conn,"insert into payments values(0,'$regno',$courseyear, $semester, '$transid',$paid)");
                        $getstudent=mysqli_query($conn, "select *from student where regno='$regno'");
                        $rets=mysqli_fetch_assoc($getstudent);
                        $newbalance=$rets['balance']-$paid;
                        if($newbalance<=0){
                            $newbalance=-1*$newbalance;
                            $updatequery=mysqli_query($conn, "update student set balance=$newbalance, fee_status=0, overpaid=$newbalance where regno='$regno'");
                        }
                        elseif($newbalance!=0){
                            $updatequery=mysqli_query($conn, "update student set balance=$newbalance where regno='$regno'");
                        }
                       

                        if(!$insertquery&&!$updatequery){
                            echo ("<div class='alert mt-3 alert-warning alert-dismissible fade show'>
                            <strong>Sorry!</strong>A problem occured while sending data
                            <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                        </div>");
                        }
                        else{
                            echo ("<div class='alert mt-3 alert-success alert-dismissible fade show'>
                            <strong>Success!</strong>Data sent successfully and student fee updated successfully
                            <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                        </div>");
                           
                           
                        }
                    }
                }
                
                 ?>
            <div class="container">
                <form action="" method="post" class="mt-2">
                    <div class="row">
                        <div class="col-sm">
                            <h3 class="fw-bold d-flex justify-content-center">View Payments</h3>
                            <label for="" class="form-label fw-bold">Search registration Number</label>
                            <input type="text" name="searchbox" placeholder="search registration no..."
                                class="form-control" required>

                            <input type="submit" name="search" class="btn btn-primary mt-2" value="Search">


                        </div>

                </form>
            </div>

            <?php
    if(isset($_REQUEST['search'])){
        $regno=$_REQUEST['searchbox'];

?>
            <div class="col-sm">

                <table class="table mt-3 table-bordered table-striped caption-top">
                    <tr class="text-capitalize">

                        <th>Student Name</th>
                        <th>Registration Number</th>
                        <th>TransactionID</th>
                        <th>Amount paid</th>
                        <th>Term</th>

                        <th>actions</th>
                    </tr>
                    <?php
$getstudent=mysqli_query($conn,"select *from student where regno='$regno'");
if(mysqli_num_rows($getstudent)>0){
$res=mysqli_fetch_assoc($getstudent);
$name=$res['s_name'];

$getpayments=mysqli_query($conn,"select *from payments where regno='$regno'");
while($rts=mysqli_fetch_assoc($getpayments)){
    ?>
                    <tr>
                        <td><?php echo $name?></td>
                        <td><?php echo $regno?></td>
                        <td><?php echo $rts['trans_id']?></td>
                        <td><?php echo $rts['amount_paid']?></td>
                        <td><?php 
        $getterm=mysqli_query($conn,"select *from term where term_id='$rts[term]'");
        $term=mysqli_fetch_assoc($getterm);
        $termname=$term['term_name'];
        $tid=$term['term_id'];
        $yrid=$term['year'];
        $classs=$rts['class'];
        $getyear=mysqli_query($conn,"select *from academic_year where id=$yrid");
        $year=mysqli_fetch_assoc($getyear);
        $yrname=$year['sname'];
        echo $yrname." - ".$termname; ?></td>

                        <td> <a href="#myModal<?php echo $rts['trans_id'] ?>" class="btn btn-sm btn-primary"
                                data-bs-toggle="modal">Payment Info</a> <a
                                href="receipt.php?data='<?php echo $rts["trans_id"] ?>'" class="btn mt-1 btn-sm btn-primary"
                                >Receipt</a>

                            <!-- Modal HTML -->
                            <div id="myModal<?php echo $rts['trans_id']  ?>" class="modal fade">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title ">
                                                Payment Details <?php  $rts['trans_id'];
                                          $getp=mysqli_query($conn,"select *from payments where trans_id='$rts[trans_id]'");
                                          $resp=mysqli_fetch_assoc($getp);
                                          $t=$resp['term'];
                                          echo $t;
                                          ?>
                                            </h5>
                                            <button type="button" title="close" class="btn-close"
                                                data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="" method="post">
                                                <label for="sname" class="form-label">Student Name</label>
                                                <input type="text" name="sname" aria-label="sname"
                                                    value="<?php echo $res['s_name']; ?>" readonly class="form-control">

                                                <label for="regno" class="form-label">Registration Number</label>
                                                <input type="text" aria-label="regno" name="regno"
                                                    value="<?php echo $res['regno']; ?>" readonly
                                                    class="form-control text-uppercase ">

                                                <label for="year" class="form-label">Academic Year</label>
                                                <input type="text" value="<?php
                                            $getyear=mysqli_query($conn,"select *from academic_year where id='$res[session_id]'");
                                            $result=mysqli_fetch_assoc($getyear);
                                            echo $result['sname']; ?>" readonly class="form-control"
                                                    aria-label="courseyear">

                                                <label for="term" class="form-label">Term</label>
                                                <input type="term" aria-label="term" value="<?php
                                            $getterm=mysqli_query($conn,"select *from term where term_id='$rts[term]'");
                                            $result=mysqli_fetch_assoc($getterm);
                                             echo $result['term_name']; ?>" readonly class="form-control">
                                                <label for="student_grade" class="form-label">Student Grade</label>
                                                <input type="student_grade" aria-label="student_grade" value="<?php
                                            $getclass=mysqli_query($conn,"select *from class where class_id=$classs");
                                            $result=mysqli_fetch_assoc($getclass);
                                             echo $result['class_name']; ?>" readonly class="form-control">
                                                <label for="transaction_id" class="form-label">TransactionID</label>
                                                <input type="term" aria-label="transaction_id" value="<?php
                                           
                                             echo $rts['trans_id']; ?>" readonly class="form-control">
                                                <label for="term" class="form-label">Transaction Amount</label>
                                                <input type="amt" aria-label="transaction_amount" value="<?php
                                           
                                             echo $rts['amount_paid']; ?>" readonly class="form-control">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Cancel</button>
                                            <button type="button" class="btn  btn-primary">Save changes</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>

                   
                    <?php
}
?>
                </table> <?php
    }
    else{
        echo "no record found";
        }
        }?>



            </div>
            <div class="container col-sm mt-3">
                <div class="row">
                    <form action="payments.php" method="post">
                        <label for="class" class="form-label">Academic Year</label>
                        <select name="year" id="year-list" class="form-select">
                            <option value="">select Year</option>

                            <?php
            $query=mysqli_query($conn,"select *from academic_year ");
            while($r=mysqli_fetch_assoc($query)){
                
                ?>
                            <option value="<?php echo $r['id']; ?>"><?php echo $r['sname']; ?></option>
                            <?php
            }
            ?>
                        </select>

                </div>
                <div class="col-md">
                    <label for="term_name" class="form-label">Term</label>
                    <select class="form-select" aria-label="term_name" name="term_name" id="term-list" required>
                        <option value=''>Select term</option>
                    </select>
                </div>


                <label for="class" class="form-label">Class</label>
                <select name="class" id="class-list" class="form-select">
                    <option value="">select class</option>

                    <?php
            $query=mysqli_query($conn,"select *from class ");
            while($r=mysqli_fetch_assoc($query)){
                
                ?>
                    <option value="<?php echo $r['class_id']; ?>"><?php echo $r['class_name']; ?></option>
                    <?php
            }
            ?>
                </select>
            </div>

            <div class="col-md-6">
                <input type="submit" value="submit" name="submit" id="formsubmit" class="btn btn-primary mt-1">
            </div>
        </div>


        </form>
    </div>




    </div>
    </div>
    <?php 
    ?>


    <script>
    $('#year-list').on('change', function() {
        var session_id = this.value;
        $.ajax({
            type: "POST",
            url: "getterms.php",
            data: 'session_id=' + session_id,
            success: function(result) {
                $("#term-list").html(result);
            }
        });
    });
    const sideBar = document.querySelector('.sidebar');
    const toggler = document.querySelector('.toggler');
    const mrow = document.querySelector('.mrow');
    const container = document.querySelector('.container');

    toggler.addEventListener('click', function() {

        if (sideBar.style.marginLeft == '-250px') {
            sideBar.style.marginLeft = '0';

        } else {

            sideBar.style.marginLeft = '-250px';

        }
    });
    </script>

</body>

</html>