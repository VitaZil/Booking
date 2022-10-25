<?php

namespace Vita\Booking\Controllers;

use Vita\Booking\Services\DatabaseService;

class FileController
{

    public static function newImage(): void
    {
        $database = new DatabaseService();
        $apartments = $database->getApartments();

        require(__DIR__ . '/../../view/image.php');
    }

    public function imageValidation(array $params): void
    {
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
    }
}

