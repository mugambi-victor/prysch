<?php
include('../connection.php');
session_start();
$a=$_SESSION['accounts_email'];
if(!isset($a)){
    header('location:accounts_login.php');
   
} 
$_GET['id'];
$id = $_GET['id'];
$option4="";
$options="";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../admin/ol.png" >
    <title>Accounts|Courses</title>
</head>
<body>
    <?php
    include('header.php');
    include('sidebar.php');
    ?>
    <?php

    $getterms = mysqli_query($conn, "select *from term where year=$id");

    
if(mysqli_num_rows($getterms)>0){

?>
<div class="container col-sm">
            <table class="table mt-3 table-bordered table-striped table-responsive-sm caption-top">
               
                <tr>
                    <th>
                        <p>
                            S/N
                        </p>
                    </th>
                   
                    <th style="width:50%;">
                        <p class="text-capitalize ">Term name</p>
                    </th>
                
                   
                    <th>
                        <p class="text-capitalize text-wrap">
                            Set Fees
                        </p>
                    </th>
                    

                </tr>
                <?php

        $x = 1;
       
        while ($result = mysqli_fetch_assoc($getterms)) {
           
            ?>
                <form action="" method="post">
                    <tr>
                        <td>
                            <?php echo $x++; ?>
                        </td>
                        
                        <td class="text-capitalize">
                            <?php echo $result['term_name']; ?>
                        </td>
                        
                        
                        <td>
                          
                        <a href="setfee.php?name=<?php echo $result['term_name']; ?>"  class="btn btn-primary"
                          role="button">Set Fees</a>

                    </td>
                        
                       
                    </tr>
                </form>
                <?php

        }
            ?>
            </table>
    </div>
            <?php
    } else {
        ?>
            <div class="alert alert-info mt-4 alert-dismissible fade show" role="alert"><strong>Sorry,</strong> No
                courses here
                <a href="classs.php" class="ms-5">click here to add some</a>
                <a href="viewcourses.php"><button type="button" class="btn-close" data-bs-dismiss="alert"
                        aria-label="Close"></button></a>
            </div>
    </div>
            <?php
    }

?>
<script src="../jquery.js"></script>
<script>
    $('#yearlist').on('change', function() {
    var yr_id = this.value;

    $.ajax({
        type: "POST",
        url: "getsemester.php",
        data: 'yr_id=' + yr_id,
        success: function(results) {
            $("#sem-list").html(results);
        }
    });
});
</script>
</body>
</html>
