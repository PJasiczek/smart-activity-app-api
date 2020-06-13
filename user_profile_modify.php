<?php

include 'dbconfig.php';

$con = mysqli_connect($HostName, $HostUser, $HostPass, $DatabaseName);

$json = file_get_contents('php://input');

$obj = json_decode($json, true);

$id = $obj['id'];
$password = $obj['password'];
$email = $obj['email'];
$weight = $obj['weight'];
$height = $obj['height'];
$profile_icon = $obj['profile_icon'];

$CheckSQL = "SELECT * FROM users WHERE id='$id'";

$check = mysqli_fetch_array(mysqli_query($con, $CheckSQL));

if ($id != NULL && $password != NULL && $email != NULL && $weight != NULL && $height != NULL && $profile_icon != NULL) {

    $Sql_Query = "UPDATE users SET id='$id', password='$password', email='$email', weight='$weight', height='$height', profile_icon='$profile_icon' WHERE id='$id';";

    if (mysqli_query($con, $Sql_Query)) {

        $MSG = 'Nastąpiło poprawna modyfikacja konta';
        $json = json_encode($MSG);
        echo $json;
    } else {
        echo 'Spóbuj ponownie';
    }
} else if ($id == NULL) {

    $ReturnJsonMSG = 'Proszę wpisać poprawną nazwę użytkownika';
    $ReturnJson = json_encode($ReturnJsonMSG);
    echo $ReturnJson;
} else if ($password == NULL) {

    $ReturnJsonMSG = 'Proszę wpisać poprawne hasło';
    $ReturnJson = json_encode($ReturnJsonMSG);
    echo $ReturnJson;
} else if ($email == NULL) {

    $ReturnJsonMSG = 'Proszę wpisać poprawny adres skrzynki pocztowej';
    $ReturnJson = json_encode($ReturnJsonMSG);
    echo $ReturnJson;
} else if ($weight == NULL) {

    $ReturnJsonMSG = 'Proszę wpisać poprawną wagę ciała';
    $ReturnJson = json_encode($ReturnJsonMSG);
    echo $ReturnJson;
} else if ($height == NULL) {

    $ReturnJsonMSG = 'Proszę wprowadzić poprawny wzrost';
    $ReturnJson = json_encode($ReturnJsonMSG);
    echo $ReturnJson;
}

mysqli_close($con);
?>
