<?php

namespace Vita\Booking\Controllers;

use Vita\Booking\Exceptions\BadFileTypeException;
use Vita\Booking\Exceptions\WrongFileUploadException;

class FileController
{
    public function imageValidation(array $params): void
    {
        $error = $_FILES['image']['error'];
        if ($error !== UPLOAD_ERR_OK) {
            throw new WrongFileUploadException();
        }

        $allowedMimeTypes = [
            'image/jpeg'
        ];

        $fileMimeType = $_FILES['image']['type'];
        if (!in_array($fileMimeType, $allowedMimeTypes)) {
            throw new BadFileTypeException();
        }
    }
}
