<?php
namespace Vita\Booking;

use Vita\Booking\Controllers\FileController;
//
//$fileDetails = new FileController();
//$fileDetails::file($_FILES);
//var_dump($_FILES);
//var_dump($_POST);
//var_dump($_GET);

//var_dump($_SERVER);

$fileName = $_FILES['image']['name'];
$filePath = './data/' . $uid . '_' . $fileName;
$fileSize = $_FILES['image']['size'];

$error = $_FILES['image']['error'];
        if ($error !== UPLOAD_ERR_OK) {
            echo 'Error uploading file';
            die;
        }

$allowedMimeTypes = [
    'image/jpeg'
];
$fileMimeType = $_FILES['image']['type'];
if (!in_array($fileMimeType, $allowedMimeTypes)) {
    echo "Bad file type";
    die;
}

$temporaryLocation = $_FILES['image']['tmp_name'];
$uploadFile = move_uploaded_file($temporaryLocation, $filePath);
if ($uploadFile) {
    echo "<b>Failas įkeltas sėkmingai!</b>";
}

$apartments = json_decode(file_get_contents(__DIR__ . './database/apartments.json'), true);

        $uploadedFileName = max(array_column($apartments, 'apartment_id')) . strstr($_FILES['image']['full_path'], '.');
        $fileSavePath = __DIR__ . './/database/images/' . $uploadedFileName;
        $tempFilePath = $_FILES['image']['tmp_name'];
        move_uploaded_file($tempFilePath, $fileSavePath);
       echo 'Upload successful';
        header('Location: /apartments');
