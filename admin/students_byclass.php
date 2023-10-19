<?php include("connection.php");
session_start();
$a = $_SESSION["email"];
if (!isset($_SESSION["email"])) {

    header("location:admin_login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .mm {
            padding-top:4rem;
        }

        .mrow {
            padding-left: 10rem;
            padding-bottom: 2rem;
            padding-top: 2rem;
            padding-right: 1rem;
            margin-right: 0;
            transition: 1s;
            background-color: white;
        }
    </style>
</head>

<body>
    <?php include("header.php");
    include("sidebar.php"); ?>
    <div class="container-fluid mm ">
        <div class="container col-sm   ">

            <div class="row mrow col-md-12 ">
                <div class="title-here">
                    <h6></h6>
                </div>
                <?php
                if (isset($_REQUEST["submit"])) {
                    $i= 1;
                    ?>

                    <?php
                    $year = mysqli_real_escape_string($conn, $_REQUEST["session"]);
                    $term = mysqli_real_escape_string($conn, $_REQUEST["term_name"]);

                    $class = mysqli_real_escape_string($conn, $_REQUEST["class"]);

                    ?>
<div class="table-responsive">
                    <table class="table table-hover table-no-border table-responsive caption-top">
                        <?php
                        //get year names
                        $yrname = mysqli_query($conn, "select *from academic_year where id=$year");
                        $yr_res = mysqli_fetch_assoc($yrname);
                        $year1 = $yr_res['sname'];
                        //get term
                        $termname = mysqli_query($conn, "select *from term where term_id=$term");
                        $term_res = mysqli_fetch_assoc($termname);
                        $term1 = $term_res['term_name'];
                        //get class
                        $classname = mysqli_query($conn, "select *from class where class_id=$class");
                        $class_res = mysqli_fetch_assoc($classname);
                        $class1 = $class_res['class_name'];

                        $sql = mysqli_query($conn, "select *from student where term_id=$term and class=$class");
                        if (mysqli_num_rows($sql) > 0) {
                            ?>
                            <caption>List of students in Year:
                                <?php echo $year1 ?> Term:
                                <?php echo $term1 ?> Class:
                                <?php echo $class1 ?>
                            </caption>
                            <tr style="background-color:#0036AB; color:white">
                            <th>S/no</th>
                                <th>Student Name</th>
                                <th>Registration Number</th>
                                <th>Parent's email</th>
                                <th>Parent's No.</th>
                                <th>Actions</th>
                            </tr>
                            <?php
                            while ($row = mysqli_fetch_assoc($sql)) {
                                ?>
                                <tr>
                                    <td>
                                        <?php echo $i?>
                                        <?php $i++; ?>
                                    </td>
                                    <td>
                                        <form method='post' action='viewstudentprofile.php'>
                                            <label class='text-capitalize'>
                                                <?php echo $row['s_name']; ?>
                                            </label>
                                    </td>
                                    <td>
                                        <input class='text-uppercase' hidden style='border:0;' name='rno' type='text' readonly value=<?php echo $row['regno'] ?>>
                                        <?php echo $row['regno']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['email']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['pno']; ?>
                                    </td>
                                    <td>
                                    <button type='submit' name='profile' class='bt btn-info' style="float:right" value='view profile'><i class="fa fa-eye"></i> View Profile</button>
                           
                                        
                                        </form>
                                        </a>
                                    </td>
                                    
                                </tr>
                            <?php  }
                            ?>
                        </table>
                        </div>
                    <?php } else {
                            ?>
                        <div class="alert mt-2 alert-danger alert-dismissible fade show" role="alert">
                            <strong>Sorry!!</strong> No Records found.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <?php
                        } ?>


                </div>
            </div>
        </div>



        </div>
        </div>
    <?php }

                ?>
    </div>
    </div>
    </div>
    <script src="sidebar.js"></script>
</body>

</html>