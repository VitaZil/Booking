<?php
namespace Vita\Booking\Controllers;
use Vita\Booking\Models\ApartmentModel;

class ApartmentController
{
    public static function home():void
    {
        $apartmentModel = new ApartmentModel();
        $apartments = $apartmentModel->getApartments();
        $cities = $apartmentModel->getUniqueCities();

        require (__DIR__ . '/../../view/home_page.php');
    }

    public static function index():void
    {
        $apartmentModel = new ApartmentModel();
        $apartments = $apartmentModel->getApartments();
        $cities = $apartmentModel->getUniqueCities();

        require (__DIR__ . '/../../view/show_all.php');
    }

    public static function show(int $id):void
    {
        $apartmentModel = new ApartmentModel();
        $apartment = $apartmentModel->getOneApartment($id);
        require (__DIR__ . '/../../view/show_one_need_date.php');
    }

    public static function create():void
    {
        require (__DIR__ . '/../../view/add_new_apartment.php');
    }

    public static function store(array $newApartment):void
    {
        $newDetails = [
            'name' => $newApartment['name'],
            'deposit' => $newApartment['deposit'],
            'daily_price' => $newApartment['daily_price'],
            'city' => $newApartment['city'],
            'description' => $newApartment['description'],
        ];

        $apartmentModel = new ApartmentModel();
        $apartmentModel->addNewApartment($newDetails);

        header('Location: /apartments/new/image');
    }

    public static function edit():void
    {
        $apartmentModel = new ApartmentModel();
        $apartments = $apartmentModel->getApartments();

        require (__DIR__ . '/../../view/edit_apartments.php');
    }

    public static function change(int $id):void
    {

        $apartmentModel = new ApartmentModel();
        $apartment = $apartmentModel->getOneApartment($id);

        require (__DIR__ . '/../../view/edit_one_apartment.php');
    }

    public static function update():void
    {
        $apartmentModel = new ApartmentModel();
        $apartmentModel->update($_POST);

        header('Location: /apartments/edit');
    }

    public static function destroy():void
    {
        $apartmentModel = new ApartmentModel();
        $apartmentModel->delete($_POST);

        header('Location: /apartments/edit');
    }
}