<?php
if (!isset($file_access)) die("Direct File Access Denied");
$source = 'dynamic';
$me = "?page=$source";
?>

<div class="content">
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">
                                All Dynamic Visitation-Reason</h3>
                            <div class='float-right'>
                              <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                    data-target="#add3">
                                    Free&Apartment VisitSchedule 
                                </button>
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                    data-target="#add">
                                    Add Paid One-Time VisitSchedule 
                                </button> - - - <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                    data-target="#add2">
                                    Add paid Range VisitSchedule 
                                </button>
                              
                            </div>
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
                                        <th>VIP Fee</th>
                                        <th>Reg Fee</th>
                                        <th>Total Visitations</th>
                                        <th>Date/Time</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $row = $conn->query("SELECT * FROM VisitSchedule ORDER BY id DESC");

                                    if ($row->num_rows < 1) echo "No Records Yet";
                                    $sn = 0;
                                    while ($fetch = $row->fetch_assoc()) {
                                        $id = $fetch['id']; ?><tr>
                                        <td><?php echo ++$sn; ?></td>
                                        <td><?php echo getEventName($fetch['Event_id']); ?></td>
                                        <td><?php echo getLocationPath($fetch['Location_id']);
                                                $fullname = " VisitSchedule" ?></td>
                                        <td>Kshs <?php echo ($fetch['first_fee']); ?></td>
                                        <td>Kshs <?php echo ($fetch['second_fee']); ?></td>
                                        <td><?php $array = getTotalBookByType($id);
                                                echo (($array['first'] - $array['first_booked'])), " Seat(s) Available for VIP" . "<hr/>" . ($array['second'] - $array['second_booked']) . " Seat(s) Available for Regular";
                                                ?></td>
                                        <td><?php echo $fetch['date'], " / ", formatTime($fetch['time']); ?></td>

                                        <td>
                                            <form method="POST">
                                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                                    data-target="#edit<?php echo $id ?>">
                                                    Edit
                                                </button> -

                                                <input type="hidden" class="form-control" name="del_Event"
                                                    value="<?php echo $id ?>" required id="">
                                                <button type="submit"
                                                    onclick="return confirm('Are you sure about this?')"
                                                    class="btn btn-danger">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>

                                    <div class="modal fade" id="edit<?php echo $id ?>">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Editing <?php echo $fullname;


                                                                                        ?> </h4>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">


                                                    <form action="" method="post">
                                                        <input type="hidden" class="form-control" name="id"
                                                            value="<?php echo $id ?>" required id="">

                                                        <p>Event/Occasion : <select class="form-control" name="Event_id" required
                                                                id="">
                                                                <option value="">Select Event/Occasion</option>
                                                                <?php
                                                                    $cons = connect()->query("SELECT * FROM Event");
                                                                    while ($t = $cons->fetch_assoc()) {
                                                                        echo "<option " . ($fetch['Event_id'] == $t['id'] ? 'selected="selected"' : '') . " value='" . $t['id'] . "'>" . $t['name'] . "</option>";
                                                                    }
                                                                    ?>
                                                            </select>
                                                        </p>

                                                        <p>Location : <select class="form-control" name="Location_id" required
                                                                id="">
                                                                <option value="">Select Location</option>
                                                                <?php
                                                                    $cond = connect()->query("SELECT * FROM Location");
                                                                    while ($r = $cond->fetch_assoc()) {
                                                                        echo "<option  " . ($fetch['Location_id'] == $r['id'] ? 'selected="selected"' : '') . " value='" . $r['id'] . "'>" . getLocationPath($r['id']) . "</option>";
                                                                    }
                                                                    ?>
                                                            </select>
                                                        </p>
                                                        <p>
                                                            VIP Charge : <input class="form-control"
                                                                type="number" value="<?php echo $fetch['first_fee'] ?>"
                                                                name="first_fee" required id="">
                                                        </p>
                                                        <p>
                                                            Regular Charge : <input class="form-control"
                                                                type="number" value="<?php echo $fetch['second_fee'] ?>"
                                                                name="second_fee" required id="">
                                                        </p>
                                                        <p>
                                                            Date :
                                                            <input type="date" class="form-control"
                                                                onchange="check(this.value)" id="date"
                                                                placeholder="Date" name="date" required
                                                                value="<?php echo (date('Y-m-d', strtotime($fetch["date"]))) ?>">

                                                        </p>
                                                        <p>
                                                            Time : <input class="form-control" type="time"
                                                                value="<?php echo $fetch['time'] ?>" name="time"
                                                                required id="">
                                                        </p>
                                                        <p class="float-right"><input type="submit" name="edit"
                                                                class="btn btn-success" value="Edit VisitSchedule"></p>
                                                    </form>

                                                    <div class="modal-footer justify-content-between">
                                                        <button type="button" class="btn btn-default"
                                                            data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                        <!-- /.modal -->
                                        <?php
                                    }
                                        ?>

                                </tbody>
                               
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
</div>
</div>
</div>
</section>
</div>

<div class="modal fade" id="add">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" align="center">
            <div class="modal-header">
                <h4 class="modal-title">Add Paid VisitSchedule ;
                </h4>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="row">
                        <div class="col-sm-6">
                            Event/Occasion : <select class="form-control" name="Event_id" required id="">
                                <option value="">Select Event/Occasion</option>
                                <?php
                                $con = connect()->query("SELECT * FROM Event");
                                while ($row = $con->fetch_assoc()) {
                                    echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
                                }
                                ?>
                            </select>

                        </div>
                        <div class="col-sm-6">
                            Location : <select class="form-control" name="Location_id" required id="">
                                <option value="">Select Location</option>
                                <?php
                                $con = connect()->query("SELECT * FROM Location");
                                while ($row = $con->fetch_assoc()) {
                                    echo "<option value='" . $row['id'] . "'>" . getLocationPath($row['id']) . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            VIP Charge : <input class="form-control" type="number" name="first_fee" required
                                id="">
                        </div>
                        <div class="col-sm-6">

                            Regular Charge : <input class="form-control" type="number" name="second_fee" required
                                id="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            Date : <input class="form-control" onchange="check(this.value)" type="date" name="date"
                                required id="date">
                        </div>
                        <div class="col-sm-6">

                            Time : <input class="form-control" type="time" name="time" required id="">
                        </div>
                    </div>
                    <hr>
                    <input type="submit" name="submit" class="btn btn-success" value="Add VisitSchedule"></p>
                </form>

                <script>
                function check(val) {
                    val = new Date(val);
                    var age = (Date.now() - val) / 31557600000;
                    var formDate = document.getElementById('date');
                    if (age > 0) {
                        alert("Past/Current Date not allowed");
                        formDate.value = "";
                        return false;
                    }
                }
                </script>

            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="add3">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" align="center">
            <div class="modal-header">
                <h4 class="modal-title">Add Free/Apartment VisitSchedule ;
                </h4>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="row">
                        <div class="col-sm-6">
                            Event/Occasion : <select class="form-control" name="Event_id" required id="">
                                <option value="">Select Event/Occasion</option>
                                <?php
                                $con = connect()->query("SELECT * FROM Event");
                                while ($row = $con->fetch_assoc()) {
                                    echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
                                }
                                ?>
                            </select>

                        </div>
                        <div class="col-sm-6">
                            Location : <select class="form-control" name="Location_id" required id="">
                                <option value="">Select Location</option>
                                <?php
                                $con = connect()->query("SELECT * FROM Location");
                                while ($row = $con->fetch_assoc()) {
                                    echo "<option value='" . $row['id'] . "'>" . getLocationPath($row['id']) . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
    <div class="col-sm-6">
        VIP Charge : <input class="form-control" type="number" name="first_fee" required value="0" >
    </div>
    <div class="col-sm-6">
        Regular Charge : <input class="form-control" type="number" name="second_fee" required value="0" >
    </div>
</div>

                    <div class="row">
                        <div class="col-sm-6">
                            Date : <input class="form-control" onchange="check(this.value)" type="date" name="date"
                                required id="date">
                        </div>
                        <div class="col-sm-6">

                            Time : <input class="form-control" type="time" name="time" required id="">
                        </div>
                    </div>
                    <hr>
                    <input type="submit" name="submit3" class="btn btn-success" value="Add VisitSchedule"></p>
                </form>

                <script>
                function check(val) {
                    val = new Date(val);
                    var age = (Date.now() - val) / 31557600000;
                    var formDate = document.getElementById('date');
                    if (age > 0) {
                        alert("Past/Current Date not allowed");
                        formDate.value = "";
                        return false;
                    }
                }
                </script>

            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="add2">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" align="center">
            <div class="modal-header">
                <h4 class="modal-title">Add Paid Range Visitchedule ;
                </h4>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="row">
                        <div class="col-sm-6">
                            Event : <select class="form-control" name="Event_id" required id="">
                                <option value="">Select Event/Occasion</option>
                                <?php
                                $con = connect()->query("SELECT * FROM Event");
                                while ($row = $con->fetch_assoc()) {
                                    echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
                                }
                                ?>
                            </select>

                        </div>
                        <div class="col-sm-6">
                            Location : <select class="form-control" name="Location_id" required id="">
                                <option value="">Select Location</option>
                                <?php
                                $con = connect()->query("SELECT * FROM Location");
                                while ($row = $con->fetch_assoc()) {
                                    echo "<option value='" . $row['id'] . "'>" . getLocationPath($row['id']) . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            VIP Charge : <input class="form-control" type="number" name="first_fee" required>
                        </div>
                        <div class="col-sm-6">

                            Regular Charge : <input class="form-control" type="number" name="second_fee" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            From Date : <input class="form-control" onchange="check(this.value)" type="date"
                                name="from_date" required>
                        </div>
                        <div class="col-sm-6">
                            End Date : <input class="form-control" onchange="check(this.value)" type="date"
                                name="to_date" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6"> Every :
                            <select class="form-control" name="every">
                                <option value="Day">Day</option>
                                <option value="Monday">Monday</option>
                                <option value="Tuesday">Tuesday</option>
                                <option value="Wednesday">Wednesday</option>
                                <option value="Thursday">Thursday</option>
                                <option value="Friday">Friday</option>
                                <option value="Saturday">Saturday</option>
                                <option value="Sunday">Sunday</option>
                            </select>
                        </div>
                        <div class="col-sm-6">

                            Time : <input class="form-control" type="time" name="time" required id="">
                        </div>
                    </div>
                    <hr>
                    <input type="submit" name="submit2" class="btn btn-success" value="Add VisitSchedule"></p>
                </form>

                <script>
                function check(val) {
                    val = new Date(val);
                    var age = (Date.now() - val) / 31557600000;
                    var formDate = document.getElementById('date');
                    if (age > 0) {
                        alert("You are using a past/current date!");
                        val.value = "";
                        return false;
                    }
                }
                </script>

            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<?php

if (isset($_POST['submit'])) {
    $Location_id = $_POST['Location_id'];
    $Event_id = $_POST['Event_id'];
    $first_fee = $_POST['first_fee'];
    $second_fee = $_POST['second_fee'];
    $date = $_POST['date'];
    $date = formatDate($date);
    // die($date);
    // $endDate = date('Y-m-d' ,strtotime( $data['automatic_until'] ));
    $time = $_POST['time'];
    if (!isset($Location_id, $Event_id, $first_fee, $second_fee,  $date, $time)) {
        alert("Fill Form Properly!");
    } else {
        $conn = connect();
        $ins = $conn->prepare("INSERT INTO `VisitSchedule`(`Event_id`, `Location_id`, `date`, `time`, `first_fee`, `second_fee`) VALUES (?,?,?,?,?,?)");
        $ins->bind_param("iissii", $Event_id, $Location_id, $date, $time, $first_fee, $second_fee);
        $ins->execute();
        alert("VisitSchedule Added!");
        load($_SERVER['PHP_SELF'] . "$me");
    }
}


if (isset($_POST['submit2'])) {
    $Location_id = $_POST['Location_id'];
    $Event_id = $_POST['Event_id'];
    $first_fee = $_POST['first_fee'];
    $second_fee = $_POST['second_fee'];
    $from_date = $_POST['from_date'];
    $to_date = $_POST['to_date'];
    $every = $_POST['every'];

    $time = $_POST['time'];
    if (!isset($Location_id, $Event_id, $first_fee, $second_fee, $date, $time)) {
        alert("Fill Form Properly!");
    } else {


        $from_date = formatDate($from_date);
        $to_date = formatDate($to_date);
        $startDate = $from_date;
        $endDate = $to_date;
        $conn = connect();
        if ($every == 'Day') {
            for ($i = strtotime($startDate); $i <= strtotime($endDate); $i = strtotime('+1 day', $i)) {
                $date = date('d-m-Y', $i);
                $ins = $conn->prepare("INSERT INTO `VisitSchedule`(`Event_id`, `Location_id`, `date`, `time`, `first_fee`, `second_fee`) VALUES (?,?,?,?,?,?)");
                $ins->bind_param("iissii", $Event_id, $Location_id, $date, $time, $first_fee, $second_fee);
                $ins->execute();
            }
        } else {
            for ($i = strtotime($every, strtotime($startDate)); $i <= strtotime($endDate); $i = strtotime('+1 week', $i)) {
                $date = date('d-m-Y', $i);

                $ins = $conn->prepare("INSERT INTO `VisitSchedule`(`Event_id`, `Location_id`, `date`, `time`, `first_fee`, `second_fee`) VALUES (?,?,?,?,?,?)");
                $ins->bind_param("iissii", $Event_id, $Location_id, $date, $time, $first_fee, $second_fee);
                $ins->execute();
            }
        }


        alert("Visitation-Reason Added!");
        load($_SERVER['PHP_SELF'] . "$me");
    }
}

if (isset($_POST['submit3'])) {
    $Location_id = $_POST['Location_id'];
    $Event_id = $_POST['Event_id'];
    $first_fee = $_POST['first_fee'];
    $second_fee = $_POST['second_fee'];
    $date = $_POST['date'];
    $date = formatDate($date);
    // die($date);
    // $endDate = date('Y-m-d' ,strtotime( $data['automatic_until'] ));
    $time = $_POST['time'];
     
    if (!isset($Location_id, $Event_id, $date, $time)) {
        alert("Fill Form Properly!");
    } else {
        $conn = connect();
                
        $ins = $conn->prepare("INSERT INTO `VisitSchedule`(`Event_id`, `Location_id`, `date`, `time`, `first_fee`, `second_fee`) VALUES (?,?,?,?,?,?)");
        $ins->bind_param("iissii", $Event_id, $Location_id, $date, $time, $first_fee, $second_fee);
        $ins->execute();
        alert("VisitSchedule Added!");
        load($_SERVER['PHP_SELF'] . "$me");
    }
}




if (isset($_POST['edit'])) {
    $Location_id = $_POST['Location_id'];
    $Event_id = $_POST['Event_id'];
    $first_fee = $_POST['first_fee'];
    $second_fee = $_POST['second_fee'];
    $date = $_POST['date'];
    $date = formatDate($date);
    $time = $_POST['time'];
    $id = $_POST['id'];
    if (!isset($Location_id, $Event_id, $first_fee, $second_fee, $date, $time)) {
        alert("Fill Form Properly!");
    } else {
        $conn = connect();
        $ins = $conn->prepare("UPDATE `VisitSchedule` SET `Event_id`=?,`Location_id`=?,`date`=?,`time`=?,`first_fee`=?,`second_fee`=? WHERE id = ?");
        $ins->bind_param("iissiii", $Event_id, $Location_id, $date, $time, $first_fee, $second_fee, $id);
        $ins->execute();
        $msg = "Having considered user's satisfactions and every other things, we the management are so sorry to let inform you that there has been a change in the date and time of your trip. <hr/> New Date : $date. <br/> New Time : ".formatTime($time)." <hr/> Kindly disregard if the date/time still stays the same.";
        $e = $conn->query("SELECT Attendee.email FROM Attendee INNER JOIN booked ON booked.user_id = Attendee.id WHERE booked.VisitSchedule_id = '$id' ");
        while($getter = $e->fetch_assoc()){
            @sendMail($getter['email'], "Change In Trip Date/Time", $msg);
        }
        alert("VisitSchedule Modified!");
        load($_SERVER['PHP_SELF'] . "$me");
    }
}

if (isset($_POST['del_Event'])) {
    $con = connect();
    $conn = $con->query("DELETE FROM VisitSchedule WHERE id = '" . $_POST['del_Event'] . "'");
    if ($con->affected_rows < 1) {
        alert("VisitSchedule Could Not Be Deleted. This Location Has Been Tied To Another Data!");
        load($_SERVER['PHP_SELF'] . "$me");
    } else {
        alert("VisitSchedule Deleted!");
        load($_SERVER['PHP_SELF'] . "$me");
    }
}
?>