<?php include('connection.php');


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .tablee {
            width: 80%;
            margin: 2% auto;
            height: max-content;


        }


        .form-style-4 {
            width: 80%;
            margin: 2% auto;
            display: flex;


        }

        .sect1 {
            width: 40%;
            margin-right: 100px;
        }

        .sect2 {
            width: 40%;

        }

        .subPopup {
            position: relative;
            text-align: center;
            width: 100%;
        }

        .formPopup {
            display: none;
            position: fixed;
            left: 45%;
            top: 5%;
            transform: translate(-50%, 5%);
            border: 3px solid #999999;
            z-index: 9;
        }

        .formContainer {
            max-width: 300px;
            padding: 20px;
            background-color: #fff;
        }

        .formContainer .btn {
            padding: 12px 20px;
            border: none;
            background-color: #8ebf42;
            color: #fff;
            cursor: pointer;
            width: 100%;
            margin-bottom: 15px;
            opacity: 0.8;
        }

        .formContainer .cancel {
            background-color: #cc0000;
        }

        .formContainer .btn:hover,
        .openButton:hover {
            opacity: 1;
        }

        .openBtn {
            display: flex;
            justify-content: left;
        }

        .openButton {
            border: none;
            border-radius: 5px;
            background-color: #1c87c9;
            color: white;
            padding: 5px 10px;
            cursor: pointer;

        }

        .formContainer input[type=text],
        .formContainer input[type=number] {
            width: 80%;
            padding: 15px;
            margin: 5px 0 20px 0;
            border: none;
            background: #eee;
        }

        .formContainer input[type=text]:focus,
        .formContainer input[type=number]:focus {
            background-color: #ddd;
            outline: none;
        }

        /*class popup*/
        .classPopup {
            position: relative;
            text-align: center;
            width: 100%;
        }

        .cformPopup {
            display: none;
            position: fixed;
            left: 45%;
            top: 5%;
            transform: translate(-50%, 5%);
            border: 3px solid #999999;
            z-index: 9;
        }

        .cformContainer {
            max-width: 300px;
            padding: 20px;
            background-color: #fff;
        }

        .cformContainer .btn {
            padding: 12px 20px;
            border: none;
            background-color: #8ebf42;
            color: #fff;
            cursor: pointer;
            width: 100%;
            margin-bottom: 15px;
            opacity: 0.8;
        }

        .cformContainer .cancel {
            background-color: #cc0000;
        }

        .cformContainer .btn:hover,
        .openButton:hover {
            opacity: 1;
        }

        .cformContainer input[type=text],
        .cformContainer input[type=number] {
            width: 80%;
            padding: 15px;
            margin: 5px 0 20px 0;
            border: none;
            background: #eee;
        }

        .cformContainer input[type=text]:focus,
        .cformContainer input[type=number]:focus {
            background-color: #ddd;
            outline: none;
        }



        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td,
        th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;

        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }

        .dropbtn {
            border: none;
            border-radius: 5px;
            background-color: #1c87c9;
            color: white;
            padding: 5px 10px;
            cursor: pointer;
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .dropdown-content a {
            color: inherit;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {
            background-color: grey;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .dropdown:hover .dropbtn {
            background-color: grey;
        }
        .dispalyform form{
            width: 500px;
            border: dotted;
            margin: 2% auto;
        }
        form input{
            width: 80%;
        }
    </style>
</head>

<body>
    <?php

    if (isset($_REQUEST['login'])) {
        $classname = $_REQUEST['cname'];
        $class_id = $_REQUEST['class_id'];

        $res = mysqli_query($conn, "insert into class values('$class_id','$classname' )");
        if ($res) {
            echo "Data inserted successfully";
        } else {
            echo "error inserting data to the database";
        }
    }

    ?>
    <?php
    if (isset($_REQUEST['submit'])) {
        $subname = $_REQUEST['subname'];
        $class_id = $_REQUEST['class'];
        $subcode = $_REQUEST['subcode '];
        $res1 = mysqli_query($conn, "insert into subject values('$subname','$class_id','$subcode' )");
        if ($res1) {
            echo "Data inserted successfully";
        } else {
            echo "error inserting data to the database";
        }
    }
    ?>
    
    <div class="tablee">
        <table>
            <tr>
                <th>
                    <div class="openBtn">
                        <button class="openButton" type="button" onclick="openForm()"><strong>Add Class</strong></button>
                    </div>
                </th>

                <th>
                    <div class="openBtn">
                        <button class="openButton" type="button" onclick="openForm1()"><strong>Add subject</strong></button>
                    </div>
                </th>
            </tr>

           </table>
    </div>
    <!-- form to display subjects per class!-->
    <div class="dispalyform">
    <?php
                $opt= "";
                $selectQ = mysqli_query($conn, "SELECT *FROM victor2");
                while ($row = mysqli_fetch_array($selectQ)) {
                    $opt= $opt . "<option value=$row[class_id]>$row[class_name]</option>";
                    $row['class_id']=$v;
                    $sqlq=mysqli_query($conn, "select * from victor2 where class_id=$v");
                }?>
        <form action="">
        <select name="class" id="class">
                    <?php echo $opt; ?>
                </select> <br>
                <?php
                
                   while($s=mysqli_fetch_array($sqlq)){ 
                ?>
                <input type="text" value=<?php echo $s['subject_name'] ?>> <br>
                <label for=""></label>
               <?php  }?>
        </form>
    </div>
    <!-- form for creating class !-->
    <div class="subPopup">
        <div class="formPopup" id="popupForm">
            <form action="" class="formContainer">
                <label for="cname">Class Name</label>
                <input type="text" name="cname" placeholder="Class Name">
                <label for="class_id">Class Id</label>
                <input type="number" name="class_id" placeholder="Class_id">
                <button type="submit" class="btn-box" name="login">submit</button>
                <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
            </form>
        </div>
    </div>

    <!-- form for creating subject !-->
    <div class="classPopup">
        <div class="cformPopup" id="cForm">
            <form action="" class="cformContainer">
                <h2>Please Log in</h2>
                <label for="class_id">Class Id</label>
                <?php
                $options = "";
                $selectQuery = mysqli_query($conn, "SELECT *FROM class");
                while ($row2 = mysqli_fetch_array($selectQuery)) {
                    $options = $options . "<option value=$row2[class_id]>$row2[class_name]</option>";
                }?>
                <select name="class" id="class">
                    <?php echo $options; ?>
                </select> <br>
                <label for="subname">subject Name</label>
                <input type="text" name="subname" placeholder="subject Name">
                <label for="subcode">subject code</label>
                <input type="text" name="subcode" placeholder="subject code">
                <button type="submit" class="btn cancel" name="submit">submit</button>
                <button type="button" class="btn cancel" onclick="closeForm1()">Close</button>
            </form>
        </div>
    </div>

    <script type="text/javascript">
        function openForm() {
            document.getElementById("popupForm").style.display = "block";
        }

        function closeForm() {
            document.getElementById("popupForm").style.display = "none";
        }

        function openForm1() {
            document.getElementById("cForm").style.display = "block";
        }

        function closeForm1() {
            document.getElementById("cForm").style.display = "none";
        }
    </script>
</body>

</html>