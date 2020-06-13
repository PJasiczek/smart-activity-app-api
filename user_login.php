<?php

include 'dbconfig.php';

$con = mysqli_connect($HostName, $HostUser, $HostPass, $DatabaseName);

$json = file_get_contents('php://input');

$obj = json_decode($json, true);

$username = $obj['username'];
$password = $obj['password'];

if ($con->connect_error) {
    
    die("Nie udało się nawiązać połączenia: " . $con->connect_error);
}

$sql = "SELECT * FROM users WHERE username = '$username' and password = '$password'";

$result = $con->query($sql);

if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc()) {
        echo $row["id"];
    }
} else {
	$InvalidMSG = 'Nieprawidłowa nazwa użytkownika lub hasło';
 
	$InvalidMSGJSon = json_encode($InvalidMSG);
 	echo $InvalidMSGJSon;
}

$con->close();
?>