<?php
include('../connection.php');

session_start();
$a=$_SESSION['accounts_email'];
if(!isset($a)){
    header('location:accounts_login.php');
   
} ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../admin/ol.png">
    <title>Accounts|Departments</title>
    <style>
   .mm{
        padding-top:10rem;
    }

    .mrow {
        padding-left: 10rem;
        transition: 1s;
    }
    </style>
</head>

<body>
    <?php

include('header.php');
include('sidebar.php');
?>
    <div class="container mm col-sm">
        <div class="row mrow">
    
            <?php
        //set fees
if(isset($_REQUEST['set'])){
    $year=$_REQUEST['year'];
    $term=$_REQUEST['term'];
    $class=$_REQUEST['class'];
    $total=$_REQUEST['total'];
    

    $arget="fee_structures/".basename( $_FILES["uploads"]["name"]);
    $filename = $_FILES["uploads"]["name"];

    $check=mysqli_query($conn,"select *from termfees where term=$term and class=$class");
    if(mysqli_num_rows($check)==0){
        $senddata=mysqli_query($conn, "insert into termfees values (0,$year,$term,$class,'$filename',$total)");

        //update student fee 
        $checker=mysqli_query($conn,"select *from student where class=$class and term_id=$term and session_id=$year");
        $rs=mysqli_fetch_assoc($checker);
        if(mysqli_num_rows($checker)>0){
            $newtotal=$rs['total']+$total;
      echo $newtotal;
        if($newtotal>0){
            $fee_status=1;
        }else{
            $fee_status=0;
        }
        $squery=mysqli_query($conn,"update student set total=$newtotal,fee_status=$fee_status,fee_structure='$filename' where class=$class and term_id=$term and session_id=$year");

        if($squery){
            echo "student fee updated successfully!";
        }else{
            echo "sorry! a problem occurred while updating student data";
        }
        }
        

        if($senddata && move_uploaded_file($_FILES['uploads']['tmp_name'],$arget)){ ?>
           
            <!-- Success Alert -->
            <div class='alert alert-success alert-dismissible fade show'>
            <strong>Success!</strong> Data inserted to the database.
    <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
</div><?php
            
          }
          else{?>
            <!-- Error Alert -->
            <div class="alert alert-danger alert-dismissible fade show">
                <strong>Error!</strong> A problem has been occurred while submitting your data.
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            <?php
          }
    }
    else{
        
        ?>
           
            <!-- Success Alert -->
            <div class='alert alert-info alert-dismissible fade show'>
            <strong>Info!</strong> fees already added, unless you update fee;
    <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
</div><?php
    }
}
//update fees
elseif(isset($_REQUEST['update'])){
    $year=$_REQUEST['year'];
    $term=$_REQUEST['term'];
    $class=$_REQUEST['class'];
    $total=$_REQUEST['total'];
 

    $arget="fee_structures/".basename( $_FILES["uploads"]["name"]);
    $filename = $_FILES["uploads"]["name"];

    $check=mysqli_query($conn,"select *from termfees where term=$term and class=$class");
    if(mysqli_num_rows($check)>0){
        $senddata=mysqli_query($conn, "update termfees set fee_structure='$filename', amount=$total");
        if($senddata && move_uploaded_file($_FILES['uploads']['tmp_name'],$arget)){ ?>
            <!-- Success Alert -->
            <div class='alert alert-success alert-dismissible fade show'>
            <strong>Success!</strong> Data inserted to the database.
    <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
</div>
            
            <?php
            
          }
          else{?>
            <!-- Error Alert -->
            <div class="alert alert-danger alert-dismissible fade show">
                <strong>Error!</strong> A problem has been occurred while submitting your data.
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            <?php
          }
}
else{
    echo "cant read data, please set fees first";
}}

?>
            <div class="row">
                <div class="col-md">
                    <p class="lead mt-2 text-center">Set Term Fees</p>
                    <?php
$select=mysqli_query($conn,"select *from academic_year");
?>
                    <form action="" method="post" enctype="multipart/form-data">
                        <label for="year" class="form-label">Academic year</label>
                        <select name="year" class="form-select" id="session-list">
                            <option value="">select academic year</option>
                            <?php
        while($rs=mysqli_fetch_assoc($select)){
            ?>
                            <option value="<?php echo $rs['id']; ?>"><?php echo $rs['sname']; ?></option>
                            <?php
        }
        ?>
                        </select>

                        <label for="term" class="form-label">Term</label>
                        <select name="term" id="term-list" class="form-select">
                            <option value="">select Term</option>
                        </select>

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
                        <label for="uploads" class="form-label ">Fee structure</label>
                        <input type="file" name="uploads" class="form-control">

                        <label for="total" class="form-label ">Fee structure</label>
                        <input type="number" placeholder="enter a number" name="total" class="form-control">

                        <input type="submit" value="set fee" name="set" class="btn btn-outline-primary mb-3 mt-3 ">
                        <input type="submit" value="update fee" name="update" class="btn mb-3 btn-outline-info mt-3 ">
                    </form>
                </div>

                <!-- view fee summary -->
                <div class="col-md">

                    <p class="lead mt-2 text-center">View Fee summary</p>
                    <?php
                $select=mysqli_query($conn,"select *from academic_year");
?>
                    <form action="" method="post">
                    <label for="year" class="form-label">Academic year</label>
                        <select name="year" class="form-select" id="session-lists">
                            <option value="">select academic year</option>
                            <?php
        while($rs=mysqli_fetch_assoc($select)){
            ?>
                            <option value="<?php echo $rs['id']; ?>"><?php echo $rs['sname']; ?></option>
                            <?php
        }
        ?>
                        </select>

                        <label for="term" class="form-label">Term</label>
                        <select name="term" id="term-lists" class="form-select">
                            <option value="">select Term</option>
                        </select>

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

                        <input type="submit" name="view" class="btn mt-2 btn-primary" value="view fees">
                    </form>
                    <?php
                if(isset($_REQUEST['view'])){
                    $year=$_REQUEST['year'];
                    $class=$_REQUEST['class'];
                    $term=$_REQUEST['term'];
                
                $selectst=mysqli_query($conn,"select *from termfees where year=$year and term=$term and class=$class ");

                ?>

                    <table class="table mt-2 table-striped">

                        <tr>

                            <th>
                                s/N
                            </th>
                            <th>
                                Term Name
                            </th>
                            <th>
                                Fee amount
                            </th>
                        </tr>
                        <?php 
              
                $x=1;
                while($rt=mysqli_fetch_assoc($selectst)){
                    ?>
                        <tr>
                            <td>
                                <?php echo $x++;
                            ?>
                            </td>
                            <td>
                                <?php 
                            $gettermname=mysqli_query($conn,"select *from term where term_id='$rt[term]'");
                            $res=mysqli_fetch_assoc($gettermname);
                            echo $res['term_name']?>
                            </td>
                            <td>
                                <?php echo $rt['amount'] ?>
                            </td>
                        </tr>
                        <?php
                }}
                ?>
                    </table>
                </div>
            </div>

        </div>
</body>

<script src="../jquery.js"></script>
<script>
function PrintPage() {
    window.print();
}
$('#session-list').on('change', function() {
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
$('#session-lists').on('change', function() {
    var session_id = this.value;
    $.ajax({
        type: "POST",
        url: "getterms.php",
        data: 'session_id=' + session_id,
        success: function(result) {
            $("#term-lists").html(result);
        }
    });
});
const sideBar = document.querySelector('.sidebar');
const toggler = document.querySelector('.toggler');
const mrow= document.querySelector('.mrow');
const container= document.querySelector('.container');
  
  toggler.addEventListener('click', function() {
   
    if (sideBar.style.marginLeft== '-250px')
    {
        sideBar.style.marginLeft= '0';
        mrow.style.paddingLeft= '10rem';
    }
    else 
    {
        
        sideBar.style.marginLeft= '-250px';
        mrow.style.paddingLeft= '2rem';
    }
  });

</script>


</html>