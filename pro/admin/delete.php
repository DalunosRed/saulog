<?php
	$con = mysqli_connect("localhost", "root", "","saulog");
    $req=$_GET['req'];
	$id=$_GET['id'];
    $sqli= "SELECT * FROM schedule where play_id='$req'";
    $que=mysqli_query($con, $sqli);
    $row=mysqli_fetch_array($que);
    $deduct=$row['capacity'] - 1;
    $capacity_availabe= ($r["capacity"])-($r["capacity"]);
    

    mysqli_query($con, "UPDATE saulog set capacity=$deduct, WHERE id=$req");
	mysqli_query($con, "DELETE FROM booked_tbl WHERE cust_id=$id");
	mysqli_query($con, "DELETE FROM history_tbl WHERE history_id=$id");
    echo "<script>alert('Deleted Customer')</script>";
	echo  "<script>window.location.href='play.php?request=".$req."'</script>";
?>