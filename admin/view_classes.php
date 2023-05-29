<?php include('connection.php') ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table.paleBlueRows {
            font-family: "Times New Roman", Times, serif;
            border: 2px solid #FFFFFF;
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
            font-size: larger;
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
        .classes{
            margin: 25px auto;
        }
    </style>
</head>
<body>
    <?php include('header.php')?>
    <div class="classes">
    <table class="paleBlueRows">
            <thead>
                <tr>
                    <th style="width: 20%;">No</th>
                    <th style="width: 20%;">Class Name</th>
                    <th style="width: 20%;">Class Id</th>
                    
                </tr>
            </thead>

            <?php

            $selectQuery = mysqli_query($conn, "SELECT * FROM `class`");
            $i = 1;
            while ($r_res = mysqli_fetch_assoc($selectQuery)) {
            ?>

                <tbody>
                    <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $r_res['class_name']; ?></td>
                        <td> <?php echo $r_res['class_id']; ?></td>
                      
                    </tr>
                </tbody>

            <?php }

            ?>
        </table>
    </div>
</body>
</html>