<?php

namespace Vita\Booking\Controllers;

use Vita\Booking\Services\DatabaseService;

class FileController
{
    public static function newImage(): void
    {
        $database = new DatabaseService();
        $apartments = $database->get();

        require(__DIR__ . '/../../view/image.php');
    }
}

