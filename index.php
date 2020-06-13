<?php

$target_dir = "upload/images";
$data = array('status' => false);

if (isset($_POST['submit'])) {
    $target_file = basename($_FILES['file']['name']);
    $file_type = pathinfo($target_file, PATHINFO_EXTENSION);
    $is_image = getimagesize($_FILES['file']['tmp_name']);
    if ($is_image !== false) {
	$data['file_name'] = time();
        $data['image'] = $target_dir . '/' . $data['file_name'] . '.' . $file_type;
        if (move_uploaded_file($_FILES['file']['tmp_name'], $data['image'])) {
            $data['status'] = true;
        } else {
            $data['message'] = 'Błąd podczas zamieszczania pliku';
        }
    } else {
        $data['message'] = 'Plik o niewłaściwym rozszerzeniu';
    }
}

header('Access-Contro-Allow-Origin: *');
header('Content-type:application/json');

echo json_encode($data);
?>