<?php

include 'dbconfig.php';

$con = mysqli_connect($HostName, $HostUser, $HostPass, $DatabaseName);

$json = file_get_contents('php://input');

$obj = json_decode($json, true);

$username = $obj['username'];
$weight = $obj['weight'];
$height = $obj['height'];
$profile_icon = $obj['profile_icon'];

$sql = "SELECT * FROM users WHERE username='$username'";

$check = mysqli_fetch_array(mysqli_query($con, $sql));

if (isset($check)) {

    $sql_query = "UPDATE users SET weight='$weight', height='$height', profile_icon='$profile_icon' WHERE username='$username';";

    if (mysqli_query($con, $sql_query)) {

        $ReturnJsonMSG = 'Nastąpiło poprawne utworzenie konta';
        $ReturnJson = json_encode($ReturnJsonMSG);
        echo $ReturnJson;
    } else {
        echo 'Spóbuj ponownie';
    }
} else {

    $ReturnJsonMSG = 'Użytkownik nie istnieje w systemie';
    $ReturnJson = json_encode($ReturnJsonMSG);
    echo $ReturnJson;
}

mysqli_close($con);
?>
