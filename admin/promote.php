<?php
include('../connection.php');
session_start();

$_GET['id'];
$id = $_GET['id'];
$option4 = "";
$options = "";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="ol.png">
    <title>Document</title>
    <style>
        .row {
            margin-top: 6em;
        }
    </style>
</head>

<body>
    <?php include('header.php'); ?>
    <div class="container">
        <div class="container">
            <div class="row" style="padding-top:13rem;">


                <?php

                $getstudentdata = mysqli_query($conn, "select *from student where id=$id");
                $student_res = mysqli_fetch_assoc($getstudentdata);
                $reg = $student_res['regno'];
                $term = $student_res['term_id'];
                $current_year = $student_res['session_id'];
                $current_class = $student_res['class'];
                $fee_balance = $student_res['total'];
                $student_name = $student_res['s_name'];

                //first get max exam_id that belongs to students' current term(exams belong to a term).
                $getmaxexam = mysqli_query($conn, "select max(exam_id) as m from exam where term_id=$term");
                $ree = mysqli_fetch_assoc($getmaxexam);
                $max_exam_id = $ree['m'];

                $check = mysqli_query($conn, "select *from exam where term_id=$term");
                if (mysqli_num_rows($check) > 0) {

                    $rescheck = mysqli_fetch_assoc($check);
                    $getstudentexam = mysqli_query($conn, "select *from results where exam_id = '$max_exam_id' and regno='$reg'");
                    if (mysqli_num_rows($getstudentexam) > 0) {
                        if ($fee_balance > 0) {
                            $record_arrear = mysqli_query($conn, "insert into arrears values(0,'$reg',$current_year,$term,$current_class,$fee_balance,'$student_name')");
                            if ($record_arrear) {
                                $update_student_fee = mysqli_query($conn, "update student set amount=0 where regno='$reg'");
                            } else {
                                echo "A problem occurred while recording arrear";
                            }
                        }
                        //promote student to next year i.e class
                        // max term
                        $getyear = mysqli_query($conn, "select *from term where term_id=$term");
                        $ree2 = mysqli_fetch_assoc($getyear);
                        $yrid = $ree2['year'];
                        $getmaxterm = mysqli_query($conn, "select max(term_id) as t from term where year=$yrid");
                        $ree1 = mysqli_fetch_assoc($getmaxterm);
                        $mxt = $ree1['t'];
                        if ($term == $mxt) {
                            $newyear = $current_year + 1;
                            $newterm = mysqli_query($conn, "select  min(term_id) as min_t from term where year=$newyear");
                            $s = mysqli_fetch_assoc($newterm);
                            $new_term_id = $s['min_t'];
                            $newclass = $current_class + 1;
                            $newfee = mysqli_query($conn, "select *from termfees where term=$new_term_id and class=$newclass");
                            if (mysqli_num_rows($newfee) > 0) {
                                $fees_res = mysqli_fetch_assoc($newfee);
                                $new_term_fees = $fees_res['amount'];
                                //update the data
                
                                $updatequery = mysqli_query($conn, "update student set term_id=$new_term_id,session_id=$newyear,total=$new_term_fees, class=$newclass where regno='$reg'");
                                if ($updatequery) {
                                    ?>
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <strong>Success!!</strong>Student has been promoted successfully to the next class!
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>

                                    <?php
                                } else {

                                    ?>
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>Sorry!!</strong> a problem has occured while updating student term. Please contact admin.
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>

                                    <?php
                                }
                            } else {
                                $new_term_fees = 0;
                                //update the data
                
                                $updatequery = mysqli_query($conn, "update student set term_id=$new_term_id,session_id=$newyear,total=$new_term_fees, class=$newclass where regno='$reg'");
                                if ($updatequery) {
                                    ?>
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <strong>Success!!</strong>Student has been promoted successfully to the next class!
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>

                                    <?php
                                } else {

                                    ?>
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>Sorry!!</strong> a problem has occured while updating student term. Please contact admin.
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>

                                    <?php
                                }
                            }


                            echo $newyear . "-" . $new_term_id . "-" . $newclass;
                        } else {
                            //check if student has paid fees
                
                            //promote student to next term of the same class
                            $new_term_id = $term + 1;
                            $newfee = mysqli_query($conn, "select *from termfees where term=$new_term_id and class=$current_class");
                            if (mysqli_num_rows($newfee) > 0) {
                                $fees_res = mysqli_fetch_assoc($newfee);
                                $new_term_fees = $fees_res['amount'];
                                //update the data
                
                                $updatequery = mysqli_query($conn, "update student set term_id=$new_term_id,total=$new_term_fees where regno='$reg'");
                                if ($updatequery) {
                                    ?>
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <strong>Success!!</strong>Student has been promoted successfully to the next term!
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>

                                    <?php
                                } else {

                                    ?>
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>Sorry!!</strong> a problem has occured while updating student term. Please contact admin.
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>

                                    <?php
                                }
                            } else {
                                $new_term_fees = 0;
                                //update the data
                
                                $updatequery = mysqli_query($conn, "update student set term_id=$new_term_id,total=$new_term_fees where regno='$reg'");
                                if ($updatequery) {
                                    ?>
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <strong>Success!!</strong>Student has been promoted successfully to the next term!
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>

                                    <?php
                                } else {

                                    ?>
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>Sorry!!</strong> a problem has occured while updating student term. Please contact admin.
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>

                                    <?php
                                }

                            }
                        }
                    } else {
                        ?>
                        <div class="alert  alert-danger alert-dismissible fade show" role="alert">
                            <strong>Sorry!!</strong>Student has to be graded first.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>

                        <?php
                    }
                }


                ?>
                </container>
</body>

</html>