<?php
if (!isset($file_access)) die("Direct File Access Denied");
$source = 'bus';
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
                                All Buses</h3>
                            <div class='float-right'>
                                <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                    data-target="#add">
                                    Add New Bus
                                </button></div>
                        </div>

                        <div class="card-body">

                            <table id="example1" style="align-items: stretch;"
                                class="table table-hover w-100 table-bordered table-striped<?php //
                                                                                                                                            ?>">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Bus Name</th>
                                        <th>Seat Capacity</th>
                                        <th>Plate number</th>
                                        
                                        <th style="width: 30%;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $row = $conn->query("SELECT * FROM bus");
                                    if ($row->num_rows < 1) echo "No Records Yet";
                                    $sn = 0;
                                    while ($fetch = $row->fetch_assoc()) {
                                        $id = $fetch['id'];
                                    ?>

                                    <tr>
                                        <td><?php echo ++$sn; ?></td>
                                        <td><?php echo $fullname = $fetch['name']; ?></td>
                                        <td><?php echo $fetch['first_seat']; ?></td>
                                        <td><?php echo $fetch['plate_number']; ?></td>
                                        <td>
                                            <form method="POST">
                                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                                    data-target="#edit<?php echo $id ?>">
                                                    Edit
                                                </button> -

                                                <input type="hidden" class="form-control" name="bus"
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


                                                                                        ?></h4>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="" method="post">
                                                        <input type="hidden" class="form-control" name="id"
                                                            value="<?php echo $id ?>" required id="">
                                                        <p>Bus Name : <input type="text" class="form-control"
                                                                name="name" value="<?php echo $fetch['name'] ?>"
                                                                required minlength="3" id=""></p>
                                                        <p>Capacity : <input type="number" min='0'
                                                                class="form-control"
                                                                value="<?php echo $fetch['first_seat'] ?>"
                                                                name="first_seat" required id="">
                                                        </p>
                                                      
                                                        <p>

                                                            <input class="btn btn-info" type="submit" value="Edit bus"
                                                                name='edit'>
                                                        </p>
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
                <h4 class="modal-title">Add New Bus 
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">

                    <table class="table table-bordered">
                        <tr>
                            <th>Bus Name</th>
                            <td><input type="text" class="form-control" name="name" required minlength="3" id=""></td>
                        </tr>
                        <tr>
                            <th>Plate number</th>
                            <td><input type="text" min='0' class="form-control" name="plate_number" required id="">
                            </td>
                        </tr>
                        <tr>
                            <th>Capacity</th>
                            <td><input type="number" min='0' class="form-control" name="first_seat" required id=""></td>
                        </tr>
                        <tr>
                            <td colspan="2">

                                <input class="btn btn-info" type="submit" value="Add bus" name='submit'>
                            </td>
                        </tr>
                    </table>
                </form>



            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<?php

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $first_seat = $_POST['first_seat'];
    $plate_number = $_POST['plate_number'];
    if (!isset($name, $first_seat, $plate_number)) {
        alert("Fill Form Properly!");
    } else {  
            $ins = $conn->prepare("INSERT INTO bus (name, first_seat, plate_number) VALUES (?,?,?)");
            $ins->bind_param("sss", $name, $first_seat, $plate_number);
            $ins->execute();
            alert("bus Added!");
            load($_SERVER['PHP_SELF'] . "$me");
        
    }
}


if (isset($_POST['edit'])) {
    $name = $_POST['name'];
    $first_seat = $_POST['first_seat'];
    $plate_number = $_POST['plate_number'];
    $id = $_POST['id'];
    if (!isset($name, $first_seat, $plate_number)) {
        alert("Fill Form Properly!");
    } else {
        $conn = connect();
        //Check if bus exists
        $check = $conn->query("SELECT * FROM bus WHERE name = '$name' ")->num_rows;
        if ($check == 2) {
            alert("bus name exists");
        } else {
            $ins = $conn->prepare("UPDATE bus SET name = ?, first_seat = ?, plate_number = ? WHERE id = ?");
            $ins->bind_param("sssi", $name, $first_seat, $plate_number, $id);
            $ins->execute();
            alert("bus Modified!");
            load($_SERVER['PHP_SELF'] . "$me");
        }
    }
}

if (isset($_POST['bus'])) {
    $con = connect();
    $conn = $con->query("DELETE FROM bus WHERE id = '" . $_POST['bus'] . "'");
    if ($con->affected_rows < 1) {
        alert("bus Could Not Be Deleted. This bus Has Been Tied To Another Data!");
        load($_SERVER['PHP_SELF'] . "$me");
    } else {
        alert("bus Deleted!");
        load($_SERVER['PHP_SELF'] . "$me");
    }
}
?>