<?php
include('../connection.php');
include('grades.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
    $sql=mysqli_query($conn, "select * from subject where class_id='$res[class]'");
    $r=mysqli_fetch_assoc($sql);
    if(!$r){
        echo ("hi");
    }else
    {
        echo("htti");
    }
    ?>
</body>
</html>