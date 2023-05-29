<?php include('../connection.php');
header('Content-type: text/html; charset=utf-8');
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
    <title>ViewInvoices</title>
    <style>
    a:hover {
        background-color: #8432DF;
    }
    </style>
</head>

<body>
    <?php include("header.php"); 
include('sidebar.php')?>

    <div class="container col-sm m-2">

        <?php
                 
                 if(isset($_REQUEST['record'])){
                    $regno=$_REQUEST['regno'];
                    $term=$_REQUEST['term_name'];
                    $class=$_REQUEST['class'];
                    
                    $transid=$_REQUEST['transid'];
                    $paid=$_REQUEST['paid'];
                    echo $regno."-".$term."-".$class."-".$transid."-".$paid;


                    
                    $check=mysqli_query($conn,"select *from payments where trans_id='$transid'");
                    if(mysqli_num_rows($check)>0){ 
                        echo ("<div class='alert mt-3 alert-warning alert-dismissible fade show'>
                        <strong>Sorry!</strong>A payment with that Transaction Id has already been Recorded.
                        <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                    </div>");

                    }else{
                        $insertquery=mysqli_query($conn,"insert into payments values(0,'$regno',$term,$class,'$transid',$paid)");

                        if($insertquery){
                        $getstudent=mysqli_query($conn, "select *from student where regno='$regno'");
                        $rets=mysqli_fetch_assoc($getstudent);
                        $newtotal=$rets['total']-$paid;
                        // if($newbalance<0){
                        //     $overpaid=-1*$newbalance;
                        //     $updatequery=mysqli_query($conn, "update student set balance= 0, overpaid=$overpaid, fee_status=0 where regno='$regno'");
                        // }
                        // elseif($newbalance==0){
                        //     $updatequery=mysqli_query($conn, "update student set balance= 0,overpaid=0, fee_status=0 where regno='$regno'");
                        // }
                        // elseif($newbalance>0){
                        //     $updatequery=mysqli_query($conn, "update student set balance=$newbalance where regno='$regno'");
                        // }
                       

                        // if(!$insertquery&&!$updatequery){
                        //     echo ("<div class='alert mt-3 alert-warning alert-dismissible fade show'>
                        //     <strong>Sorry!</strong>A problem occured while sending data
                        //     <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                        // </div>");
                        // }
                        // else{
                        //     echo ("<div class='alert mt-3 alert-success alert-dismissible fade show'>
                        //     <strong>Success!</strong>Data sent successfully and student fee updated successfully
                        //     <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                        // </div>");
                           
                           
                        // }
                        if($newtotal<=0){
                            $updatequery=mysqli_query($conn,"update student set total=$newtotal, fee_status=0 where regno='$regno'");
                            if(!$updatequery){
                                echo "sorry";
                            }
                            else{
                                echo "success";
                            }
                        }
                        else{
                            $updatequery=mysqli_query($conn,"update student set total=$newtotal where regno='$regno'");
                            if(!$updatequery){
                                echo "sorry";
                            }
                            else{
                                echo "success";
                            }
                        }
                       
                    }
                    else{
                        echo "an error occurred while recording payment";
                    }}
                    
                }
                 ?>
        <div class="row">
           
            <div class="col-md">
                <form action="" method="post">
                    <div class="row">
                        <div class="col-sm">
                            <label for="searchbox" class="form-label lead fw-bold mt-5">Search By Registration
                                No</label>
                            <input type="text" name="searchbox" placeholder="registration no..."
                                class="p-2 form-control" required>
                        </div>

                        <input type="submit" name="search" class="btn btn-sm mt-3 btn-primary" value="Search">




                </form>
            </div>

            <?php
            if(isset($_REQUEST['search'])){

           
            $regno=$_REQUEST['searchbox'];

            ?>
            <div class="col-md">

                <table class="table mt-3 ms-1 table-sm table-bordered table-striped caption-top">
                    <tr class="text-capitalize">

                        <th>Student Name</th>
                        <th>Reg Number</th>
                       
                        <th>Fees due</th>
                        <th>actions</th>
                    </tr>
                    <?php

            $sql1=mysqli_query($conn, "select * from student where regno='$regno' and fee_status=1");
            if(mysqli_num_rows($sql1)>0){
            while($row=mysqli_fetch_assoc($sql1)){
      
                ?>
                    <tr>

                        <td>
                            <form method='post' action='viewstudentprofile.php'>
                                <label class='text-capitalize'><?php echo $row['s_name']; ?> </label>
                        </td>
                        <td>
                            <input class='text-uppercase' style='border:0;' name='rno' type='text' readonly
                                value="<?php echo $row['regno'];?> ">
                        </td>


                      
                        <td>
                            <?php echo $row['total']?>
                        </td>
                        <td>

                            </form>
                            <a href="#myModal<?php echo $row['id'] ?>" class="btn btn-sm btn-primary"
                                data-bs-toggle="modal">Record Payment</a>

                           <!-- Modal HTML -->
                        <div id="myModal<?php echo $row['id'] ?>" class="modal fade">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">
                                           <?php echo $row['total']; ?>
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="" method="post">
                                            <label for="" class="form-label">Student Name</label>
                                            <input type="text" name="sname" value="<?php echo $row['s_name']; ?>" readonly
                                                class="form-control">

                                            <label for="" class="form-label">Registration Number</label>
                                            <input type="text" name="regno" value="<?php echo $row['regno']; ?>" readonly
                                                class="form-control">
                                                <input type="text" name="term_name" value="<?php echo $row['term_id']; ?>" readonly hidden 
                                                class="form-control">

                                            <label for="" class="form-label">Academic Year</label>
                                            <input type="text" value="<?php
                                            $getyr=mysqli_query($conn,"select *from academic_year where id='$row[session_id]'");
                                            $result=mysqli_fetch_assoc($getyr);
                                            echo $result['sname']; ?>" readonly
                                                class="form-control">

                                            <label for="" class="form-label">Term</label>
                                            <input type="text"  value="<?php
                                            $getterm=mysqli_query($conn,"select *from term where term_id='$row[term_id]'");
                                            $result=mysqli_fetch_assoc($getterm);
                                             echo $result['term_name']; ?>" readonly
                                                class="form-control">
                                                
                                                <label for="" class="form-label">Class</label>
                                                <?php $getclassname=mysqli_query($conn,"select *from class where class_id='$row[class]'");
                                                $ret=mysqli_fetch_assoc($getclassname);
                                                $cname=$ret['class_name'];
                                                
                                                ?>
                                           

                                                <input type="text" name="c" value="<?php echo $cname ; ?>" readonly
                                                class="form-control">

                                                <input type="text" name="class" value="<?php echo $row['class'] ; ?>" hidden readonly
                                                class="form-control">
                                                <label for="" class="form-label">Fee Amount</label>
                                            <input type="text" name="total_fee" value="<?php echo $row['total']; ?>" readonly
                                                class="form-control">
                                                <label for="" class="form-label">Paid</label> <br>
                                            <?php
                                            $check = mysqli_query($conn, "select *from payments where regno='$row[regno]' and term='$row[term_id]'");
                                            if(mysqli_num_rows($check)>0){
                                            while($rs=mysqli_fetch_assoc($check)){
                                            ?>
                                            <input type="text" name="invoice" value="<?php echo $rs['amount_paid']; ?>" readonly
                                                class="form-control ">
                                            <?php } } else{

?>
                                            <input type="text" name="invoice" value="<?php echo 0; ?>" readonly
                                                class="form-control ">
                                            <?php

                                            }?>
                                            
                                                <label for="" class="form-label">Transaction Id</label>
                                            <input type="text" name="transid" class="form-control" required>


                                            <label for="" class="form-label">Enter Total Amount paid</label>
                                            <input type="number" name="paid" class="form-control" required>

                                            <center> <input type="submit" name="record" class="btn btn-secondary m-3"
                                                    value="save data"></center>
                                        </form>

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
                </table>
                <?php  }
                ?>
            </div><?php
                
        }
        else{
            echo "<div class='lead mt-2 text-dark'>No records found in the database</div>";
        }
        
    }?>



        </div>
        <div class="col-md">

<p class="fw-bold p-0 mt-5 fs-4 lead">Search by class</p>

<div class="row">
    <div class="col-md-6">
        <form action="class.php" method="post">
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
   



<div class="col-md">
    <center><input type="submit" value="GO" name="submit" id="formsubmit" class="btn btn-primary mt-3"></center>
</div>
</div>


</form>

    </div>








    <?php 
    ?>

    <script src="https://code.jquery.com/jquery-3.6.4.js"
        integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
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
   

    function func() {
        document.getElementById('myAccordion').style.display = "none";

    }
    </script>

</body>

</html>