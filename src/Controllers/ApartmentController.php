<?php

namespace Vita\Booking\Controllers;

use Vita\Booking\Exceptions\BadFileTypeException;
use Vita\Booking\Exceptions\PropertyNotFoundException;
use Vita\Booking\Exceptions\WrongFileUploadException;
use Vita\Booking\Models\ApartmentModel;
use Vita\Booking\Services\DatabaseService;

class ApartmentController
{
    public static function home(): void
    {
        $apartmentModel = new ApartmentModel();
        $apartments = $apartmentModel->getApartments();
        $cities = $apartmentModel->getUniqueCities();

        require(__DIR__ . '/../../view/home_page.php');
    }

    public static function index(): void
    {
        $apartmentModel = new ApartmentModel();
        $apartments = $apartmentModel->getApartments();
        $cities = $apartmentModel->getUniqueCities();

        require(__DIR__ . '/../../view/show_all.php');
    }

    public static function show(int $id): void
    {
        $message = '';

        try {
            $apartmentModel = new ApartmentModel();
            $apartment = $apartmentModel->getOneApartment($id);
        } catch (PropertyNotFoundException $exception) {
            $message = $exception->getMessage();
            require(__DIR__ . '/../../view/error_page.php');
        }

        if (strlen($message) === 0) {
            require(__DIR__ . '/../../view/show_one_need_date.php');
        }
    }

    public static function create(): void
    {
        require(__DIR__ . '/../../view/add_new_apartment.php');
    }

    public static function store(array $newApartment): void
    {
        $message = '';

        try {
            (new FileController())->imageValidation($_POST);
        } catch (WrongFileUploadException $exception) {
            $message = $exception->getMessage();
        } catch (BadFileTypeException $exception) {
            $message = $exception->getMessage();
        }

        if (strlen($message) === 0) {
            header('Location: /apartments');
        } else {
            require(__DIR__ . '/../../view/add_new_apartment.php');
            exit;
        }
        $database = new DatabaseService('apartments');
        $apartments = $database->get();

        $uploadedFileId = max(array_column($apartments, 'apartment_id')) + 1;
        $uploadedFileName = $uploadedFileId . '_' . uniqid() . strstr($_FILES['image']['full_path'], '.');
        $fileSavePath = __DIR__ . '/../../database/images/' . $uploadedFileName;
        $tempFilePath = $_FILES['image']['tmp_name'];
        move_uploaded_file($tempFilePath, $fileSavePath);

        $newDetails = [
            'name' => $newApartment['name'],
            'deposit' => (int)$newApartment['deposit'],
            'daily_price' => (int)$newApartment['daily_price'],
            'city' => $newApartment['city'],
            'description' => $newApartment['description'],
            'photo_name' => $uploadedFileName,
        ];

        $apartmentModel = new ApartmentModel();
        $apartmentModel->addNewApartment($newDetails);
    }

    public static function edit(): void
    {
        $apartmentModel = new ApartmentModel();
        $apartments = $apartmentModel->getApartments();

        require(__DIR__ . '/../../view/edit_apartments.php');
    }

    public static function change(int $id): void
    {
        $apartmentModel = new ApartmentModel();
        $apartment = $apartmentModel->getOneApartment($id);

        require(__DIR__ . '/../../view/edit_one_apartment.php');
    }

    public static function update(): void
    {
        $apartmentModel = new ApartmentModel();
        $apartmentModel->update($_POST);

        header('Location: /apartments/edit');
    }

    public static function destroy(): void
    {
        $apartmentModel = new ApartmentModel();
        $apartmentModel->delete($_POST);

        header('Location: /apartments/edit');
    }
}
