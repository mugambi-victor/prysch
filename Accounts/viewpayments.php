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
    
    
    <link rel="shortcut icon" href="../admin/ol.png" >
    <title>ViewPayments</title>
    <style>
        a:hover{
            background-color: #8432DF;
        }
       
    </style>
</head>
<body>
<?php include("header.php"); 
include('sidebar.php')?>

    <div class="container col-sm m-5">
       
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
    <form action="" method="post">
    <div class="row">
    <div class="col-sm">
                <input type="text" name="searchbox" placeholder="search registration no..." class="form-control" required></div>
                <div class="col-sm m-0">
                <input type="submit" name="search" class="btn btn-primary" value="Search">
                </div>
         
             
            
        </form>
    </div>

    <?php
    if(isset($_REQUEST['search'])){
        $regno=$_REQUEST['searchbox'];

?>
<div class="col-sm">
 
<table  class="table mt-3 table-bordered table-striped caption-top">
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
        $yrid=$term['year'];
        $getyear=mysqli_query($conn,"select *from academic_year where id=$yrid");
        $year=mysqli_fetch_assoc($getyear);
        $yrname=$year['sname'];
        echo $yrname." - ".$termname; ?></td>
      
        <td><a href="#" class="btn btn-sm btn-primary">Print Receipt</a></td>
    </tr>
    <?php
}
?> </table> <?php
    }
    else{
        echo "no record found";
        }
        }?>
                    
               

    
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



    
        </div></div>
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
    </script>

</body>
</html>