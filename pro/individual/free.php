<?php
if (!isset($file_access)) die("Direct File Access Denied");
?>
<?php

$me = $_SESSION['user_id'];

?>

<div class="content">



    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title"><b>Schedule Event/Occasion Tickets</b></h3>
                </div>
                <div class="card-body">

                    <table id="example1" style="align-items: stretch;"
                        class="table table-hover w-100 table-bordered table-striped<?php //
                                                                                                                                    ?>">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Event/Occasion</th>
                                <th>Location</th>
                                <th>Status</th>
                                <th>Date/Time</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
<?php
$row = queryVisitSchedule('future');
if ($row->num_rows < 1) {
    echo "<div class='alert alert-danger' role='alert'>Sorry, There are no Visitation-Reason at the moment! Please visit after some time.</div>";
} else {
    $sn = 0;
    while ($fetch = $row->fetch_assoc()) {
        $first_fee = $fetch['first_fee'];
        $second_fee = $fetch['second_fee'];
        
        // Check if both fees are 0
        if ($first_fee == 0 && $second_fee == 0) {
            $db_date = $fetch['date'];
            if ($db_date == date('d-m-Y')) {
                $db_time = $fetch['time'];
                $current_time = date('H:i');
                if ($current_time >= $db_time) {
                    continue;
                }
            }
            // Display the row if conditions are met
            $sn++;
            $id = $fetch['id'];
?>
<tr>
    <td><?php echo $sn; ?></td>
    <td><?php echo getEventName($fetch['Event_id']); ?></td>
    <td><?php echo getLocationPath($fetch['Location_id']); ?></td>
    <td><?php 
        $array = getTotalBookByType($id);
        echo ($max_first = ($array['first'] - $array['first_booked'])), " Seat(s) Available for VIP" . "<hr/>" . ($max_second = ($array['second'] - $array['second_booked'])) . " Seat(s) Available for Regular";
    ?></td>
    <td><?php echo $fetch['date'], " / ", formatTime($fetch['time']); ?></td>
    <td>
        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#book<?php echo $id ?>">
            Schedule
        </button>
    </td>
</tr>
<div class="modal fade" id="book<?php echo $id ?>">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Schedule For <?php echo getLocationPath($fetch['Location_id']); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?php echo $_SERVER['PHP_SELF'] . "?loc=$id" ?>" method="post">
                    <input type="hidden" class="form-control" name="id" value="<?php echo $id ?>" required>
                    <p>Number of Tickets (If you are the only one, leave as it is) :
                        <input type="number" min="1" max="5" value="1" name="number" class="form-control">
                    </p>
                    <p>
                        Class : <select name="class" required class="form-control">
                            <option value="">-- Select Class --</option>
                            <option value="first">VIP (Kshs <?php echo ($fetch['first_fee']); ?>)</option>
                            <option value="second">Regular (Kshs <?php echo ($fetch['second_fee']); ?>)</option>
                        </select>
                    </p>
                    <input type="submit" name="submit" class="btn btn-success" value="Proceed">
                </form>
            </div>
        </div>
    </div>
</div>
<?php
        } // End if
    } // End while
} // End else
?>
 </tbody>
                        
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </section>

    </form>

</div>
