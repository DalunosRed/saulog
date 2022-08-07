<?php

include_once '../../conn.php';

$capacity = $_POST['capacity'];
$quantity = $_POST['quantity'];
$id = $_POST['id'];

$newCapacity = $capacity - $quantity;

$row = $conn->query("UPDATE schedule SET capacity =  '$newCapacity' WHERE id = '$id'");


