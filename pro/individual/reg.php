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
                    <h3 class="card-title"><b>Book bus Tickets</b></h3>
                </div>
                <div class="card-body">

                    <table id="example1" style="align-items: stretch;"
                        class="table table-hover w-100 table-bordered table-striped<?php //
                                                                                                                                    ?>">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Route</th>
                                <th>Capacity</th>
                                <th>Date/Time</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $row = querySchedule('future');
                            if ($row->num_rows < 1) echo "<div class='alert alert-danger' role='alert'>
                            Sorry, There are no schedules at the moment! Please visit after some time.
                          </div>";
                            $sn = 0;
                            while ($fetch = $row->fetch_assoc()) {
                                //Check if the current date is same with Database scheduled date
                                $cap_available= ($fetch["capacity"]);

                                $db_date = $fetch['date'];
                                if ($db_date == date('d-m-Y')) {
                                    //Oh yes, so what should happen?
                                    //Check for the time. If there is still about an hour left, proceed else, skip this data
                                    $db_time = $fetch['time'];
                                    $current_time = date('H:i');
                                    if ($current_time >= $db_time) {
                                        continue;
                                    }
                                }
                                $id = $fetch['id']; ?><tr>
                                <td><?php echo ++$sn; ?></td>
                                <td><?php echo $fullname =  getRoutePath($fetch['route_id']);
                                        ?></td>
                              <td> <?php echo ($fetch['capacity']); ?></td>
                                
                                <td><?php echo $fetch['date'], " / ", formatTime($fetch['time']); ?></td>

                                <td>
                                        <button type="button" class="btn btn-info" data-toggle="modal"
                                            data-target="#book<?php echo $id ?>">
                                            Book
                                        </button>
                                    </td>
                            </tr>

                            <div class="modal fade" id="book<?php echo $id ?>">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Book For <?php echo $fullname;


                                                                                    ?> </h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">


                                            <form action="<?php echo $_SERVER['PHP_SELF'] . "?loc=$id" ?>"
                                                method="post">
                                                <input type="hidden" class="form-control" name="id"
                                                    value="<?php echo $id ?>" required id="">

                                                <p>Number of Tickets (If you are the only one, leave as it is) :
                                                    <input type="number" min='0' value="0" max='<?php echo ($fetch['capacity']);?>'
                                                     
                                                        name="number" name="quantity" class="form-control" id="quantity">
                                                </p>
                                                <p>
                                                    
                                                    Amount : <select name="class" required class="form-control" id="">
                                                      
                                                        <option value="first"> ₱
                                                            <?php echo ($fetch['fee']); ?></option>
                                                </p>

                                                <?php
                                                    if ($cap_available!=0) echo '<a href="individual.php?loc=' . $id . '"> <input type="submit" id="book-btn" name="submit" class="btn btn-success book-js"
                                                    value="Proceed" data-id="'.$id.'" data-capacity="'.$fetch['capacity'].'"></a>';
                                                   
                                                   else echo '<input type="submit" disabled="disabled" class="btn btn-danger" value="Sold out">'; ?>


                                              
                                                
                                            </form>

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
                <!-- /.card-body -->
            </div>
        </div>
    </section>

    </form>

</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="individual/pay.js"></script>
<script src="/saulog/js/book.js"></script>