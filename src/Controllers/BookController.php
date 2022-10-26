<?php

namespace Vita\Booking\Controllers;

use Vita\Booking\Models\ApartmentModel;
use Vita\Booking\Models\BookModel;

class BookController
{
    public static function show(int $id, string $startDate, string $endDate): void
    {
        $bookModel = new BookModel();

        $apartment = $bookModel->checkAvailability(
            $id,
            $startDate,
            $endDate
        );

        require(__DIR__ . '/../../view/show_one_confirm.php');
    }

    public static function showOne(int $id, array $params): void
    {
        $bookModel = new BookModel();

        $apartment = $bookModel->checkAvailability(
            $id,
            $params['start_date'],
            $params['end_date']
        );

        require(__DIR__ . '/../../view/show_one_confirm.php');
    }

    public static function book(int $id): void
    {

        $bookModel = new BookModel();
        $bookModel->newBooking($id, $_POST['start_date'], $_POST['end_date']);

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

