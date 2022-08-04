<?php
if (!isset($file_access)) die("Direct File Access Denied");
$source = 'report';
$me = "?page=$source"
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
                                All Schedules</h3>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">

                                <table style="width: 100%;" id="example1" style="align-items: stretch;"
                                    class="table table-hover table-bordered">

                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Bus</th>
                                            <th>Route</th>
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

                                            <td><?php echo $fetch['date'], " / ", formatTime($fetch['time']); ?></td>

                                            <td>
                                                <a href="admin.php?page=report&id=<?php echo $id; ?>">
                                                    <button type="submit" class="btn btn-success">
                                                        View
                                                    </button></a>
                                            </td>
                                        </tr>
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
</div>
</section>
</div>

<?php

if (isset($_POST['submit'])) {
    $route_id = $_POST['route_id'];
    $bus_id = $_POST['bus_id'];
    $first_fee = $_POST['first_fee'];
    $plate_number = $_POST['plate_number'];
    $date = $_POST['date'];
    $date = formatDate($date);
    // die($date);
    // $endDate = date('Y-m-d' ,strtotime( $data['automatic_until'] ));
    $time = $_POST['time'];
    if (!isset($route_id, $bus_id, $first_fee, $plate_number, $date, $time)) {
        alert("Fill Form Properly!");
    } else {
        $conn = connect();
        $ins = $conn->prepare("INSERT INTO `schedule`(`bus_id`, `route_id`, `date`, `time`, `first_fee`, `plate_number`) VALUES (?,?,?,?,?,?)");
        $ins->bind_param("iissii", $bus_id, $route_id, $date, $time, $first_fee, $plate_number);
        $ins->execute();
        alert("Schedule Added!");
        load($_SERVER['PHP_SELF'] . "$me");
    }
}

