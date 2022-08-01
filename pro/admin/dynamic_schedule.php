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
                                All Dynamic Schedules</h3>
                            <div class='float-right'>
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                    data-target="#add">
                                    Add New One-Time Schedule 
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
                                        <th>Bus</th>
                                        <th>Route</th>
                                        <th>Ticket Fee</th>                  
                                        <th>Bus number</th>
                                        <th>Date/Time</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $row = $conn->query("SELECT * FROM schedule ORDER BY id DESC");

                                    if ($row->num_rows < 1) echo "No Records Yet";
                                    $sn = 0;
                                    while ($fetch = $row->fetch_assoc()) {
                                        $id = $fetch['id']; ?><tr>
                                        <td><?php echo ++$sn; ?></td>
                                        <td><?php echo getBusName($fetch['bus_id']); ?></td>
                                        <td><?php echo getRoutePath($fetch['route_id']);
                                                $fullname = " Schedule" ?></td>
                                        <td>₱<?php echo ($fetch['fee']); ?></td>
                                        <td> <?php echo ($fetch['bus_number']); ?></td>
                                   
                                       
                                        <td><?php echo $fetch['date'], " / ", formatTime($fetch['time']); ?></td>

                                        <td>
                                            <form method="POST">
                                               

                                                <input type="hidden" class="form-control" name="del_sched"
                                                    value="<?php echo $id ?>" required id="">
                                                <button type="submit"
                                                    onclick="return confirm('Are you sure about this?')"
                                                    class="btn btn-danger">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>

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
                <h4 class="modal-title">Add New Schedule &#128649;
                </h4>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="row">
                        <div class="col-sm-6">
                            Bus : <select class="form-control" name="bus_id" required id="">
                                <option value="">Select Bus</option>
                                <?php
                                $con = connect()->query("SELECT * FROM bus");
                                while ($row = $con->fetch_assoc()) {
                                    echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
                                }
                                ?>
                            </select>

                        </div>
                        <div class="col-sm-6">
                            Route : <select class="form-control" name="route_id" required id="">
                                <option value="">Select Route</option>
                                <?php
                                $con = connect()->query("SELECT * FROM route");
                                while ($row = $con->fetch_assoc()) {
                                    echo "<option value='" . $row['id'] . "'>" . getRoutePath($row['id']) . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                        Ticket Fee  : <input class="form-control" type="number" name="fee" required
                                id="">
                        </div>
                        <div class="col-sm-6">

                     Bus number: <input class="form-control" type="text" name="bus_number" required
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
                    <input type="submit" name="submit" class="btn btn-success" value="Add Schedule"></p>
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



<?php

if (isset($_POST['submit'])) {
    $route_id = $_POST['route_id'];
    $bus_id = $_POST['bus_id'];
    $fee = $_POST['fee'];
    $bus_number = $_POST['bus_number'];
    $date = $_POST['date'];
    $date = formatDate($date);
    // die($date);
    // $endDate = date('Y-m-d' ,strtotime( $data['automatic_until'] ));
    $time = $_POST['time'];
    if (!isset($route_id, $bus_id, $fee, $bus_number, $date, $time)) {
        alert("Fill Form Properly!");
    } else {
        $conn = connect();
        $ins = $conn->prepare("INSERT INTO `schedule`(`bus_id`, `route_id`, `date`, `time`, `fee`, `bus_number`) VALUES (?,?,?,?,?,?)");
        $ins->bind_param("iissii", $bus_id, $route_id, $date, $time, $fee, $bus_number);
        $ins->execute();
        alert("Schedule Added!");
        load($_SERVER['PHP_SELF'] . "$me");
    }
}




if (isset($_POST['del_sched'])) {
    $con = connect();
    $conn = $con->query("DELETE FROM schedule WHERE id = '" . $_POST['del_sched'] . "'");
    if ($con->affected_rows < 1) {
        alert("Schedule Could Not Be Deleted. This Route Has Been Tied To Another Data!");
        load($_SERVER['PHP_SELF'] . "$me");
    } else {
        alert("Schedule Deleted!");
        load($_SERVER['PHP_SELF'] . "$me");
    }
}
?>