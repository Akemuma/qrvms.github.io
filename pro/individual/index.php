<?php
if (!isset($file_access)) die("Direct File Access Denied");
?>

<div class="content">
    <div class="container-fluid">
        <?php
        if (!isset($_POST['submit'])) {
        ?>
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-header alert-success">
                        <h5 class="m-0">Quick Tips</h5>
                    </div>
                    <div class="card-body">
                        Use the links at the left.
                        <br />You can see list of Visitation-Reason by clicking on "New Visitation". The system will display list
                        of available Visitation-Reason for you which you can view and make Visitations from. <br>Before your
                        Visitations are saved, you are redirected to make payment. <br>After a successful payment, system
                        generates your ticket ID for you which you are required to bring to the Venue. <br>You are
                        allowed to view all your Visitation history by clicking on "View Visitations".
                    </div>
                </div>
            </div><?php
                    } else {
                        $class = $_POST['class'];
                        $number = $_POST['number'];
                        $VisitSchedule_id = $_POST['id'];
                        if ($number < 1) die("Invalid Number");
                        ?>

            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-header alert-success">
                            <h5 class="m-0">Visitation Preview</h5>
                        </div>
                        <div class="card-body">
                            <div class="callout callout-info">
                                <h5><i class="fas fa-info"></i> <?php echo ucwords($class), " Class" ?>:</h5>
                                You are about to Schedule
                                <?php echo $number, " Ticket", $number > 1 ? 's' : '', ' for ', getLocationFromVisitSchedule($VisitSchedule_id); ?>
                                <br />

                                <?php

                                    $fee = ($_SESSION['amount'] = getFee($VisitSchedule_id, $class));
                                    echo $number, " x Kshs", $fee, " = Kshs", ($fee * $number), "<hr/>";
                                    $fee = $fee * $number;
                                    $amount = intval($fee);
                                    $vat = ceil($fee * 0.01);
                                    echo "V.A.T Charges = Kshs$vat<br/><br/><hr/>";
                                    echo "Total = Kshs", $total = $amount + $vat;
                                    $fee =  intval($total) . "00";
                                    $_SESSION['amount'] =  $total;
                                    $_SESSION['original'] =  $fee;
                                    $_SESSION['VisitSchedule'] =  $VisitSchedule_id;
                                    $_SESSION['no'] =  $number;
                                    $_SESSION['class'] =  $class;
                                    ?>
                            </div>
                            <a href="pay.php"><button
                                    onclick="return confirm('You will be directed to make your payment.\nPayment finalizes your Visitation!')"
                                    class="btn btn-primary">Pay Now</button></a>
                        </div>
                    </div>
                </div>
                <?php
                    }
                ?>
            </div>
        </div>
    </div>
</div>