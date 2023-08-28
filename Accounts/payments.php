<?php include('../connection.php');
session_start();
$a=$_SESSION['accounts_email'];
if(!isset($a)){
    header('location:accounts_login.php');
   
}  

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../admin/ol.png" >
    <title>ClassPayments</title>
    <style>
        
    .mm {
        padding-top: 10rem;
    }

    .mrow {
       
        transition: 1s;
    }
    </style>
</head>
<body>
    <?php include('header.php');
    include('sidebar.php'); ?>
    <div class="container mm col-md">

   <div class="mrow">
   
    <?php
    if(isset($_REQUEST['submit'])){
        $year=$_REQUEST['year'];
        $term=$_REQUEST['term_name'];
        $class=$_REQUEST['class'];

        $getyearname=mysqli_query($conn,"select *from academic_year where id=$year");
        $res=mysqli_fetch_assoc($getyearname);
        $yearname=$res['sname'];

        $gettermname=mysqli_query($conn,"select *from term where term_id=$term");
        $res1=mysqli_fetch_assoc($gettermname);
        $termname=$res1['term_name'];

        $getclassname=mysqli_query($conn,"select *from class where class_id=$class");
        $res3=mysqli_fetch_assoc($getclassname);
        $classname=$res3['class_name'];

$x=1;
        $getstudents=mysqli_query($conn,"select *from payments where term=$term and class=$class");
        
            ?>
            <table class="table table-striped table-bordered  text-capitalize caption-top">
                <caption>
                    List of payments in <br> year: <?php echo $yearname."<br> term: ".$termname."<br> class: ".$classname;?>
                </caption>
                <tr>
                    <th>
                        s/N
                    </th>
                    <th>
                        regno
                    </th>
                <th>
                    name
                </th>
                <th>
                    amount
                </th>
                <th>
                    action
                </th>
                </tr>
                <?php
while($res=mysqli_fetch_assoc($getstudents)){
?>
<tr>
    <td>
        <?php echo $x++;?>
    </td>
    <td>
        <?php echo $res['regno']; ?>
    </td>
    <td>
        <?php $getname=mysqli_query($conn,"select *from student where regno='$res[regno]'");
        $ret=mysqli_fetch_assoc($getname);
        echo $ret['s_name']; ?>
    </td>
    <td>
        <?php echo $res['amount_paid']; ?>
    </td>
    <td>
                               
                            </form>
                            
                            <a href="#myModal<?php echo $res['id'] ?>" class="btn btn-sm btn-primary"
                            data-bs-toggle="modal">Payment Info</a>

                        <!-- Modal HTML -->
                        <div id="myModal<?php echo $res['id'] ?>" class="modal fade">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">
                                           <?php echo $res['amount_paid']; ?>
                                        </h5>
                                        <button type="button" title="close" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="" method="post">
                                            <label for="sname" class="form-label">Student Name</label>
                                            <input type="text" name="sname" aria-label="sname" value="<?php echo $ret['s_name']; ?>" readonly
                                                class="form-control">

                                            <label for="regno" class="form-label">Registration Number</label>
                                            <input type="text" aria-label="regno" name="regno" value="<?php echo $res['regno']; ?>" readonly
                                                class="form-control">

                                            <label for="year" class="form-label">Academic Year</label>
                                            <input  type="text" value="<?php
                                            $getyear=mysqli_query($conn,"select *from academic_year where id='$ret[session_id]'");
                                            $result=mysqli_fetch_assoc($getyear);
                                            echo $result['sname']; ?>" readonly
                                                class="form-control" aria-label="courseyear">

                                            <label for="term" class="form-label">Term</label>
                                            <input type="term" aria-label="term" value="<?php
                                            $getterm=mysqli_query($conn,"select *from term where term_id='$res[term]'");
                                            $result=mysqli_fetch_assoc($getterm);
                                             echo $result['term_name']; ?>" readonly
                                                class="form-control">
                                                <label for="total_fee" class="form-label">Fee Amount</label>
                                            <input type="text" name="total_fee" aria-label="total_fee" value="<?php
                                            $getfee=mysqli_query($conn,"select *from termfees where term='$res[term]'");
                                            $rest=mysqli_fetch_assoc($getfee);
                                            echo $rest['amount']; ?>" readonly
                                                class="form-control">
                                                <label for="invoice" class="form-label">Payments</label> <br>
                                            <?php
                                            $check = mysqli_query($conn, "select *from payments where regno='$res[regno]' and term=$term");
                                            
                                                $sum=0;
                                            while($rs=mysqli_fetch_assoc($check)){
                                                $sum=$sum+$rs['amount_paid'];
                                            ?>
                                            <input type="text" aria-label="invoice" name="invoice" value="<?php echo $rs['amount_paid']; ?>" readonly
                                                class="form-control ">
                                          <?php } 
                                          if($sum>=$rest['amount']){
                                           ?>
                                           <p class="lead fs-1 fw-bold text-center">Paid</p>
                                           <i>With overpay of(<?php echo $sum-$rest['amount']; ?>) <br>Overpay will be acknowledged in the next semester</i>
                                           <?php
                                          }else{
                                            

                                            $b=$rest['amount']-$sum;
                                            
                                            ?>
                                             <label for="b" class="form-label">Balance</label>
                                            <input type="text" aria-label="b" readonly class="form-control" name="b" value="<?php echo $b ?>">
                                            <?php
                                          }
                                          ?>
                                            
                                            
                                              <!-- <label for="" class="form-label">Transaction Id</label>
                                            <input type="text" name="transid" class="form-control" required>


                                            <label for="" class="form-label">Enter Total Amount paid</label>
                                            <input type="number" name="paid" class="form-control" required> -->

                                            <!-- <center> <input type="submit" name="record" class="btn btn-secondary m-3"
                                                    value="save data"></center> -->
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
     
            <?php
        }
    }
    ?>
           </table>
</div>
<script>
const sideBar = document.querySelector('.sidebar');
const toggler = document.querySelector('.toggler');
const mrow= document.querySelector('.mrow');
const container= document.querySelector('.container');
  
  toggler.addEventListener('click', function() {
   
    if (sideBar.style.marginLeft== '-250px')
    {
        sideBar.style.marginLeft= '0';
       
    }
    else 
    {
        
        sideBar.style.marginLeft= '-250px';
       
    }
  });

</script>
</body>
</html>