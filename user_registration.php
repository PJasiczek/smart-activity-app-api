<?php

include 'dbconfig.php';

$con = mysqli_connect($HostName, $HostUser, $HostPass, $DatabaseName);

$json = file_get_contents('php://input');

$obj = json_decode($json, true);

$username = $obj['username'];
$password = $obj['password'];
$email = $obj['email'];
$first_name = $obj['first_name'];
$last_name = $obj['last_name'];
$date_of_birth = $obj['date_of_birth'];
$country = $obj['country'];
$sex = $obj['sex'];
$weight = $obj['weight'];
$height = $obj['height'];
$profile_icon = $obj['profile_icon'];

$sql = "SELECT * FROM users WHERE username='$username'";

$check = mysqli_fetch_array(mysqli_query($con, $sql));


if (isset($check)) {

    $ReturnJsonMSG = 'Użytkownik istnieje już w systemie';
    $ReturnJson = json_encode($ReturnJsonMSG);
    echo $ReturnJson;
} else {

    if ($username != NULL && $password != NULL && $email != NULL && $first_name != NULL && $last_name != NULL && $date_of_birth != "--" && $country != NULL && $sex != NULL) {

        $sql_query = "INSERT INTO users (username, password, email, first_name, last_name, date_of_birth, country, sex, weight, height, profile_icon) VALUES ('$username','$password','$email','$first_name','$last_name','$date_of_birth','$country','$sex','$weight','$height','$profile_icon')";

        if (mysqli_query($con, $sql_query)) {

            $MSG = 'Nastąpiło poprawne utworzenie konta';
            $json = json_encode($MSG);
            echo $json;
        } else {
            echo 'Spóbuj ponownie';
        }
    } else if ($first_name == NULL) {

        $ReturnJsonMSG = 'Proszę wpisać poprawne imię';
        $ReturnJson = json_encode($ReturnJsonMSG);
        echo $ReturnJson;
    } else if ($last_name == NULL) {

        $ReturnJsonMSG = 'Proszę wpisać poprawne nazwisko';
        $ReturnJson = json_encode($ReturnJsonMSG);
        echo $ReturnJson;
    } else if ($username == NULL) {

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
    } else if ($date_of_birth == "--") {

        $ReturnJsonMSG = 'Proszę wpisać poprawną datę urodzenia';
        $ReturnJson = json_encode($ReturnJsonMSG);
        echo $ReturnJson;
    } else if ($country == NULL) {

        $ReturnJsonMSG = 'Proszę wprowadzić poprawny region zamieszkania';
        $ReturnJson = json_encode($ReturnJsonMSG);
        echo $ReturnJson;
    } else if ($sex == NULL) {

        $ReturnJsonMSG = 'Proszę wybrać płeć';
        $ReturnJson = json_encode($ReturnJsonMSG);
        echo $ReturnJson;
    }
}

mysqli_close($con);
?>
