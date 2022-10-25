<?php

namespace Vita\Booking\Controllers;

use Vita\Booking\Models\ApartmentModel;
use Vita\Booking\Models\BookModel;

class BookController
{
    public static function show(int $id): void
    {
        $bookModel = new BookModel();
        $temporaryData = json_decode(file_get_contents(__DIR__ . '/../../database/data.json'), true);

        $apartment = $bookModel->checkAvailability(
            $id,
            $_POST['start_date'] ?? $temporaryData['start_date'],
            $_POST['end_date'] ?? $temporaryData['end_date']
        );

        require(__DIR__ . '/../../view/show_one_confirm.php');
    }

    public static function book(int $id): void
    {
        $temporaryData = json_decode(file_get_contents(__DIR__ . '/../../database/data.json'), true);
        $bookModel = new BookModel();
        $bookModel->newBooking($id, $temporaryData['start_date'], $temporaryData['end_date']);

        require(__DIR__ . '/../../view/thank_you.php');
    }

    public static function checkDatesByCity(array $params): void
    {
        $apartmentModel = new ApartmentModel();
        $availableApartments = $apartmentModel->checkAvailableDates(
            $params['start_date'],
            $params['end_date'],
            $params['city']
        );

        require(__DIR__ . '/../../view/available_by_date_city.php');
    }


}
