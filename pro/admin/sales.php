<?php
if (!isset($file_access)) die("Direct File Access Denied");
$source = 'payment';

?>
<div class="content">



    <div class="row">
        <div class="container-fluid">
            <div class="col-lg-12">


                <div class="card card-success">
                    <div class="card-header border-0">
                        <h3 class="card-title">All Payments</h3>

                    </div>
                    <div class="card-body">
                        <table id='example1' class="table table-striped table-bordered table-hover table-valign-middle">
                            <thead>
                                <tr>
                                    <th>Location</th>
                                    <th>Date</th>
                                    <th>VIP</th>
                                    <th>Regular</th>
                                    <th>Capacity</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $pay = $conn->query("SELECT *, VisitSchedule.id as id, VisitSchedule.date as date, VisitSchedule.time as time FROM VisitSchedule INNER JOIN payment ON VisitSchedule.id = payment.VisitSchedule_id");
                                $sn = 0;

                                while ($val = $pay->fetch_assoc()) {
                                    $id = $val['id'];
                                    $array = getTotalBookByType($id);
                                    // echo (($array['first'] - $array['first_booked'])), " Seat(s) Available for VIP" . "<hr/>" . ($array['second'] - $array['second_booked']) . " Seat(s) Available for Regular";
                                    $sn++;
                                    echo "<tr>
                                      <td>" . getLocationPath($val['Location_id']) . "</td>
                                      <td>" . $val['date'] . " - " . formatTime($val['time']) . "</td>
                                      <td>$ " . sum($val['id'], 'first') . "</td>
                                      <td>$ " . sum($val['id'], 'second') . "</td>
                                      <td>" . (($array['first'] - $array['first_booked'])), " Seat(s) Available for VIP" . "<hr/>" . ($array['second'] - $array['second_booked']) . " Seat(s) Available for Regular" . "</td>
                                      </tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col-md-6 -->

            <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /.content -->
<!-- /.col -->
</div>
<!-- /.row -->

</div>