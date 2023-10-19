<?php include('../connection.php');
session_start();
if (isset($_GET['data'])) {
    $s = $_GET['data'];

    $getp = mysqli_query($conn, "select *from acknowledged_invoices where transaction_id=$s");
    $resp = mysqli_fetch_assoc($getp);
    $regno = $resp['regno'];
    $query = mysqli_query($conn, "select *from student where regno='$regno'");
    $res = mysqli_fetch_assoc($query);


    //get payments
    $getpp = mysqli_query($conn, "select *from payments where trans_id=$s");
    $rts = mysqli_fetch_assoc($getpp);
    $classs = $rts['class'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
        </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400&display=swap" rel="stylesheet">
<style>
    *{
        margin:0;
    }
    @media(max-width:997px)
    {
        
    }
</style>
</head>

<body class="text-capitalize  ">
    <div class="container-fluid col-md-5 col-sm-12 justify-content-around " style="background-color:whitesmoke;">
        <div class="row ">
            <div class="justify-content-center col-md-12 " style="display:flex;">
                <img src="../images/shyne.png" class="d-block" height="80" alt="Logo" />
                <p class="lead text-wrap text-dark fw-bold mt-1 ms-1" style="width:6rem; font-family:monospace ">SHYNE
                    STUDENT FINANCE</p>
                <div class="text-center pt-4 me-1">
                    <h4 class="text-uppercase">student finance</h4>
                    <p class="lead text-capitalize fw-bold">
                        Receipt
                    </p>
                </div>
                <div class="col-md text-end ">
                    <h6>PO BOX 60200</h6>
                    <h6>TEL: <br> 0740843795</h6>

                </div>
            </div>
            <hr>
        </div>
        <div class="row">


        </div>
    </div>
    <div class="container col-md-5 col-sm-12 justify-content-around" style="background-color:whitesmoke;">


        <form action="" method="post">
            <div class="row">
                <div class="col-sm">
                    <label for="sname" class="form-label fw-bold">Student Name: </label>
                    <label for="sname" class="form-label">
                        <?php echo $res['s_name']; ?>
                    </label>
                </div>
                <div class="col-sm">
                    <label for="regno" class="form-label fw-bold">Registration Number: </label>
                    <label for="regno" class="form-label">
                        <?php echo $resp['regno']; ?>
                    </label>
                </div>
            </div>

            <div class="row">
                <div class="col-sm">
                    <label for="year" class="form-label fw-bold">Academic Year: </label>

                    <?php
                    $getyear = mysqli_query($conn, "select *from academic_year where id='$res[session_id]'");
                    $result = mysqli_fetch_assoc($getyear);
                    ?>
                    <label for="year" class="form-label">
                        <?php echo $result['sname']; ?>
                    </label>
                </div>
                    <div class="col-sm">
                        <label for="term" class="form-label fw-bold">Term: </label>
                        <?php
                        $getterm = mysqli_query($conn, "select *from term where term_id='$rts[term]'");
                        $result = mysqli_fetch_assoc($getterm);
                        ?>
                        <label for="year" class="form-label">
                            <?php echo $result['term_name']; ?>
                        </label>
                    </div>
                </div>



                <label for="student_grade" class="form-label fw-bold">Student Grade: </label>
                <?php
                $getclass = mysqli_query($conn, "select *from class where class_id=$classs");
                $result = mysqli_fetch_assoc($getclass);
                ?>
                <label for="year" class="form-label">
                    <?php echo $result['class_name']; ?>
                </label>
                <div class="row">
                    <div class="col-sm">
                        <label for="transaction_id" class="fw-bold form-label">TransactionID: </label>
                        <label for="year" class="form-label">
                            <?php echo $s; ?>
                        </label>
                    </div>
                    <div class="col-sm">
                        <label for="term" class=" fw-bold form-label">Transaction Amount: </label>
                        <?php
                        ?>
                        <label for="year" class="form-label">
                            <?php echo $rts['amount_paid']; ?>
                        </label>
                    </div>

                </div>
                <div class="row">
                    <div class="col-sm">
                        <table class="table  table-striped text-capitalize table-bordered">
                            <thead>
                                <tr>
                                    <th>S/NO</th>
                                    <th>Description</th>
                                    <th>Paid Amount</th>
                                    <th>Invoice balance</th>
                                </tr>
                            </thead>
                            <!-- get invoices associated with payment -->
                            <?php
                            $getpayments = mysqli_query($conn, "select *from acknowledged_Invoices where transaction_id='$rts[trans_id]'");
                            ?>

                            <?php
                            if (mysqli_num_rows($getpayments) > 0) {
                                $i = 1;
                                ?>

                                <?php
                                while ($ress = mysqli_fetch_assoc($getpayments)) {
                                    ?>
                                    <tr>
                                        <td>
                                            <?php echo $i; ?>
                                        </td>
                                        <td>
                                            <?php echo $ress['invoice_details']; ?>
                                        </td>
                                        <td>
                                            <?php echo $ress['paid_amt']; ?>
                                        </td>
                                        <td>
                                            <?php echo $ress['invoice_balance']; ?>
                                        </td>
                                    </tr>
                                    <?php
                                    $i++;
                                }
                                ?>
                            </table>
                            <?php
                            }
                            ?>
                    </div>
                </div>

        </form>
    </div>
</body>

</html>