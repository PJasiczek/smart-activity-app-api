<?php

include 'dbconfig.php';

$con = mysqli_connect($HostName, $HostUser, $HostPass, $DatabaseName);

$json = file_get_contents('php://input');

$obj = json_decode($json, true);

$id = $obj['id'];

if ($con->connect_error) {

    die("Nie udało się nawiązać połączenia: " . $con->connect_error);
}

$sql = "SELECT (SELECT COUNT(*) FROM activity WHERE MONTH(date)=(SELECT MONTH(CURDATE()) - 2) and user_id = '$id') AS two_month_ago, (SELECT COUNT(*) FROM activity WHERE MONTH(date)=(SELECT MONTH(CURDATE()) - 1) and user_id = '$id') AS one_month_ago, (SELECT COUNT(*) FROM activity WHERE MONTH(date)=(SELECT MONTH(CURDATE())) and user_id = '$id') AS this_month FROM activity LIMIT 1";

$result = $con->query($sql);

if ($result->num_rows > 0) {


    while ($row[] = $result->fetch_assoc()) {

        $tem = $row;
        $json = json_encode($tem);
    }
} else {
    echo "Nie znaleziono wyników";
}
echo $json;
$con->close();
?>