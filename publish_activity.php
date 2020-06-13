<?php

include 'dbconfig.php';

$con = mysqli_connect($HostName, $HostUser, $HostPass, $DatabaseName);

$json = file_get_contents('php://input');

$obj = json_decode($json, true);

$id = $obj['id'];
$name = $obj['name'];
$type = $obj['type'];
$time = $obj['time'];
$date = $obj['date'];
$distance = $obj['distance'];
$steps = $obj['steps'];
$calories = $obj['calories'];
$max_pace = $obj['max_pace'];
$max_speed = $obj['max_speed'];
$max_heart_beat = $obj['max_heart_beat'];
$min_heart_beat = $obj['min_heart_beat'];


$sql = "INSERT INTO activity (user_id, name, type, time, date, distance, steps, calories, max_pace, max_speed, max_heart_beat, min_heart_beat) VALUES ('$id','$name','$type','$time','$date','$distance','$steps','$calories','$max_pace','$max_speed','$max_heart_beat','$min_heart_beat')";

if (mysqli_query($con, $sql)) {

    $MSG = 'Pomyślnie zapisano aktywność w systemie';
    $json = json_encode($MSG);
    echo $json;
} else {
    echo 'Spóbuj ponownie';
}

mysqli_close($con);
?>
