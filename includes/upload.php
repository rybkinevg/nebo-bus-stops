<?php

$uploaddir = $_SERVER['DOCUMENT_ROOT'] . './files/map_imports/';

$uploadfile = $uploaddir . basename($_FILES['upload-file']['name']);

if (empty($_FILES['upload-file']['error'])) {

    $uploaded = move_uploaded_file($_FILES['upload-file']['tmp_name'], $uploadfile);

    if ($uploaded) {
        echo json_encode('?file=' . basename($uploadfile));
    }
}
