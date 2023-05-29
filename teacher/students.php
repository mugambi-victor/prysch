<?php
include('../connection.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="../st.css">
    <style>
        table.paleBlueRows {
            font-family: "Times New Roman", Times, serif;
            border: 1px solid #FFFFFF;
            width: 80%;
            height: max-content;
            text-align: center;
            border-collapse: collapse;
            margin-left: 17%;
            
        }

        table.paleBlueRows td,
        table.paleBlueRows th {
            border: 1px solid #FFFFFF;
            padding: 3px 2px;
        }

        table.paleBlueRows tbody td {
            font-size: 15px;
            padding: 10px;
        }

        table.paleBlueRows tr:nth-child(even) {
            background: #D0E4F5;
        }

        table.paleBlueRows thead {
            background: #0B6FA4;
            border-bottom: 5px solid #FFFFFF;
        }

        table.paleBlueRows thead th {
            font-size: 17px;
            font-weight: bold;
            color: #FFFFFF;
            text-align: center;
            border-left: 2px solid #FFFFFF;
        }

        table.paleBlueRows thead th:first-child {
            border-left: none;
        }
    </style>
</head>

<body>
<div class="header">
        <a href="#default" class="logo">welcome</a>
        <div class="header-right">
            <a class="active" href="t_dashboard.php">Home</a>
            <div class="subnav">
                <button class="subnavbtn">Profile <i class="fa fa-caret-down"></i></button>
                <div class="subnav-content">
                    <a href="#link1">View Profile</a>
                    <a href="../logout.php"><h2><font color="red">Logout</font></h2> </a>
                    
                </div>
            </div>
            
        </div>
    </div>
   
        <table class="paleBlueRows">
            <thead>
                <tr>
                    <th style="width: 20%;">No</th>
                    <th style="width: 20%;">Name</th>
                    <th style="width: 20%;">Registration Number</th>
                    <th style="width: 20%;">Class </th>
                    <th style="width: 20%;">Year</th>
                </tr>
            </thead>

            <?php

            $selectQuery = mysqli_query($conn, "SELECT `s_name`, `regno`, `password`, `class`, `syear` FROM `student`");
            $i = 1;
            while ($r_res = mysqli_fetch_assoc($selectQuery)) {
            ?>

                <tbody>
                    <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $r_res['s_name']; ?></td>
                        <td> <?php echo $r_res['regno']; ?></td>
                        <td><?php echo $r_res['class']; ?></td>
                        <td> <?php echo $r_res['syear']; ?></td>
                    </tr>
                </tbody>

            <?php }

            ?>
        </table>


</body>

</html>